@extends('frontend.frontend-page-master')

@section('page-meta-data')
  <title> {{ __('All Sellers') }}</title>
@endsection

@section('page-title')
{{ __('All Sellers') }}
@endsection 

@section('inner-title')
{{ __('All Sellers') }}
@endsection

@section('content')

    <!-- Category Service area starts -->
    <section class="category-services-area padding-top-70 padding-bottom-100">
        <div class="container">
            <!-- Filters Section -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="seller-filters-wrapper" style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px;">
                        <form method="GET" action="{{ route('all.sellers') }}" id="seller-filters-form">
                            <div class="row g-3">
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">{{ __('القسم') }}</label>
                                    <select name="category_id" class="form-control" style="border-radius: 8px;">
                                        <option value="">{{ __('جميع الأقسام') }}</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">{{ __('التقييم الأدنى') }}</label>
                                    <select name="min_rating" class="form-control" style="border-radius: 8px;">
                                        <option value="">{{ __('جميع التقييمات') }}</option>
                                        <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>4 نجوم فأكثر</option>
                                        <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>3 نجوم فأكثر</option>
                                        <option value="2" {{ request('min_rating') == '2' ? 'selected' : '' }}>2 نجوم فأكثر</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">{{ __('المدينة') }}</label>
                                    <select name="city_id" class="form-control" style="border-radius: 8px;">
                                        <option value="">{{ __('جميع المدن') }}</option>
                                        @if(isset($cities))
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->service_city }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label" style="font-weight: 600; margin-bottom: 8px;">{{ __('الترتيب') }}</label>
                                    <select name="sort_by" class="form-control" style="border-radius: 8px;">
                                        <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>{{ __('الأحدث') }}</option>
                                        <option value="rating" {{ request('sort_by') == 'rating' ? 'selected' : '' }}>{{ __('الأعلى تقييماً') }}</option>
                                        <option value="orders" {{ request('sort_by') == 'orders' ? 'selected' : '' }}>{{ __('الأكثر طلبات') }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="verified" value="1" id="verified-only" {{ request('verified') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="verified-only">
                                            {{ __('فقط الفنيين الموثوقين') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="cmn-btn btn-bg-1" style="margin-top: 10px;">
                                        <i class="las la-filter"></i> {{ __('تصفية') }}
                                    </button>
                                    <a href="{{ route('all.sellers') }}" class="cmn-btn btn-outline-1" style="margin-top: 10px; margin-right: 10px;">
                                        <i class="las la-redo"></i> {{ __('إعادة تعيين') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="row">

                @if(!empty($seller_lists) && $seller_lists->count() > 0)
                    @foreach($seller_lists as $seller)

                    @php
                        $img_url = get_attachment_image_by_id($seller->image,null,false);

                        if($seller->image){
                            $seller_image =  render_background_image_markup_by_attachment_id($seller->image);
                        }else{
                            $seller_image = 'style="background-image:url('.asset('assets/frontend/img/user-no-image.png').')"';
                        }
                    @endphp
                
                        <div class="col-lg-3 col-md-6">
                        <div class="single_seller_profile gray_bg">
                            <div class="thumb" {!! $seller_image !!}></div>
                            <div class="content_area_wrap">
                                <h4 class="title">
                                    <a href="{{route('about.seller.profile',$seller->username)}}">{{$seller->name}}</a>
                                    @if(optional($seller->sellerVerify)->status==1 || $seller->verified_by_national_id == 1)
                                        <div data-toggle="tooltip" data-placement="top" title="{{ $seller->verified_by_national_id ? __('موثوق برقم الهوية الوطنية') : __('This seller is verified by the site admin according his national id card.') }}"> <span class="seller-verified"> <i class="las la-check"></i> </span></div>
                                    @endif
                                </h4>
                                 @if(optional($seller->review->where('type', 1))->avg('rating') >=1)
                                    <div class="profiles-review">
                                        <span class="reviews">
                                            <b>{!! ratting_star(round(optional($seller->review->where('type', 1))->avg('rating'), 1)) !!}</b>
                                            ({{optional($seller->review->where('type', 1))->count()}})
                                        </span>
                                    </div>
                                @endif
                                <span class="order_completation">{{$seller->order->where('status', 2)->count() ?? 0}} {{__('Order Completed')}}</span>
                                
                                @if(!empty($seller->job_type))
                                    <div class="seller-job-type mt-2">
                                        <span style="font-size: 12px; color: #666;">
                                            <i class="las la-briefcase"></i> {{ $seller->job_type }}
                                        </span>
                                    </div>
                                @endif
                                
                                @if(!empty($seller->city))
                                    <div class="seller-location mt-1">
                                        <span style="font-size: 12px; color: #666;">
                                            <i class="las la-map-marker-alt"></i> {{ $seller->city->service_city }}
                                        </span>
                                    </div>
                                @endif
                                
                                @auth('web')
                                    @if(Auth::guard('web')->user()->user_type == 1)
                                        <div class="mt-3">
                                            <a href="{{ route('about.seller.profile', $seller->username) }}" class="cmn-btn btn-bg-1" style="width: 100%; padding: 8px; font-size: 13px;">
                                                <i class="las la-eye"></i> {{ __('عرض الملف') }}
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="mt-3">
                                        <a href="{{ route('about.seller.profile', $seller->username) }}" class="cmn-btn btn-bg-1" style="width: 100%; padding: 8px; font-size: 13px;">
                                            <i class="las la-eye"></i> {{ __('عرض الملف') }}
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-info text-center" style="padding: 40px;">
                            <i class="las la-info-circle" style="font-size: 48px; margin-bottom: 15px;"></i>
                            <h4>{{ __('لا توجد نتائج') }}</h4>
                            <p>{{ __('لم يتم العثور على فنيين يطابقون معايير البحث') }}</p>
                            <a href="{{ route('all.sellers') }}" class="cmn-btn btn-bg-1 mt-3">
                                {{ __('عرض جميع الفنيين') }}
                            </a>
                        </div>
                    </div>
                @endif
                    @if($seller_lists->count() >= 12)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $seller_lists->links() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
    <!-- Category Service area end -->

@endsection
