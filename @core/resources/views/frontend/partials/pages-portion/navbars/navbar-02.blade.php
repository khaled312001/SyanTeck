@php
    if(request()->is('/')){
        $page__id = get_static_option('home_page');
        $page_details = App\Page::find($page__id);
        $page_post = isset($page_post) && is_null($page_details) ? $page_post : $page_details;
    }
@endphp
<header class="header-style-02">
    {{-- Top Bar - شريط علوي منظم --}}
    <div class="top-bar-modern">
        <div class="container container-two">
            <div class="row align-items-center">
                {{-- Left Side: Contact Info --}}
                <div class="col-lg-6 col-md-6 col-12 order-lg-1 order-md-1 order-1">
                    <div class="top-bar-contact-info">
                        @php
                            $phone = get_static_option('site_contact_phone') ?: '+966 50 123 4567';
                            // البريد الإلكتروني ثابت
                            $email = 'info@syanatech.com';
                        @endphp
                        <a href="tel:{{ str_replace(' ', '', $phone) }}" class="contact-item phone-item">
                            <i class="las la-phone"></i>
                            <span>{{ $phone }}</span>
                        </a>
                        <a href="mailto:{{ $email }}" class="contact-item email-item">
                            <i class="las la-envelope"></i>
                            <span>{{ $email }}</span>
                        </a>
                    </div>
                </div>
                
                {{-- Right Side: Language & Social Media --}}
                <div class="col-lg-6 col-md-6 col-12 order-lg-2 order-md-2 order-2">
                    <div class="top-bar-actions">
                        @php
                            $all_languages = \App\Helpers\LanguageHelper::all_languages();
                            $current_lang = \App\Helpers\LanguageHelper::user_lang();
                        @endphp
                        
                        {{-- Language Switcher - قائمة منسدلة مع أعلام --}}
                        @if($all_languages->count() > 1)
                        <div class="language-switcher-wrapper">
                            <div class="lang-dropdown">
                                <button type="button" class="lang-dropdown-toggle" id="langDropdownToggle">
                                    @php
                                        $currentFlag = '';
                                        if($current_lang) {
                                            if($current_lang->slug == 'ar') {
                                                $currentFlag = '🇸🇦';
                                            } elseif($current_lang->slug == 'en') {
                                                $currentFlag = '🇬🇧';
                                            }
                                        }
                                    @endphp
                                    <span class="lang-flag">{{ $currentFlag }}</span>
                                    <span class="lang-name">{{ $current_lang ? $current_lang->name : 'العربية' }}</span>
                                    <i class="las la-chevron-down"></i>
                                </button>
                                <div class="lang-dropdown-menu" id="langDropdownMenu">
                                    @foreach($all_languages as $lang)
                                        @php
                                            $flag = '';
                                            if($lang->slug == 'ar') {
                                                $flag = '🇸🇦';
                                            } elseif($lang->slug == 'en') {
                                                $flag = '🇬🇧';
                                            }
                                        @endphp
                                        <form action="{{ route('frontend.lang.change') }}" method="POST" class="lang-dropdown-item-form">
                                            @csrf
                                            <input type="hidden" name="lang" value="{{ $lang->slug }}">
                                            <button type="submit" class="lang-dropdown-item {{ $current_lang && $current_lang->slug === $lang->slug ? 'active' : '' }}">
                                                <span class="lang-flag">{{ $flag }}</span>
                                                <span class="lang-name">{{ $lang->name }}</span>
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        {{-- Social Media Icons --}}
                        <div class="social-icons-group">
                            @php
                                $socialLinks = [
                                    'site_facebook_link' => 'lab la-facebook-f',
                                    'site_twitter_link' => 'lab la-twitter',
                                    'site_instagram_link' => 'lab la-instagram',
                                    'site_linkedin_link' => 'lab la-linkedin-in',
                                    'site_youtube_link' => 'lab la-youtube',
                                    'site_whatsapp_link' => 'lab la-whatsapp',
                                ];
                            @endphp
                            @foreach($socialLinks as $optionKey => $iconClass)
                                @if(!empty(get_static_option($optionKey)))
                                <a href="{{ get_static_option($optionKey) }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="social-icon-link"
                                   aria-label="{{ str_replace('site_', '', str_replace('_link', '', $optionKey)) }}">
                                    <i class="{{ $iconClass }}"></i>
                                </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* ============================================
           Modern Top Bar - Premium Design
           ============================================ */
        .top-bar-modern {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 215, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        .lang-dropdown-wrapper {
            position: relative;
            z-index: 10050;
        }

        /* Contact Info Section */
        .top-bar-contact-info {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #FFFFFF;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .contact-item i {
            color: #FFD700;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            color: #FFD700;
            transform: translateY(-2px);
        }

        .contact-item:hover i {
            transform: scale(1.1);
        }

        .phone-item span {
            direction: ltr;
            display: inline-block;
        }

        /* Actions Section (Language + Social) */
        .top-bar-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* Language Switcher - قائمة منسدلة مع أعلام */
        .language-switcher-wrapper {
            display: flex;
            align-items: center;
            position: relative;
            z-index: 10050;
        }

        .lang-dropdown {
            position: relative;
            z-index: 10050;
        }

        .lang-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 2px solid rgba(255, 215, 0, 0.4);
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.15) 0%, rgba(255, 215, 0, 0.25) 100%);
            backdrop-filter: blur(10px);
            color: #FFD700;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.2);
        }

        .lang-dropdown-toggle:hover {
            border-color: rgba(255, 215, 0, 0.7);
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.25) 0%, rgba(255, 215, 0, 0.35) 100%);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        .lang-dropdown-toggle i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .lang-dropdown.active .lang-dropdown-toggle i {
            transform: rotate(180deg);
        }

        .lang-flag {
            font-size: 18px;
            line-height: 1;
        }

        .lang-name {
            font-size: 13px;
        }

        .lang-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 180px;
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.98) 0%, rgba(45, 45, 45, 0.98) 100%);
            backdrop-filter: blur(20px);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 10050 !important;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .lang-dropdown.active .lang-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .lang-dropdown-item-form {
            margin: 0;
            width: 100%;
        }

        .lang-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 16px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: right;
        }

        .lang-dropdown-item:hover {
            background: rgba(255, 215, 0, 0.15);
            color: #FFD700;
        }

        .lang-dropdown-item.active {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.3) 0%, rgba(255, 215, 0, 0.4) 100%);
            color: #FFD700;
        }

        .lang-dropdown-item .lang-flag {
            font-size: 20px;
        }

        /* Social Media Icons */
        .social-icons-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .social-icon-link {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFD700;
            border-radius: 50%;
            color: #000000;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        }

        .social-icon-link:hover {
            background: #FFA500;
            transform: scale(1.15) translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.5);
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .top-bar-modern {
                padding: 10px 0;
            }

            .top-bar-contact-info {
                justify-content: center;
                gap: 15px;
            }

            .top-bar-actions {
                justify-content: center;
                gap: 12px;
            }
            
            /* إخفاء زر اللغة من الشريط العلوي في الموبايل */
            .language-switcher-wrapper {
                display: none !important;
            }
            
            .lang-dropdown {
                display: none !important;
            }
        }

        @media (max-width: 767.98px) {
            .top-bar-modern {
                padding: 8px 0;
            }

            .top-bar-contact-info {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .contact-item {
                font-size: 12px;
            }

            .contact-item i {
                font-size: 16px;
            }

            .top-bar-actions {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .social-icons-group {
                justify-content: center;
                flex-wrap: wrap;
            }

            .social-icon-link {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            /* إخفاء زر اللغة من الشريط العلوي في الموبايل */
            .language-switcher-wrapper {
                display: none !important;
            }

            /* تعديل القائمة المنسدلة في الموبايل */
            .lang-dropdown-menu {
                right: auto;
                left: 0;
                min-width: 150px;
            }
        }
    </style>
    
<nav class="navbar navbar-area navbar-two enhanced-navbar {{ $page_post->page_class ?? '' }} navbar-expand-lg" id="mainNavbar" style="padding: 12px 0; background: #FFFFFF !important; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);">
    <div class="container container-two nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper">
                <a href="{{ route('homepage') }}" class="logo" style="transition: transform 0.3s ease;">
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                </a>
            </div>

            {{-- User menu removed from here - will be in mobile sidebar --}}
            <button class="navbar-toggler black-color enhanced-navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#bizcoxx_main_menu_navabar_two" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-text">القائمة</span>
            </button>
        </div>

        <div class="collapse navbar-collapse enhanced-navbar-collapse" id="bizcoxx_main_menu_navabar_two">
            {{-- Close Button (X) for Mobile Sidebar --}}
            <button type="button" class="mobile-sidebar-close-btn" id="mobileSidebarCloseBtn" aria-label="إغلاق القائمة">
                <i class="las la-times"></i>
            </button>
            
            <ul class="navbar-nav enhanced-navbar-nav ms-auto">
                {!! render_frontend_menu($primary_menu) !!}
            </ul>
            
            {{-- Language Switcher for Mobile --}}
            @php
                $all_languages_mobile = \App\Helpers\LanguageHelper::all_languages();
                $current_lang_mobile = \App\Helpers\LanguageHelper::user_lang();
            @endphp
            @if($all_languages_mobile->count() > 1)
            <div class="mobile-language-switcher-wrapper">
                <div class="mobile-lang-options">
                    @foreach($all_languages_mobile as $lang)
                        <form action="{{ route('frontend.lang.change') }}" method="POST" class="lang-form-mobile-item" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="lang" value="{{ $lang->slug }}">
                            <button type="submit" class="mobile-lang-button {{ $current_lang_mobile && $current_lang_mobile->slug === $lang->slug ? 'active' : '' }}">
                                {{ $lang->name }}
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
            @endif
            
            {{-- User Menu for Mobile Sidebar --}}
            <div class="mobile-user-menu-wrapper">
                <x-frontend.user-menu/>
            </div>
            
            <div class="nav-right-content enhanced-nav-right">
                <div class="navbar-right-inner">
                <div class="info-bar-item">
                    @if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0)
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0)
                            <div class="notification-icon icon">
                                @if(Auth::guard('web')->check())
                                    <i class="las la-bell"></i>
                                    <span class="notification-number style-02">
                                {{ Auth()->user()->unreadNotifications()->count() }}
                            </span>
                                @endif

                                <div class="notification-list-item mt-2">
                                    <h5 class="notification-title">{{ __('Notifications') }}</h5>
                                    <div class="list">
                                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->count() >=1)
                                            <span>
                                        @foreach(Auth::user()->unreadNotifications->take(5) as $notification)

                                          <!-- seller ticket Notifications-->
                                        @foreach(Auth::guard('web')->user()->unreadNotifications->take(10) as $notification)
                                            @if(isset($notification->data['seller_last_ticket_id']))
                                                <a class="list-order" href="{{ route('seller.support.ticket.view',$notification->data['seller_last_ticket_id']) }}">
                                                <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                {{ $notification->data['order_ticcket_message']  }} #{{ $notification->data['seller_last_ticket_id'] }}
                                            </a>
                                              @endif
                                        @endforeach

                                          <!-- seller order Notifications-->
                                        @if(isset($notification->data['order_id']))
                                            <a class="list-order" href="{{ route('seller.order.details',$notification->data['order_id']) }}">
                                                <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                {{ $notification->data['order_message'] }} #{{ $notification->data['order_id'] }}
                                            </a>
                                        @endif
                                    @endforeach

                                    </span>
                                            <a class="p-2 text-center d-block" href="{{ route('seller.notification.all') }}">{{ __('View All Notification') }}</a>
                                        @else
                                            <p class="text-center padding-3">{{ __('No New Notification') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <x-frontend.user-menu/>
                </div>
            </div>
        </div>
    </div>
</nav>
</header>

<style>
/* ============================================
   Modern Enhanced Navbar 02 - Premium Design
   ============================================ */

/* Mobile Sidebar Overlay */
.mobile-sidebar-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
    z-index: 999998 !important; /* تحت السايدبار مباشرة */
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-sidebar-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Enhanced Navbar Styles - Modern Premium Design */
.enhanced-navbar {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1050;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    background: #FFFFFF !important;
}

/* على الموبايل، تقليل z-index للهيدر ليكون تحت الـ sidebar */
@media (max-width: 991.98px) {
    .enhanced-navbar {
        z-index: 1000 !important;
    }
    
    .top-bar-modern {
        z-index: 999 !important;
    }
}

.enhanced-navbar .nav-container {
    padding: 10px 0 !important;
    min-height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.enhanced-navbar.scrolled {
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.enhanced-navbar.scrolled .nav-container {
    padding: 8px 0 !important;
    min-height: 60px;
}

.enhanced-navbar .logo-wrapper {
    display: flex;
    align-items: center;
    min-width: 150px;
}

.enhanced-navbar .logo {
    display: inline-block;
    transition: all 0.3s ease;
}

.enhanced-navbar .logo:hover {
    transform: scale(1.05);
}

.enhanced-navbar .logo img {
    max-height: 45px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: all 0.3s ease;
}

.enhanced-navbar.scrolled .logo img {
    max-height: 40px;
}

.enhanced-navbar-toggler {
    border: 2px solid rgba(255, 215, 0, 0.3) !important;
    border-radius: 10px;
    padding: 10px 16px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 120px;
    justify-content: center;
}

.enhanced-navbar-toggler:hover {
    border-color: rgba(255, 215, 0, 0.6) !important;
    background: rgba(255, 215, 0, 0.1);
    transform: translateY(-1px);
}

.enhanced-navbar-toggler .navbar-toggler-text {
    font-size: 15px;
    font-weight: 600;
    color: #FFD700;
    letter-spacing: 0.3px;
}

.enhanced-navbar-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    padding: 0;
}

.enhanced-navbar-nav > li {
    margin: 0;
    padding: 0;
}

.enhanced-navbar-nav > li > a {
    padding: 12px 22px !important;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-weight: 600;
    font-size: 16px;
    line-height: 1.5;
    position: relative;
    overflow: hidden;
    display: inline-block;
    white-space: nowrap;
    background: transparent;
    color: #1a1a1a !important;
}

.enhanced-navbar-nav > li > a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateX(-50%);
    border-radius: 3px 3px 0 0;
}

.enhanced-navbar-nav > li > a::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 215, 0, 0.1);
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
    z-index: -1;
}

