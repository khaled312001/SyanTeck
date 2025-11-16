<!-- Banner area Starts -->
<div class="new_banner_area new-section-bg padding-top-100 padding-bottom-100 hero-section-enhanced" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>"
     style="background-color: <?php echo e($header_background_color); ?>; position: relative; overflow: hidden; padding-top: 180px !important; padding-bottom: 80px !important;">
    <!-- Background Pattern -->
    <div class="hero-bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.03; z-index: 0; background-image: radial-gradient(circle, #000 1px, transparent 1px); background-size: 30px 30px;"></div>
    
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row g-5 align-items-center justify-content-between">
            <div class="col-xl-6 col-lg-7">
                <div class="new_banner__contents">
                    <!-- Badge -->
                    <div class="hero-badge mb-3" style="display: inline-block; padding: 7px 18px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50px; color: #fff; font-size: 13px; font-weight: 600; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                        <i class="fa-solid fa-star me-2"></i> <?php echo e(__('Trusted Maintenance Platform')); ?>

                    </div>
                    
                    <h2 class="new_banner__contents__title" style="font-size: 2.8rem; line-height: 1.3; font-weight: 800; margin-bottom: 1.2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        <?php echo e($title_start); ?> <span class="color-three" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"> <?php echo e($title_end); ?> </span>
                    </h2>
                    <p class="new_banner__contents__para mt-3" style="font-size: 1.1rem; line-height: 1.7; color: #6c757d; max-width: 90%;"><?php echo e($subtitle); ?></p>
                    <!-- Statistics -->
                    <div class="hero-statistics mt-4 mb-4" style="display: flex; gap: 2rem; flex-wrap: wrap;">
                        <div class="stat-item" style="display: flex; align-items: center; gap: 0.5rem;">
                            <div class="stat-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                                <i class="fa-solid fa-city"></i>
                            </div>
                            <div>
                                <div class="stat-number" style="font-size: 1.5rem; font-weight: 700; color: #2d3748;"><?php echo e(__('Cities Coverage')); ?></div>
                                <div class="stat-label" style="font-size: 0.9rem; color: #718096;"><?php echo e(__('Multiple Cities')); ?></div>
                            </div>
                        </div>
                        <div class="stat-item" style="display: flex; align-items: center; gap: 0.5rem;">
                            <div class="stat-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <div>
                                <div class="stat-number" style="font-size: 1.5rem; font-weight: 700; color: #2d3748;"><?php echo e(__('Certified Technicians')); ?></div>
                                <div class="stat-label" style="font-size: 0.9rem; color: #718096;"><?php echo e(__('Expert Team')); ?></div>
                            </div>
                        </div>
                        <div class="stat-item" style="display: flex; align-items: center; gap: 0.5rem;">
                            <div class="stat-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <div class="stat-number" style="font-size: 1.5rem; font-weight: 700; color: #2d3748;"><?php echo e(__('24/7 Service')); ?></div>
                                <div class="stat-label" style="font-size: 0.9rem; color: #718096;"><?php echo e(__('Always Available')); ?></div>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($satisfied_customer_show_hide)): ?>
                        <div class="new_banner__reviewer mt-4">
                            <div class="new_banner__reviewer__flex d-flex">
                                <?php $__currentLoopData = $satisfied_customer_images['satisfied_customer_image_'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="new_banner__reviewer__thumb">
                                    <a href="javascript:void(0)">
                                        <?php echo render_image_markup_by_attachment_id($customer_image); ?>

                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <h4 class="new_banner__reviewer__title"><a href="javascript:void(0)"><?php echo e($satisfied_customer_title); ?></a></h4>
                        </div>
                    <?php endif; ?>

                    <div class="btn-wrapper btn_flex mt-4" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <?php if(!empty($button_one_show_hide)): ?>
                            <a href="<?php echo e(url('/qr')); ?>" class="cmn-btn btn-outline-2 radius-5" style="padding: 1rem 2.5rem; border: 2px solid #dc3545; color: #dc3545; font-weight: 600; border-radius: 12px; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i class="fa-solid fa-qrcode"></i><?php echo e($button_one_title ?: __('Request Service')); ?>

                            </a>
                        <?php endif; ?>
                        <?php if(!empty($button_two_show_hide)): ?>
                            <a href="<?php echo e($button_two_link); ?>" class="cmn-btn btn-bg-2 radius-5" style="padding: 1rem 2.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; font-weight: 600; border-radius: 12px; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                                <i class="fa-solid fa-hand-holding-hand"></i><?php echo e($button_two_title); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5">
                <div class="new_banner__wrapper" style="position: relative;">
                    <!-- Floating Elements -->
                    <div class="floating-element" style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; opacity: 0.1; z-index: 0; animation: float 6s ease-in-out infinite;"></div>
                    <div class="floating-element" style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; opacity: 0.1; z-index: 0; animation: float 8s ease-in-out infinite reverse;"></div>
                    
                    <div class="new_banner__thumb" style="position: relative; z-index: 1;">
                        <div class="new_banner__thumb__flex">
                            <div class="new_banner__thumb__item" style="transform: translateY(-20px); transition: transform 0.3s;">
                                <div class="new_banner__thumb__main" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
                                    <?php echo $image_two; ?>

                                </div>
                            </div>
                            <div class="new_banner__thumb__item" style="transform: translateY(20px); transition: transform 0.3s;">
                                <div class="new_banner__thumb__main" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">  <?php echo $image_one; ?> </div>
                                <?php if(!empty($review_banner_show_hide)): ?>
                                    <div class="new_banner__thumb__contents d-flex" style="position: absolute; bottom: 20px; left: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 1rem 1.5rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                        <div class="new_banner__thumb__contents__icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px; margin-right: 1rem;">
                                            <i class="<?php echo e($review_icon ?? 'fa-solid fa-star'); ?>"></i>
                                        </div>
                                        <div>
                                            <p class="new_banner__thumb__contents__para" style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #2d3748;"><?php echo e($five_star_review_clients_count); ?>+</p>
                                            <p style="margin: 0; font-size: 0.9rem; color: #718096;"><?php echo e($review_title ?: __('5 Star Reviews')); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.hero-section-enhanced .new_banner__thumb__item:hover {
    transform: translateY(-10px) !important;
}

.hero-section-enhanced .new_banner__search__button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5) !important;
}

