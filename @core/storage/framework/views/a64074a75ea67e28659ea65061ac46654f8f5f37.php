<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">
<head>
   <?php if(!empty(get_static_option('site_google_analytics'))): ?>
        <?php echo get_static_option('site_google_analytics'); ?>

    <?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>

       <?php
        $custom_body_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 1)->latest()->first();
        $custom_heading_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 2)->latest()->first();
       ?>
       <?php if(!empty($custom_body_font_get) || !empty($custom_heading_font_get)): ?>
           <style>
               /*heading font*/
               @font-face {
                   font-family: <?php echo e(optional($custom_heading_font_get)->file); ?>;
                   src: url('<?php echo e(optional($custom_heading_font_get)->path); ?>') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               /*body font*/
               @font-face {
                   font-family: <?php echo e(optional($custom_body_font_get)->file); ?>;
                   src: url('<?php echo e(optional($custom_body_font_get)->path); ?>') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               :root {
                   --heading-font: '<?php echo e(optional($custom_heading_font_get)->file); ?>', sans-serif !important;
                   --body-font: '<?php echo e(optional($custom_body_font_get)->file); ?>', sans-serif !important;
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
       <?php else: ?>
        <?php echo load_google_fonts(); ?>

       <?php endif; ?>

           <!--new css load -->
           <link rel=icon href="favicons.ico" sizes="16x16" type="icon/ico">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/animate.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/bootstrap.min.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/fontawesome.min.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/flaticon.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/slick.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/line-awesome.min.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/select2.min.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/flatpickr.min.css')); ?>">
           
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/nice-select.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.min.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/theme-two/css/02_style.css')); ?>">

    <?php if( get_user_lang_direction() === 'rtl'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/rtl.css')); ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?php echo e(canonical_url()); ?>" />
    <?php
    $page_post = isset($page_post) ? $page_post : [];
    $page_type = isset($page_type) ? $page_post : [];
    ?>
    <?php echo $__env->make('frontend.partials.root-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>
    <?php if(request()->routeIs('homepage')): ?>
           <?php echo render_site_meta(); ?>

     <?php elseif( request()->routeIs('frontend.dynamic.page') && $page_type === 'page' ): ?>
           <?php echo render_site_title(optional($page_post)->title ); ?>

           <?php echo render_site_meta(); ?>

    <?php else: ?>
        <?php echo $__env->yieldContent('page-meta-data'); ?>
    <?php endif; ?>
 <?php if(!empty( get_static_option('site_third_party_tracking_code'))): ?>
 <?php echo get_static_option('site_third_party_tracking_code'); ?>

 <?php endif; ?>

</head>
<body class="__qixer">
<?php
    $notice = \App\AdminNotice::where('status', 1)->where('expire_date', '>', now())->latest()->where('notice_for', 1)->first();
?>
<?php if($notice): ?>
    <div class="notice_main_section">
        <div class="col-12">
            <div class="alert
         <?php if($notice->notice_type === 1): ?> alert-danger
         <?php elseif($notice->notice_type === 2): ?> alert-warning
         <?php elseif($notice->notice_type === 3): ?> alert-success
         <?php elseif($notice->notice_type === 4): ?> alert-info
         <?php endif; ?> d-flex  notice_for_frontend m-0 justify-content-center">
                <p> <strong class="text-dark"><?php echo e($notice->title); ?></strong>
                    <strong><?php echo e($notice->description); ?> </strong>
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->make('frontend.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.navbar',$page_post, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>