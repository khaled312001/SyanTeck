@php
    if(request()->is('/')){
        $page__id = get_static_option('home_page');
        $page_details = App\Page::find($page__id);
        $page_post = isset($page_post) && is_null($page_details) ? $page_post : $page_details;
    }
@endphp
<nav class="navbar navbar-area navbar-two enhanced-navbar {{ $page_post->page_class ?? '' }} navbar-expand-lg" id="mainNavbar">
    <div class="container container-two nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper">
                <a href="{{ route('homepage') }}" class="logo" style="transition: transform 0.3s ease;">
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                </a>
            </div>

            <div class="onlymobile-device-account-navbar navtwo">
                <div class="onlymobile-device-account-navbar-flex">
                    <div class="navbar-right-inner">
                        <x-frontend.user-menu/>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler black-color enhanced-navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#bizcoxx_main_menu_navabar_two" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-text">القائمة</span>
            </button>
        </div>

        <div class="collapse navbar-collapse enhanced-navbar-collapse" id="bizcoxx_main_menu_navabar_two">
            <ul class="navbar-nav enhanced-navbar-nav">
                {!! render_frontend_menu($primary_menu) !!}
            </ul>
        </div>

        <div class="nav-right-content enhanced-nav-right">
            <div class="request-service-btn-wrapper margin-right-20">
                <a href="{{route('qr.index')}}" class="btn btn-primary btn-request-service enhanced-request-btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 14px 32px; border-radius: 35px; font-weight: 700; font-size: 15px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); position: relative; overflow: hidden; display: inline-flex; align-items: center; gap: 10px; white-space: nowrap;">
                    <span style="position: relative; z-index: 1; display: inline-flex; align-items: center; gap: 10px;">
                        <i class="las la-tools" style="font-size: 18px;"></i>
                        {{__('Request Maintenance Now')}}
                    </span>
                    <span class="btn-ripple-effect"></span>
                </a>
            </div>
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
</nav>