.hero-section-enhanced .cmn-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4) !important;
}

.hero-section-enhanced .btn-outline-2:hover {
    background-color: #dc3545 !important;
    color: #fff !important;
    border-color: #dc3545 !important;
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4) !important;
}

.hero-section-enhanced .btn-service-request:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5) !important;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

@media (max-width: 1200px) {
    .hero-section-enhanced {
        padding-top: 170px !important;
    }
    .hero-section-enhanced .new_banner__contents__title {
        font-size: 2.4rem !important;
    }
}

@media (max-width: 768px) {
    .hero-section-enhanced {
        padding-top: 160px !important;
    }
    .hero-section-enhanced .new_banner__contents__title {
        font-size: 2rem !important;
        line-height: 1.2 !important;
    }
    .hero-section-enhanced .new_banner__contents__para {
        font-size: 1rem !important;
    }
    .hero-statistics {
        gap: 1rem !important;
    }
    .stat-item {
        flex: 1 1 calc(50% - 0.5rem);
    }
    .stat-item .stat-number {
        font-size: 1.2rem !important;
    }
    .stat-item .stat-label {
        font-size: 0.85rem !important;
    }
}

@media (max-width: 576px) {
    .hero-section-enhanced {
        padding-top: 140px !important;
        padding-bottom: 60px !important;
    }
    .hero-section-enhanced .new_banner__contents__title {
        font-size: 1.75rem !important;
        margin-bottom: 1rem !important;
    }
    .hero-section-enhanced .new_banner__contents__para {
        font-size: 0.95rem !important;
    }
    .hero-badge {
        font-size: 12px !important;
        padding: 6px 15px !important;
    }
}
</style>
<!-- Banner area end --><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\app\Providers/../PageBuilder/views/headers/header-five.blade.php ENDPATH**/ ?>