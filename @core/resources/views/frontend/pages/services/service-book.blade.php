@extends('frontend.frontend-page-master')
@section('page-meta-data')
    <title>{{ $service_details_for_book->title }}</title>
@endsection
@section('page-title')
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    {{ __(ucwords(str_replace("-", " ", $page_info))) }}
@endsection
@section('inner-title')
    {{ $service_details_for_book->title}}
@endsection

@section('style')
    <style>
        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #999;
        }

        .wallet-payment-gateway-wrapper label{
            padding: 10px;
            font-weight: bold;
        }

        .wallet-payment-gateway-wrapper input{
            transform: scale(1.3);
        }
        .show-schedule {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .paymentGateway_add__item {
            width: calc(100% / 5 - 16px);
            overflow: hidden;
        }
        @media screen and (max-width: 1199px) and (min-width: 992px) {
            .paymentGateway_add__item {
                width: calc(100% / 3 - 13.33px);
            }
        }
        @media only screen and (max-width: 991px) {
            .paymentGateway_add__item {
                width: calc(100% / 4 - 15px);
            }
        }
        @media only screen and (max-width: 767px) {
            .paymentGateway_add__item {
                width: calc(100% / 3 - 13.33px);
            }
        }
        @media only screen and (max-width: 425px) {
            .paymentGateway_add__item {
                width: calc(100% / 2 - 10px);
            }
        }
        .custom_radio__inline__two .custom_radio__single{
            width: calc(56% - 8px);
        }

        .coupon_amount_for_apply_code {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        /* GPS Location Button Styles */
        .address-input-wrapper {
            position: relative;
        }

        .btn-get-location-service {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            background: #FFD700;
            color: #000000;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 10;
            font-size: 13px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .btn-get-location-service:hover:not(:disabled) {
            background: #FFD700;
            transform: translateY(-50%) translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .btn-get-location-service:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-get-location-service i {
            font-size: 16px;
        }

        .address-input-wrapper input {
            padding-right: 140px;
        }

        .location-status-service {
            margin-top: 8px;
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 6px;
            background: #f8f9fa;
        }

        [dir="rtl"] .btn-get-location-service {
            right: auto;
            left: 10px;
        }

        [dir="rtl"] .address-input-wrapper input {
            padding-right: 15px;
            padding-left: 140px;
        }

        @media (max-width: 768px) {
            .btn-get-location-service {
                position: relative;
                top: auto;
                transform: none;
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
            
            .address-input-wrapper input {
                padding-right: 15px;
            }
            
            [dir="rtl"] .address-input-wrapper input {
                padding-left: 15px;
            }
        }

    </style>
@endsection

@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    @php
        $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
        $country_tax =  App\Tax::select('id','tax')->where('country_id',$service_country)->first();
    @endphp

            <!-- Service Details area start -->
    <div class="new_service_details_area padding-top-100 padding-bottom-100">
        <div class="container">

            <div class="new_stepForm">
                <form action="{{ route('service.create.order') }}" id="msform" class="msform ms-order-form" method="post" name="msOrderForm" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row g-4 mt-1">
                        <!-- Hidden data for request -->
                        <input type="hidden" name="service_id" value="{{ $service_details_for_book->id }}">
                        <input type="hidden" name="seller_id" value="{{ optional($service_details_for_book->seller)->id }}">

                        @if($service_details_for_book->is_service_online == 1)
                            <input type="hidden" name="is_service_online_" value="{{ $service_details_for_book->is_service_online }}">
                            <input type="hidden" name="online_service_package_fee" value="{{ $service_details_for_book->price }}">
                        @endif
                        <input type="hidden" name="date">
                        <input type="hidden" name="schedule">
                        <input type="hidden" id="payment_form_services" name="services[]">
                        <input type="hidden" id="payment_form_additionals" name="additionals[]">

                        <div class="col-12">

                            <!--for coupon code and other -->
                            <input type="hidden" id="service_id" value="{{ $service_details_for_book->id }}">
                            <input type="hidden" id="seller_id" value="{{ $service_details_for_book->seller_id }}">

                            <div class="new_serviceDetails radius-10">
                                <div class="new_serviceDetails__flex">
                                    <div class="new_serviceDetails__author">
                                        <div class="new_serviceDetails__author__flex">
                                            <div class="new_serviceDetails__author__thumb"
                                                 @if(empty(render_image_markup_by_attachment_id($service_details_for_book->image))) style="height: 82px; width: 92px"  @endif>
                                                <a href="javascript:void(0)">
                                                    @if(empty(render_image_markup_by_attachment_id($service_details_for_book->image)))
                                                        <img src="{{ asset('assets/frontend/img/no-image-one.jpg', 'thumb') }}" alt="no-image" />
                                                    @else
                                                        {!! render_image_markup_by_attachment_id($service_details_for_book->image,'','thumb') !!}
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="new_serviceDetails__author__contents">
                                                <h4 class="new_serviceDetails__author__title">
                                                    <a href="{{ route('service.list.details',$service_details_for_book->slug) }}">{{ $service_details_for_book->title }}</a>
                                                </h4>
                                                <div class="d-flex justify-content-start" style="display: none !important;">
                                                    <!--service seller info -->

                                                    <p class="new_serviceDetails__author__para">
                                                        @if(!empty(optional(optional($service_details_for_book)->seller)->username))
                                                            <a href="{{ route('about.seller.profile', optional(optional($service_details_for_book)->seller)->username) }}">
                                                                {{ optional($service_details_for_book)->seller->name }}</a>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Error message show -->
                            <div>
                                <x-msg.error_for_service_book/> <x-session-msg/>
                            </div>

                            <div class="new_stepForm_list step_list list_none mt-5">
                                @if($service_details_for_book->is_service_online != 1)
                                    <!--Location -->
                                    <div class="new_stepForm_list__item active full_address_get_next_page edit_location">
                                        <div class="new_stepForm_list__item__flex">
                                            <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                                <span class="new_stepForm_list__item__click__icon"><i class="fa-solid fa-location-dot"></i></span>
                                                <div class="new_stepForm_list__item__click__contents">
                                                    <h6 class="new_stepForm_list__item__click__title">{{ __('Location') }}</h6>
                                                    <span class="new_stepForm_list__item__click__para">
                                                    @if(empty(get_static_option('google_map_settings')))
                                                            <strong>{{ __('Your Location:') }}</strong>
                                                            @if(Auth::guard('web')->check())
                                                                {{ optional(Auth::guard('web')->user()->country)->country }},
                                                                {{ optional(Auth::guard('web')->user()->city)->service_city }}
                                                            @endif
                                                        @endif
                                                </span>
                                                </div>
                                            </a>
                                            <div class="new_stepForm_list__item__btn click_edit_address">
                                                <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5">{{ __('Edit') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Service info-->
                                <div class="new_stepForm_list__item  edit_service_info @if($service_details_for_book->is_service_online == 1) active @endif">
                                    <div class="new_stepForm_list__item__flex">
                                        <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                            <span class="new_stepForm_list__item__click__icon"><i class="fa-regular fa-envelope"></i></span>
                                            <div class="new_stepForm_list__item__click__contents">
                                                <h6 class="new_stepForm_list__item__click__title">{{ __('Service') }}</h6>
                                            </div>
                                        </a>
                                        <div class="new_stepForm_list__item__btn click_edit_service_info">
                                            <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5">{{ __('Edit') }}</a>
                                        </div>
                                    </div>
                                </div>


                                <!--Booking Info -->
                                <div class="new_stepForm_list__item  edit_booking_info">
                                    <div class="new_stepForm_list__item__flex">
                                        <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                            <span class="new_stepForm_list__item__click__icon"><i class="fa-regular fa-envelope"></i></span>
                                            <div class="new_stepForm_list__item__click__contents">
                                                <h6 class="new_stepForm_list__item__click__title">{{ get_static_option('service_booking_information_title') ?? __('Booking Information') }}</h6>
                                            </div>
                                        </a>
                                        <div class="new_stepForm_list__item__btn click_edit_info click_edit_booking_info">
                                            <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5">{{ __('Edit') }}</a>
                                        </div>
                                    </div>
                                </div>

                                @if($service_details_for_book->is_service_online != 1)
                                    <!--Date & Time-->
                                    <div class="confirm-overview-left new_stepForm_list__item edit_date_time_info">
                                        <div class="new_stepForm_list__item__flex">
                                            <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                                <span class="new_stepForm_list__item__click__icon"><i class="fa-regular fa-calendar-days"></i></span>
                                                <div class="new_stepForm_list__item__click__contents">
                                                    <h6 class="new_stepForm_list__item__click__title">{{ __('Date & Time') }} </h6>

                                                    <span class="new_stepForm_list__item__click__para">
                                                  <span class="details available_date"> </span>
                                                  <span class="details available_schedule"> </span>
                                                </span>
                                                </div>
                                            </a>
                                            <div class="new_stepForm_list__item__btn click_edit_schedule click_edit_date_time">
                                                <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5">{{ __('Edit') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!--payment Confirmation -->
                                <div class="new_stepForm_list__item all_check_for_order edit_payment_option">
                                    <div class="new_stepForm_list__item__flex">
                                        <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                            <span class="new_stepForm_list__item__click__icon"><i class="fa-solid fa-circle-check"></i></span>
                                            <div class="new_stepForm_list__item__click__contents">
                                                <h6 class="new_stepForm_list__item__click__title">{{ __('Confirmation') }} </h6>
                                            </div>
                                        </a>
                                        <div class="new_stepForm_list__item__btn click_edit_schedule">
                                            <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5">{{ __('Edit') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @if($service_details_for_book->is_service_online != 1)
                                <!-- Location  -->
                                <fieldset class="padding-top-50 confirm-location">
                                    <div class="row">

                                        @if(empty(get_static_option('google_map_settings')))
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title">{{ __('Service Country') }}</label>
                                                    <div class="single-input-select radius-5">
                                                        <select name="choose_service_country" id="choose_service_country"  class="select2_activation">
                                                            @if(!empty($country))
                                                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title">{{ __('Service City') }}</label>
                                                    <div class="single-input-select radius-5">
                                                        <select name="choose_service_city" id="choose_service_city" class="select2_activation get_service_city">
                                                            @if($service_details_for_book->is_service_all_cities === 1)
                                                                @php $cities = App\ServiceCity::select('id','service_city')->where('country_id',$service_country)->where('status',1)->get(); @endphp
                                                                @foreach($cities as $city)
                                                                    <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                                                @endforeach
                                                            @else
                                                                @if(!empty($city))
                                                                    <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                                                @endif
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title">{{ __('Choose Area') }}</label>
                                                    <div class="single-input-select radius-5">
                                                        <select name="choose_service_area" id="choose_service_area" class="select2_activation get_service_area">
                                                            <option value="">{{ __('Select Area') }}</option>
                                                            @foreach($areas as $area)
                                                                <option value="{{ $area->id }}">{{ $area->service_area }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        <div class="col-12 margin-bottom-20">
                                            <label class="label-title">{{__('حدد موقعك على الخريطة')}} <span class="text-danger">*</span></label>
                                            <div id="location-map-container" style="width: 100%; height: 500px; border-radius: 12px; overflow: hidden; border: 2px solid rgba(0, 0, 0, 0.15); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); position: relative;">
                                                <div id="location-map" style="width: 100%; height: 100%;"></div>
                                                <div id="map-loading" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #f5f5f5; display: flex; align-items: center; justify-content: center; z-index: 10;">
                                                    <div style="text-align: center;">
                                                        <i class="las la-spinner la-spin" style="font-size: 48px; color: #FFD700; margin-bottom: 15px;"></i>
                                                        <p style="color: #666; font-size: 16px;">{{__('جاري تحميل الخريطة...')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="user_address" id="user_address" required>
                                            <input type="hidden" name="latitude" id="latitude">
                                            <input type="hidden" name="longitude" id="longitude">
                                            <div id="location-status" style="margin-top: 15px; padding: 12px; background: #f8f9fa; border-radius: 8px; font-size: 14px; color: #666;">
                                                <i class="las la-info-circle" style="color: #FFD700;"></i>
                                                <span>{{__('سيتم اكتشاف موقعك تلقائياً. يمكنك سحب العلامة لتعديل موقعك الدقيق.')}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Auth User Check - Removed login requirement -->
                                    <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                        <input type="button" name="next" class="next stepForm_btn radius-5" value="{{__('Next')}}"/>
                                    </div>
                                </fieldset>
                            @endif

                            <!-- Service Info -->
                            <fieldset class="padding-top-50 edit_style_service_info">
                                <div class="custom-form">
                                    <div class="row g-4">
                                        <div class="col-sm-12">

                                            <div class="new_packageBook__details">
                                                <!-- Hide "What's Included" section -->
                                                <div class="new_packageBook__details__item" style="display: none;">
                                                    <!-- Heading start -->
                                                    <div class="new_packageBook__header">
                                                        <div class="new_packageBook__header__left">
                                                            <h4 class="new_packageBook__details__title">{{ get_static_option('service_main_attribute_title') ?? __('What\'s Included') }}</h4>
                                                        </div>
                                                    </div>
                                                    <!-- Heading send -->
                                                    @if($service_details_for_book->is_service_online == 1)
                                                        <ul class="new_packageBook__list list_none mt-4">
                                                            @foreach ($service_includes as $include)
                                                                <li class="list_show new_packageBook__addFeature__title">{{ $include->include_service_title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <!--Service customize start -->
                                                        <div class="row g-4 mt-1 service_include_edit_show_hide">
                                                            @foreach ($service_includes as $include)
                                                                <div class="col-lg-6 single-include include_service_id_{{ $include->id }}">
                                                                    <div class="new_packageBook__addFeature radius-10">
                                                                        <div class="new_packageBook__addFeature__flex">
                                                                            <div class="new_packageBook__addFeature__contents">
                                                                                <ul class="new_packageBook__list list_none mt-4">
                                                                                    <li class="list_show new_packageBook__addFeature__title">{{ $include->include_service_title }}</li>
                                                                                </ul>

                                                                                @if($service_details_for_book->is_service_online !=1)
                                                                                    <p class="new_packageBook__addFeature__price mt-2"
                                                                                       id="include_service_unit_price_{{ $include->id }}" style="display: none;">
                                                                                        {{ amount_with_currency_symbol($include->include_service_price) }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>

                                                                            @if($service_details_for_book->is_service_online !=1)
                                                                                <div class="btn-wrapper">
                                                                                    <div class="package_quantity">
                                                                                    <span class="substract package_quantity__icon include_service_qty_decrement">
                                                                                        <i class="fa-solid fa-minus"></i></span>
                                                                                        <input type="number" min="1"
                                                                                               class="quantity-input package_quantity__input inc_dec_include_service"
                                                                                               data-id="{{ $include->id }}"
                                                                                               data-price="{{ $include->include_service_price }}"
                                                                                               value="{{ $include->include_service_quantity }}"  oninput="validateNumberInput(this)">
                                                                                        <span class="plus package_quantity__icon inc_dec_include_service"><i class="fa-solid fa-plus"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="btn-wrapper">
                                                                                    <div class="package_quantity remove-service-list"
                                                                                         data-id="{{ $include->id }}">
                                                                                        <a class="remove text-danger" href="javascript:void(0)">{{ __('Remove') }}</a>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <!--Service customize end -->
                                                    @endif
                                                </div>

                                                <!--Service Additional start - Show this section -->
                                                <div class="new_packageBook__details__item extra-services">
                                                    <h4 class="new_packageBook__details__title">{{ get_static_option('service_additional_attribute_title') ?? __('Upgrade your order with extras') }}</h4>
                                                    <div class="new_packageBook__details__inner">
                                                        @if($service_additionals->count() > 0)
                                                        <div class="row g-4 mt-1">
                                                            @foreach ($service_additionals as $additional)
                                                                <div class="col-lg-6">
                                                                    <div class="new_packageBook__addFeature radius-10">
                                                                        <div class="new_packageBook__addFeature__flex">
                                                                            <div class="new_packageBook__addFeature__contents">
                                                                                <div class="checkbox-inlines">
                                                                                    <input class="check-input" type="checkbox" id="additional_{{ $additional->id }}" value="{{ $additional->id }}">
                                                                                    <label class="new_packageBook__addFeature__title" for="additional_{{ $additional->id }}"> {{ $additional->additional_service_title }} </label>
                                                                                </div>
                                                                                <p class="new_packageBook__addFeature__price price-value mt-2" style="display: none;">
                                                                                    {{ amount_with_currency_symbol($additional->additional_service_price) }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="btn-wrapper">
                                                                                <div class="package_quantity">
                                                                                    <span class="values d-none" price="{{ $additional->id }}"> {{ $additional->additional_service_price }}</span>
                                                                                    <span class="substract package_quantity__icon additional_service_qty_decrement"><i class="fa-solid fa-minus"></i></span>
                                                                                    <input  type="number"
                                                                                            min="1"
                                                                                            class="quantity-input package_quantity__input inc_dec_additional_service"
                                                                                            id="additional_service_quantity_{{ $additional->id }}"
                                                                                            data-id="{{ $additional->id }}"
                                                                                            data-price="{{ $additional->additional_service_price }}"
                                                                                            value="{{ $additional->additional_service_quantity }}" oninput="validateNumberInput(this)">

                                                                                    <span class="plus package_quantity__icon inc_dec_additional_service"><i class="fa-solid fa-plus"></i></span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @endif
                                                        
                                                        <!-- Manual Additional Service Input -->
                                                        <div class="row g-4 mt-3">
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <label class="label-title">{{ __('Additional Service (Optional)') }}</label>
                                                                    <textarea 
                                                                        class="form--control radius-5" 
                                                                        id="manual_additional_service" 
                                                                        name="manual_additional_service" 
                                                                        rows="3" 
                                                                        placeholder="{{ __('Enter any additional service or special request (optional)') }}"></textarea>
                                                                    <small class="form-text text-muted">{{ __('You can add any additional service or special request here') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Service Additional end -->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                    <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5
                                        @if($service_details_for_book->is_service_online == 1) d-none @endif" value="{{__('Previous')}}"/>
                                    <input type="button" name="next" class="next stepForm_btn radius-5" value="{{__('Next')}}"/>
                                </div>




                                <!-- service faq and benefits  -->
                                @if($service_benifits->count() >1)
                                    <div class="overview-single padding-top-60">
                                        <h4 class="title">{{ get_static_option('service_benifits_title') ?? __('Benefits of the Package:') }}</h4>
                                        <ul class="new_packageBook__list list_none mt-4">
                                            @foreach ($service_benifits as $benifit)
                                                <li class="list_show">{{ $benifit->benifits }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($service_details_for_book->is_service_online == 1)
                                    @if($service_faqs && count($service_faqs) > 0)
                                        <div class="faq-area" data-padding-top="70" data-padding-bottom="100">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 margin-top-30">
                                                        <div class="faq-contents">
                                                            @foreach ($service_faqs as $faq)
                                                                @if(empty($faq->title )) @continue  @endif
                                                                <div class="faq-item">
                                                                    <div class="faq-title">
                                                                        {{ $faq->title }}
                                                                    </div>
                                                                    <div class="faq-panel">
                                                                        <p class="faq-para">{{ $faq->description }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </fieldset>


                            <!-- Booking Info -->
                            <fieldset class="confirm-information padding-top-50 edit_style_booking_info">
                                <div class="custom-form">
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="single-input">
                                                <label class="label-title"> {{ __('Your Name') }} <span class="text-danger">*</span> </label>
                                                <input class="form--control radius-5" type="text" name="name" id="name" placeholder="{{ __('Enter Full Name') }}"
                                                       @if(Auth::guard('web')->check()) value="{{ Auth::user()->name }}" @else value="" @endif>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="single-input">
                                                <label class="label-title">{{ __('Your Email') }} <span class="text-danger">*</span> </label>
                                                <input type="text" class="form--control radius-5" name="email" id="email" placeholder="{{ __('Type Your Email') }}"
                                                       @if(Auth::guard('web')->check()) value="{{ Auth::user()->email }}" @else value="" @endif>
                                            </div>
                                        </div>

                                        <div class="@if(empty(get_static_option('google_map_settings'))) col-sm-6 @else col-sm-12 @endif">
                                            <div class="single-input">
                                                <label class="label-title">{{ __('Phone Number') }} <span class="text-danger">*</span> </label>
                                                <input type="number" class="form--control radius-5" name="phone" id="phone" placeholder="{{ __('Type Your Number') }}"
                                                       @if(Auth::guard('web')->check()) value="{{ Auth::user()->phone }}" @else value="" @endif>
                                            </div>
                                        </div>

                                        @if(empty(get_static_option('google_map_settings')))
                                            <div class="col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title">{{ __('Post Code') }} <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form--control radius-5" name="post_code" id="post_code" placeholder="{{ __('Type Post Code') }}"
                                                           @if(Auth::guard('web')->check()) value="{{ Auth::user()->post_code }}" @else value="" @endif>
                                                </div>
                                            </div>
                                        @endif


                                        <div class="col-sm-12">
                                            <div class="single-input">
                                                <label class="label-title">{{ __('Your Address') }}</label>
                                                <div class="input-with-icon address-input-wrapper" style="position: relative;">
                                                    <input type="text" class="form--control radius-5" name="address"
                                                           @if($service_details_for_book->is_service_online == 1) id="user_address" @else id="address"  @endif
                                                           placeholder="{{ __('Type Your Address') }}"
                                                           @if(Auth::guard('web')->check()) value="{{ Auth::user()->address }}"
                                                           @else value="" @endif
                                                           readonly>
                                                    <button type="button" class="btn-get-location-service" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px; background: #FFD700; color: #000000; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px; z-index: 10; font-size: 13px;">
                                                        <i class="las la-map-marker-alt"></i>
                                                        <span>{{__('Get Location')}}</span>
                                                    </button>
                                                    <div class="location-status-service" style="margin-top: 8px; font-size: 13px; color: #666;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="single-input">
                                                <label class="label-title">{{ __('Order Note') }}</label>
                                                <textarea cols="30" rows="3" class="form--control radius-5" name="order_note" id="order_note" placeholder="{{ __('Type Order Note') }}"></textarea>
                                                <span>{{__('Max: 190 Character')}}</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                    <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5" value="{{__('Previous')}}"/>
                                    <input type="button" name="next" class="next stepForm_btn radius-5" value="{{__('Next')}}"/>
                                </div>
                            </fieldset>

                            @if($service_details_for_book->is_service_online != 1)
                                <!-- Schedule -->
                                <fieldset class="confirm-date-time padding-top-50 edit_style_schedule">
                                    <div class="row g-4 date-overview">
                                        <div class="col-xxl-4 col-xl-5 col-md-6">
                                            <h4 class="date-time-title"> {{ get_static_option('service_available_date_title') ?? __('Available Date') }} </h4>
                                            <div class="overview-location">
                                                <input type="hidden" class="flatpickr_calendar d-none" id="service_available_dates" name="service_available_dates">
                                                <ul class="date-time-list margin-top-20 show-date">
                                                    <span class="seller-id-for-schedule" style="display:none">{{ $service_details_for_book->seller_id }}</span>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-xxl-8 col-xl-7 col-md-6">
                                            <div class="schedule_radioInput mt-4">
                                                <div class="custom_radio custom_radio__inline">
                                                    <h4 class="date-time-title">{{ __('Select Time') }}</h4>
                                                    <!-- Allow manual time input only -->
                                                    <div class="mt-3">
                                                        <label class="form-label">{{ __('Select Time') }} <span class="text-danger">*</span></label>
                                                        <input type="time" class="form-control" id="manual_time" name="manual_time" required>
                                                        <small class="form-text text-muted">{{ __('Please select your preferred time') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                        <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5" value="{{__('Previous')}}"/>
                                        <input type="button" name="next" class="next stepForm_btn radius-5" value="{{__('Next')}}"/>
                                    </div>
                                </fieldset>
                            @endif

                            <!-- payment -->
                            <fieldset class="padding-top-50 edit_style_payment_option">
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <!-- Payment Information Message -->
                                        <div class="alert alert-info" style="background-color: #e7f3ff; border: 2px solid #2196F3; border-radius: 10px; padding: 25px;">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3" style="font-size: 32px;">ℹ️</div>
                                                <div>
                                                    <h4 class="alert-heading mb-3" style="color: #1976D2; font-weight: bold;">
                                                        {{ __('Payment Information') }}
                                                    </h4>
                                                    <p class="mb-2" style="font-size: 16px; line-height: 1.8; color: #333;">
                                                        <strong>{{ __('Important:') }}</strong> {{ __('The price for maintenance, repair, or installation will be calculated after the technician\'s inspection.') }}
                                                    </p>
                                                    <p class="mb-0" style="font-size: 16px; line-height: 1.8; color: #333;">
                                                        <strong>{{ __('Payment Methods:') }}</strong> {{ __('Cash, Visa, or STC Pay') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden payment gateway field (required for form submission) -->
                                        <input type="hidden" name="selected_payment_gateway" value="cash_on_delivery">

                                        <!--agree button -->
                                        <div class="schedule_radioInput mt-4" style="float: right">
                                            <div class="checkbox-inlines bottom-checkbox terms-and-conditions">
                                                <input class="check-input" type="checkbox" id="check3" required>
                                                <label class="checkbox-label" for="check3">{{ __('I agree with') }}
                                                    <a href="{{ url('/'.get_static_option('select_terms_condition_page')) }}" target="_blank">{{ __('terms and conditions') }} <span class="text-danger">*</span></a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                    <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5" value="{{__('Previous')}}"/>
                                    <input type="submit" class="stepForm_btn radius-5" value="{{ get_static_option('service_order_confirm_title') ?? __('Confirm Your Order') }}">
                                </div>
                            </fieldset>
                        </div>



                        <!--Booking Summary section - Hidden -->
                        <div class="col-xl-3 col-lg-4" style="display: none;">
                            <div class="new_serviceDetails__side">
                                <div class="new_serviceDetails__side__item">
                                    <div class="new_serviceBooking__summary">
                                        <h4 class="new_serviceBooking__summary__title"> {{ get_static_option('service_booking_title') ?? __('Booking Summery') }} </h4>
                                        <div class="new_serviceBooking__summary__contents">
                                            <div class="new_serviceBooking__summary__contents__inner">

                                                <div class="mt-4">
                                                    <h4 class="new_serviceBooking__summary__sub_title border_top">
                                                        @if($service_details_for_book->is_service_online != 1)
                                                            {{ get_static_option('service_appoinment_package_title') ?? __('Appointment Package Service') }}
                                                        @else
                                                            <ul class='onlilne-special-list'>
                                                                <li><i class="las la-clock"></i> {{ __('Delivery Days').': '.$service_details_for_book->delivery_days }}</li>
                                                                <li class="margin-bottom-30"><i class="las la-redo-alt"></i> {{ __('Revisions').': '.$service_details_for_book->revision }}</li>
                                                            </ul>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <!--Service additional -->
                                                <ul class="summery_list border_top list_none @if($service_details_for_book->is_service_online == 1) d-none @endif">
                                                    @foreach ($service_includes as $include)
                                                        <li class="list include_service_id_{{ $include->id }} include_service_list">
                                                            <input type="hidden" class="includeServiceID" value="{{ $include->id }}">
                                                            <span class="item__title">{{ $include->include_service_title }}</span>
                                                            @if($service_details_for_book->is_service_online !=1)
                                                                <span class="item_count include_service_quantity service_quantity_count" id="include_service_quantity_3_{{ $include->id }}">
                                                                {{ $include->include_service_quantity }}
                                                            </span>
                                                                <span class="value_count room-count" style="display: none;">{{ amount_with_currency_symbol($include->include_service_price) }}</span>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <!--Package fee - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title">{{ get_static_option('service_package_fee_title') ?? __('Package Fee') }}</span>
                                                        <span class="value_count package-fee">{{ amount_with_currency_symbol($service_details_for_book->price) }}</span>
                                                    </li>
                                                </ul>
                                                <h4 class="new_serviceBooking__summary__sub_title border_top">{{ get_static_option('service_extra_title') ?? __('Extra Service') }}</h4>
                                                <input type="hidden" name="package_fee_input_hiddend_field_for_js_calculation" value="{{$service_details_for_book->price}}">

                                                <!--additional service for display data-->
                                                <ul class="summery_list list_none extra-service-list">

                                                </ul>

                                                <!--additional service for backend request data-->
                                                <ul class="summery_list extra-service-list-2 d-none">

                                                </ul>

                                                <!--extra service count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"> {{ get_static_option('service_extra_title') ?? __('Extra Service') }}</span>
                                                        <span class="value-count extra-service-fee">{{amount_with_currency_symbol(0)}}</span>
                                                    </li>
                                                </ul>

                                                <!--sub-total count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"> {{ get_static_option('service_subtotal_title') ?? __('Subtotal') }}</span>
                                                        <span class="value-count service-subtotal">{{amount_with_currency_symbol(0)}}</span>
                                                    </li>
                                                </ul>

                                                <!--Tax Count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"> {{ __('Tax(+)') }}
                                                             <span class="service-tax">{{ optional($country_tax)->tax ?? 0}}</span> %
                                                        </span>
                                                        <span class="value-count tax-amount">{{amount_with_currency_symbol(0)}}</span>
                                                    </li>
                                                </ul>

                                                <!--service Sub Total value -->
                                                <input type="hidden" name="service_subtotal_input_hidden_field_for_js_calculation" value="">

                                                <!--Total count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"><strong>{{ get_static_option('service_total_amount_title') ?? __('Total') }}</strong></span>
                                                        <span class="value-count total-amount total_amount_for_coupon" id="total_amount_for_coupon">{{amount_with_currency_symbol(0)}}</span>
                                                    </li>
                                                </ul>


                                                <ul class="new_serviceBooking__summary__list list_none mt-3">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="coupon_amount_for_apply_code"> </span>
                                                    </li>
                                                </ul>


                                                <ul class="new_serviceBooking__summary__list list_none border_top coupon_input_field">
                                                    <li class="result-list">
                                                        <input type="text" name="coupon_code" class="form-control coupon_code" placeholder="{{__('Enter Coupon Code')}}">
                                                        <button class="apply-coupon">{{ __('Apply') }}</button>
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Service Details area end -->
@endsection
@include('frontend.pages.services.service-book-js')
