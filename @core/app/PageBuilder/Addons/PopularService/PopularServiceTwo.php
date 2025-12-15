<?php


namespace App\PageBuilder\Addons\PopularService;

use App\PageBuilder\Fields\ColorPicker;
use App\Service;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class PopularServiceTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/popular_service_2.png';
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
        $output .= Text::get([
            'name' => 'explore_all',
            'label' => __('Explore Text'),
            'value' => $widget_saved_values['explore_all'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'explore_link',
            'label' => __('Explore Link'),
            'value' => $widget_saved_values['explore_link'] ?? null,
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
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
        $output .= Text::get([
            'name' => 'book_appointment',
            'label' => __('Book Appoinment Button Text'),
            'value' => $widget_saved_values['book_appointment'] ?? 'Book Now',
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }
    

    public function frontend_render() : string
    {
        
        $settings = $this->get_settings();
        $section_title =$settings['title'];
        $explore_text =$settings['explore_all'];
        $explore_link =$settings['explore_link'];
        $explore_link =$settings['explore_link']?? route('service.all.popular');

        $items =$settings['items'];

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $book_appoinment = $settings['book_appointment'] ?? 'Book Now';


        //static text helpers
        $static_text = static_text();
        // تصفية الخدمات للتركيز على الكهرباء والسباكة والتكييف فقط
        $serviceKeywords = [
            'كهرباء', 'كهربائي', 'electrical', 'electricity', 'electric',
            'سباكة', 'سباك', 'plumbing', 'plumber', 'plumb',
            'تكييف', 'مكيف', 'air conditioning', 'ac', 'air conditioner', 'cooling'
        ];
        
        $services = Service::select('id','title','image','description','price','slug','seller_id','featured', 'service_city_id','is_service_online')
        ->where(['status'=>1,'is_service_on'=>1])
        ->where(function($query) use ($serviceKeywords) {
            foreach ($serviceKeywords as $index => $keyword) {
                if ($index === 0) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                } else {
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                }
            }
        })
        ->orderByRaw("
            CASE 
                WHEN title LIKE '%كهرباء%' OR title LIKE '%كهربائي%' OR title LIKE '%electrical%' OR title LIKE '%electricity%' OR title LIKE '%electric%' THEN 1
                WHEN title LIKE '%سباكة%' OR title LIKE '%سباك%' OR title LIKE '%plumbing%' OR title LIKE '%plumber%' THEN 2
                WHEN title LIKE '%تكييف%' OR title LIKE '%مكيف%' OR title LIKE '%air conditioning%' OR title LIKE '%ac%' OR title LIKE '%cooling%' THEN 3
                ELSE 4
            END
        ")
        ->orderBy('title', 'asc')
        ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
            $q->whereHas('seller_subscription');
        })
        ->take($items)
        ->get();

        $service_markup = '';
        foreach ($services as $service){
            
            // استخدام helper function لتحديد الأيقونة
            $serviceIconData = get_service_icon($service->title);
            $serviceIcon = $serviceIconData['icon'];
            $iconColor = $serviceIconData['color'];
            
            // لا نستخدم الصورة، فقط الأيقونة
            $title =  $service->title;    
            $route = route('service.list.details',$service->slug);   
            $book_now = route('service.list.book',$service->slug);   
            $price =  amount_with_currency_symbol($service->price); 
            $seller_image =  render_image_markup_by_attachment_id(optional($service->seller)->image,'','','thumb');
            $seller_name =  optional($service->seller)->name;
            $seller_service_location = sellerServiceLocation($service);

            //calculate each service rating and count review
            $total_review = optional($service->reviews->where('type', 1));
            $total_count = $total_review->count();
            $rating = round($total_review->avg('rating'),1);
            $seller_profile = route('about.seller.profile',optional($service->seller)->username);

            $rating_and_review='';
            if($rating >= 1){
                $rating_and_review .='<a href="javascript:void(0)">
                    <span class="reviews">'.ratting_star($rating). '('.$total_count.')'. '</span>
                </a>';
            }
            $featured ='';
            if($service->featured == 1){
                $featured .='<div class="award-icons">
                <i class="las la-award"></i>
                </div>';
            }

            $service_markup.= <<<SERVICE

                <div class="col-xl-3 col-lg-4 col-md-6 margin-top-30 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-service service-two style-03 section-bg-2">
                        <a href="{$route}" class="service-icon-thumb" style="position: relative; display: flex; align-items: center; justify-content: center; height: 220px; background: #FFFFFF; transition: all 0.3s ease;">
                            <i class="{$serviceIcon}" style="color: #000000; font-size: 80px; transition: all 0.3s ease;"></i>
                            
                            <div class="country_city_location" style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); padding: 15px;">
                                <span class="single_location" style="color: #fff; font-size: 13px; display: flex; align-items: center; gap: 5px;"> 
                                    <i class="las la-map-marker-alt"></i> {$seller_service_location}
                                </span>
                            </div>
                        </a>
                        <div class="services-contents">
                            <ul class="author-tag">
                                <li class="tag-list">
                                    <a href="{$seller_profile}">
                                        <div class="authors">
                                            <div class="thumb">
                                            {$seller_image}
                                                <span class="notification-dot"></span>
                                            </div>
                                            <span class="author-title"> {$seller_name} </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    {$rating_and_review}
                                </li>
                            </ul>
                            <h5 class="common-title"> <a href="{$route}">{$title} </a> </h5>
                            <div class="service-price-wrapper">
                                <div class="service-price">
                                    <span class="prices style-02"> {$price} </span>
                                </div>
                                <div class="btn-wrapper">
                                    <a href="{$book_now}" class="cmn-btn btn-small btn-outline-3"> {$book_appoinment} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

SERVICE;
        
}

return <<<HTML
    <!-- Popular Service area starts -->
    <section class="services-area"  data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title">{$section_title}</h3>
                        <a href="{$explore_link}" class="section-btn">{$explore_text}</a>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                    {$service_markup}
            </div>
        </div>
    </section>
    <!-- Popular Service area end -->
    <style>
    .services-area .cmn-btn.btn-outline-3 {
        background: #10b981 !important;
        color: #fff !important;
        border: 2px solid #10b981 !important;
    }
    .services-area .cmn-btn.btn-outline-3:hover {
        background: #059669 !important;
        color: #fff !important;
        border-color: #059669 !important;
    }
    </style>
    
HTML;

}

    public function addon_title()
    {
       return __('Popular Service: 02') . ' <span class="text-danger">(' . __('Deprecated') . ')</span>';
    }
}