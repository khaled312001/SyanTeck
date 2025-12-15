@extends('frontend.frontend-page-master')


@section('page-meta-data')
{!! render_site_title($page_post->meta_title ?? $page_post->title) !!}
<!-- Primary Meta Tags -->
<meta name="title" content="{{optional($page_post->meta_data)->meta_title}}">
<meta name="description" content="{{optional($page_post->meta_data)->meta_description}}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:title" content="{{optional($page_post->meta_data)->meta_title}}">
<meta property="og:description" content="{{optional($page_post->meta_data)->meta_description}}">
{!! render_og_meta_image_by_attachment_id(optional($page_post->meta_data)->facebook_meta_image) !!}

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{url()->current()}}">
<meta property="twitter:title" content="{{optional($page_post->meta_data)->meta_title}}">
<meta property="twitter:description" content="{{optional($page_post->meta_data)->meta_description}}">
{!! render_twitter_meta_image_by_attachment_id(optional($page_post->meta_data)->twitter_meta_image) !!}
@endsection

@section('page-title')
{{  optional(getPageDetailsFromSlug('service_list_page'))->title }}
@endsection 
@section('site-title')
{{  optional(getPageDetailsFromSlug('service_list_page'))->title }}
@endsection 
@section('content')

    <!-- Category Service area starts -->
    <section class="category-services-area padding-top-70 padding-bottom-100">
        <div class="container">
            @if(!empty($page_post))
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center margin-bottom-60">
                        <h2 class="title">{{ optional($page_post)->title ?? __('All Services') }}</h2>
                        @if(!empty(optional($page_post)->meta_description))
                        <p class="subtitle">{{ optional($page_post)->meta_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            
            <div class="row">
                @if(!empty($all_services) && $all_services->count() > 0)
                    @foreach($all_services as $service)
                        @php
                            $serviceIconData = get_service_icon($service->title);
                            $serviceIcon = $serviceIconData['icon'];
                            $iconColor = $serviceIconData['color'];
                        @endphp
                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%; display: flex; flex-direction: column;">
                                <a href="{{ route('service.list.details',$service->slug) }}" class="service-icon-thumb" style="position: relative; display: flex; align-items: center; justify-content: center; height: 220px; background: #FFFFFF; transition: all 0.3s ease;">
                                    <i class="{{$serviceIcon}}" style="color: #000000; font-size: 80px; transition: all 0.3s ease;"></i>

                                    @if($service->featured == 1)
                                    <div class="award-icons" style="position: absolute; top: 15px; right: 15px; background: #FFD700; color: #000000; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                        <i class="las la-award" style="font-size: 20px;"></i>
                                    </div>
                                    @endif
                                    
                                    <div class="country_city_location" style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); padding: 15px;">
                                        <span class="single_location" style="color: #fff; font-size: 13px; display: flex; align-items: center; gap: 5px;"> 
                                            <i class="las la-map-marker-alt"></i>
                                            {{ sellerServiceLocation($service) }}
                                        </span>
                                    </div>
                                </a>
                                <div class="services-contents" style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                                    <ul class="author-tag" style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; flex-wrap: wrap; padding: 0; list-style: none;">
                                        <li class="tag-list" style="margin: 0;">
                                            <a href="{{ route('about.seller.profile',optional($service->seller)->username) }}" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #333;">
                                                <div class="authors" style="display: flex; align-items: center; gap: 8px;">
                                                    <div class="thumb" style="width: 35px; height: 35px; border-radius: 50%; overflow: hidden; border: 2px solid #f0f0f0;">
                                                        {!! render_image_markup_by_attachment_id(optional($service->seller)->image) !!}
                                                        <span class="notification-dot"></span>
                                                    </div>
                                                    <span class="author-title" style="font-size: 14px; font-weight: 500;"> {{ optional($service->seller)->name }}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @if($service->reviews->where('type', 1)->count() >= 1)
                                        <li class="tag-list" style="margin: 0;">
                                            <a href="javascript:void(0)" style="display: flex; align-items: center; gap: 5px; text-decoration: none; color: #ffa500;">
                                                <span class="reviews" style="font-size: 13px; font-weight: 500;"> 
                                                    {!! ratting_star(round(optional($service->reviews->where('type', 1))->avg('rating'),1)) !!}
                                                    <span style="color: #666; margin-left: 3px;">({{ optional($service->reviews->where('type', 1))->count() }})</span>
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                    <h5 class="common-title" style="margin-bottom: 12px; line-height: 1.4;"> 
                                        <a href="{{ route('service.list.details',$service->slug) }}" style="color: #333; text-decoration: none; font-size: 18px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"> 
                                            {{ Str::limit($service->title, 60) }} 
                                        </a> 
                                    </h5>
                                    <p class="common-para" style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"> 
                                        {{ Str::limit(strip_tags($service->description), 120) }} 
                                    </p>
                                    <div class="btn-wrapper d-flex flex-wrap" style="gap: 10px; margin-top: auto;">
                                        <a href="{{ url('/qr') }}" class="cmn-btn btn-small btn-bg-1" style="flex: 1; text-align: center; padding: 12px 20px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;"> 
                                            {{ __('Book Now') }} 
                                        </a>
                                        <a href="{{ route('service.list.details',$service->slug) }}" class="cmn-btn btn-small btn-outline-1" style="flex: 1; text-align: center; padding: 12px 20px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;"> 
                                            {{ __('View Details') }} 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($all_services->count() >= 6)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $all_services->links() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-info text-center" style="padding: 40px; border-radius: 12px; background: #f8f9fa; border: none;">
                            <i class="las la-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                            <h4 style="color: #666; margin-bottom: 10px;">{{ __('No Services Available') }}</h4>
                            <p style="color: #999;">{{ __('There are no services available at the moment. Please check back later.') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Category Service area end -->
    
    <style>
        .single-service:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
        }
        .service-thumb {
            transition: transform 0.3s ease;
        }
        .single-service:hover .service-icon-thumb {
            background: linear-gradient(135deg, rgba(255, 107, 44, 0.1) 0%, rgba(255, 140, 66, 0.05) 100%);
        }
        .single-service:hover .service-icon-thumb i {
            transform: scale(1.2) rotate(5deg);
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }
        .cmn-btn.btn-bg-1:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .cmn-btn.btn-outline-1:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
@endsection