<style>
/* Enhanced Navbar Styles - Improved Dimensions */
.enhanced-navbar {
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.enhanced-navbar .nav-container {
    padding: 20px 0 !important;
    min-height: 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.enhanced-navbar.scrolled {
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.enhanced-navbar.scrolled .nav-container {
    padding: 14px 0 !important;
    min-height: 85px;
}

.enhanced-navbar .logo-wrapper {
    display: flex;
    align-items: center;
    min-width: 180px;
}

.enhanced-navbar .logo {
    display: inline-block;
    transition: all 0.3s ease;
}

.enhanced-navbar .logo:hover {
    transform: scale(1.05);
}

.enhanced-navbar .logo img {
    max-height: 70px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: all 0.3s ease;
}

.enhanced-navbar.scrolled .logo img {
    max-height: 60px;
}

.enhanced-navbar-toggler {
    border: 2px solid rgba(102, 126, 234, 0.3) !important;
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
    border-color: rgba(102, 126, 234, 0.6) !important;
    background: rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.enhanced-navbar-toggler .navbar-toggler-text {
    font-size: 15px;
    font-weight: 600;
    color: #667eea;
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
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.5;
    position: relative;
    overflow: hidden;
    display: inline-block;
    white-space: nowrap;
}

.enhanced-navbar-nav > li > a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 3px 3px 0 0;
}

.enhanced-navbar-nav > li:hover > a,
.enhanced-navbar-nav > li.active > a {
    color: #667eea !important;
    background: rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.enhanced-navbar-nav > li:hover > a::before,
.enhanced-navbar-nav > li.active > a::before {
    width: 85%;
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
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5) !important;
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

/* Mobile Enhancements */
@media (max-width: 991.98px) {
    .enhanced-navbar .nav-container {
        padding: 14px 0 !important;
        min-height: 80px;
        flex-wrap: wrap;
    }
    
    .enhanced-navbar .logo-wrapper {
        min-width: 150px;
    }
    
    .enhanced-navbar .logo img {
        max-height: 55px;
    }
    
    .enhanced-navbar.scrolled .logo img {
        max-height: 50px;
    }
    
    .enhanced-navbar-toggler {
        padding: 8px 14px;
        min-width: 110px;
        gap: 8px;
        border-color: rgba(102, 126, 234, 0.5) !important;
    }
    
    .enhanced-navbar-toggler .navbar-toggler-text {
        font-size: 14px;
    }
    
    .enhanced-navbar-toggler[aria-expanded="true"] {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: transparent !important;
    }
    
    .enhanced-navbar-toggler[aria-expanded="true"] .navbar-toggler-text {
        color: #fff;
    }
    
    .enhanced-navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
        filter: brightness(0) invert(1);
    }
    
    .enhanced-navbar-collapse {
        background: #fff;
        border-radius: 15px;
        margin-top: 15px;
        padding: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        width: 100%;
    }
    
    .enhanced-navbar-nav {
        flex-direction: column;
        width: 100%;
        gap: 8px;
    }
    
    .enhanced-navbar-nav > li {
        width: 100%;
    }
    
    .enhanced-navbar-nav > li > a {
        padding: 14px 20px !important;
        border-radius: 10px;
        border: 1px solid rgba(102, 126, 234, 0.1);
        margin-bottom: 5px;
        width: 100%;
        text-align: right;
        font-size: 15px;
    }
    
    .enhanced-navbar-nav > li > a::before {
        display: none;
    }
    
    .enhanced-navbar-nav > li:hover > a,
    .enhanced-navbar-nav > li.active > a {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-color: rgba(102, 126, 234, 0.3);
        transform: translateX(-5px);
    }
    
    .enhanced-nav-right {
        flex-direction: column;
        width: 100%;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        gap: 15px;
    }
    
    .request-service-btn-wrapper {
        width: 100%;
        margin-right: 0 !important;
        margin-bottom: 15px;
    }
    
    .enhanced-request-btn {
        width: 100%;
        justify-content: center;
        padding: 12px 28px !important;
        font-size: 14px !important;
    }
    
    .enhanced-request-btn i {
        font-size: 16px !important;
    }
}

/* Tablet Responsive */
@media (min-width: 992px) and (max-width: 1199.98px) {
    .enhanced-navbar .nav-container {
        padding: 18px 0 !important;
        min-height: 95px;
    }
    
    .enhanced-navbar .logo img {
        max-height: 65px;
    }
    
    .enhanced-navbar.scrolled .logo img {
        max-height: 55px;
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
    padding: 8px 16px;
    border-radius: 25px;
    transition: all 0.3s ease;
    font-size: 15px;
    font-weight: 600;
    color: var(--heading-color);
    background: rgba(102, 126, 234, 0.05);
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.enhanced-navbar .login-account .accounts:hover {
    background: rgba(102, 126, 234, 0.1);
    border-color: rgba(102, 126, 234, 0.3);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
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
    background: rgba(102, 126, 234, 0.05);
    transition: all 0.3s ease;
    cursor: pointer;
}

.enhanced-navbar .notification-icon:hover {
    background: rgba(102, 126, 234, 0.15);
    transform: scale(1.1);
}

.enhanced-navbar .notification-icon i {
    font-size: 20px;
    color: var(--heading-color);
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
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    color: #fff;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    padding: 0 6px;
    box-shadow: 0 2px 8px rgba(245, 87, 108, 0.4);
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

<script>
// Navbar scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
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
        });
    }
    
    // Mobile menu close on link click
    const mobileMenuLinks = document.querySelectorAll('.enhanced-navbar-nav a');
    const mobileMenuCollapse = document.getElementById('bizcoxx_main_menu_navabar_two');
    const mobileMenuToggle = document.querySelector('.enhanced-navbar-toggler');
    
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992 && mobileMenuCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(mobileMenuCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            }
        });
    });
});
</script>