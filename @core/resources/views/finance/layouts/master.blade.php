<!doctype html>
<html class="no-js" lang="{{get_default_language()}}" dir="{{get_default_language_direction()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{get_static_option('site_title')}} - @yield('site-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'),"full",false);
    @endphp
    @if (!empty($site_favicon))
        <link rel="icon" href="{{$site_favicon['img_url']}}" type="image/png">
    @endif

    <link rel="stylesheet" href="{{asset('assets/common/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome-iconpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/flatpickr.min.css')}}">
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.min.css')}}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('style')
    @if(get_static_option('site_admin_dark_mode') == 'on')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dark-mode.css')}}">
    @endif
    @if( get_default_language_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/backend/css/rtl.css')}}">
    @endif
    
    <style>
        /* Enhanced Header Styles - Modern & Beautiful */
        .header-area {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 18px 30px;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        .header-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            pointer-events: none;
        }
        
        .header-area .row {
            position: relative;
            z-index: 1;
        }
        
        .header-area .notification-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .header-area .notification-area li {
            list-style: none;
            margin: 0;
        }
        
        .header-area .notification-area .btn-primary {
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .header-area .notification-area .btn-primary:hover {
            background: rgba(255,255,255,0.35);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        
        .header-area .notification-area .btn-primary i {
            margin-right: 6px;
        }
        
        /* Enhanced Page Title Area */
        .page-title-area {
            background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%);
            padding: 24px 30px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: relative;
        }
        
        .page-title-area::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            opacity: 0.3;
        }
        
        .breadcrumbs-area {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .page-title-area .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .page-title-area .page-title::before {
            content: '';
            width: 4px;
            height: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }
        
        .page-title-area .breadcrumbs {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .page-title-area .breadcrumbs li {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            color: #6c757d;
        }
        
        .page-title-area .breadcrumbs li a {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 6px;
        }
        
        .page-title-area .breadcrumbs li a:hover {
            color: #764ba2;
            background: rgba(102, 126, 234, 0.1);
        }
        
        .page-title-area .breadcrumbs li span {
            color: #495057;
            font-weight: 500;
        }
        
        .page-title-area .breadcrumbs li:not(:last-child)::after {
            content: '›';
            margin: 0 4px;
            color: #adb5bd;
            font-size: 16px;
            font-weight: 300;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 18px;
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: relative;
            z-index: 1050;
        }
        
        .user-profile:hover {
            background: #f8f9fa;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-1px);
            border-color: #667eea;
        }
        
        .user-profile .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #667eea;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
        }
        
        .user-profile .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        
        .user-profile .user-name {
            font-size: 15px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 6px;
            line-height: 1.2;
        }
        
        .user-profile .user-role {
            font-size: 12px;
            color: #667eea;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .user-profile .user-name i {
            font-size: 12px;
            color: #6c757d;
            transition: transform 0.3s ease;
        }
        
        .user-profile:hover .user-name i {
            transform: translateY(2px);
        }
        
        .user-profile .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            border: 1px solid #e9ecef;
            padding: 8px 0;
            margin-top: 12px;
            min-width: 200px;
            z-index: 1051;
            position: absolute;
        }
        
        .user-profile .dropdown-menu .dropdown-item {
            padding: 12px 20px;
            font-size: 14px;
            color: #495057;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .user-profile .dropdown-menu .dropdown-item i {
            width: 20px;
            text-align: center;
        }
        
        .user-profile .dropdown-menu .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding-left: 25px;
        }
        
        .user-profile .dropdown-menu .dropdown-divider {
            margin: 6px 0;
            border-color: #e9ecef;
        }
        
        .nav-btn {
            width: 44px;
            height: 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            padding: 10px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.05);
        }
        
        .nav-btn span {
            width: 22px;
            height: 2.5px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s ease;
            display: block;
        }
        
        .nav-btn:hover span {
            background: rgba(255,255,255,0.9);
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .header-area {
                padding: 14px 18px;
            }
            
            .header-area .notification-area {
                flex-wrap: wrap;
                gap: 8px;
            }
            
            .header-area .notification-area .btn-primary {
                padding: 8px 16px;
                font-size: 13px;
                border-radius: 10px;
            }
            
            .header-area .notification-area .btn-primary i {
                margin-right: 4px;
            }
            
            .nav-btn {
                width: 40px;
                height: 40px;
                padding: 8px;
            }
            
            .page-title-area {
                padding: 18px 18px;
            }
            
            .page-title-area .row {
                flex-direction: column;
                gap: 12px;
            }
            
            .page-title-area .col-sm-6 {
                width: 100%;
            }
            
            .page-title-area .page-title {
                font-size: 22px;
                gap: 10px;
            }
            
            .page-title-area .page-title::before {
                height: 22px;
                width: 3px;
            }
            
            .page-title-area .breadcrumbs {
                font-size: 12px;
                margin-top: 8px;
            }
            
            .user-profile {
                width: 100%;
                justify-content: center;
            }
            
            .user-profile .user-name {
                font-size: 13px;
            }
            
            .user-profile .user-role {
                font-size: 10px;
            }
            
            .user-profile .avatar {
                width: 35px;
                height: 35px;
            }
        }
        
        @media (max-width: 576px) {
            .header-area {
                padding: 12px 15px;
            }
            
            .header-area .notification-area {
                justify-content: flex-end;
                width: 100%;
            }
            
            .header-area .notification-area .btn-primary {
                padding: 7px 14px;
                font-size: 12px;
                border-radius: 8px;
            }
            
            .header-area .notification-area .btn-primary i {
                display: inline-block;
                margin-right: 4px;
            }
            
            .nav-btn {
                width: 38px;
                height: 38px;
                padding: 7px;
            }
            
            .nav-btn span {
                width: 20px;
                height: 2px;
            }
            
            .page-title-area {
                padding: 16px 15px;
            }
            
            .page-title-area .page-title {
                font-size: 20px;
                gap: 8px;
            }
            
            .page-title-area .page-title::before {
                height: 20px;
                width: 3px;
            }
            
            .page-title-area .breadcrumbs {
                font-size: 11px;
                margin-top: 6px;
            }
            
            .page-title-area .breadcrumbs li:not(:last-child)::after {
                margin: 0 3px;
                font-size: 14px;
            }
            
            .user-profile {
                padding: 6px 10px;
            }
            
            .user-profile .user-name {
                font-size: 12px;
            }
            
            .user-profile .user-role {
                font-size: 9px;
            }
            
            .user-profile .avatar {
                width: 30px;
                height: 30px;
            }
        }
        /* Force sidebar to always stay open on desktop - Right side */
        @media (min-width: 768px) {
            .page-container {
                padding-right: 280px !important;
                padding-left: 0 !important;
            }
            .sidebar-menu {
                right: 0 !important;
                left: auto !important;
                visibility: visible !important;
                opacity: 1 !important;
                width: 280px !important;
            }
            body.sbar_collapsed .page-container,
            .sbar_collapsed.page-container {
                padding-right: 280px !important;
                padding-left: 0 !important;
            }
            body.sbar_collapsed .sidebar-menu,
            .sbar_collapsed .sidebar-menu {
                right: 0 !important;
                left: auto !important;
                visibility: visible !important;
                opacity: 1 !important;
                width: 280px !important;
            }
        }
        
        /* Mobile: Sidebar collapsed by default, can be toggled */
        @media (max-width: 767px) {
            .page-container {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .sidebar-menu {
                right: -100% !important;
                left: auto !important;
                transition: right 0.3s ease !important;
                z-index: 9999 !important;
            }
            .sidebar-menu.sidebar-open {
                right: 0 !important;
            }
            body.sbar_collapsed .page-container,
            .sbar_collapsed.page-container {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            body.sbar_collapsed .sidebar-menu,
            .sbar_collapsed .sidebar-menu {
                right: -100% !important;
            }
            /* Overlay when sidebar is open */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 9998;
            }
            .sidebar-overlay.active {
                display: block;
            }
            /* Close button in sidebar */
            .sidebar-close-btn {
                display: block;
                position: absolute;
                top: 15px;
                left: 15px;
                right: auto;
                width: 35px;
                height: 35px;
                background: rgba(255, 255, 255, 0.1);
                border: none;
                border-radius: 50%;
                color: #fff;
                font-size: 20px;
                cursor: pointer;
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }
            .sidebar-close-btn:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }
        }
        
        /* Hide close button on desktop */
        @media (min-width: 768px) {
            .sidebar-close-btn {
                display: none !important;
            }
        }
    </style>