.enhanced-navbar-nav > li:hover > a,
.enhanced-navbar-nav > li.active > a {
    color: #FFD700 !important;
    background: rgba(255, 215, 0, 0.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
}

.enhanced-navbar-nav > li:hover > a::before,
.enhanced-navbar-nav > li.active > a::before {
    width: 85%;
}

.enhanced-navbar-nav > li:hover > a::after {
    width: 100px;
    height: 100px;
}

.enhanced-request-btn {
    position: relative;
    overflow: hidden;
    font-size: 15px !important;
    padding: 14px 32px !important;
    border-radius: 35px !important;
    font-weight: 700 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    white-space: nowrap;
}

.enhanced-request-btn i {
    font-size: 18px !important;
}

.enhanced-request-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(255, 215, 0, 0.5) !important;
    background: #FFD700 !important;
}

.enhanced-request-btn .btn-ripple-effect {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.enhanced-request-btn:hover .btn-ripple-effect {
    width: 300px;
    height: 300px;
}

.request-service-btn-wrapper {
    display: flex;
    align-items: center;
}

.enhanced-nav-right {
    display: flex;
    align-items: center;
    gap: 20px;
    min-width: fit-content;
}

/* التأكد من أن زر اللغة لا يظهر في الشريط الرئيسي (الهيدر) - فقط في الـ top bar */
.enhanced-navbar .language-switcher-wrapper,
.enhanced-navbar .lang-dropdown,
.enhanced-navbar-collapse .language-switcher-wrapper,
.enhanced-navbar-collapse .lang-dropdown,
.nav-right-content .language-switcher-wrapper,
.nav-right-content .lang-dropdown {
    display: none !important;
}

/* التأكد من أن زر اللغة يظهر فقط في الـ top bar */
/* إظهار زر اللغة في الـ top bar على الديسكتوب فقط */
@media (min-width: 992px) {
    .top-bar-modern .language-switcher-wrapper,
    .top-bar-modern .lang-dropdown {
        display: flex !important;
    }
}

/* إخفاء زر اللغة من الـ top bar على الموبايل */
@media (max-width: 991.98px) {
    .top-bar-modern .language-switcher-wrapper,
    .top-bar-modern .lang-dropdown,
    .top-bar-modern .top-bar-actions .language-switcher-wrapper,
    .top-bar-modern .top-bar-actions .lang-dropdown {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        width: 0 !important;
        overflow: hidden !important;
    }
}

/* Desktop: Keep nav-right-content outside collapse */
@media (min-width: 992px) {
    .enhanced-navbar .nav-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .enhanced-navbar-collapse {
        flex-grow: 1;
    }
    
    /* إظهار nav-right-content على الديسكتوب */
    .enhanced-nav-right {
        display: flex !important;
        flex-direction: row;
        align-items: center;
        gap: 20px;
    }
    
    /* إظهار login-account على الديسكتوب */
    .enhanced-nav-right .login-account {
        display: block !important;
    }
    
    /* إخفاء mobile-user-menu-wrapper على الديسكتوب */
    .mobile-user-menu-wrapper {
        display: none !important;
    }
    
    /* إخفاء mobile-language-switcher-wrapper على الديسكتوب */
    .mobile-language-switcher-wrapper {
        display: none !important;
    }
    
    /* التأكد من إخفاء زر اللغة من الشريط الرئيسي على الديسكتوب */
    .enhanced-navbar .language-switcher-wrapper,
    .enhanced-navbar .lang-dropdown,
    .enhanced-navbar-collapse .language-switcher-wrapper,
    .enhanced-navbar-collapse .lang-dropdown,
    .nav-right-content .language-switcher-wrapper,
    .nav-right-content .lang-dropdown {
        display: none !important;
    }
}

/* ============================================
   Modern Mobile Sidebar/Drawer - Premium Design
   ============================================ */
@media (max-width: 991.98px) {
    .enhanced-navbar .nav-container {
        padding: 12px 0 !important;
        min-height: 75px;
        flex-wrap: wrap;
    }
    
    .enhanced-navbar .logo-wrapper {
        min-width: 140px;
        flex: 1;
        z-index: 1051;
    }
    
    .enhanced-navbar .logo img {
        max-height: 45px;
    }
    
    .enhanced-navbar.scrolled .logo img {
        max-height: 40px;
    }
    
    .responsive-mobile-menu {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 10px;
    }
    
    /* Modern Mobile Toggler */
    .enhanced-navbar-toggler {
        padding: 10px 16px;
        min-width: 120px;
        gap: 10px;
        border: 2px solid rgba(255, 215, 0, 0.3) !important;
        background: rgba(255, 215, 0, 0.08);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        position: relative;
        z-index: 1051;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .enhanced-navbar-toggler:hover {
        background: rgba(255, 215, 0, 0.15);
        border-color: rgba(255, 215, 0, 0.5) !important;
        transform: scale(1.05);
    }
    
    .enhanced-navbar-toggler .navbar-toggler-text {
        font-size: 14px;
        color: #FFD700;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    
    .enhanced-navbar-toggler[aria-expanded="true"] {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        border-color: transparent !important;
        transform: rotate(90deg);
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }
    
    .enhanced-navbar-toggler[aria-expanded="true"] .navbar-toggler-text {
        color: #fff;
    }
    
    .enhanced-navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
        filter: brightness(0) invert(1);
    }
    
    /* Modern Mobile Sidebar/Drawer */
    .enhanced-navbar-collapse {
        position: fixed !important;
        top: 0 !important;
        right: -100%;
        width: 85%;
        max-width: 400px;
        height: 100vh !important;
        min-height: 100vh !important;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 250, 255, 0.98) 100%);
        backdrop-filter: blur(30px) saturate(180%);
        -webkit-backdrop-filter: blur(30px) saturate(180%);
        border-radius: 0;
        margin: 0 !important;
        padding: 80px 25px 30px;
        box-shadow: -10px 0 50px rgba(0, 0, 0, 0.15);
        max-height: 100vh !important;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 999999 !important; /* أعلى z-index ليكون فوق كل شيء بما في ذلك الهيدر */
        transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 2px solid rgba(255, 215, 0, 0.2);
    }
    
    .enhanced-navbar-collapse.show {
        right: 0;
    }
    
    /* Custom Scrollbar for Mobile Sidebar */
    .enhanced-navbar-collapse::-webkit-scrollbar {
        width: 6px;
    }
    
    .enhanced-navbar-collapse::-webkit-scrollbar-track {
        background: rgba(255, 215, 0, 0.05);
        border-radius: 10px;
    }
    
    .enhanced-navbar-collapse::-webkit-scrollbar-thumb {
        background: rgba(255, 215, 0, 0.3);
        border-radius: 10px;
    }
    
    /* تم حذف hover من scrollbar */
    
    
    /* Close Button (X) for Mobile Sidebar */
    .mobile-sidebar-close-btn {
        position: absolute;
        top: 20px;
        left: 25px;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1a1a1a;
        font-size: 24px;
        font-weight: 700;
        cursor: pointer;
        border-radius: 50%;
        background: rgba(255, 215, 0, 0.15);
        border: 2px solid rgba(255, 215, 0, 0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 10000;
        padding: 0;
        margin: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* إخفاء زر الإغلاق على الديسكتوب */
    @media (min-width: 992px) {
        .mobile-sidebar-close-btn {
            display: none !important;
        }
    }
    
    .mobile-sidebar-close-btn:hover {
        background: rgba(255, 215, 0, 0.25);
        border-color: rgba(255, 215, 0, 0.5);
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
    }
    
    .mobile-sidebar-close-btn:active {
        transform: scale(0.95) rotate(90deg);
    }
    
    .mobile-sidebar-close-btn i {
        font-size: 22px;
        color: #1a1a1a;
    }
    
    /* Mobile Request Button Styling */
    .mobile-request-btn-wrapper {
        width: 100%;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.15);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease 0.1s forwards;
    }
    
    .mobile-request-btn {
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 16px 24px !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        border-radius: 12px !important;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: none !important;
    }
    
    /* تم حذف hover من زر الطلب */
    
    .mobile-request-btn i {
        font-size: 20px !important;
    }
    
    /* Mobile Language Switcher - إظهار في الموبايل فقط */
    .mobile-language-switcher-wrapper {
        display: block !important;
        width: 100%;
        padding: 20px 0;
        margin: 15px 0;
        border-top: 2px solid rgba(255, 215, 0, 0.15);
        border-bottom: 2px solid rgba(255, 215, 0, 0.15);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease 0.2s forwards;
    }

    /* Mobile User Menu - إظهار في الموبايل فقط */
    .mobile-user-menu-wrapper {
        display: block !important;
        width: 100%;
        padding: 20px 0;
        margin: 15px 0;
        border-top: 2px solid rgba(255, 215, 0, 0.15);
        border-bottom: 2px solid rgba(255, 215, 0, 0.15);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease 0.3s forwards;
    }

    /* Mobile Language Options - أزرار مباشرة بدون بحث */
    .mobile-lang-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
    }

    .lang-form-mobile-item {
        margin: 0;
        width: 100%;
    }

    .mobile-lang-button {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid rgba(255, 215, 0, 0.4);
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 215, 0, 0.2) 100%);
        color: #1a1a1a;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 2px 8px rgba(255, 215, 0, 0.2);
    }

    .mobile-lang-button.active {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #FFFFFF;
        border-color: #FFD700;
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
    }

    .mobile-lang-button:focus {
        outline: none;
        border-color: rgba(255, 215, 0, 0.9);
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2), 0 4px 12px rgba(255, 215, 0, 0.4);
    }

    /* Mobile Language Switcher - إظهار في الموبايل فقط */
    .mobile-language-switcher-wrapper {
        display: block !important;
        width: 100%;
        padding: 20px 0;
        margin: 15px 0;
        border-top: 2px solid rgba(255, 215, 0, 0.15);
        border-bottom: 2px solid rgba(255, 215, 0, 0.15);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease 0.2s forwards;
    }

    /* Mobile User Menu - إظهار في الموبايل فقط */
    .mobile-user-menu-wrapper {
        display: block !important;
        width: 100%;
        padding: 20px 0;
        margin: 15px 0;
        border-top: 2px solid rgba(255, 215, 0, 0.15);
        border-bottom: 2px solid rgba(255, 215, 0, 0.15);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease 0.3s forwards;
    }

    .mobile-user-menu-wrapper .login-account,
    .mobile-user-menu-wrapper .navbar-right-inner {
        width: 100%;
        justify-content: center;
    }

    .mobile-user-menu-wrapper .accounts {
        width: 100%;
        justify-content: center;
        padding: 14px 20px !important;
        font-size: 15px !important;
        border-radius: 12px !important;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 215, 0, 0.2) 100%) !important;
        border: 2px solid rgba(255, 215, 0, 0.3) !important;
    }

    /* تم حذف hover من زر الحساب */

    /* Mobile Navigation Items */
    .enhanced-navbar-nav {
        flex-direction: column;
        width: 100%;
        gap: 12px;
        margin-top: 20px;
    }
    
    .enhanced-navbar-nav > li {
        width: 100%;
        opacity: 0;
        transform: translateX(20px);
        animation: slideInRight 0.4s ease forwards;
    }
    
    .enhanced-navbar-collapse.show .enhanced-navbar-nav > li {
        animation-delay: calc(var(--i, 0) * 0.05s);
    }
    
    @keyframes slideInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .enhanced-navbar-nav > li > a {
        padding: 16px 20px !important;
        border-radius: 12px;
        border: 2px solid rgba(255, 215, 0, 0.15);
        margin-bottom: 0;
        width: 100%;
        text-align: right;
        font-size: 15px;
        font-weight: 600;
        background: rgba(255, 215, 0, 0.05);
        backdrop-filter: blur(10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        color: var(--heading-color) !important;
    }
    
    .enhanced-navbar-nav > li > a::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #FFD700 0%, #FFA500 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: top;
    }
    
    .enhanced-navbar-nav > li > a::after {
        display: none;
    }
    
    /* تم حذف hover من عناصر القائمة - فقط active يبقى */
    .enhanced-navbar-nav > li.active > a {
        background: rgba(255, 215, 0, 0.15);
        border-color: rgba(255, 215, 0, 0.4);
        color: #FFD700 !important;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
    }
    
    .enhanced-navbar-nav > li.active > a::before {
        transform: scaleY(1);
    }
    
    /* Mobile Right Content */
    .enhanced-nav-right {
        flex-direction: column;
        width: 100%;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid rgba(255, 215, 0, 0.15);
        gap: 15px;
        display: flex !important;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease 0.3s forwards;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .enhanced-navbar-collapse.show .enhanced-nav-right {
        animation-delay: 0.2s;
    }
    
    .request-service-btn-wrapper {
        display: none !important;
    }
    
    .navbar-right-inner {
        width: 100%;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        flex-direction: column;
    }
    
    .onlymobile-device-account-navbar {
        display: none !important; /* إخفاء زر الحساب من الموبايل - سيظهر في القائمة الجانبية */
    }
    
    /* إخفاء nav-right-content على الموبايل لأنه موجود في الـ mobile sidebar */
    .enhanced-nav-right {
        display: none !important;
    }
    
    /* إظهار mobile-language-switcher-wrapper في الـ mobile sidebar على الموبايل */
    .mobile-language-switcher-wrapper {
        display: block !important;
        width: 100%;
        padding: 20px 0;
        margin: 15px 0;
        border-top: 2px solid rgba(255, 215, 0, 0.15);
        border-bottom: 2px solid rgba(255, 215, 0, 0.15);
    }
}

