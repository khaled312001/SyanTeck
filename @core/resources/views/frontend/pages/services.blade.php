@extends('frontend.frontend-page-master')

@section('page-title')
{{__('Services')}}
@endsection

@section('site-title')
{{__('Services')}} - {{get_static_option('site_title')}}
@endsection

@section('page-meta-data')
{!! render_site_title(__('Services')) !!}
<meta name="description" content="{{__('Browse all maintenance services available on SyanTeck platform')}}">
@endsection

@section('content')
<!-- Services area starts -->
<section class="services-page-area padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center margin-bottom-60">
                    <h2 class="title">{{__('Our Services')}}</h2>
                    <p class="subtitle">{{__('We provide you with a comprehensive range of home and technical maintenance services')}}</p>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        @if(!empty($categories) && $categories->count() > 0)
        <div class="row margin-bottom-60">
            <div class="col-lg-12">
                <div class="categories-filter">
                    <h4 class="filter-title margin-bottom-30">{{__('Service Categories')}}</h4>
                    <div class="category-buttons">
                        <a href="{{route('services')}}" class="btn btn-outline-primary {{!request()->has('category') ? 'active' : ''}}">{{__('All')}}</a>
                        @foreach($categories as $category)
                        <a href="{{route('services')}}?category={{$category->id}}" class="btn btn-outline-primary {{request()->get('category') == $category->id ? 'active' : ''}}">
                            {{$category->name}}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Services Grid -->
        <div class="row">
            @if(!empty($services) && $services->count() > 0)
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 margin-bottom-30">
                    <div class="single-service-item">
                        <div class="service-image">
                            <a href="{{route('frontend.service.single', $service->slug)}}">
                                {!! render_image_markup_by_attachment_id($service->image, 'service-thumb') !!}
                            </a>
                        </div>
                        <div class="service-content padding-20">
                            <h4 class="service-title">
                                <a href="{{route('frontend.service.single', $service->slug)}}">
                                    {{$service->title}}
                                </a>
                            </h4>
                            <p class="service-description">
                                {{Str::limit(strip_tags($service->description), 100)}}
                            </p>
                            <div class="service-footer d-flex justify-content-end align-items-center margin-top-20">
                                <a href="{{route('frontend.service.single', $service->slug)}}" class="btn btn-primary btn-sm">
                                    {{__('View Details')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="col-lg-12">
                <div class="alert alert-info text-center">
                    <p>{{__('No Services Available Currently')}}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if(!empty($services) && $services->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-wrapper text-center margin-top-40">
                    {{$services->links()}}
                </div>
            </div>
        </div>
        @endif

        <!-- CTA Section -->
        <div class="row margin-top-60">
            <div class="col-lg-12">
                <div class="cta-section text-center bg-light padding-40 radius-10">
                    <h3 class="margin-bottom-20">{{__('Couldn\'t Find the Service You\'re Looking For?')}}</h3>
                    <p class="margin-bottom-30">{{__('Contact Us and We\'ll Help You Find the Right Solution')}}</p>
                    <a href="{{route('frontend.dynamic.page', 'contact')}}" class="btn btn-primary btn-lg">{{__('Contact Us')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.services-page-area {
    background-color: #f8f9fa;
}
.single-service-item {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.single-service-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}
.service-image {
    overflow: hidden;
    height: 200px;
}
.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.single-service-item:hover .service-image img {
    transform: scale(1.1);
}
.service-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.service-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
}
.service-title a {
    color: #111d5c;
    text-decoration: none;
}
.service-title a:hover {
    color: #1a2d7a;
}
.service-description {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    flex: 1;
}
.service-price {
    font-size: 24px;
    font-weight: 700;
    color: #111d5c;
}
.category-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.category-buttons .btn {
    margin: 5px;
}
.cta-section {
    background: linear-gradient(135deg, #111d5c 0%, #1a2d7a 100%);
    color: #fff;
}
.cta-section h3 {
    color: #fff;
}
.cta-section p {
    color: rgba(255,255,255,0.9);
}
</style>
@endsection

