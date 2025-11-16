<?php

namespace App\PageBuilder\Addons\WhyOurMarketplace;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Fields\Image;

class WhyOurMarketplaceThree extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/why_our_marketplace_3.jpg';
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
            'value' => $widget_saved_values['title'] ?? null,
        ]);
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 260,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 190,
            'max' => 500,
        ]);
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);

        // Register Button
        $output .= Text::get([
            'name' => 'customer_btn_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values['customer_btn_text'] ?? __('Join As A Customer'),
        ]);
        $output .= Text::get([
            'name' => 'customer_btn_link',
            'label' => __('Button Link'),
            'value' => $widget_saved_values['customer_btn_link'] ?? route('user.register'),
        ]);


        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'contact_page_contact_info_01',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Image')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description',
                    'label' => __('Details'),
                    'info' => __('new line count as a separate text')
                ],

            ]
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render() : string
    {
        $settings = $this->get_settings();
        $section_title =$settings['title'] ?? '';
        $subtitle = $settings['subtitle'] ?? '';

        $padding_top = $settings['padding_top'] ?? '';
        $padding_bottom = $settings['padding_bottom'] ?? '';
        $section_bg = $settings['section_bg'] ?? '';
        
        $customer_btn_text = $settings['customer_btn_text'] ?? __('Join As A Customer');
        $customer_btn_link = $settings['customer_btn_link'] ?? '';
        // Always use route() to ensure correct domain
        if(empty($customer_btn_link) || strpos($customer_btn_link, 'bytesed.com') !== false || strpos($customer_btn_link, 'qixer') !== false){
            $customer_btn_link = route('user.register');
        }
        
        $repeater_data = $settings['contact_page_contact_info_01'];


    return $this->renderBlade('marketplaces.why-our-marketplace-three',[
        'padding_top' => $padding_top,
        'padding_bottom' => $padding_bottom,
        'section_bg' => $section_bg,
        'section_title' => $section_title,
        'subtitle' => $subtitle,
        'customer_btn_text' => $customer_btn_text,
        'customer_btn_link' => $customer_btn_link,
        'repeater_data' => $repeater_data
    ]);

}

    public function addon_title()
    {
        return __('Why Our Marketplace: 03');
    }
}