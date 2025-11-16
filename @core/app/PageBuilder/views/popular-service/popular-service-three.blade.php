<!-- Service area starts -->
<section class="new_services_area padding-top-50 padding-bottom-50" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background-color:{{$section_bg}}">
    <div class="container">
        <div class="new_sectionTitle text-left title_flex">
            <h2 class="title">{{ $section_title }}</h2>
            <form action="{{ get_static_option('select_home_page_search_service_page_url') ?? url('/service-list') }}" method="get">
                <button class="new_exploreBtn bg-transparent border-0">{{ $explore_text }} <i class="fa-solid fa-angle-right"></i></button>
                <input type="hidden" name="sortby" value="popular"/>
            </form>
        </div>
        <div class="row g-4 mt-4">

            @foreach($services as $index => $service)
            @php
                $service_image_data = get_attachment_image_by_id($service->image, 'full', false);
                $default_image = asset('assets/uploads/no-image.png');
                $image_url = !empty($service_image_data) && is_array($service_image_data) && isset($service_image_data['img_url']) 
                    ? $service_image_data['img_url'] 
                    : $default_image;
                
                // حساب التقييم
                $total_review = optional($service->reviews);
                $total_count = $total_review->where('type', 1)->count();
                $rating = round($total_review->where('type', 1)->avg('rating'), 1);
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="new_service__single service-card-modern" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="service-card-image-wrapper">
                        <a href="{{ route('service.list.details',$service->slug) }}" class="service-image-link">
                            <div class="service-image-container">
                                <img src="{{ $image_url }}" alt="{{ $service->title }}" class="service-image" loading="lazy">
                                <div class="service-image-overlay">
                                    <span class="view-service-btn">
                                        <i class="las la-eye"></i>
                                        <span>{{ __('View Details') }}</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                        @if($service->featured == 1)
                        <div class="service-badge featured-badge">
                            <i class="las la-award"></i>
                            <span>{{ __('Featured') }}</span>
                        </div>
                        @endif
                        @if($rating >= 1)
                        <div class="service-badge rating-badge">
                            <i class="las la-star"></i>
                            <span>{{ $rating }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="service-card-content">
                        <h5 class="service-card-title">
                            <a href="{{ route('service.list.details',$service->slug) }}">{{ $service->title }}</a>
                        </h5>
                        @if($total_count > 0)
                        <div class="service-card-meta">
                            <div class="service-rating">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="las la-star {{ $i <= $rating ? 'active' : '' }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-count">({{ $total_count }})</span>
                            </div>
                        </div>
                        @endif
                        <div class="service-card-footer">
                            <a href="{{ route('service.list.book',$service->slug) }}" class="service-book-btn-modern"
                               style="background:{{$btn_color}}; color:{{$button_text_color}}">
                                <span>{{ $book_appoinment }}</span>
                                <i class="las la-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<style>
/* Modern Service Card Styles */
.service-card-modern {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    opacity: 0;
    transform: translateY(40px) scale(0.95);
    animation: cardFadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@keyframes cardFadeInUp {
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.service-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
}

.service-card-modern:hover::before {
    transform: scaleX(1);
}

.service-card-modern:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

/* Image Wrapper */
.service-card-image-wrapper {
    position: relative;
    width: 100%;
    height: 240px;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.service-image-link {
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
}

.service-image-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.service-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    transform: scale(1);
}

.service-card-modern:hover .service-image {
    transform: scale(1.15);
}

.service-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card-modern:hover .service-image-overlay {
    opacity: 1;
}

.view-service-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: rgba(255, 255, 255, 0.95);
    color: #667eea;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.service-card-modern:hover .view-service-btn {
    transform: translateY(0);
}

.view-service-btn i {
    font-size: 18px;
}

/* Service Badges */
.service-badge {
    position: absolute;
    top: 16px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: badgePulse 2s ease-in-out infinite;
}

.featured-badge {
    right: 16px;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
}

.rating-badge {
    left: 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

@keyframes badgePulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Card Content */
.service-card-content {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.service-card-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 0 16px 0;
    line-height: 1.4;
    min-height: 56px;
}

.service-card-title a {
    color: #2d3748;
    text-decoration: none;
    transition: color 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.service-card-modern:hover .service-card-title a {
    color: #667eea;
}

/* Service Meta */
.service-card-meta {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e2e8f0;
}

.service-rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.rating-stars {
    display: flex;
    gap: 2px;
}

.rating-stars i {
    font-size: 14px;
    color: #cbd5e0;
    transition: all 0.3s ease;
}

.rating-stars i.active {
    color: #fbbf24;
    animation: starTwinkle 0.5s ease;
}

@keyframes starTwinkle {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
}

.rating-count {
    font-size: 13px;
    color: #718096;
    font-weight: 500;
}

/* Card Footer */
.service-card-footer {
    margin-top: auto;
}

.service-book-btn-modern {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 14px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
}

.service-book-btn-modern::before {
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

.service-book-btn-modern:hover::before {
    width: 400px;
    height: 400px;
}

.service-book-btn-modern i {
    transition: transform 0.4s ease;
    font-size: 18px;
}

.service-book-btn-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
}

.service-book-btn-modern:hover i {
    transform: translateX(-4px);
}

.service-book-btn-modern span {
    position: relative;
    z-index: 1;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .service-card-image-wrapper {
        height: 220px;
    }
}

@media (max-width: 768px) {
    .service-card-modern {
        margin-bottom: 20px;
    }
    
    .service-card-image-wrapper {
        height: 200px;
    }
    
    .service-card-content {
        padding: 20px;
    }
    
    .service-card-title {
        font-size: 1.1rem;
        min-height: auto;
    }
    
    .service-card-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .service-badge {
        padding: 6px 12px;
        font-size: 12px;
    }
}

@media (max-width: 576px) {
    .service-card-image-wrapper {
        height: 180px;
    }
    
    .view-service-btn {
        padding: 10px 20px;
        font-size: 13px;
    }
}
</style>
<!-- Service area end -->
<!-- Service area end -->