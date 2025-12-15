<!-- Banner area Starts -->
<div class="new_banner_area new-section-bg padding-top-100 padding-bottom-100 hero-section-enhanced" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}"
     style="background-color: {{$header_background_color}}; position: relative; overflow: hidden; padding-top: 180px !important; padding-bottom: 80px !important;">
    <!-- Background Pattern -->
    <div class="hero-bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.03; z-index: 0; background-image: radial-gradient(circle, #000 1px, transparent 1px); background-size: 30px 30px;"></div>
    
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row g-5 align-items-center justify-content-between">
            <div class="col-xl-6 col-lg-7">
                <div class="new_banner__contents">
                    <div class="btn-wrapper mb-4" style="display: flex; justify-content: center; width: 100%;">
                        <a href="{{ url('/qr') }}" class="cmn-btn btn-bg-2 radius-5" style="padding: 1rem 2.5rem; background: #FFD700; color: #000; font-weight: 600; border-radius: 12px; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);">
                            <i class="fa-solid fa-wrench"></i>{{__('أطلب صيانة الآن')}}
                        </a>
                    </div>
                    
                    <h2 class="new_banner__contents__title" style="font-size: 2.8rem; line-height: 1.3; font-weight: 800; margin-bottom: 0.8rem; color: #000; text-align: center;">
                        @if(!empty($highlighted_word))
                            {!! $title_start !!} {!! $highlighted_word !!} <span style="color: #000;">{{$title_end}}</span>
                        @else
                            {!! $title_start !!} <span class="color-three" style="color: #FFD700;"> {{$title_end}} </span>
                        @endif
                    </h2>
                    
                    <p class="hero-subtitle-text" style="font-size: 1rem; line-height: 1.6; font-weight: 400; color: #666; text-align: center; margin-bottom: 1.2rem; opacity: 0.9;">
                        لدينا فريق فني متخصص لخدمتكم علي مدار اليوم
                    </p>

                    @if(!empty($satisfied_customer_show_hide))
                        <div class="new_banner__reviewer mt-4">
                            <div class="new_banner__reviewer__flex d-flex">
                                @foreach ($satisfied_customer_images['satisfied_customer_image_'] ?? [] as $key => $customer_image)
                                <div class="new_banner__reviewer__thumb">
                                    <a href="javascript:void(0)">
                                        {!! render_image_markup_by_attachment_id($customer_image) !!}
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <h4 class="new_banner__reviewer__title"><a href="javascript:void(0)">{{ $satisfied_customer_title }}</a></h4>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-6 col-lg-5">
                <div class="new_banner__wrapper" style="position: relative;">
                    <!-- Floating Elements -->
                    <div class="floating-element" style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: #FFD700; border-radius: 50%; opacity: 0.1; z-index: 0; animation: float 6s ease-in-out infinite;"></div>
                    <div class="floating-element" style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: #FFD700; border-radius: 50%; opacity: 0.1; z-index: 0; animation: float 8s ease-in-out infinite reverse;"></div>
                    
                    <div class="new_banner__thumb" style="position: relative; z-index: 1;">
                        <div class="hero-video-wrapper" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2); position: relative; width: 100%; max-width: 100%;">
                            <video autoplay muted loop playsinline style="width: 100%; height: auto; min-height: 400px; object-fit: cover; display: block; border-radius: 20px;" preload="auto">
                                <source src="{{ asset('assets/frontend/img/SyanaTech_Maintenance_Video_Creation.mp4') }}" type="video/mp4">
                                متصفحك لا يدعم تشغيل الفيديو.
                            </video>
                            @if(!empty($review_banner_show_hide))
                                <div class="new_banner__thumb__contents d-flex" style="position: absolute; bottom: 20px; left: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 1rem 1.5rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 2;">
                                    <div class="new_banner__thumb__contents__icon" style="width: 50px; height: 50px; background: #FFD700; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #000; font-size: 24px; margin-right: 1rem;">
                                        <i class="{{$review_icon ?? 'fa-solid fa-star'}}"></i>
                                    </div>
                                    <div>
                                        <p class="new_banner__thumb__contents__para" style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #2d3748;">{{$five_star_review_clients_count}}+</p>
                                        <p style="margin: 0; font-size: 0.9rem; color: #718096;">{{ $review_title ?: __('5 Star Reviews') }}</p>
                                    </div>
                                </div>
                            @endif
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

.hero-video-wrapper {
    position: relative;
    width: 100%;
    max-width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    background: #000;
}

.hero-video-wrapper video {
    width: 100%;
    height: auto;
    min-height: 400px;
    max-height: 600px;
    display: block;
    border-radius: 20px;
    object-fit: cover;
}

@media (max-width: 768px) {
    .hero-video-wrapper video {
        min-height: 300px;
        max-height: 400px;
    }
}

@media (max-width: 576px) {
    .hero-video-wrapper video {
        min-height: 250px;
        max-height: 350px;
    }
}

.hero-section-enhanced .new_banner__thumb__item:hover {
    transform: translateY(-10px) !important;
}

.hero-section-enhanced .new_banner__search__button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5) !important;
}

.hero-section-enhanced .cmn-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4) !important;
}

.hero-section-enhanced .btn-outline-2:hover {
    background-color: #FFD700 !important;
    color: #000 !important;
    border-color: #FFD700 !important;
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4) !important;
}

.hero-section-enhanced .btn-service-request:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5) !important;
    background: #FFD700 !important;
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
    .hero-subtitle-text {
        font-size: 0.9rem !important;
        margin-bottom: 1rem !important;
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
        margin-bottom: 0.8rem !important;
    }
    .hero-section-enhanced .new_banner__contents__para {
        font-size: 0.95rem !important;
    }
    .hero-subtitle-text {
        font-size: 0.85rem !important;
        margin-bottom: 0.8rem !important;
        line-height: 1.5 !important;
    }
    .hero-badge {
        font-size: 12px !important;
        padding: 6px 15px !important;
    }
}
</style>
<!-- Banner area end -->