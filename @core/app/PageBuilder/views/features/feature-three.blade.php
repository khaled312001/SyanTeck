<!-- Service area starts -->
<section class="new_services_area section-padding section-wrapper" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background-color:{{$section_bg}}">
    <div class="container">
        <div class="section-title-wrapper text-left title_flex">
            <h2 class="section-title title">{{ $section_title }}</h2>
            <form action="{{ get_static_option('select_home_page_search_service_page_url') ?? url('/service-list') }}" method="get">
               <button class="new_exploreBtn bg-transparent border-0">{{ $explore_text }} <i class="fa-solid fa-angle-right"></i></button>
                <input type="hidden" name="sortby" value="featured"/>
            </form>
        </div>
        <div class="row g-4 mt-4">
            @foreach($services as $service)
            @php
                // استخدام helper function لتحديد الأيقونة
                $serviceIconData = get_service_icon($service->title);
                $serviceIcon = $serviceIconData['icon'];
                $iconColor = $serviceIconData['color'];
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="new_service__single">
                    <div class="new_service__single__thumb" style="background: #FFFFFF; display: flex; align-items: center; justify-content: center; min-height: 200px;">
                        <a href="{{ route('service.list.details',$service->slug) }}" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                            <i class="{{$serviceIcon}}" style="color: #000000; font-size: 80px; transition: all 0.3s ease;"></i>
                        </a>
                        <div class="award_icons">
                            <a href="javascript:void(0)" class="award_icons__item">
                                <i class="las la-award"></i>
                            </a>
                        </div>
                    </div>
                    <div class="new_service__single__contents">
                        <span class="new_jobs__single__contents__location mb-2">
                              <i class="fa-solid fa-location-dot"></i>
                                {{ sellerServiceLocation($service) }}
                            </span>

                        <h5 class="new_service__single__contents__title"><a href="{{ route('service.list.details',$service->slug) }}">{{ $service->title }}</a></h5>

                        <div class="author_tag border_top">
                            <a href="{{ route('about.seller.profile',optional($service->seller)->username) }}" class="single_authors">
                                <div class="single_authors__thumb">
                                    {!! render_image_markup_by_attachment_id(optional($service->seller)->image,'','','thumb') !!}
                                    <span class="notification-dot"></span>
                                </div>
                                <span class="single_authors__title"> {{ optional($service->seller)->name }} </span>
                            </a>
                            <div class="author_tag__review radius-5">
                                @php
                                    $total_review = optional($service->reviews->where('type', 1));
                                    $total_count = $total_review ->count();
                                    $rating = round($total_review->avg('rating'),1);
                                @endphp
                                @if($rating >= 1)
                                    <a href="javascript:void(0)" class="author_tag__review__para"> {!! ratting_star($rating) !!} {{ $total_count }}</a>
                                @endif
                            </div>
                        </div>

                        <div class="btn-wrapper border_top">
                            <a href="{{ route('service.list.book',$service->slug) }}" class="cmn-btn btn-outline-border w-100 radius-5"
                               style="background:#FFD700 !important; color:#000 !important;">{{ $book_appoinment }} </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Service area end -->
<style>
.cmn-btn.btn-outline-border {
    background: #FFD700 !important;
    color: #000 !important;
    border: none !important;
}
.cmn-btn.btn-outline-border:hover {
    background: #FFD700 !important;
    color: #000 !important;
    opacity: 0.9;
}
</style>