/* Tablet Responsive */
@media (min-width: 992px) and (max-width: 1199.98px) {
    .enhanced-navbar .nav-container {
        padding: 18px 0 !important;
        min-height: 95px;
    }
    
    .enhanced-navbar .logo img {
        max-height: 45px;
    }
    
    .enhanced-navbar.scrolled .logo img {
        max-height: 40px;
    }
    
    .enhanced-navbar-nav > li > a {
        padding: 10px 18px !important;
        font-size: 15px;
    }
    
    .enhanced-request-btn {
        padding: 12px 28px !important;
        font-size: 14px !important;
    }
    
    .enhanced-nav-right {
        gap: 15px;
    }
}

/* Smooth scroll behavior */
@media (prefers-reduced-motion: no-preference) {
    .enhanced-navbar-nav > li > a {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
}

/* Notification icon enhancement */
.notification-icon {
    position: relative;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.notification-icon:hover {
    transform: scale(1.1);
}

.notification-number {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* User menu enhancement */
.navbar-right-inner {
    display: flex;
    align-items: center;
    gap: 18px;
}

/* Account button improvements */
.enhanced-navbar .login-account .accounts {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
    background: rgba(255, 215, 0, 0.15);
    border: 1px solid rgba(255, 215, 0, 0.3);
}

.enhanced-navbar .login-account .accounts:hover {
    background: rgba(255, 215, 0, 0.25);
    border-color: rgba(255, 215, 0, 0.5);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
    color: #1a1a1a;
}

.enhanced-navbar .login-account .accounts i {
    font-size: 18px;
}

.enhanced-navbar .login-account .accounts.loggedin {
    padding: 6px 14px;
    gap: 10px;
}

/* Notification icon improvements */
.enhanced-navbar .notification-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 215, 0, 0.05);
    transition: all 0.3s ease;
    cursor: pointer;
}

.enhanced-navbar .notification-icon:hover {
    background: rgba(255, 215, 0, 0.15);
    transform: scale(1.1);
}

.enhanced-navbar .notification-icon i {
    font-size: 20px;
    color: #1a1a1a;
}

.enhanced-navbar .notification-number {
    position: absolute;
    top: -5px;
    right: -5px;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFD700;
    color: #fff;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    padding: 0 6px;
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.4);
}

