@php
    // Get the 3 main categories
    $electricityCategory = \App\Category::where('status', 1)
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
    
    $plumbingCategory = \App\Category::where('status', 1)
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
    
    $acCategory = \App\Category::where('status', 1)
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
    
    $categoryRoute = route('service.list.category');
    $siteLogo = render_image_markup_by_attachment_id(get_static_option('site_logo'));
    $siteDescription = get_static_option('site_tag_line') ?? 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية.';
@endphp

<footer class="footer-area" style="background: #000000; color: #FFFFFF;">
    <div class="footer-top padding-top-100 padding-bottom-70" style="background: #000000;">
        <div class="container container-two">
            <div class="row">
                <!-- About Us Section -->
                <div class="col-lg-4 col-md-6 col-sm-12 margin-bottom-30">
                    <div class="footer-widget widget">
                        <div class="about_us_widget">
                            <a href="{{ route('qr.index') }}" class="footer-logo" style="display: block; margin-bottom: 20px;">
                                {!! $siteLogo !!}
                            </a>
                        </div>
                        <div class="footer-inner">
                            <p class="footer-para" style="color: #CCCCCC; line-height: 1.8; font-size: 14px; margin-bottom: 20px;">
                                {{ $siteDescription }}
                            </p>
                            <div class="footer-socials">
                                <ul class="footer-social-list" style="display: flex; gap: 15px; list-style: none; padding: 0;">
                                    @if(!empty(get_static_option('site_facebook_link')))
                                    <li class="lists">
                                        <a href="{{ get_static_option('site_facebook_link') }}" target="_blank" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #FFD700; border-radius: 50%; color: #000000; text-decoration: none; transition: all 0.3s;">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(get_static_option('site_twitter_link')))
                                    <li class="lists">
                                        <a href="{{ get_static_option('site_twitter_link') }}" target="_blank" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #FFD700; border-radius: 50%; color: #000000; text-decoration: none; transition: all 0.3s;">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(get_static_option('site_instagram_link')))
                                    <li class="lists">
                                        <a href="{{ get_static_option('site_instagram_link') }}" target="_blank" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #FFD700; border-radius: 50%; color: #000000; text-decoration: none; transition: all 0.3s;">
                                            <i class="lab la-instagram"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(get_static_option('site_whatsapp_link')))
                                    <li class="lists">
                                        <a href="{{ get_static_option('site_whatsapp_link') }}" target="_blank" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #FFD700; border-radius: 50%; color: #000000; text-decoration: none; transition: all 0.3s;">
                                            <i class="lab la-whatsapp"></i>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Categories Section -->
                <div class="col-lg-3 col-md-6 col-sm-12 margin-bottom-30">
                    <div class="footer-widget widget">
                        <h6 class="widget-title" style="color: #FFD700; font-size: 18px; font-weight: 700; margin-bottom: 25px; text-transform: uppercase;">{{ __('Our Services') }}</h6>
                        <div class="footer-inner">
                            <ul class="footer-link-list" style="list-style: none; padding: 0;">
                                @if($electricityCategory)
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; display: flex; align-items: center; gap: 10px; transition: all 0.3s;">
                                        <i class="las la-bolt" style="color: #FFD700; font-size: 18px;"></i>
                                        <span>{{ $electricityCategory->name }}</span>
                                    </a>
                                </li>
                                @endif
                                @if($plumbingCategory)
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; display: flex; align-items: center; gap: 10px; transition: all 0.3s;">
                                        <i class="las la-tools" style="color: #FFD700; font-size: 18px;"></i>
                                        <span>{{ $plumbingCategory->name }}</span>
                                    </a>
                                </li>
                                @endif
                                @if($acCategory)
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; display: flex; align-items: center; gap: 10px; transition: all 0.3s;">
                                        <i class="las la-snowflake" style="color: #FFD700; font-size: 18px;"></i>
                                        <span>{{ $acCategory->name }}</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Quick Links Section -->
                <div class="col-lg-2 col-md-6 col-sm-12 margin-bottom-30">
                    <div class="footer-widget widget">
                        <h6 class="widget-title" style="color: #FFD700; font-size: 18px; font-weight: 700; margin-bottom: 25px; text-transform: uppercase;">{{ __('Quick Links') }}</h6>
                        <div class="footer-inner">
                            <ul class="footer-link-list" style="list-style: none; padding: 0;">
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ __('Home') }}</a>
                                </li>
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ __('About Us') }}</a>
                                </li>
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ __('Services') }}</a>
                                </li>
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ __('Contact Us') }}</a>
                                </li>
                                <li class="list" style="margin-bottom: 12px;">
                                    <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; font-size: 15px; transition: all 0.3s;">{{ __('Register') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Section -->
                <div class="col-lg-3 col-md-6 col-sm-12 margin-bottom-30">
                    <div class="footer-widget widget">
                        <h6 class="widget-title" style="color: #FFD700; font-size: 18px; font-weight: 700; margin-bottom: 25px; text-transform: uppercase;">{{ __('Contact Info') }}</h6>
                        <div class="footer-inner">
                            <ul class="footer-link-address" style="list-style: none; padding: 0;">
                                @if(!empty(get_static_option('site_contact_address')))
                                <li class="list" style="margin-bottom: 15px; display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="las la-map-marker-alt" style="color: #FFD700; font-size: 20px; margin-top: 3px;"></i>
                                    <span style="color: #CCCCCC; font-size: 14px; line-height: 1.6;">{{ get_static_option('site_contact_address') }}</span>
                                </li>
                                @endif
                                @if(!empty(get_static_option('site_contact_phone')))
                                <li class="list" style="margin-bottom: 15px; display: flex; align-items: center; gap: 12px;">
                                    <i class="las la-phone" style="color: #FFD700; font-size: 20px;"></i>
                                    <a href="tel:{{ get_static_option('site_contact_phone') }}" style="color: #CCCCCC; text-decoration: none; font-size: 14px;">{{ get_static_option('site_contact_phone') }}</a>
                                </li>
                                @endif
                                @if(!empty(get_static_option('site_global_email')))
                                <li class="list" style="margin-bottom: 15px; display: flex; align-items: center; gap: 12px;">
                                    <i class="las la-envelope" style="color: #FFD700; font-size: 20px;"></i>
                                    <a href="mailto:{{ get_static_option('site_global_email') }}" style="color: #CCCCCC; text-decoration: none; font-size: 14px;">{{ get_static_option('site_global_email') }}</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Vision 2030 Section -->
    <div class="vision-2030-section" style="background: linear-gradient(135deg, #006633 0%, #004d26 100%); border-top: 2px solid rgba(255, 215, 0, 0.3); padding: 50px 0; position: relative; overflow: hidden;">
        <!-- Background Pattern -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"1\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        
        <div class="container container-two" style="position: relative; z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7">
                    <div class="vision-2030-text" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <i class="las la-flag" style="color: #FFD700; font-size: 36px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);"></i>
                        <div>
                            <h4 style="color: #FFFFFF; font-size: 20px; font-weight: 700; margin: 0 0 8px 0; text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">
                                {{ __('دعم التحول الرقمي ضمن رؤية المملكة 2030') }}
                            </h4>
                            <p style="color: rgba(255, 255, 255, 0.9); font-size: 14px; margin: 0; line-height: 1.6;">
                                {{ __('نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 text-center text-md-left">
                    <div class="vision-2030-logo" style="position: relative;">
                        <a href="https://www.vision2030.gov.sa/ar/" target="_blank" rel="noopener noreferrer" style="display: inline-block; transition: all 0.4s ease; position: relative;">
                        <img src="{{ asset('assets/frontend/img/Saudi_Vision_2030_logo.svg.png') }}" 
                             alt="رؤية المملكة 2030" 
                             style="max-height: 120px; width: auto; filter: brightness(1.1) drop-shadow(0 6px 15px rgba(0,0,0,0.4)); transition: all 0.4s ease; display: block;"
                             onerror="this.onerror=null; this.src='{{ asset('assets/frontend/img/Saudi_Vision_2030_logo.svg.png') }}';">

                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,215,0,0.1); opacity: 0; transition: opacity 0.4s ease; border-radius: 10px;"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div style="position: absolute; top: -20%; right: -5%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(255, 215, 0, 0.15) 0%, transparent 70%); border-radius: 50%; z-index: 1;"></div>
        <div style="position: absolute; bottom: -15%; left: -3%; width: 150px; height: 150px; background: radial-gradient(circle, rgba(255, 215, 0, 0.12) 0%, transparent 70%); border-radius: 50%; z-index: 1;"></div>
    </div>
    
    <style>
        .vision-2030-section a:hover img {
            transform: scale(1.08) rotate(2deg);
            filter: brightness(1.3) drop-shadow(0 6px 15px rgba(255,215,0,0.3)) !important;
        }
        .vision-2030-section a:hover div {
            opacity: 1 !important;
        }
        @media (max-width: 767px) {
            .vision-2030-section {
                padding: 35px 0 !important;
            }
            .vision-2030-text {
                justify-content: center !important;
                text-align: center !important;
            }
            .vision-2030-text h4 {
                font-size: 18px !important;
            }
            .vision-2030-logo img {
                max-height: 60px !important;
            }
        }
    </style>
    
    <!-- Copyright Section -->
    <div class="copyright-area style-02 copyright-border" style="background: #000000; border-top: 1px solid rgba(255, 255, 255, 0.1); padding: 25px 0;">
        <div class="container container-two">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text" style="color: #CCCCCC; font-size: 14px;">
                        {!! render_footer_copyright_text() !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 text-right">
                    <div class="copyright-links" style="color: #CCCCCC; font-size: 14px;">
                        <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; margin-left: 20px; transition: all 0.3s;">{{ __('Privacy Policy') }}</a>
                        <a href="{{ route('qr.index') }}" style="color: #CCCCCC; text-decoration: none; margin-left: 20px; transition: all 0.3s;">{{ __('Terms & Conditions') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.footer-area .footer-widget .widget-title {
    position: relative;
    padding-bottom: 15px;
}

.footer-area .footer-widget .widget-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 50px;
    height: 3px;
    background: #FFD700;
}

.footer-area .footer-link-list a:hover,
.footer-area .footer-link-address a:hover {
    color: #FFD700 !important;
    padding-right: 5px;
}

.footer-area .footer-social-list a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

@media (max-width: 768px) {
    .footer-area .footer-top {
        padding: 60px 0 40px !important;
    }
    
    .footer-area .margin-bottom-30 {
        margin-bottom: 40px;
    }
}
</style>

