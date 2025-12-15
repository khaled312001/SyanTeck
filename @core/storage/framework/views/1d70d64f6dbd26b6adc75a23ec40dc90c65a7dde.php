<!-- Join Team Section Starts -->
<section class="join-team-section section-padding section-wrapper" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>" style="background-color:<?php echo e($section_bg); ?>">
    <!-- Background Decoration -->
    <div class="join-team-bg-decoration">
        <div class="bg-text">صيانة</div>
        <div class="bg-shapes">
            <span class="shape-1"></span>
            <span class="shape-2"></span>
            <span class="shape-3"></span>
        </div>
    </div>
    
    <div class="container">
        <!-- Section Header -->
        <div class="section-title-wrapper text-center mb-5">
            <h2 class="section-title" style="color:<?php echo e($title_text_color); ?>">انضم إلى فريق عمل صيانة تك</h2>
            <p class="section-subtitle mt-3">نوفر فرص عمل متنوعة في مختلف المجالات التقنية والإدارية</p>
        </div>
        
        <!-- Job Categories Grid -->
        <div class="row g-4 job-categories-grid">
            <?php
                $job_categories = [
                    [
                        'title' => 'فني كهرباء',
                        'icon' => 'fa-solid fa-bolt',
                        'description' => 'صيانة وإصلاح الأعطال الكهربائية',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'فني سباكة',
                        'icon' => 'fa-solid fa-faucet-drip',
                        'description' => 'تركيب وصيانة أنظمة السباكة',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'فني تكييف',
                        'icon' => 'fa-solid fa-snowflake',
                        'description' => 'صيانة وتركيب أجهزة التكييف',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'فني أجهزة منزلية',
                        'icon' => 'fa-solid fa-house',
                        'description' => 'إصلاح وصيانة الأجهزة المنزلية',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'دعم فني',
                        'icon' => 'fa-solid fa-headset',
                        'description' => 'دعم العملاء وحل المشاكل التقنية',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'ماركتنج',
                        'icon' => 'fa-solid fa-bullhorn',
                        'description' => 'التسويق الرقمي والإعلانات',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'مبيعات',
                        'icon' => 'fa-solid fa-handshake',
                        'description' => 'إدارة المبيعات والتسويق',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ],
                    [
                        'title' => 'فني إلكترونيات',
                        'icon' => 'fa-solid fa-microchip',
                        'description' => 'صيانة الأجهزة الإلكترونية',
                        'link' => route('user.register', ['type' => 'seller']),
                        'color' => '#FFD700'
                    ]
                ];
            ?>
            
            <?php $__currentLoopData = $job_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="job-card-modern" style="animation-delay: <?php echo e($index * 0.1); ?>s;">
                    <div class="job-card-inner">
                        <div class="job-card-icon" style="background: linear-gradient(135deg, <?php echo e($job['color']); ?> 0%, #FFA500 100%);">
                            <i class="<?php echo e($job['icon']); ?>"></i>
                        </div>
                        <div class="job-card-content">
                            <h5 class="job-card-title"><?php echo e($job['title']); ?></h5>
                            <p class="job-card-description"><?php echo e($job['description']); ?></p>
                            <a href="<?php echo e($job['link']); ?>" class="job-card-btn">
                                <span>انضم الآن</span>
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Benefits Section -->
        <?php if(!empty($content_list_show_hide) && isset($repeater_data['benifits_'])): ?>
        <div class="benefits-section mt-5">
            <div class="benefits-wrapper">
                <h3 class="benefits-title">مميزات الانضمام لفريقنا</h3>
                <div class="row g-3 mt-3">
                    <?php $__currentLoopData = $repeater_data['benifits_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $benifits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="benefit-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span><?php echo e($benifits); ?></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- CTA Button -->
        <div class="text-center mt-5">
            <a href="<?php echo e($btn_link); ?>" class="join-team-cta-btn" style="background:<?php echo e($btn_color); ?>">
                <i class="fa-solid fa-user-plus"></i>
                <span><?php echo e($btn_text ?: 'انضم إلى فريقنا الآن'); ?></span>
            </a>
        </div>
    </div>
</section>
<!-- Join Team Section Ends -->

<style>
/* ============================================
   Join Team Section - Modern Enhanced Design
   ============================================ */

/* Background Decoration */
.join-team-bg-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
    pointer-events: none;
}

.join-team-bg-decoration .bg-text {
    position: absolute;
    bottom: -50px;
    left: -50px;
    font-size: 300px;
    font-weight: 900;
    color: rgba(0, 0, 0, 0.02);
    transform: rotate(-45deg);
    white-space: nowrap;
    line-height: 1;
}

.join-team-bg-decoration .bg-shapes {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
}

.join-team-bg-decoration .shape-1,
.join-team-bg-decoration .shape-2,
.join-team-bg-decoration .shape-3 {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 215, 0, 0.05);
}

.join-team-bg-decoration .shape-1 {
    width: 200px;
    height: 200px;
    top: 10%;
    right: 10%;
    animation: float 6s ease-in-out infinite;
}

.join-team-bg-decoration .shape-2 {
    width: 150px;
    height: 150px;
    bottom: 20%;
    left: 15%;
    animation: float 8s ease-in-out infinite reverse;
}