@media (max-width: 991.98px) {
    .navbar-right-inner {
        width: 100%;
        justify-content: space-between;
        gap: 12px;
    }
    
    .enhanced-navbar .login-account .accounts {
        padding: 6px 12px;
        font-size: 14px;
    }
    
    .enhanced-navbar .notification-icon {
        width: 40px;
        height: 40px;
    }
    
    .enhanced-navbar .notification-icon i {
        font-size: 18px;
    }
}
</style>

<!-- Mobile Sidebar Overlay -->
<div class="mobile-sidebar-overlay" id="mobileSidebarOverlay02"></div>

<script>
// Modern Enhanced Navbar 02 with Premium Mobile Sidebar
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const mobileMenuCollapse = document.getElementById('bizcoxx_main_menu_navabar_two');
    const mobileToggler = navbar?.querySelector('.enhanced-navbar-toggler');
    const overlay = document.getElementById('mobileSidebarOverlay02');
    
    // Scroll effect with smooth transition
    if (navbar) {
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        }, { passive: true });
    }
    
    // Modern Mobile Sidebar/Drawer Functionality
    if (mobileMenuCollapse && mobileToggler && overlay) {
        // Add index to menu items for staggered animation
        const menuItems = mobileMenuCollapse.querySelectorAll('.enhanced-navbar-nav > li');
        menuItems.forEach((item, index) => {
            item.style.setProperty('--i', index);
        });
        
        // Handle sidebar toggle
        mobileToggler.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            if (!isExpanded) {
                // Opening sidebar
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                // Closing sidebar
                closeMobileSidebar();
            }
        });
        
        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileSidebar();
        });
        
        // Close sidebar when clicking close button (X)
        const closeBtn = document.getElementById('mobileSidebarCloseBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeMobileSidebar();
            });
        }
        
        // Close sidebar on menu link click
        const mobileMenuLinks = mobileMenuCollapse.querySelectorAll('.enhanced-navbar-nav a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    setTimeout(() => {
                        closeMobileSidebar();
                    }, 300);
                }
            });
        });
        
        // Close sidebar function
        function closeMobileSidebar() {
            if (mobileMenuCollapse.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(mobileMenuCollapse) || 
                                 new bootstrap.Collapse(mobileMenuCollapse, { toggle: false });
                bsCollapse.hide();
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        // Handle Bootstrap collapse events
        mobileMenuCollapse.addEventListener('hidden.bs.collapse', function() {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenuCollapse.classList.contains('show')) {
                closeMobileSidebar();
            }
        });
        
        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 992) {
                    closeMobileSidebar();
                }
            }, 250);
        });
    }

    // Language Dropdown Toggle
    const langDropdownToggle = document.getElementById('langDropdownToggle');
    const langDropdownMenu = document.getElementById('langDropdownMenu');
    const langDropdown = document.querySelector('.lang-dropdown');

    if (langDropdownToggle && langDropdownMenu && langDropdown) {
        // Toggle dropdown
        langDropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            langDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!langDropdown.contains(e.target)) {
                langDropdown.classList.remove('active');
            }
        });

        // Close dropdown when selecting a language
        const langItems = langDropdownMenu.querySelectorAll('.lang-dropdown-item-form');
        langItems.forEach(item => {
            item.addEventListener('submit', function() {
                langDropdown.classList.remove('active');
            });
        });
    }
});
</script>