<?php

namespace App\PageBuilder\Addons\MainDepartments;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class MainDepartments extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/main_departments.jpg';
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
            'value' => $widget_saved_values['title'] ?? __('الأقسام الرئيسية في صيانة تك'),
        ]);
        
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? __('نقدم لكم مجموعة شاملة من الأقسام المتخصصة لتلبية جميع احتياجاتكم في مجال الصيانة والبناء'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 100,
            'max' => 500,
        ]);
        
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 100,
            'max' => 500,
        ]);
        
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? '#FFFFFF',
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render() : string
    {
        $settings = $this->get_settings();
        $title = $settings['title'] ?? __('الأقسام الرئيسية في صيانة تك');
        $subtitle = $settings['subtitle'] ?? __('نقدم لكم مجموعة شاملة من الأقسام المتخصصة لتلبية جميع احتياجاتكم في مجال الصيانة والبناء');
        
        $padding_top = $settings['padding_top'] ?? 100;
        $padding_bottom = $settings['padding_bottom'] ?? 100;
        $section_bg = $settings['section_bg'] ?? '#FFFFFF';

        return $this->renderBlade('main-departments.main-departments', [
            'title' => $title,
            'subtitle' => $subtitle,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
            'section_bg' => $section_bg,
        ]);
    }

    public function addon_title()
    {
        return __('الأقسام الرئيسية');
    }
}

