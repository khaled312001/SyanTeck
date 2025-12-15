<!DOCTYPE html>
<html lang="{{get_user_lang()}}" dir="{{get_user_lang_direction()}}">
<head>
   @if(!empty(get_static_option('site_google_analytics')))
        {!! get_static_option('site_google_analytics') !!}
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}
       @php
        $custom_body_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 1)->latest()->first();
        $custom_heading_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 2)->latest()->first();
       @endphp
       @if(!empty($custom_body_font_get) || !empty($custom_heading_font_get))
           <style>
               /*heading font*/
               @font-face {
                   font-family: {{optional($custom_heading_font_get)->file}};
                   src: url('{{optional($custom_heading_font_get)->path}}') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               /*body font*/
               @font-face {
                   font-family: {{optional($custom_body_font_get)->file}};
                   src: url('{{optional($custom_body_font_get)->path}}') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               :root {
                   --heading-font: '{{optional($custom_heading_font_get)->file}}', sans-serif !important;
                   --body-font: '{{optional($custom_body_font_get)->file}}', sans-serif !important;
               }
               #all_search_result {
                   position: absolute; /* or "fixed" depending on your requirement */
                   top: 0;
                   left: 0;
                   background-color: white; /* Optional: Set a background color to distinguish the data */
                   padding: 10px; /* Optional: Add some padding for better visibility */
                   z-index: 9999; /* A higher value to bring it above other elements */
               }
           </style>
       @else
        <!-- خط عربي احترافي ومميز Almarai - بريميوم وعصري -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
        {!! load_google_fonts() !!}
       @endif
       
       <!-- تطبيق خط Almarai العربي الاحترافي والمميز على جميع العناصر -->
       <style>
           /* خط عربي احترافي ومميز Almarai - تطبيق شامل على الموقع الخارجي */
           @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');
           
           /* تطبيق الخط على جميع العناصر - مع استثناء الأيقونات */
           body, html {
               font-family: 'Almarai', sans-serif !important;
           }
           
           /* استثناء الأيقونات من تطبيق خط Almarai - الأيقونات تستخدم :before */
           i[class*="las"]:before, i[class*="lab"]:before, i[class*="lar"]:before, 
           i[class*="lad"]:before, i[class*="lal"]:before,
           i[class*="fas"]:before, i[class*="far"]:before, i[class*="fab"]:before, 
           i[class*="fal"]:before, i[class*="flaticon"]:before,
           [class*="las"]:before, [class*="lab"]:before, [class*="lar"]:before,
           [class*="lad"]:before, [class*="lal"]:before,
           [class*="fas"]:before, [class*="far"]:before, [class*="fab"]:before,
           [class*="fal"]:before, [class*="flaticon"]:before, 
           [class*="ti-"]:before, [class*="themify-"]:before,
           .la:before, .lab:before, .las:before, .lar:before, .lad:before, .lal:before,
           .fa:before, .fas:before, .far:before, .fab:before, .fal:before,
           .flaticon:before, .icon:before {
               font-family: "Line Awesome Free", "Font Awesome 5 Free", "Font Awesome 5 Brands", "Font Awesome 6 Free", "Flaticon", "Themify" !important;
           }
           
           /* استثناء جميع عناصر i التي تحتوي على أيقونات */
           i[class]:before {
               font-family: "Line Awesome Free", "Font Awesome 5 Free", "Font Awesome 5 Brands", "Font Awesome 6 Free", "Flaticon", "Themify" !important;
           }
           
           /* استثناء عناصر الأيقونات نفسها */
           i[class*="las"], i[class*="lab"], i[class*="lar"], 
           i[class*="lad"], i[class*="lal"],
           i[class*="fas"], i[class*="far"], i[class*="fab"], 
           i[class*="fal"], i[class*="flaticon"],
           [class*="las"]:not([class*="text"]), [class*="lab"]:not([class*="text"]), 
           [class*="lar"]:not([class*="text"]), [class*="fas"]:not([class*="text"]),
           [class*="far"]:not([class*="text"]), [class*="fab"]:not([class*="text"]),
           [class*="flaticon"]:not([class*="text"]), 
           [class*="ti-"]:not([class*="text"]), [class*="themify-"]:not([class*="text"]),
           .la, .lab, .las, .lar, .lad, .lal,
           .fa, .fas, .far, .fab, .fal,
           .flaticon, .icon {
               font-family: "Line Awesome Free", "Font Awesome 5 Free", "Font Awesome 5 Brands", "Font Awesome 6 Free", "Flaticon", "Themify" !important;
           }
           
           /* العناوين - عريضة واحترافية ومميزة */
           h1, h2, h3, h4, h5, h6, 
           .h1, .h2, .h3, .h4, .h5, .h6,
           .common-title, .common-title-two, .common-title-three,
           .section-title, .banner-title, .title {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 800 !important;
               letter-spacing: -0.03em !important;
               line-height: 1.4 !important;
           }
           
           /* الفقرات والنصوص - مع استثناء الأيقونات */
           p, span:not([class*="las"]):not([class*="lab"]):not([class*="fas"]):not([class*="far"]):not([class*="flaticon"]), 
           div:not([class*="icon"]), a:not([class*="las"]):not([class*="lab"]):not([class*="fas"]), 
           li:not([class*="las"]):not([class*="lab"]), td, th, 
           .common-para, .paragraph, .text {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 400 !important;
               line-height: 1.9 !important;
           }
           
           /* الأزرار - عريضة واحترافية ومميزة */
           .btn, button, input[type="submit"], 
           input[type="button"], .cmn-btn, 
           .submit-btn, .btn-primary, .btn-secondary,
           .enhanced-request-btn, .mobile-request-btn {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 700 !important;
               letter-spacing: 0.02em !important;
           }
           
           /* حقول الإدخال */
           input, textarea, select, 
           .form-control, .form--control,
           .form-message {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 400 !important;
           }
           
           /* القوائم والروابط */
           .navbar-nav a, .nav-link, .navbar-brand,
           .menu-item a, .nav a, ul li a {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 700 !important;
           }
           
           /* التسميات */
           label, .label-title, .label_title {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 700 !important;
           }
           
           /* الجداول */
           table, thead, tbody, tr, td, th {
               font-family: 'Almarai', sans-serif !important;
           }
           
           /* العناوين في الجداول */
           thead th, .table thead th {
               font-family: 'Almarai', sans-serif !important;
               font-weight: 800 !important;
           }
           
           /* حماية منع لقطات الشاشة */
           * {
               -webkit-user-select: none !important;
               -moz-user-select: none !important;
               -ms-user-select: none !important;
               user-select: none !important;
               -webkit-touch-callout: none !important;
           }
           
           /* السماح بالنسخ في حقول الإدخال */
           input, textarea, [contenteditable], select {
               -webkit-user-select: text !important;
               -moz-user-select: text !important;
               -ms-user-select: text !important;
               user-select: text !important;
           }
           
           /* منع حفظ الصور */
           img {
               -webkit-user-drag: none !important;
               -khtml-user-drag: none !important;
               -moz-user-drag: none !important;
               -o-user-drag: none !important;
               user-drag: none !important;
           }
       </style>
       
       <script>
           // منع لقطات الشاشة والنسخ
           (function() {
               'use strict';
               
               // منع Print Screen و F12
               document.addEventListener('keydown', function(e) {
                   // F12 (أدوات المطور)
                   if (e.keyCode === 123) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Ctrl+Shift+I (أدوات المطور)
                   if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Ctrl+Shift+J (Console)
                   if (e.ctrlKey && e.shiftKey && e.keyCode === 74) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Ctrl+U (عرض المصدر)
                   if (e.ctrlKey && e.keyCode === 85) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Ctrl+S (حفظ الصفحة)
                   if (e.ctrlKey && e.keyCode === 83) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Ctrl+P (طباعة)
                   if (e.ctrlKey && e.keyCode === 80) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Print Screen
                   if (e.keyCode === 44) {
                       e.preventDefault();
                       return false;
                   }
                   
                   // Ctrl+Shift+C (Inspect Element)
                   if (e.ctrlKey && e.shiftKey && e.keyCode === 67) {
                       e.preventDefault();
                       return false;
                   }
               });
               
               // منع النقر بالزر الأيمن
               document.addEventListener('contextmenu', function(e) {
                   e.preventDefault();
                   return false;
               });
               
               // منع النسخ
               document.addEventListener('copy', function(e) {
                   e.preventDefault();
                   return false;
               });
               
               // منع القص
               document.addEventListener('cut', function(e) {
                   e.preventDefault();
                   return false;
               });
               
               // منع اللصق
               document.addEventListener('paste', function(e) {
                   e.preventDefault();
                   return false;
               });
               
               // منع السحب والإفلات
               document.addEventListener('dragstart', function(e) {
                   e.preventDefault();
                   return false;
               });
               
               // منع أدوات المطور
               let devtools = {open: false};
               setInterval(function() {
                   if (window.outerHeight - window.innerHeight > 200 || window.outerWidth - window.innerWidth > 200) {
                       if (!devtools.open) {
                           devtools.open = true;
                       }
                   } else {
                       devtools.open = false;
                   }
               }, 500);
           })();
       </script>

           <!--new css load -->
           <link rel=icon href="favicons.ico" sizes="16x16" type="icon/ico">
       <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/animate.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/bootstrap.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/fontawesome.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/flaticon.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/slick.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/line-awesome.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/select2.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/flatpickr.min.css')}}">
           {{--  // booststrap 4--}}
           <link rel="stylesheet" href="{{asset('assets/frontend/css/nice-select.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery.ihavecookies.css')}}">
           <link rel="stylesheet" href="{{asset('assets/common/css/toastr.min.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/css/helpers.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/theme-two/css/02_style.css')}}">
           <link rel="stylesheet" href="{{asset('assets/frontend/css/unified-spacing-system.css')}}">

    @if( get_user_lang_direction() === 'rtl')
    <link rel="stylesheet" href="{{asset('assets/common/css/rtl.css')}}">
    @endif
    <link rel="canonical" href="{{canonical_url()}}" />
    @php
    $page_post = isset($page_post) ? $page_post : [];
    $page_type = isset($page_type) ? $page_post : [];
    @endphp
    @include('frontend.partials.root-style')
    @yield('style')
    @if(request()->routeIs('homepage'))
           {!! render_site_meta() !!}
     @elseif( request()->routeIs('frontend.dynamic.page') && $page_type === 'page' )
           {!! render_site_title(optional($page_post)->title ) !!}
           {!! render_site_meta() !!}
    @else
        @yield('page-meta-data')
    @endif
 @if(!empty( get_static_option('site_third_party_tracking_code')))
 {!! get_static_option('site_third_party_tracking_code') !!}
 @endif

</head>
<body class="__qixer">
@php
    $notice = \App\AdminNotice::where('status', 1)->where('expire_date', '>', now())->latest()->where('notice_for', 1)->first();
@endphp
@if($notice)
    <div class="notice_main_section">
        <div class="col-12">
            <div class="alert
         @if($notice->notice_type === 1) alert-danger
         @elseif($notice->notice_type === 2) alert-warning
         @elseif($notice->notice_type === 3) alert-success
         @elseif($notice->notice_type === 4) alert-info
         @endif d-flex  notice_for_frontend m-0 justify-content-center">
                <p> <strong class="text-dark">{{ $notice->title }}</strong>
                    <strong>{{ $notice->description }} </strong>
                </p>
            </div>
        </div>
    </div>
@endif
@include('frontend.partials.preloader')
@include('frontend.partials.navbar', ['page_post' => $page_post ?? null])



