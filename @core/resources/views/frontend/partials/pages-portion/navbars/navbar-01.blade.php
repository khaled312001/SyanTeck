@php
    $navClasses = request()->is('/') ? 'navbar navbar-area white navbar-light bg-white nav-absolute navbar-expand-lg navbar-border' : 'navbar navbar-area white navbar-light bg-white navbar-expand-lg navbar-border';
@endphp
<header class="header-style-01">
    {{-- Top Bar - شريط علوي --}}
    <div class="top-bar" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); padding: 10px 0; border-bottom: 1px solid rgba(255, 215, 0, 0.1);">
        <div class="container container-two">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12 order-lg-2 order-md-2 order-2">
                    <div class="top-bar-right" style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; flex-wrap: wrap;">
                        @php
                            $all_languages = \App\Helpers\LanguageHelper::all_languages();
                            $current_lang = \App\Helpers\LanguageHelper::user_lang_slug();
                        @endphp
                        @if($all_languages->count() > 1)
                        <div class="language-switcher-top" style="margin-left: 8px;">
                            <form action="{{ route('frontend.lang.change') }}" method="POST" id="language-switcher-form-top" style="margin: 0;">
                                @csrf
                                <select name="lang" id="language-select-top" class="form-control" style="padding: 5px 28px 5px 10px; border: 1px solid rgba(255, 215, 0, 0.3); border-radius: 6px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); color: #FFFFFF; font-size: 13px; cursor: pointer; transition: all 0.3s; min-width: 90px; appearance: none; background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'10\' height=\'10\' viewBox=\'0 0 10 10\'%3E%3Cpath fill=\'%23FFD700\' d=\'M5 7L1 3h8z\'/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 8px center; background-size: 10px;" onchange="this.form.submit()">
                                    @foreach($all_languages as $lang)
                                        <option value="{{ $lang->slug }}" {{ $current_lang && $current_lang->slug === $lang->slug ? 'selected' : '' }} style="background: #1a1a1a; color: #FFFFFF;">
                                            {{ $lang->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        @endif
                        @if(!empty(get_static_option('site_facebook_link')))
                        <a href="{{ get_static_option('site_facebook_link') }}" target="_blank" rel="noopener noreferrer" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255, 215, 0, 0.15); border-radius: 50%; color: #FFD700; text-decoration: none; transition: all 0.3s; font-size: 16px;">
                            <i class="lab la-facebook-f"></i>
                        </a>
                        @endif
                        @if(!empty(get_static_option('site_twitter_link')))
                        <a href="{{ get_static_option('site_twitter_link') }}" target="_blank" rel="noopener noreferrer" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255, 215, 0, 0.15); border-radius: 50%; color: #FFD700; text-decoration: none; transition: all 0.3s; font-size: 16px;">
                            <i class="lab la-twitter"></i>
                        </a>
                        @endif
                        @if(!empty(get_static_option('site_instagram_link')))
                        <a href="{{ get_static_option('site_instagram_link') }}" target="_blank" rel="noopener noreferrer" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255, 215, 0, 0.15); border-radius: 50%; color: #FFD700; text-decoration: none; transition: all 0.3s; font-size: 16px;">
                            <i class="lab la-instagram"></i>
                        </a>
                        @endif
                        @if(!empty(get_static_option('site_linkedin_link')))
                        <a href="{{ get_static_option('site_linkedin_link') }}" target="_blank" rel="noopener noreferrer" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255, 215, 0, 0.15); border-radius: 50%; color: #FFD700; text-decoration: none; transition: all 0.3s; font-size: 16px;">
                            <i class="lab la-linkedin-in"></i>
                        </a>
                        @endif
                        @if(!empty(get_static_option('site_youtube_link')))
                        <a href="{{ get_static_option('site_youtube_link') }}" target="_blank" rel="noopener noreferrer" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255, 215, 0, 0.15); border-radius: 50%; color: #FFD700; text-decoration: none; transition: all 0.3s; font-size: 16px;">
                            <i class="lab la-youtube"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 order-lg-1 order-md-1 order-1">
                    <div class="top-bar-left" style="display: flex; align-items: center; gap: 25px; flex-wrap: wrap; justify-content: flex-start;">
                        @if(!empty(get_static_option('site_contact_phone')))
                        <a href="tel:{{ get_static_option('site_contact_phone') }}" style="display: flex; align-items: center; gap: 8px; color: #FFFFFF; text-decoration: none; font-size: 14px; transition: all 0.3s; font-weight: 500;">
                            <i class="las la-phone" style="color: #FFD700; font-size: 18px;"></i>
                            <span>{{ get_static_option('site_contact_phone') }}</span>
                        </a>
                        @endif
                        @if(!empty(get_static_option('site_global_email')))
                        <a href="mailto:{{ get_static_option('site_global_email') }}" style="display: flex; align-items: center; gap: 8px; color: #CCCCCC; text-decoration: none; font-size: 13px; transition: all 0.3s; font-weight: 500;">
                            <i class="las la-envelope" style="color: #FFD700; font-size: 16px;"></i>
                            <span>{{ get_static_option('site_global_email') }}</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .top-bar {
            position: relative;
            z-index: 1000;
        }
        .top-bar a:hover {
            color: #FFD700 !important;
            transform: translateY(-2px);
        }
        .top-bar-left a:hover {
            opacity: 0.9;
        }
        .top-bar-right a:hover {
            background: rgba(255, 215, 0, 0.3) !important;
            transform: scale(1.15) translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }
        .language-switcher-top {
            display: flex;
            align-items: center;
        }
        .language-switcher-top select {
            border: 1px solid rgba(255, 215, 0, 0.3) !important;
            border-radius: 6px !important;
            padding: 5px 28px 5px 10px !important;
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(5px) !important;
            color: #FFFFFF !important;
            font-size: 13px !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            min-width: 90px !important;
            appearance: none !important;
            background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'10\' height=\'10\' viewBox=\'0 0 10 10\'%3E%3Cpath fill=\'%23FFD700\' d=\'M5 7L1 3h8z\'/%3E%3C/svg%3E') !important;
            background-repeat: no-repeat !important;
            background-position: right 8px center !important;
            background-size: 10px !important;
        }
        .language-switcher-top select:hover {
            border-color: rgba(255, 215, 0, 0.6) !important;
            background: rgba(255, 255, 255, 0.15) !important;
        }
        .language-switcher-top select:focus {
            outline: none !important;
            border-color: rgba(255, 215, 0, 0.8) !important;
            background: rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2) !important;
        }
        .language-switcher-top select option {
            background: #1a1a1a !important;
            color: #FFFFFF !important;
            padding: 8px !important;
        }
        @media (max-width: 767px) {
            .top-bar {
                padding: 8px 0 !important;
            }
            .top-bar-left, .top-bar-right {
                justify-content: center !important;
                gap: 10px !important;
            }
            .top-bar-left {
                margin-bottom: 8px;
            }
            .top-bar-left a span, .top-bar-left a {
                font-size: 11px !important;
            }
            .top-bar-left a i, .top-bar-left a span {
                font-size: 12px !important;
            }
        }
    </style>
    
    <nav class="{{ $navClasses }} enhanced-navbar {{ $page_post->page_class ?? '' }}" id="mainNavbar01" style="padding: 12px 0; background: #FFFFFF !important; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);">
        <div class="container container-two nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="{{ route('homepage') }}" class="logo" style="transition: transform 0.3s ease;">
                        {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                    </a>
                </div>

                <div class="onlymobile-device-account-navbar">
                    <div class="onlymobile-device-account-navbar-flex">
                        <x-frontend.user-menu/>
                    </div>
                </div>

                <button class="navbar-toggler enhanced-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bizcoxx_main_menu_navbar_one" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-text">القائمة</span>
                </button>
            </div>

            <div class="collapse navbar-collapse enhanced-navbar-collapse" id="bizcoxx_main_menu_navbar_one">
                <ul class="navbar-nav enhanced-navbar-nav ms-auto">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>

            <div class="nav-right-content enhanced-nav-right">
                <div class="navbar-right-inner">
                    <div class="info-bar-item">
                        @if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0)
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0)
                                <div class="notification-icon icon">
                                    @if(Auth::guard('web')->check())
                                        <span class="text-dark"> <i class="las la-bell"></i> </span>
                                        <span class="notification-number">
                                        {{ Auth()->user()->unreadNotifications()->count() }}
                                    </span>
                                    @endif

                                    <div class="notification-list-item mt-2">
                                        <h5 class="notification-title">{{ __('Notifications') }}</h5>
                                        <div class="list">
                                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->count() >=1)
                                                <span>

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
                                            @foreach(Auth::guard('web')->user()->unreadNotifications()->take(5) as $notification)
                                                        @if(isset($notification->data['order_id']))
                                                            <a class="list-order" href="{{ route('seller.order.details',$notification->data['order_id']) }}">
                                                        <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                        {{ $notification->data['order_message']  }} #{{ $notification->data['order_id'] }}
                                                    </a>
                                                        @endif
                                                    @endforeach
                                        </span>

                                                <a class="p-2 text-center d-block" href="{{ route('seller.notification.all') }}">{{ __('View All Notification') }}</a>
                                            @else
                                                <p class="text-center text-white padding-3">{{ __('No New Notification') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    {{-- Language Switcher --}}
                    @php
                        $all_languages = \App\Helpers\LanguageHelper::all_languages();
                        $current_lang = \App\Helpers\LanguageHelper::user_lang();
                    @endphp
                    @if($all_languages->count() > 1)
                    <div class="language-switcher" style="margin-left: 15px;">
                        <form action="{{ route('frontend.lang.change') }}" method="POST" id="language-switcher-form">
                            @csrf
                            <select name="lang" id="language-select" class="form-control" style="padding: 6px 30px 6px 12px; border: 1px solid rgba(0,0,0,0.1); border-radius: 8px; background: #fff; font-size: 14px; cursor: pointer; transition: all 0.3s; min-width: 100px;" onchange="this.form.submit()">
                                @foreach($all_languages as $lang)
                                    <option value="{{ $lang->slug }}" {{ $current_lang && $current_lang->slug === $lang->slug ? 'selected' : '' }}>
                                        {{ $lang->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    @endif
                    <x-frontend.user-menu/>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
/* Language Switcher Styles */
.language-switcher {
    display: flex;
    align-items: center;
}

.language-switcher select {
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-radius: 8px !important;
    padding: 6px 30px 6px 12px !important;
    background: #fff !important;
    font-size: 14px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    min-width: 100px !important;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%231a1a1a' d='M6 9L1 4h10z'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 10px center !important;
    background-size: 12px !important;
}

.language-switcher select:hover {
    border-color: rgba(255, 215, 0, 0.5) !important;
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.2) !important;
}

.language-switcher select:focus {
    outline: none !important;
    border-color: #FFD700 !important;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1) !important;
}

@media (max-width: 991px) {
    .language-switcher {
        margin: 10px 0 !important;
        width: 100%;
    }
    .language-switcher select {
        width: 100% !important;
    }
}

<style>
/* ============================================
   Modern Enhanced Navbar 01 - Premium Design
   ============================================ */

/* Mobile Sidebar Overlay */
.mobile-sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
    z-index: 1040;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-sidebar-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Enhanced Navbar 01 Styles (White/Dark Theme) - Modern Premium Design */
.enhanced-navbar.white {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1050;
    background: #FFFFFF !important;
}

.enhanced-navbar.white .nav-container {
    padding: 10px 0 !important;
    min-height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.enhanced-navbar.white.scrolled {
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.enhanced-navbar.white.scrolled .nav-container {
    padding: 8px 0 !important;
    min-height: 60px;
}

.enhanced-navbar.white .logo-wrapper {
    display: flex;
    align-items: center;
    min-width: 150px;
}

.enhanced-navbar.white .logo img {
    max-height: 45px;
    width: auto;
}

.enhanced-navbar.white.scrolled .logo img {
    max-height: 40px;
}

.enhanced-navbar.white .logo {
    display: inline-block;
    transition: all 0.3s ease;
}

.enhanced-navbar.white .logo:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

.enhanced-navbar.white .logo img {
    max-height: 45px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: all 0.3s ease;
}

.enhanced-navbar.white.scrolled .logo img {
    max-height: 40px;
}

.enhanced-navbar.white .enhanced-navbar-toggler {
    border: 2px solid rgba(26, 26, 26, 0.2) !important;
    border-radius: 10px;
    padding: 10px 16px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 120px;
    justify-content: center;
    background: rgba(255, 215, 0, 0.1);
}

.enhanced-navbar.white .enhanced-navbar-toggler:hover {
    border-color: rgba(255, 215, 0, 0.5) !important;
    background: rgba(255, 215, 0, 0.15);
    transform: translateY(-1px);
}

.enhanced-navbar.white .enhanced-navbar-toggler .navbar-toggler-text {
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
    letter-spacing: 0.3px;
}

.enhanced-navbar.white .enhanced-navbar-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    padding: 0;
}

.enhanced-navbar.white .enhanced-navbar-nav > li {
    margin: 0;
    padding: 0;
}

.enhanced-navbar.white .enhanced-navbar-nav > li > a {
    padding: 12px 22px !important;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-weight: 600;
    font-size: 16px;
    line-height: 1.5;
    position: relative;
    overflow: hidden;
    color: #1a1a1a !important;
    display: inline-block;
    white-space: nowrap;
    background: transparent;
}

.enhanced-navbar.white .enhanced-navbar-nav > li > a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: linear-gradient(135deg, #FFD700 0%, rgba(255, 215, 0, 0.7) 100%);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateX(-50%);
    border-radius: 3px 3px 0 0;
}

.enhanced-navbar.white .enhanced-navbar-nav > li > a::after {
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

.enhanced-navbar.white .enhanced-navbar-nav > li:hover > a,
.enhanced-navbar.white .enhanced-navbar-nav > li.active > a {
    color: #1a1a1a !important;
    background: rgba(255, 215, 0, 0.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.15);
}

.enhanced-navbar.white .enhanced-navbar-nav > li:hover > a::before,
.enhanced-navbar.white .enhanced-navbar-nav > li.active > a::before {
    width: 85%;
}

.enhanced-navbar.white .enhanced-navbar-nav > li:hover > a::after {
    width: 100px;
    height: 100px;
}

.enhanced-navbar.white .enhanced-nav-right {
    display: flex;
    align-items: center;
    gap: 20px;
    min-width: fit-content;
}

.enhanced-navbar.white .navbar-right-inner {
    display: flex;
    align-items: center;
    gap: 18px;
}

/* Account button improvements for white navbar */
.enhanced-navbar.white .login-account .accounts {
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

.enhanced-navbar.white .login-account .accounts:hover {
    background: rgba(255, 215, 0, 0.25);
    border-color: rgba(255, 215, 0, 0.5);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
    color: #1a1a1a;
}

.enhanced-navbar.white .login-account .accounts i {
    font-size: 18px;
}

.enhanced-navbar.white .login-account .accounts.loggedin {
    padding: 6px 14px;
    gap: 10px;
}

/* Notification icon improvements for white navbar */
.enhanced-navbar.white .notification-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 215, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

.enhanced-navbar.white .notification-icon:hover {
    background: rgba(255, 215, 0, 0.2);
    transform: scale(1.1);
}

.enhanced-navbar.white .notification-icon i {
    font-size: 20px;
    color: #1a1a1a;
}

.enhanced-navbar.white .notification-number {
    position: absolute;
    top: -5px;
    right: -5px;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    color: #fff;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    padding: 0 6px;
    box-shadow: 0 2px 8px rgba(245, 87, 108, 0.4);
}

/* ============================================
   Modern Mobile Sidebar/Drawer - Premium Design
   ============================================ */
@media (max-width: 991.98px) {
    .enhanced-navbar.white .nav-container {
        padding: 14px 0 !important;
        min-height: 85px;
        flex-wrap: wrap;
    }
    
    .enhanced-navbar.white .logo-wrapper {
        min-width: 150px;
        z-index: 1051;
    }
    
    .enhanced-navbar.white .logo img {
        max-height: 60px;
    }
    
    .enhanced-navbar.white.scrolled .logo img {
        max-height: 55px;
    }
    
    /* Modern Mobile Toggler */
    .enhanced-navbar.white .enhanced-navbar-toggler {
        padding: 10px 16px;
        min-width: 120px;
        gap: 10px;
        border: 2px solid rgba(26, 26, 26, 0.2) !important;
        background: rgba(255, 215, 0, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
        z-index: 1051;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .enhanced-navbar.white .enhanced-navbar-toggler:hover {
        background: rgba(255, 215, 0, 0.2);
        border-color: rgba(255, 215, 0, 0.5) !important;
        transform: scale(1.05);
    }
    
    .enhanced-navbar.white .enhanced-navbar-toggler .navbar-toggler-text {
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #1a1a1a;
    }
    
    .enhanced-navbar.white .enhanced-navbar-toggler[aria-expanded="true"] {
        background: rgba(255, 215, 0, 0.25);
        border-color: rgba(255, 215, 0, 0.6) !important;
        transform: rotate(90deg);
    }
    
    /* Modern Mobile Sidebar/Drawer */
    .enhanced-navbar.white .enhanced-navbar-collapse {
        position: fixed;
        top: 0;
        right: -100%;
        width: 85%;
        max-width: 400px;
        height: 100vh;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.98) 0%, rgba(20, 20, 30, 0.98) 100%);
        backdrop-filter: blur(30px) saturate(180%);
        -webkit-backdrop-filter: blur(30px) saturate(180%);
        border-radius: 0;
        margin: 0;
        padding: 80px 25px 30px;
        box-shadow: -10px 0 50px rgba(0, 0, 0, 0.8);
        max-height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1050;
        transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse.show {
        right: 0;
    }
    
    /* Custom Scrollbar for Mobile Sidebar */
    .enhanced-navbar.white .enhanced-navbar-collapse::-webkit-scrollbar {
        width: 6px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    
    /* Close Button for Mobile Sidebar */
    .enhanced-navbar.white .enhanced-navbar-collapse::before {
        content: '✕';
        position: absolute;
        top: 20px;
        left: 25px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 24px;
        font-weight: 300;
        cursor: pointer;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse::before:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }
    
    /* إخفاء زر الإغلاق على الديسكتوب */
    @media (min-width: 992px) {
        .enhanced-navbar.white .enhanced-navbar-collapse::before {
            display: none !important;
        }
    }
    
    /* Mobile Navigation Items */
    .enhanced-navbar.white .enhanced-navbar-nav {
        flex-direction: column;
        width: 100%;
        gap: 12px;
        margin-top: 20px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li {
        width: 100%;
        opacity: 0;
        transform: translateX(20px);
        animation: slideInRight 0.4s ease forwards;
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse.show .enhanced-navbar-nav > li {
        animation-delay: calc(var(--i, 0) * 0.05s);
    }
    
    @keyframes slideInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li > a {
        padding: 16px 20px !important;
        border: 2px solid rgba(255, 215, 0, 0.2);
        border-radius: 12px;
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
        color: #1a1a1a !important;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li > a::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, rgba(255, 215, 0, 0.8) 0%, rgba(255, 215, 0, 0.4) 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: top;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li > a::after {
        display: none;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li:hover > a,
    .enhanced-navbar.white .enhanced-navbar-nav > li.active > a {
        background: rgba(255, 215, 0, 0.15);
        border-color: rgba(255, 215, 0, 0.4);
        transform: translateX(-8px);
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
        color: #1a1a1a !important;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li:hover > a::before,
    .enhanced-navbar.white .enhanced-navbar-nav > li.active > a::before {
        transform: scaleY(1);
    }
    
    /* Mobile Right Content */
    .enhanced-navbar.white .enhanced-nav-right {
        width: 100%;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px solid rgba(255, 255, 255, 0.1);
        gap: 15px;
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
    
    .enhanced-navbar.white .enhanced-navbar-collapse.show .enhanced-nav-right {
        animation-delay: 0.2s;
    }
    
    .enhanced-navbar.white .navbar-right-inner {
        width: 100%;
        justify-content: space-between;
        gap: 12px;
        flex-direction: column;
    }
    
    .enhanced-navbar.white .login-account .accounts {
        padding: 12px 20px;
        font-size: 15px;
        width: 100%;
        justify-content: center;
        border-radius: 12px;
    }
    
    .enhanced-navbar.white .notification-icon {
        width: 45px;
        height: 45px;
    }
    
    .enhanced-navbar.white .notification-icon i {
        font-size: 20px;
    }
}

/* Tablet Responsive */
@media (min-width: 992px) and (max-width: 1199.98px) {
    .enhanced-navbar.white .nav-container {
        padding: 18px 0 !important;
        min-height: 100px;
    }
    
    .enhanced-navbar.white .logo img {
        max-height: 70px;
    }
    
    .enhanced-navbar.white.scrolled .logo img {
        max-height: 60px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li > a {
        padding: 10px 18px !important;
        font-size: 15px;
    }
    
    .enhanced-navbar.white .enhanced-nav-right {
        gap: 15px;
    }
}
</style>

<!-- Mobile Sidebar Overlay -->
<div class="mobile-sidebar-overlay" id="mobileSidebarOverlay01"></div>

<script>
// Modern Enhanced Navbar 01 with Premium Mobile Sidebar
document.addEventListener('DOMContentLoaded', function() {
    const navbar01 = document.getElementById('mainNavbar01');
    const mobileMenuCollapse = document.getElementById('bizcoxx_main_menu_navbar_one');
    const mobileToggler = navbar01?.querySelector('.enhanced-navbar-toggler');
    const overlay = document.getElementById('mobileSidebarOverlay01');
    
    // Scroll effect with smooth transition
    if (navbar01) {
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar01.classList.add('scrolled');
            } else {
                navbar01.classList.remove('scrolled');
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
        overlay.addEventListener('click', function() {
            closeMobileSidebar();
        });
        
        // Close sidebar when clicking close button (::before pseudo-element)
        mobileMenuCollapse.addEventListener('click', function(e) {
            if (e.target === this || e.target.classList.contains('enhanced-navbar-collapse')) {
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const clickY = e.clientY - rect.top;
                
                // Check if click is in the close button area (top-left)
                if (clickX < 70 && clickY < 70) {
                    closeMobileSidebar();
                }
            }
        });
        
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
});
</script>