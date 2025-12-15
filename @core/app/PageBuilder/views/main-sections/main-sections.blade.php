<!-- Main Sections Area Starts -->
<section class="main-sections-area section-padding section-wrapper" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background-color:{{$section_bg}}">
    <div class="container">
        <!-- Section Header -->
        <div class="section-title-wrapper text-center mb-5">
            <h2 class="section-title">{{ $title }}</h2>
            @if(!empty($subtitle))
                <p class="section-subtitle mt-3">{{ $subtitle }}</p>
            @endif
        </div>
        
        <!-- Sections Grid -->
        <div class="row g-4 main-sections-grid">
            <!-- Maintenance Section - Active -->
            <div class="col-lg-4 col-md-6">
                <div class="main-section-card active">
                    <div class="section-card-inner">
                        <div class="section-card-icon" style="background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);">
                            <i class="{{ $maintenance_icon }}"></i>
                        </div>
                        <div class="section-card-content">
                            <h4 class="section-card-title">{{ $maintenance_title }}</h4>
                            <p class="section-card-description">{{ $maintenance_description }}</p>
                            <a href="{{ $maintenance_link }}" class="section-card-btn">
                                <span>{{ __('استكشف الخدمات') }}</span>
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Finishing Section - Coming Soon -->
            <div class="col-lg-4 col-md-6">
                <div class="main-section-card disabled">
                    <div class="section-card-inner">
                        <div class="section-card-icon" style="background: linear-gradient(135deg, #999 0%, #666 100%);">
                            <i class="{{ $finishing_icon }}"></i>
                        </div>
                        <div class="section-card-content">
                            <h4 class="section-card-title">{{ $finishing_title }}</h4>
                            <p class="section-card-description">{{ $finishing_description }}</p>
                            <div class="section-card-badge">
                                <span class="coming-soon-badge">
                                    <i class="las la-clock"></i> {{ __('قريباً') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Foundation Section - Coming Soon -->
            <div class="col-lg-4 col-md-6">
                <div class="main-section-card disabled">
                    <div class="section-card-inner">
                        <div class="section-card-icon" style="background: linear-gradient(135deg, #999 0%, #666 100%);">
                            <i class="{{ $foundation_icon }}"></i>
                        </div>
                        <div class="section-card-content">
                            <h4 class="section-card-title">{{ $foundation_title }}</h4>
                            <p class="section-card-description">{{ $foundation_description }}</p>
                            <div class="section-card-badge">
                                <span class="coming-soon-badge">
                                    <i class="las la-clock"></i> {{ __('قريباً') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main Sections Area Ends -->

<style>
/* ============================================
   Main Sections - Modern Design
   ============================================ */

.main-sections-grid {
    position: relative;
    z-index: 1;
    margin-top: 40px;
}

/* Section Card */
.main-section-card {
    height: 100%;
    opacity: 0;
    transform: translateY(40px);
    animation: cardFadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.main-section-card:nth-child(1) {
    animation-delay: 0.1s;
}

.main-section-card:nth-child(2) {
    animation-delay: 0.2s;
}

.main-section-card:nth-child(3) {
    animation-delay: 0.3s;
}

@keyframes cardFadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.section-card-inner {
    background: #fff;
    border-radius: 20px;
    padding: 40px 30px;
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

.main-section-card.active .section-card-inner {
    border-color: rgba(255, 215, 0, 0.3);
}

.main-section-card.active .section-card-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    z-index: 2;
}

.main-section-card.active:hover .section-card-inner {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border-color: rgba(255, 215, 0, 0.5);
}

.main-section-card.disabled .section-card-inner {
    opacity: 0.6;
    filter: grayscale(0.3);
    cursor: not-allowed;
}

.main-section-card.disabled:hover .section-card-inner {
    transform: none;
}

/* Section Card Icon */
.section-card-icon {
    width: 100px;
    height: 100px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.section-card-icon i {
    font-size: 48px;
    color: #fff;
    transition: all 0.3s ease;
}

.main-section-card.active:hover .section-card-icon {
    transform: scale(1.15) rotate(5deg);
    box-shadow: 0 12px 30px rgba(255, 215, 0, 0.4);
}

/* Section Card Content */
.section-card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
}

.section-card-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: #000;
    margin-bottom: 16px;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.main-section-card.active:hover .section-card-title {
    color: #FFD700;
}

.section-card-description {
    font-size: 1rem;
    line-height: 1.7;
    color: #666;
    margin-bottom: 24px;
    flex: 1;
}

/* Section Card Button */
.section-card-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 28px;
    background: #FFD700;
    color: #000;
    border-radius: 10px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-top: auto;
    width: 100%;
}

.section-card-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.section-card-btn:hover {
    background: #FFA500;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    color: #000;
}

.section-card-btn:hover i {
    transform: translateX(-4px);
}

/* Coming Soon Badge */
.section-card-badge {
    margin-top: auto;
    width: 100%;
}

.coming-soon-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    background: #f0f0f0;
    color: #666;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    width: 100%;
}

.coming-soon-badge i {
    font-size: 16px;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .section-card-inner {
        padding: 35px 25px;
    }
    
    .section-card-icon {
        width: 90px;
        height: 90px;
    }
    
    .section-card-icon i {
        font-size: 42px;
    }
    
    .section-card-title {
        font-size: 1.6rem;
    }
}

@media (max-width: 992px) {
    .section-card-inner {
        padding: 30px 20px;
        border-radius: 16px;
    }
    
    .section-card-icon {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
    }
    
    .section-card-icon i {
        font-size: 36px;
    }
    
    .section-card-title {
        font-size: 1.5rem;
        margin-bottom: 12px;
    }
    
    .section-card-description {
        font-size: 0.95rem;
        margin-bottom: 20px;
    }
}

@media (max-width: 768px) {
    .section-card-inner {
        padding: 28px 20px;
    }
    
    .section-card-icon {
        width: 70px;
        height: 70px;
        margin-bottom: 16px;
    }
    
    .section-card-icon i {
        font-size: 32px;
    }
    
    .section-card-title {
        font-size: 1.35rem;
        margin-bottom: 10px;
    }
    
    .section-card-description {
        font-size: 0.9rem;
        margin-bottom: 18px;
    }
    
    .section-card-btn {
        padding: 12px 24px;
        font-size: 14px;
    }
    
    .coming-soon-badge {
        padding: 10px 20px;
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .section-card-inner {
        padding: 24px 16px;
        border-radius: 12px;
    }
    
    .section-card-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 16px;
    }
    
    .section-card-icon i {
        font-size: 28px;
    }
    
    .section-card-title {
        font-size: 1.25rem;
    }
    
    .section-card-description {
        font-size: 0.85rem;
    }
}
</style>

