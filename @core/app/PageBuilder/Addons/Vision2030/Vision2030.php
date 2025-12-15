<?php

namespace App\PageBuilder\Addons\Vision2030;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class Vision2030 extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_five/vision_2030.jpg';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? __('دعم التحول الرقمي ضمن رؤية المملكة 2030'),
        ]);
        
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? __('نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 80,
            'max' => 500,
        ]);
        
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 80,
            'max' => 500,
        ]);
        
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? '#006633',
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render() : string
    {
        $settings = $this->get_settings();
        $title = $settings['title'] ?? __('دعم التحول الرقمي ضمن رؤية المملكة 2030');
        $subtitle = $settings['subtitle'] ?? __('نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم');
        
        $padding_top = $settings['padding_top'] ?? 80;
        $padding_bottom = $settings['padding_bottom'] ?? 80;
        $section_bg = $settings['section_bg'] ?? '#006633';

        return $this->renderBlade('vision2030.vision2030', [
            'title' => $title,
            'subtitle' => $subtitle,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
            'section_bg' => $section_bg,
        ]);
    }

    public function addon_title()
    {
        return __('رؤية المملكة 2030');
    }
}

