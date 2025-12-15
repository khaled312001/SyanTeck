<?php

namespace App\PageBuilder\Addons\MainSections;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\IconPicker;

class MainSections extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_five/main_sections.jpg';
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
            'value' => $widget_saved_values['title'] ?? __('الأقسام الرئيسية'),
        ]);
        
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? __('نوفر خدمات متكاملة في مختلف المجالات'),
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
            'value' => $widget_saved_values['section_bg'] ?? '#ffffff',
        ]);

        // Section 1: Maintenance
        $output .= Text::get([
            'name' => 'maintenance_title',
            'label' => __('صيانة - العنوان'),
            'value' => $widget_saved_values['maintenance_title'] ?? __('صيانة'),
        ]);
        
        $output .= Textarea::get([
            'name' => 'maintenance_description',
            'label' => __('صيانة - الوصف'),
            'value' => $widget_saved_values['maintenance_description'] ?? __('خدمات صيانة شاملة لجميع الأجهزة والأنظمة'),
        ]);
        
        $output .= IconPicker::get([
            'name' => 'maintenance_icon',
            'label' => __('صيانة - الأيقونة'),
            'value' => $widget_saved_values['maintenance_icon'] ?? 'las la-tools',
        ]);
        
        $output .= Text::get([
            'name' => 'maintenance_link',
            'label' => __('صيانة - الرابط'),
            'value' => $widget_saved_values['maintenance_link'] ?? route('all.sellers'),
        ]);

        // Section 2: Finishing
        $output .= Text::get([
            'name' => 'finishing_title',
            'label' => __('تشطيب - العنوان'),
            'value' => $widget_saved_values['finishing_title'] ?? __('تشطيب'),
        ]);
        
        $output .= Textarea::get([
            'name' => 'finishing_description',
            'label' => __('تشطيب - الوصف'),
            'value' => $widget_saved_values['finishing_description'] ?? __('خدمات تشطيب وتنفيذ ديكورات عالية الجودة'),
        ]);
        
        $output .= IconPicker::get([
            'name' => 'finishing_icon',
            'label' => __('تشطيب - الأيقونة'),
            'value' => $widget_saved_values['finishing_icon'] ?? 'las la-paint-roller',
        ]);

        // Section 3: Foundation
        $output .= Text::get([
            'name' => 'foundation_title',
            'label' => __('تأسيس - العنوان'),
            'value' => $widget_saved_values['foundation_title'] ?? __('تأسيس'),
        ]);
        
        $output .= Textarea::get([
            'name' => 'foundation_description',
            'label' => __('تأسيس - الوصف'),
            'value' => $widget_saved_values['foundation_description'] ?? __('خدمات تأسيس وبناء متكاملة'),
        ]);
        
        $output .= IconPicker::get([
            'name' => 'foundation_icon',
            'label' => __('تأسيس - الأيقونة'),
            'value' => $widget_saved_values['foundation_icon'] ?? 'las la-building',
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render() : string
    {
        $settings = $this->get_settings();
        $title = $settings['title'] ?? __('الأقسام الرئيسية');
        $subtitle = $settings['subtitle'] ?? __('نوفر خدمات متكاملة في مختلف المجالات');
        
        $padding_top = $settings['padding_top'] ?? 100;
        $padding_bottom = $settings['padding_bottom'] ?? 100;
        $section_bg = $settings['section_bg'] ?? '#ffffff';
        
        // Maintenance Section
        $maintenance_title = $settings['maintenance_title'] ?? __('صيانة');
        $maintenance_description = $settings['maintenance_description'] ?? __('خدمات صيانة شاملة لجميع الأجهزة والأنظمة');
        $maintenance_icon = $settings['maintenance_icon'] ?? 'las la-tools';
        $maintenance_link = $settings['maintenance_link'] ?? route('all.sellers');
        
        // Finishing Section
        $finishing_title = $settings['finishing_title'] ?? __('تشطيب');
        $finishing_description = $settings['finishing_description'] ?? __('خدمات تشطيب وتنفيذ ديكورات عالية الجودة');
        $finishing_icon = $settings['finishing_icon'] ?? 'las la-paint-roller';
        
        // Foundation Section
        $foundation_title = $settings['foundation_title'] ?? __('تأسيس');
        $foundation_description = $settings['foundation_description'] ?? __('خدمات تأسيس وبناء متكاملة');
        $foundation_icon = $settings['foundation_icon'] ?? 'las la-building';

        return $this->renderBlade('main-sections.main-sections', [
            'title' => $title,
            'subtitle' => $subtitle,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
            'section_bg' => $section_bg,
            'maintenance_title' => $maintenance_title,
            'maintenance_description' => $maintenance_description,
            'maintenance_icon' => $maintenance_icon,
            'maintenance_link' => $maintenance_link,
            'finishing_title' => $finishing_title,
            'finishing_description' => $finishing_description,
            'finishing_icon' => $finishing_icon,
            'foundation_title' => $foundation_title,
            'foundation_description' => $foundation_description,
            'foundation_icon' => $foundation_icon,
        ]);
    }

    public function addon_title()
    {
        return __('الأقسام الرئيسية');
    }
}

