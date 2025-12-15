<?php

namespace App\WidgetsBuilder\Widgets;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\Category as CategoryModel;

class Category extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

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
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title_text = purify_html($settings['title'] ?? __('Categories'));
        $route = route('service.list.category');
        
        // Get only 3 categories: Electricity, Plumbing, Air Conditioning
        $electricityCategory = CategoryModel::where('status', 1)
            ->where(function($query) {
                $query->where('name', 'like', '%كهرباء%')
                      ->orWhere('name', 'like', '%electrical%')
                      ->orWhere('name', 'like', '%electricity%');
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '%كهرباء%' THEN 1
                    WHEN name LIKE '%electrical%' OR name LIKE '%electricity%' THEN 2
                    ELSE 3
                END
            ")
            ->first();
        
        $plumbingCategory = CategoryModel::where('status', 1)
            ->where(function($query) {
                $query->where('name', 'like', '%سباكة%')
                      ->orWhere('name', 'like', '%plumbing%');
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '%سباكة%' THEN 1
                    WHEN name LIKE '%plumbing%' THEN 2
                    ELSE 3
                END
            ")
            ->first();
        
        $acCategory = CategoryModel::where('status', 1)
            ->where(function($query) {
                $query->where('name', 'like', '%تكييف%')
                      ->orWhere('name', 'like', '%air conditioning%')
                      ->orWhere('name', 'like', '%ac%')
                      ->orWhere('name', 'like', '%hvac%');
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE '%تكييف%' THEN 1
                    WHEN name LIKE '%air conditioning%' OR name LIKE '%ac%' OR name LIKE '%hvac%' THEN 2
                    ELSE 3
                END
            ")
            ->first();
        
        $category_markup = '';
        
        if ($electricityCategory) {
            $category_name = $electricityCategory->name;
            $category_slug = $electricityCategory->slug;
            $category_markup.= <<<CATEGORY
    <li class="list"><a href="{$route}/{$category_slug}">{$category_name}</a></li>
CATEGORY;
        }
        
        if ($plumbingCategory) {
            $category_name = $plumbingCategory->name;
            $category_slug = $plumbingCategory->slug;
            $category_markup.= <<<CATEGORY
    <li class="list"><a href="{$route}/{$category_slug}">{$category_name}</a></li>
CATEGORY;
        }
        
        if ($acCategory) {
            $category_name = $acCategory->name;
            $category_slug = $acCategory->slug;
            $category_markup.= <<<CATEGORY
    <li class="list"><a href="{$route}/{$category_slug}">{$category_name}</a></li>
CATEGORY;
        }
   
   return <<<HTML
   <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer-widget widget">
            <h6 class="widget-title">{$title_text}</h6>
            <div class="footer-inner">
                <ul class="footer-link-list">
                    {$category_markup}
                </ul>
            </div>
        </div>
    </div>
HTML;
    }

    public function widget_title()
    {
        return __('Category');
    }

}