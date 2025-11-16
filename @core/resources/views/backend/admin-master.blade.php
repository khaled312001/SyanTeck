<!doctype html>
<html class="no-js" lang="{{get_default_language()}}" dir="{{get_default_language_direction()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{get_static_option('site_title')}} -
        @if(request()->path() == 'admin-home')
            {{get_static_option('site_tag_line')}}
        @else
            @yield('site-title')
        @endif
    </title>
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
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome-iconpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/flatpickr.min.css')}}">
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.min.css')}}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    @yield('style')
    @if(get_static_option('site_admin_dark_mode') == 'on')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dark-mode.css')}}">
    @endif
    @if( get_default_language_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/backend/css/rtl.css')}}">
    @endif
    
    <style>
        /* تطبيق خط Manrope على النصوص - مع استثناء الأيقونات */
        html,
        body {
            font-family: 'Manrope', sans-serif !important;
        }
        
        /* استثناء الأيقونات من قاعدة الخط - يجب أن يكون بعد قاعدة body */
        [class*="ti-"],
        i[class*="ti-"],
        .ti {
            font-family: 'themify' !important;
        }
        
        [class*="fa-"],
        i[class*="fa-"],
        .fa,
        .fas,
        .far,
        .fab,
        .fal {
            font-family: 'Font Awesome 5 Free', 'Font Awesome 5 Brands', 'FontAwesome' !important;
        }
        
        [class*="las"],
        [class*="la-"],
        i[class*="las"],
        i[class*="la-"],
        .las,
        .la {
            font-family: 'Line Awesome Free', 'Line Awesome Brands' !important;
        }
        
        [class*="flaticon"],
        i[class*="flaticon"] {
            font-family: 'Flaticon' !important;
        }
        
        /* العناوين */
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        
        /* Enhanced Header Styles - Modern & Beautiful */
        .header-area {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 18px 30px;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
            border-bottom: none;
            position: relative;
            overflow: visible;
            z-index: 1000;
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
        
        .header-area .notification-area .btn-primary,
        .header-area .notification-area .btn-dark {
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
        
        .header-area .notification-area .btn-primary:hover,
        .header-area .notification-area .btn-dark:hover {
            background: rgba(255,255,255,0.35);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        
        .header-area .notification-area .btn-primary i,
        .header-area .notification-area .btn-dark i {
            margin-right: 6px;
        }
        
        /* Notification Button Styles */
        .header-area .notification-area {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }
        
        .header-area .notification-area .notification-btn-wrapper {
            position: relative;
            display: inline-block;
        }
        
        .header-area .notification-area .notification-btn {
            position: relative;
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            font-size: 18px;
            text-decoration: none;
        }
        
        .header-area .notification-area .notification-btn:hover {
            background: rgba(255,255,255,0.35);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        
        .header-area .notification-area .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ff4757;
            color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            border: 2px solid rgba(102, 126, 234, 1);
            min-width: 20px;
            padding: 0 2px;
        }
        
        /* Notification Dropdown Styles */
        .header-area .notification-area .notification-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            left: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            min-width: 350px;
            max-width: 400px;
            max-height: 500px;
            overflow: hidden;
            z-index: 10000;
            display: none;
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .header-area .notification-area .notification-dropdown.show {
            display: block;
            transform: translateY(0);
            opacity: 1;
        }
        
        .header-area .notification-area .notification-dropdown .notify-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 15px;
        }
        
        .header-area .notification-area .notification-dropdown .notify-title a {
            color: #fff;
            font-size: 13px;
            text-decoration: underline;
            opacity: 0.9;
        }
        
        .header-area .notification-area .notification-dropdown .notify-title a:hover {
            opacity: 1;
        }
        
        .header-area .notification-area .notification-dropdown .nofity-list {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .header-area .notification-area .notification-dropdown .notify-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            color: #333;
            transition: background 0.2s ease;
        }
        
        .header-area .notification-area .notification-dropdown .notify-item:hover {
            background: #f8f9fa;
        }
        
        .header-area .notification-area .notification-dropdown .notify-item:last-child {
            border-bottom: none;
        }
        
        .header-area .notification-area .notification-dropdown .notify-thumb {
            margin-right: 12px;
        }
        
        .header-area .notification-area .notification-dropdown .notify-text {
            flex: 1;
        }
        
        .header-area .notification-area .notification-dropdown .notify-text p {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 500;
            color: #2c3e50;
        }
        
        .header-area .notification-area .notification-dropdown .notify-text span {
            font-size: 12px;
            color: #6c757d;
        }
        
        /* Ensure header area doesn't clip the dropdown */
        .header-area {
            overflow: visible !important;
        }
        
        /* Ensure main content doesn't overlap */
        .main-content {
            position: relative;
            z-index: 1;
        }
        
        /* Mobile responsive for notification dropdown */
        @media (max-width: 768px) {
            .header-area .notification-area .notification-dropdown {
                min-width: 300px;
                max-width: calc(100vw - 40px);
                right: 0;
            }
        }
        
        /* Sidebar notification badge styles */
        .sidebar-menu .bage-notification {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-left: 0 !important;
            margin-right: 8px !important;
            vertical-align: middle !important;
            order: 1 !important;
            position: relative !important;
            float: none !important;
        }
        
        .sidebar-menu a {
            display: flex !important;
            align-items: center !important;
            flex-direction: row !important;
            gap: 8px !important;
        }
        
        /* Ensure icon comes first, then badge, then text */
        .sidebar-menu a > i {
            order: 0 !important;
        }
        
        .sidebar-menu a .bage-notification {
            order: 1 !important;
        }
        
        .sidebar-menu a > span:not(.bage-notification) {
            order: 2 !important;
        }
        
        /* Override any existing styles that position badge on right */
        .sidebar-menu li a .bage-notification {
            float: none !important;
            position: relative !important;
            left: auto !important;
            right: auto !important;
            margin-left: 0 !important;
            margin-right: 8px !important;
        }
        
        /* إصلاح أيقونة شريط القائمة - فقط في الموبايل */
        .nav-btn {
            display: none !important; /* مخفي افتراضياً (في الكمبيوتر) */
        }
        
        /* إظهار الأيقونة فقط في الموبايل */
        @media (max-width: 767px) {
            .nav-btn,
            .nav-btn.pull-left,
            div.nav-btn,
            div.nav-btn.pull-left,
            .col-md-9 .nav-btn,
            .col-sm-9 .nav-btn {
                width: 44px !important;
                height: 44px !important;
                min-width: 44px !important;
                min-height: 44px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
                cursor: pointer !important;
                visibility: visible !important;
                opacity: 1 !important;
                gap: 5px !important;
                padding: 10px !important;
                margin: 10px 15px 0 0 !important;
                background: rgba(255,255,255,0.25) !important;
                backdrop-filter: blur(10px) !important;
                border-radius: 10px !important;
                border: 1px solid rgba(255,255,255,0.4) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                position: relative !important;
                z-index: 1000 !important;
                float: left !important;
            }
            
            .nav-btn:hover,
            .nav-btn.pull-left:hover,
            div.nav-btn:hover,
            div.nav-btn.pull-left:hover {
                background: rgba(255,255,255,0.35) !important;
                transform: scale(1.05) !important;
                border-color: rgba(255,255,255,0.6) !important;
            }
            
            .nav-btn span,
            .nav-btn.pull-left span,
            div.nav-btn span,
            div.nav-btn.pull-left span {
                width: 24px !important;
                height: 3px !important;
                min-width: 24px !important;
                min-height: 3px !important;
                background: #fff !important;
                border-radius: 2px !important;
                transition: all 0.3s ease !important;
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                margin: 3px 0 !important;
                position: relative !important;
                transform: none !important;
                -webkit-transform: none !important;
                -moz-transform: none !important;
                -ms-transform: none !important;
                -o-transform: none !important;
            }
            
            .nav-btn span:first-child,
            .nav-btn.pull-left span:first-child,
            div.nav-btn span:first-child {
                transform: none !important;
                -webkit-transform: none !important;
            }
            
            .nav-btn span:nth-child(2),
            .nav-btn.pull-left span:nth-child(2),
            div.nav-btn span:nth-child(2) {
                opacity: 1 !important;
                transform: none !important;
                -webkit-transform: none !important;
            }
            
            .nav-btn span:last-child,
            .nav-btn.pull-left span:last-child,
            div.nav-btn span:last-child {
                transform: none !important;
                -webkit-transform: none !important;
            }
            
            .nav-btn:hover span,
            .nav-btn.pull-left:hover span,
            div.nav-btn:hover span {
                background: rgba(255,255,255,1) !important;
                transform: none !important;
                -webkit-transform: none !important;
            }
            
            /* التأكد من عدم تحويل الأيقونة إلى سهم */
            .sbar_collapsed .nav-btn span,
            body.sbar_collapsed .nav-btn span,
            .sbar_collapsed .nav-btn.pull-left span,
            body.sbar_collapsed .nav-btn.pull-left span {
                transform: none !important;
                -webkit-transform: none !important;
            }
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
            margin-top: 10px;
            padding: 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
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
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .page-title-area .breadcrumbs li a:hover {
            color: #764ba2;
            background: rgba(102, 126, 234, 0.1);
        }
        
        .page-title-area .breadcrumbs li:not(:last-child)::after {
            content: '›';
            margin: 0 4px;
            color: #adb5bd;
            font-size: 16px;
            font-weight: 300;
        }
        
        .page-title-area .breadcrumbs li span {
            color: #495057;
            font-weight: 500;
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
            
            .header-area .notification-area .btn-primary,
            .header-area .notification-area .btn-dark {
                padding: 8px 16px;
                font-size: 13px;
                border-radius: 10px;
            }
            
            .header-area .notification-area .btn-primary i,
            .header-area .notification-area .btn-dark i {
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
        }
        
        @media (max-width: 576px) {
            .header-area {
                padding: 12px 15px;
            }
            
            .header-area .notification-area {
                justify-content: flex-end;
                width: 100%;
            }
            
            .header-area .notification-area .btn-primary,
            .header-area .notification-area .btn-dark {
                padding: 7px 14px;
                font-size: 12px;
                border-radius: 8px;
            }
            
            .header-area .notification-area .btn-primary i,
            .header-area .notification-area .btn-dark i {
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
                display: flex !important;
                position: absolute !important;
                top: 15px !important;
                left: 15px !important;
                right: auto !important;
                width: 42px !important;
                height: 42px !important;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                border: none !important;
                border-radius: 50% !important;
                color: #fff !important;
                font-size: 24px !important;
                font-weight: 600 !important;
                cursor: pointer !important;
                z-index: 10000 !important;
                align-items: center !important;
                justify-content: center !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4) !important;
            }
            .sidebar-close-btn:hover {
                background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
                color: #fff !important;
                transform: rotate(90deg) scale(1.15) !important;
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6) !important;
            }
            .sidebar-close-btn:active {
                transform: rotate(90deg) scale(1.05) !important;
            }
            .sidebar-close-btn i {
                color: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: 1 !important;
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
    @include('backend/partials/sidebar')
    <div class="main-content">

        <div class="header-area">
            <div class="row align-items-center">

                
                <div class="col-md-9 col-sm-9 clearfix">
                <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="notification-area pull-right">
                    @php
                        $unread_count = 0;
                        $admin_unread_notifications = [];
                        try{
                            $unread_count = \App\AdminNotification::where('status', 0)->count();
                            $admin_unread_notifications = \App\AdminNotification::where('status', 0)->take(5)->get();
                        }catch(\Exception $e){  }
                    @endphp
                        <li class="notification-btn-wrapper">
                            <a href="javascript:void(0)" class="notification-btn" id="notificationToggle">
                                <i class="ti-bell"></i>
                                @if($unread_count > 0)
                                    <span class="notification-badge">{{ $unread_count }}</span>
                                @endif
                            </a>
                            <div class="notification-dropdown" id="notificationDropdown">
                                <div class="notify-title">
                                    <span>{{ __('Notifications') }}</span>
                                    <a href="{{ route('admin.notifications.all') }}">{{ __('view all') }}</a>
                                </div>
                                <div class="nofity-list">
                                    @if(count($admin_unread_notifications) > 0)
                                        <!-- Order section start -->
                                        @foreach($admin_unread_notifications as $data)
                                            @if(!empty($data->order_id))
                                            <a href="{{ route('admin.orders.details', $data->order_id) }}" class="notify-item">
                                                <div class="notify-thumb"><i class="ti-check-box btn-dark"></i></div>
                                                <div class="notify-text">
                                                    <p>{{ __('New order') }} #{{ $data->order_id ?? '' }}</p>
                                                    <span> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }} </span>
                                                </div>
                                            </a>
                                            @endif
                                        @endforeach
                                        <!-- Order section end -->
                                        <!-- Tickets section start -->
                                        @foreach($admin_unread_notifications as $data)
                                            @if(!empty($data->ticket_id))
                                            <a href="{{ route('admin.ticket.details', $data->ticket_id) }}" class="notify-item">
                                                <div class="notify-thumb"><i class="ti-check-box btn-dark"></i></div>
                                                <div class="notify-text">
                                                    <p>{{ __('New order ticket') }} #{{ $data->ticket_id ?? '' }}</p>
                                                    <span> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }} </span>
                                                </div>
                                            </a>
                                            @endif
                                        @endforeach
                                        <!-- Tickets section end -->
                                        <!-- Job post section start -->
                                        @foreach($admin_unread_notifications as $data)
                                            @if(!empty($data->job_post_id))
                                            <a href="{{ route('job.post.details', optional($data->buyerJob)->slug ?? '') }}" class="notify-item">
                                                <div class="notify-thumb"><i class="ti-check-box btn-dark"></i></div>
                                                <div class="notify-text">
                                                    <p>{{ __('New Job Created') }} #{{ $data->job_post_id ?? '' }}</p>
                                                    <span> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }} </span>
                                                </div>
                                            </a>
                                            @endif
                                        @endforeach
                                        <!-- Job Post section end -->
                                    @else
                                        <div class="notify-item" style="text-align: center; color: #6c757d;">
                                            <p>{{ __('No New Notification') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li ><label class="switch yes">
                            <input id="darkmode" type="checkbox" data-mode={{ get_static_option('site_admin_dark_mode') }} @if(get_static_option('site_admin_dark_mode') == 'on') checked @else @endif>
                            <span class="slider-color-mode onff"></span>
                        </label></li>
                        <li><a class="btn @if(get_static_option('site_admin_dark_mode') == 'off')btn-primary @else btn-dark  @endif" target="_blank" href="{{url('/')}}"><i class="fas fa-external-link-alt mr-1"></i>   {{__('View Site')}} </a></li>
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
                            <li><a href="{{route('admin.home')}}">{{__('Home')}}</a></li>
                            <li><span>@yield('site-title')</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right dropdown">
                        {!! render_image_markup_by_attachment_id(auth()->guard('admin')->user()->image,'avatar user-thumb') !!}
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin.profile.update')}}">{{__('Edit Profile')}}</a>
                            <a class="dropdown-item" href="{{route('admin.password.change')}}">{{__('Password Change')}}</a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">{{ __('Logout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <footer>
        <div class="footer-area footer-wrap">
        </div>
    </footer>
</div>

<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/backend/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('assets/backend/js/fontawesome-iconpicker.min.js')}}"></script>
<script src="{{asset('assets/backend/js/flatpickr.js')}}"></script>
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