</head>

<body>

@if(!empty(get_static_option('admin_loader_animation')))
<div id="preloader">
    <div class="loader"></div>
</div>
@endif

<div class="page-container">
    <div class="sidebar-overlay"></div>
    @include('finance.partials.sidebar')
    <div class="main-content">
        <div class="header-area">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-3 clearfix">
                   
                </div>
                <div class="col-md-9 col-sm-9 clearfix">
                <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="notification-area pull-right">
                        <li><a class="btn btn-primary" target="_blank" href="{{url('/')}}"><i class="fas fa-external-link-alt mr-1"></i> {{__('View Site')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">@yield('site-title')</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{route('finance.dashboard')}}">{{__('Home')}}</a></li>
                            <li><span>@yield('site-title')</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right dropdown">
                        {!! render_image_markup_by_attachment_id(auth()->user()->image ?? null,'avatar user-thumb') !!}
                        <div class="user-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <h4 class="user-name">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></h4>
                            <span class="user-role">{{ Auth::user()->roles->first()->name ?? __('Finance') }}</span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('finance.dashboard')}}">
                                <i class="ti-dashboard mr-2"></i> {{__('Dashboard')}}
                            </a>
                            <a class="dropdown-item" href="{{route('finance.profile')}}">
                                <i class="ti-user mr-2"></i> {{__('Profile')}}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('finance.logout') }}">
                                <i class="ti-power-off mr-2"></i> {{ __('Logout') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <footer>
        <div class="footer-area footer-wrap">
            <p>{!! render_footer_copyright_text() !!}</p>
        </div>
    </footer>
</div>

<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/backend/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.slicknav.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')
<script src="{{asset('assets/backend/js/plugins.js')}}"></script>
<script src="{{asset('assets/backend/js/scripts.js')}}"></script>
<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}
<script>
    // Mobile sidebar toggle functionality
    (function($) {
        function isMobile() {
            return window.innerWidth <= 767;
        }
        
        function toggleSidebar() {
            if (isMobile()) {
                $('.sidebar-menu').toggleClass('sidebar-open');
                $('.sidebar-overlay').toggleClass('active');
                $('body').toggleClass('sidebar-open');
            }
        }
        
        function closeSidebar() {
            if (isMobile()) {
                $('.sidebar-menu').removeClass('sidebar-open');
                $('.sidebar-overlay').removeClass('active');
                $('body').removeClass('sidebar-open');
            }
        }
        
        // Toggle sidebar on nav-btn click (mobile only)
        $(document).on('click', '.nav-btn', function(e) {
            if (isMobile()) {
                e.preventDefault();
                e.stopPropagation();
                toggleSidebar();
            }
        });
        
        // Close sidebar on close button click
        $(document).on('click', '.sidebar-close-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeSidebar();
        });
        
        // Close sidebar when clicking overlay
        $(document).on('click', '.sidebar-overlay', function(e) {
            closeSidebar();
        });
        
        // Close sidebar when clicking a menu link (mobile only)
        $(document).on('click', '.sidebar-menu a', function() {
            if (isMobile()) {
                setTimeout(function() {
                    closeSidebar();
                }, 300);
            }
        });
        
        // Handle window resize
        $(window).on('resize', function() {
            if (!isMobile()) {
                closeSidebar();
            }
        });
    })(jQuery);
</script>
</body>
</html>

