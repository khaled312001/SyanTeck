<?php
    $navClasses = request()->is('/') ? 'navbar navbar-area white navbar-dark bg-dark nav-absolute navbar-expand-lg navbar-border' : 'navbar navbar-area white navbar-dark bg-dark navbar-expand-lg navbar-border';
?>
<header class="header-style-01">
    <nav class="<?php echo e($navClasses); ?> enhanced-navbar <?php echo e($page_post->page_class ?? ''); ?>" id="mainNavbar01">
        <div class="container container-two nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(route('homepage')); ?>" class="logo" style="transition: transform 0.3s ease;">
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

                    </a>
                </div>

                <div class="onlymobile-device-account-navbar">
                    <div class="onlymobile-device-account-navbar-flex">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>

                <button class="navbar-toggler enhanced-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bizcoxx_main_menu_navbar_one" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-text">القائمة</span>
                </button>
            </div>

            <div class="collapse navbar-collapse enhanced-navbar-collapse" id="bizcoxx_main_menu_navbar_one">
                <ul class="navbar-nav enhanced-navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>

            <div class="nav-right-content enhanced-nav-right">
                <div class="navbar-right-inner">
                    <div class="info-bar-item">
                        <?php if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0): ?>
                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                                <div class="notification-icon icon">
                                    <?php if(Auth::guard('web')->check()): ?>
                                        <span class="text-white"> <i class="las la-bell"></i> </span>
                                        <span class="notification-number">
                                        <?php echo e(Auth()->user()->unreadNotifications()->count()); ?>

                                    </span>
                                    <?php endif; ?>

                                    <div class="notification-list-item mt-2">
                                        <h5 class="notification-title"><?php echo e(__('Notifications')); ?></h5>
                                        <div class="list">
                                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->count() >=1): ?>
                                                <span>

                                      <!-- seller ticket Notifications-->
                                        <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($notification->data['seller_last_ticket_id'])): ?>
                                                            <a class="list-order" href="<?php echo e(route('seller.support.ticket.view',$notification->data['seller_last_ticket_id'])); ?>">
                                                            <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                            <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['seller_last_ticket_id']); ?>

                                                        </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                               <!-- seller order Notifications-->
                                            <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications()->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($notification->data['order_id'])): ?>
                                                            <a class="list-order" href="<?php echo e(route('seller.order.details',$notification->data['order_id'])); ?>">
                                                        <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                        <?php echo e($notification->data['order_message']); ?> #<?php echo e($notification->data['order_id']); ?>

                                                    </a>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>

                                                <a class="p-2 text-center d-block" href="<?php echo e(route('seller.notification.all')); ?>"><?php echo e(__('View All Notification')); ?></a>
                                            <?php else: ?>
                                                <p class="text-center text-white padding-3"><?php echo e(__('No New Notification')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
/* Enhanced Navbar 01 Styles (White/Dark Theme) - Improved Dimensions */
.enhanced-navbar.white {
    transition: all 0.3s ease;
}

.enhanced-navbar.white .nav-container {
    padding: 20px 0 !important;
    min-height: 110px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.enhanced-navbar.white.scrolled {
    background: rgba(0, 0, 0, 0.95) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.enhanced-navbar.white.scrolled .nav-container {
    padding: 14px 0 !important;
    min-height: 90px;
}

.enhanced-navbar.white .logo-wrapper {
    display: flex;
    align-items: center;
    min-width: 180px;
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
    max-height: 75px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: all 0.3s ease;
}

.enhanced-navbar.white.scrolled .logo img {
    max-height: 65px;
}

.enhanced-navbar.white .enhanced-navbar-toggler {
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    border-radius: 10px;
    padding: 10px 16px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 120px;
    justify-content: center;
}

.enhanced-navbar.white .enhanced-navbar-toggler:hover {
    border-color: rgba(255, 255, 255, 0.6) !important;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
}

.enhanced-navbar.white .enhanced-navbar-toggler .navbar-toggler-text {
    font-size: 15px;
    font-weight: 600;
    color: #fff;
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
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.5;
    position: relative;
    overflow: hidden;
    color: rgba(255, 255, 255, 0.95) !important;
    display: inline-block;
    white-space: nowrap;
}

.enhanced-navbar.white .enhanced-navbar-nav > li > a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.7) 100%);
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 3px 3px 0 0;
}

