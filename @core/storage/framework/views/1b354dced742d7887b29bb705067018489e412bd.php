<!-- Choose area starts -->
<section class="new_choose_area why-choose-section section-padding section-wrapper" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>" style="background-color:<?php echo e($section_bg); ?>">
    <!-- Background Decoration -->
    <div class="why-choose-bg-decoration">
        <i class="fa-solid fa-gear"></i>
    </div>
    
    <div class="container">
        <div class="section-title-wrapper">
            <h2 class="section-title title"><?php echo e($section_title); ?></h2>
            <p class="section-subtitle section-para"><?php echo e($subtitle); ?></p>
        </div>
        
        <!-- CTA Button Below Text -->
        <div class="text-center mt-4 mb-5">
            <?php if(!empty($customer_btn_text)): ?>
            <a href="<?php echo e($customer_btn_link); ?>" class="why-choose-cta-btn">
                <i class="fa-solid fa-user-plus"></i>
                <span><?php echo e($customer_btn_text); ?></span>
            </a>
            <?php endif; ?>
        </div>
        
        <div class="row g-4 why-choose-cards-wrapper">
            <?php $__currentLoopData = $repeater_data['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-md-6">
                <div class="why-choose-card-modern" style="animation-delay: <?php echo e($key * 0.15); ?>s;">
                    <div class="why-choose-card-inner">
                        <div class="why-choose-card-icon">
                            <div class="icon-wrapper">
                                <?php echo render_image_markup_by_attachment_id($repeater_data['image_'][$key]); ?>

                            </div>
                        </div>
                        <div class="why-choose-card-content">
                            <h5 class="why-choose-card-title"><?php echo e($title); ?></h5>
                            <p class="why-choose-card-description"><?php echo e($repeater_data['description_'][$key]); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<style>
/* ============================================
   Why Choose Section - Modern Enhanced Design
   ============================================ */

/* Background Decoration */
.why-choose-bg-decoration {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 600px;
    height: 600px;
    opacity: 0.03;
    z-index: 0;
    pointer-events: none;
}

.why-choose-bg-decoration i {
    font-size: 600px;
    color: #000;
    animation: rotateGear 30s linear infinite;
}

@keyframes rotateGear {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@media (max-width: 992px) {
    .why-choose-bg-decoration {
        width: 400px;
        height: 400px;
    }
    .why-choose-bg-decoration i {
        font-size: 400px;
    }
}

@media (max-width: 768px) {
    .why-choose-bg-decoration {
        width: 300px;
        height: 300px;
    }
    .why-choose-bg-decoration i {
        font-size: 300px;
    }
}

/* Section Title Wrapper */
.why-choose-section .section-title-wrapper {
    position: relative;
    z-index: 1;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .why-choose-section .section-title-wrapper {
        margin-bottom: 0;
    }
}

/* CTA Button */
.why-choose-cta-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 16px 32px;
    background: #FFD700 !important;
    color: #000 !important;
    font-weight: 700;
    font-size: 16px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    position: relative;
    overflow: hidden;
    border: none;
}

.why-choose-cta-btn::before {
    content: '';
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

.why-choose-cta-btn:hover::before {
    width: 400px;
    height: 400px;
}

.why-choose-cta-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.5);
    background: #FFA500 !important;
}

.why-choose-cta-btn i {
    font-size: 18px;
    position: relative;
    z-index: 1;
}

.why-choose-cta-btn span {
    position: relative;
    z-index: 1;
}

/* Cards Wrapper */
.why-choose-cards-wrapper {
    position: relative;
    z-index: 1;
    margin-top: 48px;
}

@media (max-width: 768px) {
    .why-choose-cards-wrapper {
        margin-top: 32px;
    }
}

/* Modern Card Design */
.why-choose-card-modern {
    height: 100%;
    opacity: 0;
    transform: translateY(40px);
    animation: cardFadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@keyframes cardFadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.why-choose-card-inner {
    background: #fff;
    border-radius: 20px;
    padding: 32px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: 2px solid transparent;
}

.why-choose-card-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
}

.why-choose-card-modern:hover .why-choose-card-inner {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border-color: rgba(255, 215, 0, 0.2);
}

.why-choose-card-modern:hover .why-choose-card-inner::before {
    transform: scaleX(1);
}

/* Icon Wrapper */
.why-choose-card-icon {
    margin-bottom: 24px;
    position: relative;
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.icon-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.why-choose-card-modern:hover .icon-wrapper {
    transform: scale(1.15) rotate(5deg);
}

.why-choose-card-modern:hover .icon-wrapper img {
    filter: brightness(1.1);
}

/* Card Content */
.why-choose-card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
}

.why-choose-card-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #000;
    margin-bottom: 16px;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.why-choose-card-modern:hover .why-choose-card-title {
    color: #FFD700;
}

.why-choose-card-description {
    font-size: 1rem;
    line-height: 1.7;
    color: #666;
    margin: 0;
    flex: 1;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .why-choose-card-inner {
        padding: 28px;
    }
    
    .icon-wrapper {
        width: 70px;
        height: 70px;
    }
    
    .why-choose-card-title {
        font-size: 1.35rem;
    }
}

@media (max-width: 992px) {
    .why-choose-card-inner {
        padding: 24px;
        border-radius: 16px;
    }
    
    .icon-wrapper {
        width: 65px;
        height: 65px;
    }
    
    .why-choose-card-title {
        font-size: 1.25rem;
        margin-bottom: 12px;
    }
    
    .why-choose-card-description {
        font-size: 0.95rem;
    }
}

@media (max-width: 768px) {
    .why-choose-section .section-title {
        font-size: 1.75rem;
    }
    
    .why-choose-section .section-subtitle {
        font-size: 1rem;
    }
    
    .why-choose-cta-btn {
        padding: 14px 28px;
        font-size: 15px;
        width: 100%;
        max-width: 300px;
    }
    
    .why-choose-card-inner {
        padding: 24px 20px;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
    }
    
    .why-choose-card-title {
        font-size: 1.15rem;
        margin-bottom: 12px;
    }
    
    .why-choose-card-description {
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .why-choose-cards-wrapper {
        gap: 20px !important;
    }
}

@media (max-width: 576px) {
    .why-choose-card-inner {
        padding: 20px 16px;
        border-radius: 12px;
    }
    
    .icon-wrapper {
        width: 55px;
        height: 55px;
        margin-bottom: 16px;
    }
    
    .why-choose-card-title {
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    
    .why-choose-card-description {
        font-size: 0.85rem;
    }
}

/* Override existing styles */
.why-choose-section .cmn-btn:hover {
    transform: translateY(-3px);
    background: #FFD700 !important;
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5) !important;
}

.why-choose-section .btn-outline-1:hover {
    background: #FFD700 !important;
    color: #fff !important;
    border-color: transparent !important;
}
</style>
<!-- Choose area end --><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\app\Providers/../PageBuilder/views/marketplaces/why-our-marketplace-three.blade.php ENDPATH**/ ?>