.join-team-bg-decoration .shape-3 {
    width: 100px;
    height: 100px;
    top: 50%;
    left: 5%;
    animation: float 7s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@media (max-width: 992px) {
    .join-team-bg-decoration .bg-text {
        font-size: 200px;
    }
}

@media (max-width: 768px) {
    .join-team-bg-decoration .bg-text {
        font-size: 150px;
    }
}

/* Section Title */
.join-team-section .section-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 16px;
}

@media (max-width: 992px) {
    .join-team-section .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .join-team-section .section-title {
        font-size: 1.75rem;
    }
}

/* Job Categories Grid */
.job-categories-grid {
    position: relative;
    z-index: 1;
    margin-top: 40px;
}

/* Job Card Modern */
.job-card-modern {
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

.job-card-inner {
    background: #fff;
    border-radius: 20px;
    padding: 32px 24px;
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

.job-card-inner::before {
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

.job-card-modern:hover .job-card-inner {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border-color: rgba(255, 215, 0, 0.2);
}

.job-card-modern:hover .job-card-inner::before {
    transform: scaleX(1);
}

/* Job Card Icon */
.job-card-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
}

.job-card-icon i {
    font-size: 36px;
    color: #000;
    transition: all 0.3s ease;
}

.job-card-modern:hover .job-card-icon {
    transform: scale(1.15) rotate(5deg);
    box-shadow: 0 12px 30px rgba(255, 215, 0, 0.4);
}

/* Job Card Content */
.job-card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
}

.job-card-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: #000;
    margin-bottom: 12px;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.job-card-modern:hover .job-card-title {
    color: #FFD700;
}

.job-card-description {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #666;
    margin-bottom: 20px;
    flex: 1;
}

/* Job Card Button */
.job-card-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    background: #FFD700;
    color: #000;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-top: auto;
    width: 100%;
}

.job-card-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.job-card-btn:hover {
    background: #FFA500;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
}

.job-card-btn:hover i {
    transform: translateX(-4px);
}

/* Benefits Section */
.benefits-section {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.5);
    padding: 40px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

.benefits-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: #000;
    text-align: center;
    margin-bottom: 24px;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.benefit-item:hover {
    transform: translateX(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.benefit-item i {
    color: #FFD700;
    font-size: 20px;
    flex-shrink: 0;
}

.benefit-item span {
    color: #333;
    font-weight: 500;
    font-size: 0.95rem;
}

/* CTA Button */
.join-team-cta-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 18px 40px;
    background: #FFD700 !important;
    color: #000 !important;
    font-weight: 700;
    font-size: 18px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    position: relative;
    overflow: hidden;
    border: none;
}

.join-team-cta-btn::before {
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

.join-team-cta-btn:hover::before {
    width: 400px;
    height: 400px;
}

.join-team-cta-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.5);
    background: #FFA500 !important;
}

.join-team-cta-btn i {
    font-size: 20px;
    position: relative;
    z-index: 1;
}

.join-team-cta-btn span {
    position: relative;
    z-index: 1;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .job-card-inner {
        padding: 28px 20px;
    }
    
    .job-card-icon {
        width: 70px;
        height: 70px;
    }
    
    .job-card-icon i {
        font-size: 32px;
    }
    
    .job-card-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 992px) {
    .job-card-inner {
        padding: 24px 20px;
        border-radius: 16px;
    }
    
    .job-card-icon {
        width: 65px;
        height: 65px;
        margin-bottom: 20px;
    }
    
    .job-card-icon i {
        font-size: 28px;
    }
    
    .job-card-title {
        font-size: 1.15rem;
        margin-bottom: 10px;
    }
    
    .job-card-description {
        font-size: 0.9rem;
        margin-bottom: 16px;
    }
    
    .benefits-section {
        padding: 30px 20px;
    }
}

@media (max-width: 768px) {
    .join-team-section .section-title {
        font-size: 1.75rem;
    }
    
    .join-team-section .section-subtitle {
        font-size: 1rem;
    }
    
    .job-categories-grid {
        margin-top: 32px;
    }
    
    .job-card-inner {
        padding: 24px 16px;
    }
    
    .job-card-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 16px;
    }
    
    .job-card-icon i {
        font-size: 24px;
    }
    
    .job-card-title {
        font-size: 1.1rem;
        margin-bottom: 8px;
    }
    
    .job-card-description {
        font-size: 0.85rem;
        margin-bottom: 16px;
    }
    
    .job-card-btn {
        padding: 10px 20px;
        font-size: 13px;
    }
    
    .benefits-section {
        padding: 24px 16px;
    }
    
    .benefits-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    
    .benefit-item {
        padding: 10px 12px;
    }
    
    .benefit-item i {
        font-size: 18px;
    }
    
    .benefit-item span {
        font-size: 0.9rem;
    }
    
    .join-team-cta-btn {
        padding: 16px 32px;
        font-size: 16px;
        width: 100%;
        max-width: 300px;
    }
}

@media (max-width: 576px) {
    .job-card-inner {
        padding: 20px 16px;
        border-radius: 12px;
    }
    
    .job-card-icon {
        width: 55px;
        height: 55px;
        margin-bottom: 16px;
    }
    
    .job-card-icon i {
        font-size: 22px;
    }
    
    .job-card-title {
        font-size: 1rem;
    }
    
    .job-card-description {
        font-size: 0.8rem;
    }
    
    .benefits-title {
        font-size: 1.35rem;
    }
}
</style><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\app\Providers/../PageBuilder/views/become-seller/become-seller-three.blade.php ENDPATH**/ ?>