.enhanced-navbar.white .enhanced-navbar-nav > li:hover > a,
.enhanced-navbar.white .enhanced-navbar-nav > li.active > a {
    color: #fff !important;
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-1px);
}

.enhanced-navbar.white .enhanced-navbar-nav > li:hover > a::before,
.enhanced-navbar.white .enhanced-navbar-nav > li.active > a::before {
    width: 85%;
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
    padding: 8px 16px;
    border-radius: 25px;
    transition: all 0.3s ease;
    font-size: 15px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.95);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.enhanced-navbar.white .login-account .accounts:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(255, 255, 255, 0.2);
    color: #fff;
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
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

.enhanced-navbar.white .notification-icon:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.enhanced-navbar.white .notification-icon i {
    font-size: 20px;
    color: rgba(255, 255, 255, 0.95);
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

/* Mobile Enhancements for Navbar 01 */
@media (max-width: 991.98px) {
    .enhanced-navbar.white .nav-container {
        padding: 14px 0 !important;
        min-height: 85px;
        flex-wrap: wrap;
    }
    
    .enhanced-navbar.white .logo-wrapper {
        min-width: 150px;
    }
    
    .enhanced-navbar.white .logo img {
        max-height: 60px;
    }
    
    .enhanced-navbar.white.scrolled .logo img {
        max-height: 55px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-toggler {
        padding: 8px 14px;
        min-width: 110px;
        gap: 8px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-toggler .navbar-toggler-text {
        font-size: 14px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-collapse {
        background: rgba(0, 0, 0, 0.95);
        border-radius: 15px;
        margin-top: 15px;
        padding: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        width: 100%;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav {
        flex-direction: column;
        width: 100%;
        gap: 8px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li {
        width: 100%;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li > a {
        padding: 14px 20px !important;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 5px;
        width: 100%;
        text-align: right;
        font-size: 15px;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li > a::before {
        display: none;
    }
    
    .enhanced-navbar.white .enhanced-navbar-nav > li:hover > a,
    .enhanced-navbar.white .enhanced-navbar-nav > li.active > a {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateX(-5px);
    }
    
    .enhanced-navbar.white .enhanced-navbar-toggler[aria-expanded="true"] {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5) !important;
    }
    
    .enhanced-navbar.white .enhanced-nav-right {
        width: 100%;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        gap: 15px;
    }
    
    .enhanced-navbar.white .navbar-right-inner {
        width: 100%;
        justify-content: space-between;
        gap: 12px;
    }
    
    .enhanced-navbar.white .login-account .accounts {
        padding: 6px 12px;
        font-size: 14px;
    }
    
    .enhanced-navbar.white .notification-icon {
        width: 40px;
        height: 40px;
    }
    
    .enhanced-navbar.white .notification-icon i {
        font-size: 18px;
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

<script>
// Navbar 01 scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const navbar01 = document.getElementById('mainNavbar01');
    if (navbar01) {
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar01.classList.add('scrolled');
            } else {
                navbar01.classList.remove('scrolled');
            }
        });
    }
    
    // Mobile menu close on link click
    const mobileMenuLinks = document.querySelectorAll('#bizcoxx_main_menu_navbar_one .enhanced-navbar-nav a');
    const mobileMenuCollapse = document.getElementById('bizcoxx_main_menu_navbar_one');
    
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
</script><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/frontend/partials/pages-portion/navbars/navbar-01.blade.php ENDPATH**/ ?>