<script>
    // Notification dropdown toggle functionality
    $(document).ready(function() {
        var $notificationToggle = $('#notificationToggle');
        var $notificationDropdown = $('#notificationDropdown');
        
        // Toggle dropdown on button click
        $notificationToggle.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $notificationDropdown.toggleClass('show');
        });
        
        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.notification-btn-wrapper').length) {
                $notificationDropdown.removeClass('show');
            }
        });
        
        // Prevent dropdown from closing when clicking inside it
        $notificationDropdown.on('click', function(e) {
            e.stopPropagation();
        });
    });
</script>

<script>
    (function ($){
        "use strict";



        $('#reload').on('click', function(){
            location.reload();
        })
        $('#darkmode').on('click', function(){
           var el = $(this)
            var mode = el.data('mode')
            $.ajax({
                type:'GET',
                url:  '{{ route("admin.dark.mode.toggle") }}',
                data:{mode:mode},
                success: function(){
                    location.reload();
                },error: function(){
                }
            });
        });

        $(document).on('click','.swal_delete_button',function(e){
          e.preventDefault();
            Swal.fire({
              title: '{{__("Are you sure?")}}',
              text: '{{__("You would not be able to revert this item!")}}',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: "{{__('Yes, Delete it!')}}",
               cancelButtonText: "{{__('Cancel')}}"
            }).then((result) => {
              if (result.isConfirmed) {
                $(this).next().find('.swal_form_submit_btn').trigger('click');
              }
            });
        });


        $(document).on('click','.swal_delete_all_lang_data_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure?")}}',
                text: '{{__("It will delete All language data..!")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Yes, Delete it!')}}",
                 cancelButtonText: "{{__('Cancel')}}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click','.swal_change_language_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure to make this language as a default language?")}}',
                text: '{{__("Languages will be turn changed as default")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Yes, Change it!')}}",
                cancelButtonText: "{{__('Cancel')}}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

    })(jQuery);
</script>
<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}
<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'top','color':'green'});
    });
</script>
</body>

</html>
