@extends('frontend.frontend-master')
@section('page-meta-data')
    <title>{{ __('User Register') }}</title>
@endsection

@if(empty(get_static_option('disable_user_otp_verify')))
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <style>
        .intl-tel-input,
        .iti{
            width: 100%;
        }


        .signup-wrapper {
            padding: 1px 100px;
            -webkit-box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 0px rgba(0, 0, 0, 0.1);
            max-width: 650px;
            margin: 0 auto;
        }

        /* Location Map Styles */
        .location-map-wrapper {
            position: relative;
            margin-top: 15px;
        }

        #register-location-map {
            width: 100%;
            height: 500px;
            min-height: 500px;
            border-radius: 12px;
            border: 2px solid rgba(0, 0, 0, 0.15);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        #get-current-location-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
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
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        #get-current-location-btn:hover {
            background: #FFD700;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        #get-current-location-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        #location-status {
            margin-top: 10px;
            font-size: 14px;
            padding: 8px 12px;
            background: #FFFFFF;
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #location-status i {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            #register-location-map {
                height: 400px;
                min-height: 400px;
            }
            
            #get-current-location-btn {
                padding: 8px 16px;
                font-size: 13px;
                top: 10px;
                right: 10px;
            }
        }
        
        @media (max-width: 480px) {
            #register-location-map {
                height: 350px;
                min-height: 350px;
            }
        }

    </style>
@endsection
@endif

@section('content')
@php 
$reg_type = request()->get('type') ?? 'buyer';
@endphp
    <!-- Banner Inner area Starts -->
    <div class="banner-inner-area section-bg-2 padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-inner-contents text-center">
                        <h2 class="banner-inner-title"> {{ get_static_option('register_page_title') ? __(get_static_option('register_page_title')) : __('Register') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Inner area end -->
    <!-- Register Step Form area starts -->
    <section class="registration-step-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="registration-seller-btn">
                        @if(get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                            <div class="alert alert-danger" role="alert">
                                {{ get_static_option('register_notice') ?? __('Please be patient!!. Register system is currently disabled. We will come back very soon.') }}
                            </div>
                        @else
                            <ul class="registration-tabs tabs">
                                @if(get_static_option('seller_register_on_off') === 'on')
                                    <li data-tab="tab_one" class="is_user_seller @if($reg_type === 'seller') active @endif">
                                        <div class="single-tabs-registration">
                                            <div class="icon">
                                                <i class="las la-briefcase"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title" id="seller">{{ __('Seller') }}</h4>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(get_static_option('buyer_register_on_off') === 'on')
                                    <li data-tab="tab_two" class="@if($reg_type === 'buyer') active @endif is_user_buyer">
                                        <div class="single-tabs-registration">
                                            <div class="icon">
                                                <i class="las la-user-alt"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title" id="buyer">{{ __('Buyer') }}</h4>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                    
                    <div class="tab-content active" id="tab_one">
                        <div class="registration-step-form margin-top-55">
                            <form id="msform-one" class="msform user-register-form" method="post"
                                action="{{ route('user.register') }}" enctype="multipart/form-data">
                                @csrf
                                <ul class="registration-list step-list-two">
                                    <li class="list active">
                                        <a class="list-click" href="javascript:void(0)"> 1 </a>
                                    </li>
                                    <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> 2 </a>
                                    </li>
                                    <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> 3 </a>
                                    </li>
                                </ul>
                                <div class="text-center mt-5" id="error-message"></div>
                                <!-- Information -->
                                <fieldset class="fieldset-info user-information">
                                    {{-- validation error show  --}}
                                    <div class="mt-5"> <x-msg.error/> </div>

                                    @php
                                        $googleData = session('google_register_data', []);
                                    @endphp
                                    @if(!empty($googleData))
                                        <div class="alert alert-success mb-4">
                                            <i class="las la-check-circle"></i> {{ __('تم تسجيل الدخول بجوجل. يرجى إكمال بياناتك') }}
                                        </div>
                                    @endif
                                    <div class="information-all margin-top-55">
                                        <div class="info-forms">
                                            <div class="single-forms">
                                                <div class="single-content margin-top-30">
                                                    <label class="forms-label"> {{ __('Full Name') }} <span class="text-danger">*</span> </label>
                                                    <input class="form--control" type="text" name="name" id="name" value="{{old('name', $googleData['name'] ?? '')}}" placeholder="{{__('Full Name')}}" @if(!empty($googleData['name'])) readonly @endif>
                                                </div>
                                                <div class="single-content margin-top-30">
                                                    <label class="forms-label"> {{ __('Email Address') }} <span class="text-danger">*</span> </label>
                                                    <input class="form--control" type="text" name="email" id="email" value="{{old('email', $googleData['email'] ?? '')}}"
                                                        placeholder="{{__('Type Email')}}" @if(!empty($googleData['email'])) readonly @endif>
                                                    @if(!empty($googleData['google_id']))
                                                        <input type="hidden" name="google_id" value="{{$googleData['google_id']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="single-forms">

                                                <div class="single-content margin-top-30">
                                                    <input type="hidden" id="country-code" name="country_code">
                                                    <label class="forms-label"> {{ __('Phone Number') }}  <span class="text-danger">*</span> </label>
                                                    <input class="form--control" type="tel" name="phone" id="phone" value="{{old('phone')}}"
                                                        placeholder="{{__('Type Number')}}">

                                                    @if(empty(get_static_option('disable_user_otp_verify')))
                                                        <div class="d-none">
                                                          <span id="error-msg" class="hide"></span>
                                                         <p id="result" class="d-none"></p>
                                                      </div>
                                                    @endif

                                                </div>
                                                
                                                <div class="single-content margin-top-30">
                                                    <label class="forms-label"> {{ __('رقم الهوية الوطنية') }}  <span class="text-danger">*</span> </label>
                                                    <input class="form--control" type="text" name="national_id" id="national_id" value="{{old('national_id')}}"
                                                        placeholder="{{__('أدخل رقم الهوية الوطنية (10 أرقام)')}}" maxlength="10" pattern="[0-9]{10}" inputmode="numeric">
                                                    <small class="form-text text-muted">{{ __('رقم الهوية الوطنية يجب أن يكون 10 أرقام. يمكنك التسجيل بحساب واحد فقط لكل رقم هوية.') }}</small>
                                                    <div id="national_id_error" class="text-danger" style="display: none; font-size: 13px; margin-top: 5px;"></div>
                                                </div>
                                            </div>


                                            @if(empty($googleData))
                                            <div class="single-forms">
                                                <div class="single-content margin-top-30">
                                                    <label class="forms-label"> {{ __('Password') }} <span class="text-danger">*</span> </label>
                                                    <input class="form--control" type="password" name="password"
                                                        id="password" placeholder="{{__('Password')}}">
                                                </div>
                                                <div class="single-content margin-top-30">
                                                    <label class="forms-label"> {{ __('Confirm Password') }} <span class="text-danger">*</span> </label>
                                                    <input class="form--control" type="password"
                                                        name="password_confirmation" id="password_confirmation"
                                                        placeholder="{{__('Confirm Password')}}">
                                                </div>
                                            </div>
                                            @else
                                            <input type="hidden" name="password" value="{{Str::random(16)}}">
                                            <input type="hidden" name="password_confirmation" value="{{Str::random(16)}}">
                                            @endif
                                        </div>
                                    </div>
                                    @if(get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                        <input type="button" name="next" class="next action-button" value="{{__('Next')}}" disabled />
                                    @else
                                        <input type="button" name="next" class="next action-button" value="{{__('Next')}}" />
                                    @endif
                                </fieldset>
                                <!-- Service -->
                                <fieldset class="fieldset-service service-area">
                                    <div class="information-all margin-top-55">
                                        <h3 class="register-title"> {{ __('Service Area') }} </h3>
                                        <div class="info-service">
                                            <div class="single-info-service margin-top-30 country-wrapper">
                                                <div class="single-content">
                                                    <label class="forms-label"> {{ __('Service Country') }} <span class="text-danger">*</span> </label>
                                                    <select name="country" id="country">
                                                        <option value="">{{ __('Select Country') }}</option>
                                                        @php
                                                            // جميع الدول العربية (22 دولة)
                                                            $arabicCountries = [
                                                                'SA' => 'السعودية',
                                                                'AE' => 'الإمارات العربية المتحدة',
                                                                'EG' => 'مصر',
                                                                'JO' => 'الأردن',
                                                                'KW' => 'الكويت',
                                                                'QA' => 'قطر',
                                                                'BH' => 'البحرين',
                                                                'OM' => 'عمان',
                                                                'YE' => 'اليمن',
                                                                'IQ' => 'العراق',
                                                                'SY' => 'سوريا',
                                                                'LB' => 'لبنان',
                                                                'PS' => 'فلسطين',
                                                                'LY' => 'ليبيا',
                                                                'TN' => 'تونس',
                                                                'DZ' => 'الجزائر',
                                                                'MA' => 'المغرب',
                                                                'SD' => 'السودان',
                                                                'SO' => 'الصومال',
                                                                'DJ' => 'جيبوتي',
                                                                'MR' => 'موريتانيا',
                                                                'KM' => 'جزر القمر'
                                                            ];
                                                            // تصنيف الدول العربية والدول الأخرى
                                                            $arabicCountriesList = [];
                                                            $otherCountries = [];
                                                            $saudiCountry = null;
                                                            
                                                            foreach ($countries as $country) {
                                                                $countryCode = $country->country_code ?? '';
                                                                if (isset($arabicCountries[$countryCode])) {
                                                                    $arabicCountriesList[] = $country;
                                                                    if ($countryCode === 'SA') {
                                                                        $saudiCountry = $country;
                                                                    }
                                                                } else {
                                                                    $otherCountries[] = $country;
                                                                }
                                                            }
                                                        @endphp
                                                        {{-- عرض الدول العربية أولاً --}}
                                                        @foreach($arabicCountriesList as $country)
                                                            <option value="{{ $country->id }}" @if($country->country_code === 'SA') selected @endif>{{ $country->country }}</option>
                                                        @endforeach
                                                        {{-- عرض الدول الأخرى --}}
                                                        @foreach($otherCountries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Leaflet Map for Location Selection (Free, no API key needed) -->
                                            <div class="single-info-service margin-top-30">
                                                <div class="single-content">
                                                    <label class="forms-label">{{ __('حدد موقعك على الخريطة') }} <span class="text-danger">*</span></label>
                                                    <p class="form-text text-muted margin-bottom-15" style="font-size: 13px; color: #666;">
                                                        {{ __('سيتم تحديد موقعك تلقائياً عبر GPS. يمكنك أيضاً النقر على الخريطة أو سحب العلامة لتحديد موقعك بدقة.') }}
                                                    </p>
                                                    <div class="location-map-wrapper" style="position: relative; width: 100%;">
                                                        <button type="button" id="get-current-location-btn" class="btn btn-sm" style="position: absolute; top: 15px; right: 15px; z-index: 10; background: #FFD700; color: #000000; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                                                            <i class="las la-map-marker-alt"></i> {{ __('تحديد موقعي') }}
                                                        </button>
                                                        <div id="register-location-map" style="width: 100%; height: 500px; border-radius: 12px; border: 2px solid rgba(0, 0, 0, 0.15); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                                            <div style="text-align: center; color: #666;">
                                                                <i class="las la-spinner la-spin" style="font-size: 32px; margin-bottom: 10px;"></i>
                                                                <p>جاري تحميل الخريطة...</p>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="selected_latitude" name="latitude">
                                                        <input type="hidden" id="selected_longitude" name="longitude">
                                                        <div id="location-status" class="margin-top-15" style="font-size: 14px; padding: 12px 15px; background: #FFFFFF; border-radius: 8px; border: 1px solid rgba(0, 0, 0, 0.1); display: flex; align-items: center; gap: 10px; min-height: 45px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Department Selection - Only for Seller/Technician -->
                                            <div class="single-info-service margin-top-30 department-wrapper" id="department-wrapper" style="display: none;">
                                                <div class="single-content">
                                                    <label class="forms-label"> {{ __('Department') }} <span class="text-danger">*</span> </label>
                                                    <select name="department" id="department" class="get_department">
                                                        <option value="">{{ __('Select Department') }}</option>
                                                        @if(isset($categories) && $categories->count() > 0)
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="form-text text-muted">{{ __('Choose your specialization: Electricity, Plumbing, or Air Conditioning') }}</small>
                                                </div>
                                            </div>
                                            
                                            <!-- Job Type Selection - Only for Seller/Technician -->
                                            <div class="single-info-service margin-top-30 job-type-wrapper" id="job-type-wrapper" style="display: none;">
                                                <div class="single-content">
                                                    <label class="forms-label"> {{ __('نوع الوظيفة المراد التقديم عليها') }} <span class="text-danger">*</span> </label>
                                                    <select name="job_type" id="job_type" class="get_job_type">
                                                        <option value="">{{ __('اختر نوع الوظيفة') }}</option>
                                                        <option value="فني كهرباء">{{ __('فني كهرباء') }}</option>
                                                        <option value="فني سباكة">{{ __('فني سباكة') }}</option>
                                                        <option value="فني تكييف">{{ __('فني تكييف') }}</option>
                                                        <option value="فني أجهزة منزلية">{{ __('فني أجهزة منزلية') }}</option>
                                                        <option value="فني إلكترونيات">{{ __('فني إلكترونيات') }}</option>
                                                        <option value="دعم فني">{{ __('دعم فني') }}</option>
                                                        <option value="ماركتنج">{{ __('ماركتنج') }}</option>
                                                        <option value="مبيعات">{{ __('مبيعات') }}</option>
                                                    </select>
                                                    <small class="form-text text-muted">{{ __('اختر نوع الوظيفة التي ترغب في التقديم عليها') }}</small>
                                                </div>
                                            </div>
                                            
                                            <!-- Experience/Skills - Only for Seller/Technician -->
                                            <div class="single-info-service margin-top-30 experience-wrapper" id="experience-wrapper" style="display: none;">
                                                <div class="single-content">
                                                    <label class="forms-label"> {{ __('الخبرة والمهارات') }} <span class="text-danger">*</span> </label>
                                                    <textarea class="form--control" name="experience" id="experience" rows="5" placeholder="{{ __('اكتب خبرتك والمهارات التي تمتلكها...') }}"></textarea>
                                                    <small class="form-text text-muted">{{ __('اذكر خبرتك في المجال والمهارات التي تمتلكها') }}</small>
                                                </div>
                                            </div>
                                            
                                            <!-- Resume File Upload - Only for Seller/Technician -->
                                            <div class="single-info-service margin-top-30 resume-wrapper" id="resume-wrapper" style="display: none;">
                                                <div class="single-content">
                                                    <label class="forms-label"> {{ __('رفع السيرة الذاتية') }} <span class="text-danger">*</span> </label>
                                                    <input type="file" class="form--control" name="resume_file" id="resume_file" accept=".pdf,.doc,.docx">
                                                    <small class="form-text text-muted">{{ __('يرجى رفع ملف السيرة الذاتية بصيغة PDF أو Word (حجم أقصى 5 ميجابايت)') }}</small>
                                                    <div id="resume-file-name" class="margin-top-10" style="display: none; padding: 8px 12px; background: #f0f0f0; border-radius: 6px; font-size: 14px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button" value="{{__('Next')}}" />
                                    <input type="button" name="previous" class="previous action-button-previous"
                                        value="{{__('Previous')}}" />
                                </fieldset>
                                <!-- Terms & Condition -->
                                <fieldset class="fieldset-condition terms-conditions">
                                    <div class="information-all margin-top-55">
                                        <h3 class="register-title"> {{ __('Terms and Conditions') }} </h3>
                                        <div class="condition-info">
                                            <div class="single-condition margin-top-30">
                                                <div class="condition-content">
                                                    <div class="checkbox-inlines">
                                                        <input class="check-input" type="checkbox"
                                                            name="terms_conditions" id="terms_conditions">
                                                        <label class="checkbox-label" for="terms_conditions">
                                                            {{ __('I agree with the') }}
                                                            <a href="{{ url('/'.get_static_option('select_terms_condition_page')) }}" target="_blank">
                                                                {{ __('terms and conditions.') }}
                                                            </a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="get_user_type" id="get_user_type" value="{{$reg_type === 'buyer' ? 1 : 0}}">
                                    <input type="submit" name="submit" class="action-button" value="{{__('Submit')}}" />
                                    <input type="button" name="previous" class="previous action-button-previous"
                                        value="{{__('Previous')}}" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="signup-wrapper mt-2">
                <div class="signup-contents">
                    <div class="social-login-wrapper">
                        <div class="bar-wrap">
                            <span class="bar"></span>
                            <p class="or">{{ __('أو') }}</p>
                            <span class="bar"></span>
                        </div>
                        <div class="sin-in-with">
                            <a href="{{ route('register.google.redirect') }}" class="sign-in-btn" style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 20px; background: #fff; border: 1px solid #ddd; border-radius: 8px; color: #333; text-decoration: none; transition: all 0.3s; width: 100%; margin-bottom: 10px;">
                                <img src="{{ asset('assets/frontend/img/static/google.png') }}" alt="Google" style="width: 20px; height: 20px;">
                                {{ __('التسجيل بجوجل') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Register Step Form area end -->
@endsection
@section('scripts')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    @if(empty(get_static_option('disable_user_otp_verify')))
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    @endif

    <script>
        // بيانات الدول المتاحة من PHP
        const availableCountries = {};
        @foreach($countries as $country)
            @if(!empty($country->country_code))
            availableCountries['{{ strtoupper($country->country_code) }}'] = {
                id: {{ $country->id }},
                name: '{{ addslashes($country->country) }}',
                code: '{{ strtoupper($country->country_code) }}'
            };
            @endif
        @endforeach
        
        // Leaflet Map initialization for register (Free, no API key needed)
        let registerMap;
        let registerMarker;
        let registerUserLocation = null;

        function showRegisterMapError(message) {
            const mapElement = document.getElementById('register-location-map');
            if (mapElement) {
                mapElement.innerHTML = '<div style="padding: 30px 20px; text-align: center; color: #666; background: #fff; border-radius: 8px;"><div style="font-size: 48px; margin-bottom: 15px; color: #999;">⚠️</div><p style="font-size: 18px; font-weight: 600; margin-bottom: 10px; color: #333;">عفوًا، حدث خطأ.</p><p style="font-size: 14px; margin-top: 10px; color: #666; line-height: 1.6;">' + message + '</p></div>';
            }
        }

        function initRegisterMap() {
            console.log('Initializing Leaflet Map for register...');
            
            try {
                const mapElement = document.getElementById('register-location-map');
                
                if (!mapElement) {
                    console.error('Map element not found');
                    return;
                }
                
                // Check if Leaflet is loaded
                if (typeof L === 'undefined') {
                    showRegisterMapError('{{__("جاري تحميل مكتبة الخريطة...")}}');
                    setTimeout(initRegisterMap, 500);
                    return;
                }
                
                // Clear loading message
                mapElement.innerHTML = '';
                
                // Default center (will be updated with user location)
                const defaultCenter = [24.7136, 46.6753]; // Riyadh, Saudi Arabia
                
                console.log('Creating Leaflet Map...');
                // Initialize map
                registerMap = L.map('register-location-map', {
                    center: defaultCenter,
                    zoom: 15,
                    zoomControl: true
                });
                
                // Add OpenStreetMap tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(registerMap);
                
                console.log('Map created successfully');
                
                // Create custom red marker icon
                const redIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
                
                // Create draggable marker
                registerMarker = L.marker(defaultCenter, {
                    draggable: true,
                    icon: redIcon
                }).addTo(registerMap);
                
                // Update address when marker is dragged
                registerMarker.on('dragend', function() {
                    updateRegisterAddressFromMarker();
                });
                
                // Update address when map is clicked
                registerMap.on('click', function(event) {
                    registerMarker.setLatLng(event.latlng);
                    updateRegisterAddressFromMarker();
                });
                
                // Get user location automatically
                getRegisterCurrentLocation();
            } catch (error) {
                console.error('Error in initRegisterMap:', error);
                showRegisterMapError('{{__("خطأ في تهيئة الخريطة. يرجى تحديث الصفحة.")}}');
            }
        }

        function getRegisterCurrentLocation() {
            const locationStatus = document.getElementById('location-status');
            
            if (!navigator.geolocation) {
                if (locationStatus) {
                    locationStatus.innerHTML = '<i class="las la-exclamation-circle"></i> <span>{{__("المتصفح لا يدعم تحديد الموقع الجغرافي")}}</span>';
                }
                return;
            }
            
            if (locationStatus) {
                locationStatus.innerHTML = '<i class="las la-spinner la-spin"></i> <span>جاري طلب إذن الموقع...</span>';
            }
            
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    
                    registerUserLocation = { lat: latitude, lng: longitude };
                    
                    // Center map on user location
                    if (registerMap) {
                        registerMap.setView([registerUserLocation.lat, registerUserLocation.lng], 17);
                    }
                    
                    // Set marker position
                    if (registerMarker) {
                        registerMarker.setLatLng([registerUserLocation.lat, registerUserLocation.lng]);
                    }
                    
                    // Get address
                    updateRegisterAddressFromMarker();
                    
                    if (locationStatus) {
                        locationStatus.innerHTML = '<i class="las la-check-circle"></i> <span>تم تحديد الموقع بنجاح! جاري الحصول على العنوان...</span>';
                    }
                },
                function(error) {
                    let errorMessage = 'تعذر الحصول على موقعك. يرجى النقر على الخريطة أو الضغط على زر "تحديد موقعي".';
                    if (error.code === error.PERMISSION_DENIED) {
                        errorMessage = 'تم رفض إذن الموقع. يرجى السماح بالوصول إلى الموقع في إعدادات المتصفح أو النقر على الخريطة لتحديد الموقع يدوياً.';
                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                        errorMessage = 'معلومات الموقع غير متاحة. يرجى النقر على الخريطة لتحديد موقعك.';
                    } else if (error.code === error.TIMEOUT) {
                        errorMessage = 'انتهت مهلة طلب الموقع. يرجى المحاولة مرة أخرى أو النقر على الخريطة.';
                    }
                    if (locationStatus) {
                        locationStatus.innerHTML = '<i class="las la-exclamation-circle"></i> <span>' + errorMessage + '</span>';
                    }
                    
                    // Set default location
                    if (registerMap && registerMarker) {
                        registerMap.setView([24.7136, 46.6753], 13);
                        registerMarker.setLatLng([24.7136, 46.6753]);
                        updateRegisterAddressFromMarker();
                    }
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
            );
        }

        function updateRegisterAddressFromMarker() {
            if (!registerMarker) return;
            
            const locationStatus = document.getElementById('location-status');
            const latlng = registerMarker.getLatLng();
            const lat = latlng.lat;
            const lng = latlng.lng;
            
            // Update hidden fields
            const latField = document.getElementById('selected_latitude');
            const lngField = document.getElementById('selected_longitude');
            
            if (latField) latField.value = lat;
            if (lngField) lngField.value = lng;
            
            // Get address from coordinates using Nominatim (OpenStreetMap geocoding - free)
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language={{app()->getLocale()}}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        if (locationStatus) {
                            locationStatus.innerHTML = '<i class="las la-check-circle"></i> <span>تم تحديد الموقع: ' + data.display_name + '</span>';
                        }
                        
                        // تحديد الدولة تلقائياً من بيانات Nominatim
                        let countryCode = null;
                        let cityName = '';
                        
                        if (data.address_components) {
                            for (let i = 0; i < data.address_components.length; i++) {
                                const component = data.address_components[i];
                                
                                // البحث عن رمز الدولة
                                if (component.types.includes('country') && component.short_name) {
                                    countryCode = component.short_name.toUpperCase();
                                }
                                
                                // البحث عن اسم المدينة
                                if (component.types.includes('locality') || component.types.includes('administrative_area_level_2')) {
                                    if (!cityName) {
                                        cityName = component.long_name;
                                    }
                                }
                            }
                            
                            // تحديد الدولة تلقائياً
                            if (countryCode) {
                                matchCountryFromCode(countryCode);
                            }
                            
                            // تحديد المدينة تلقائياً
                            if (cityName) {
                                matchCityFromName(cityName);
                            }
                        }
                        
                        // محاولة بديلة من data.address إذا كان متاحاً
                        if (!countryCode && data.address && data.address.country_code) {
                            countryCode = data.address.country_code.toUpperCase();
                            matchCountryFromCode(countryCode);
                        }
                    } else {
                        if (locationStatus) {
                            locationStatus.innerHTML = '<i class="las la-exclamation-circle"></i> <span>تعذر تحديد العنوان من الإحداثيات. يرجى المحاولة مرة أخرى.</span>';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error getting address:', error);
                    if (locationStatus) {
                        locationStatus.innerHTML = '<i class="las la-exclamation-circle"></i> <span>تعذر تحديد العنوان من الإحداثيات. يرجى المحاولة مرة أخرى.</span>';
                    }
                });
        }

        // دالة لتحديد الدولة تلقائياً من رمز الدولة
        function matchCountryFromCode(countryCode) {
            if (!countryCode || !availableCountries) return;
            
            // البحث عن الدولة في البيانات المتاحة
            const country = availableCountries[countryCode];
            
            if (country && country.id) {
                const countrySelect = $('#country');
                const currentValue = countrySelect.val();
                
                // تحديث القائمة المنسدلة فقط إذا لم تكن محددة مسبقاً
                if (!currentValue || currentValue === '') {
                    countrySelect.val(country.id).trigger('change');
                    console.log('تم تحديد الدولة تلقائياً: ' + country.name);
                }
            }
        }

        function matchCityFromName(cityName) {
            const countryId = $('#country').val();
            if (!countryId) return;

            $.ajax({
                method: 'post',
                url: "{{ route('user.country.city') }}",
                data: {
                    country_id: countryId,
                    _token: "{{csrf_token()}}"
                },
                success: function(res) {
                    if (res.status == 'success' && res.cities) {
                        let matchedCity = null;
                        
                        // Try exact match first
                        for (let i = 0; i < res.cities.length; i++) {
                            if (res.cities[i].service_city.toLowerCase() === cityName.toLowerCase()) {
                                matchedCity = res.cities[i];
                                break;
                            }
                        }

                        // Try partial match
                        if (!matchedCity) {
                            for (let i = 0; i < res.cities.length; i++) {
                                if (res.cities[i].service_city.toLowerCase().includes(cityName.toLowerCase()) || 
                                    cityName.toLowerCase().includes(res.cities[i].service_city.toLowerCase())) {
                                    matchedCity = res.cities[i];
                                    break;
                                }
                            }
                        }

                        if (matchedCity) {
                            $('#service_city').val(matchedCity.id);
                        }
                    }
                }
            });
        }

        // Get Current Location Button
        $('#get-current-location-btn').on('click', function() {
            getRegisterCurrentLocation();
        });

        // Initialize map when entering service area step
        $(document).on('click', '.user-information .next', function() {
            setTimeout(function() {
                if (!registerMap) {
                    initRegisterMap();
                }
            }, 800);
        });

        // Initialize map when going back to service area step
        $(document).on('click', '.terms-conditions .previous', function() {
            setTimeout(function() {
                if (!registerMap) {
                    initRegisterMap();
                } else {
                    // Refresh map
                    setTimeout(function() {
                        if (registerMap) {
                            registerMap.invalidateSize();
                        }
                    }, 300);
                }
            }, 800);
        });

        // Initialize map on page load if already on service area step
        $(document).ready(function() {
            setTimeout(function() {
                if ($('.service-area').is(':visible') && $('#register-location-map').length && !registerMap) {
                    initRegisterMap();
                }
            }, 1000);
        });
    </script>

    @if(false)
    <script>
        (function() {
            'use strict';
            
            var googleMapsLoaded = false;
            var googleMapsLoadAttempts = 0;
            var maxLoadAttempts = 150; // 30 seconds max wait
            var apiKey = '{{ $googleMapsApiKey }}';
            var mapScriptLoaded = false;
            
            // Show error message in map container
            function showMapError(message) {
                var mapElement = document.getElementById('register-location-map');
                if (mapElement) {
                    mapElement.innerHTML = '<div style="padding: 30px 20px; text-align: center; color: #666; background: #fff; border-radius: 8px;"><div style="font-size: 48px; margin-bottom: 15px; color: #999;">⚠️</div><p style="font-size: 18px; font-weight: 600; margin-bottom: 10px; color: #333;">عفوًا، حدث خطأ.</p><p style="font-size: 14px; margin-top: 10px; color: #666; line-height: 1.6;">' + message + '</p></div>';
                }
            }
            
            // Callback function for Google Maps API
            window.initGoogleMapsCallback = function() {
                if (googleMapsLoaded) return;
                
                try {
                    if (typeof google !== 'undefined' && typeof google.maps !== 'undefined' && typeof google.maps.Map !== 'undefined') {
                        googleMapsLoaded = true;
                        mapScriptLoaded = true;
                        console.log('✅ Google Maps API loaded successfully via callback');
                        
                        // Clear any error messages
                        var mapElement = document.getElementById('register-location-map');
                        if (mapElement && mapElement.innerHTML.includes('عفوًا')) {
                            mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;"><i class="las la-spinner la-spin" style="font-size: 32px; margin-bottom: 10px;"></i><p>جاري تحميل الخريطة...</p></div>';
                        }
                        
                        // Initialize map if function exists
                        if (typeof waitForGoogleMapsAndInit === 'function') {
                            setTimeout(function() {
                                waitForGoogleMapsAndInit();
                            }, 500);
                        }
                    } else {
                        throw new Error('Google Maps API objects not available');
                    }
                } catch (error) {
                    console.error('Error in Google Maps callback:', error);
                    showMapError('لم تحمل هذه الصفحة خرائط Google بشكل صحيح. راجع وحدة تحكم JavaScript للاطلاع على التفاصيل التقنية.');
                }
            };
            
            // Fallback function to check if Google Maps loaded
            function checkGoogleMapsLoaded() {
                if (googleMapsLoaded) return;
                
                googleMapsLoadAttempts++;
                
                if (googleMapsLoadAttempts >= maxLoadAttempts) {
                    console.error('❌ Failed to load Google Maps API after ' + maxLoadAttempts + ' attempts');
                    if (!googleMapsLoaded) {
                        showMapError('لم تحمل هذه الصفحة خرائط Google بشكل صحيح. راجع وحدة تحكم JavaScript للاطلاع على التفاصيل التقنية.<br><br>يرجى التحقق من:<br>1. إعدادات Google Maps API Key في لوحة التحكم<br>2. اتصال الإنترنت<br>3. أن API Key مفعل وله الصلاحيات المطلوبة');
                    }
                    return;
                }
                
                try {
                    if (typeof google !== 'undefined' && typeof google.maps !== 'undefined' && typeof google.maps.Map !== 'undefined') {
                        if (!googleMapsLoaded) {
                            googleMapsLoaded = true;
                            mapScriptLoaded = true;
                            console.log('✅ Google Maps API loaded successfully via fallback check (attempt ' + googleMapsLoadAttempts + ')');
                            
                            // Clear any error messages
                            var mapElement = document.getElementById('register-location-map');
                            if (mapElement && mapElement.innerHTML.includes('عفوًا')) {
                                mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;"><i class="las la-spinner la-spin" style="font-size: 32px; margin-bottom: 10px;"></i><p>جاري تحميل الخريطة...</p></div>';
                            }
                            
                            // Initialize map if function exists
                            if (typeof waitForGoogleMapsAndInit === 'function') {
                                setTimeout(function() {
                                    waitForGoogleMapsAndInit();
                                }, 500);
                            }
                        }
                    } else {
                        // Continue checking
                        setTimeout(checkGoogleMapsLoaded, 200);
                    }
                } catch (error) {
                    console.error('Error checking Google Maps:', error);
                    setTimeout(checkGoogleMapsLoaded, 200);
                }
            }
            
            // Load Google Maps script
            function loadGoogleMapsScript() {
                if (mapScriptLoaded || googleMapsLoaded) return;
                
                try {
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.async = true;
                    script.defer = true;
                    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&libraries=places&language={{app()->getLocale()}}&callback=initGoogleMapsCallback';
                    script.onerror = function() {
                        console.error('❌ Failed to load Google Maps script');
                        checkGoogleMapsLoaded();
                    };
                    script.onload = function() {
                        console.log('📜 Google Maps script tag loaded');
                    };
                    
                    // Insert script before the first script tag or at the end of body
                    var firstScript = document.getElementsByTagName('script')[0];
                    if (firstScript && firstScript.parentNode) {
                        firstScript.parentNode.insertBefore(script, firstScript);
                    } else {
                        document.body.appendChild(script);
                    }
                    
                    // Start fallback check
                    setTimeout(checkGoogleMapsLoaded, 1000);
                } catch (error) {
                    console.error('Error loading Google Maps script:', error);
                    showMapError('حدث خطأ أثناء تحميل سكريبت Google Maps. يرجى تحديث الصفحة.');
                }
            }
            
            // Start loading when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(loadGoogleMapsScript, 100);
                });
            } else {
                setTimeout(loadGoogleMapsScript, 100);
            }
            
            // Also try on window load
            window.addEventListener('load', function() {
                if (!googleMapsLoaded && !mapScriptLoaded) {
                    setTimeout(loadGoogleMapsScript, 500);
                }
            });
        })();
    </script>
    @else
    <script>
        // Show message if API key is not set
        document.addEventListener('DOMContentLoaded', function() {
            var mapElement = document.getElementById('register-location-map');
            if (mapElement) {
                mapElement.innerHTML = '<div style="padding: 30px 20px; text-align: center; color: #666; background: #fff; border-radius: 8px;"><div style="font-size: 48px; margin-bottom: 15px; color: #999;">⚠️</div><p style="font-size: 18px; font-weight: 600; margin-bottom: 10px; color: #333;">Google Maps API Key غير موجود</p><p style="font-size: 14px; margin-top: 10px; color: #666; line-height: 1.6;">يرجى إضافة Google Maps API Key من لوحة التحكم > إعدادات الخدمة > إعدادات Google Map</p></div>';
            }
        });
    </script>
    @endif

    <script type="text/javascript">
        (function() {
            "use strict";
            $(document).ready(function() {

                // if otp is active for site check
                @if(empty(get_static_option('disable_user_otp_verify')))
                var input = document.querySelector("#phone"),
                    hiddenInput = document.querySelector("#country-code"),
                    errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"],
                    result = document.querySelector("#result");
                    window.addEventListener("load", function () {
                        var errorMsg = document.querySelector("#error-msg");
                        const restrictedCountries = {!! $restricted_countries !!};
                        const allowedCountryCodes =  {!! $restricted_countries !!}.map(countryCode => countryCode.toLowerCase());

                        // Set Saudi Arabia as default country
                        const defaultCountry = restrictedCountries.includes('SA') ? 'SA' : (restrictedCountries.length > 0 ? restrictedCountries[0] : 'SA');
                        
                        var iti = window.intlTelInput(input, {
                            hiddenInput: "full_number",
                            nationalMode: false,
                            formatOnDisplay: true,
                            separateDialCode: true,
                            autoHideDialCode: true,
                            autoPlaceholder: "aggressive" ,
                            initialCountry: defaultCountry.toLowerCase(),
                            placeholderNumberType: "MOBILE",
                            preferredCountries: [defaultCountry.toLowerCase()],
                            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/utils.js",
                            allowDropdown: true,
                            searchCountryFlag: true
                        });
                        
                        // Set default country code in hidden input
                        setTimeout(function() {
                            if (iti.getSelectedCountryData()) {
                                hiddenInput.value = iti.getSelectedCountryData().dialCode;
                            }
                        }, 100);


                    //Place Autocomplete Restricted to Multiple Countries
                    const listItemElements = $('.iti__country');
                    listItemElements.each(function() {
                        const countryDataCode = $(this).attr('data-country-code').toLowerCase();
                        if (countryDataCode && !allowedCountryCodes.includes(countryDataCode)) {
                            $(this).hide();
                        }
                    });


                    input.addEventListener('keyup', formatIntlTelInput);
                    input.addEventListener('change', formatIntlTelInput);

                    function formatIntlTelInput() {
                        if (typeof intlTelInputUtils !== 'undefined') {
                            var currentText = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                            if (typeof currentText === 'string') {
                                iti.setNumber(currentText);
                            }
                        }
                    }

                    input.addEventListener('keyup', function () {
                        reset();
                        if (input.value.trim()) {
                            if (iti.isValidNumber()) {
                                $(input).addClass('form-control is-valid');
                                hiddenInput.value = iti.getSelectedCountryData().dialCode;
                            } else {
                                $(input).addClass('form-control is-invalid');
                                var errorCode = iti.getValidationError();
                                errorMsg.innerHTML = errorMap[errorCode];
                                $(errorMsg).show();
                            }
                        }
                    });
                    input.addEventListener('change', reset);
                    input.addEventListener('keyup', reset);

                    var reset = function () {
                        $(input).removeClass('form-control is-invalid');
                        errorMsg.innerHTML = "";
                        $(errorMsg).hide();
                    };
                });
                     //-only-phone-number-input code (with +)
                    function isPhoneNumberKey(evt)
                    {
                        var charCode = (evt.which) ? evt.which : evt.keyCode
                        if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
                            return false;
                        return true;
                    }
                @endif

               var user_type = "{{$reg_type === 'buyer' ? 1 : 0}}";
                $('#get_user_type').val(user_type);
                
                // Set active tab on page load based on reg_type
                @if($reg_type === 'seller')
                    $('.is_user_seller').addClass('active');
                    $('.is_user_buyer').removeClass('active');
                @else
                    $('.is_user_buyer').addClass('active');
                    $('.is_user_seller').removeClass('active');
                @endif
                
                $(document).on('click', '.is_user_buyer', function() {
                    var user_type = 1;
                    $('#get_user_type').val(user_type);
                    $('.is_user_buyer').addClass('active');
                    $('.is_user_seller').removeClass('active');
                    
                    // Hide department field for buyer
                    $('#department-wrapper').hide();
                    $('#department').val('').removeAttr('required');

                })
                $(document).on('click', '.is_user_seller', function() {
                    var user_type = 0;
                    $('#get_user_type').val(user_type);
                    $('.is_user_seller').addClass('active');
                    $('.is_user_buyer').removeClass('active');
                    
                    // Show all seller/technician fields
                    $('#department-wrapper').show();
                    $('#department').attr('required', 'required');
                    $('#job-type-wrapper').show();
                    $('#job_type').attr('required', 'required');
                    $('#experience-wrapper').show();
                    $('#experience').attr('required', 'required');
                    $('#resume-wrapper').show();
                    $('#resume_file').attr('required', 'required');
                })
                
                // Show/hide fields based on initial user type
                @if($reg_type === 'seller')
                    $('#department-wrapper').show();
                    $('#department').attr('required', 'required');
                    $('#job-type-wrapper').show();
                    $('#job_type').attr('required', 'required');
                    $('#experience-wrapper').show();
                    $('#experience').attr('required', 'required');
                    $('#resume-wrapper').show();
                    $('#resume_file').attr('required', 'required');
                @else
                    $('#department-wrapper').hide();
                    $('#department').val('').removeAttr('required');
                    $('#job-type-wrapper').hide();
                    $('#job_type').val('').removeAttr('required');
                    $('#experience-wrapper').hide();
                    $('#experience').val('').removeAttr('required');
                    $('#resume-wrapper').hide();
                    $('#resume_file').val('').removeAttr('required');
                @endif
                
                // Hide seller fields when buyer is selected
                $(document).on('click', '.is_user_buyer', function() {
                    $('#department-wrapper').hide();
                    $('#department').val('').removeAttr('required');
                    $('#job-type-wrapper').hide();
                    $('#job_type').val('').removeAttr('required');
                    $('#experience-wrapper').hide();
                    $('#experience').val('').removeAttr('required');
                    $('#resume-wrapper').hide();
                    $('#resume_file').val('').removeAttr('required');
                });
                
                // Show file name when file is selected
                $(document).on('change', '#resume_file', function() {
                    var fileName = $(this).val().split('\\').pop();
                    if (fileName) {
                        $('#resume-file-name').html('<i class="las la-file"></i> ' + fileName).show();
                    } else {
                        $('#resume-file-name').hide();
                    }
                });
                
                // Validate national ID format and check uniqueness
                $(document).on('input', '#national_id', function() {
                    var nationalId = $(this).val();
                    var errorDiv = $('#national_id_error');
                    
                    // Remove non-numeric characters
                    nationalId = nationalId.replace(/[^0-9]/g, '');
                    $(this).val(nationalId);
                    
                    // Clear previous error
                    errorDiv.hide().text('');
                    
                    // Validate length
                    if (nationalId.length > 0 && nationalId.length !== 10) {
                        errorDiv.text('رقم الهوية الوطنية يجب أن يكون 10 أرقام').show();
                        $(this).addClass('is-invalid');
                    } else if (nationalId.length === 10) {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                        
                        // Check uniqueness via AJAX
                        $.ajax({
                            url: "{{ route('user.check.national.id') }}",
                            method: 'POST',
                            data: {
                                national_id: nationalId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.exists) {
                                    errorDiv.text('رقم الهوية الوطنية مستخدم بالفعل. يمكنك التسجيل بحساب واحد فقط لكل رقم هوية').show();
                                    $('#national_id').removeClass('is-valid').addClass('is-invalid');
                                } else {
                                    errorDiv.hide();
                                    $('#national_id').removeClass('is-invalid').addClass('is-valid');
                                }
                            }
                        });
                    } else {
                        $(this).removeClass('is-invalid is-valid');
                    }
                });

           $('.user-information .next').on('click', function() {
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var national_id = $('#national_id').val();
                    var password = $('#password').val();
                    var password_confirmation = $('#password_confirmation').val();
                    var googleData = @json(session('google_register_data', []));

                    // validate user information
                    // Password is optional if Google data exists
                    var passwordRequired = Object.keys(googleData).length === 0;
                    
                    // Validate national ID format (10 digits)
                    var nationalIdPattern = /^[0-9]{10}$/;
                    if (national_id && !nationalIdPattern.test(national_id)) {
                        Command: toastr["warning"]("{{__('رقم الهوية الوطنية يجب أن يكون 10 أرقام فقط!')}}", "{{__('Warning')}}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                    
                    if (name == '' || email == '' || phone == '' || national_id == '' || (passwordRequired && (password == '' || password_confirmation == ''))) {
                        //error msg
                        Command: toastr["warning"]("{{__('Please fill all fields!')}}", "{{__('Warning')}}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                    else if (password != password_confirmation) {
                        //error msg
                        Command: toastr["warning"]("{{__('Password and confirm password not match.!')}}","{{__('Warning')}}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                    else {
                        var current_fs, next_fs, previous_fs;
                        var opacity;
                        var current = 1;
                        var steps = $("fieldset").length;
                        current_fs = $(this).parent();
                        next_fs = $(this).parent().next();

                        //Add Class Active
                        $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass(
                            "active");
                        next_fs.show();
                        current_fs.animate({
                            opacity: 0
                        }, {
                            step: function(now) {
                                opacity = 1 - now;
                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({
                                    'opacity': opacity
                                });
                            },
                            duration: 500
                        });
                    }
                })
           // change country and get city
            $(document).on('change','#country' ,function() {
                let country_id = $("#country").val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('user.country.city') }}",
                    data: {
                        country_id: country_id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            var alloptions = "<option value=''>{{__('Select City')}}</option>";
                            var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                            var allCity = res.cities;
                            $.each(allCity, function(index, value) {
                                alloptions += "<option value='" + value.id +
                                    "'>" + value.service_city + "</option>";
                                allList += "<li class='option' data-value='" + value.id +
                                    "'>" + value.service_city + "</li>";
                            });
                            $("#service_city").html(alloptions);
                            $("#service_city").parent().find(".current").html("{{__('Select City')}}");
                            $("#service_city").parent().find(".list").html(allList);
                        }
                    }
                });
            });

            // if default county set
            @if($countries->count() === 1)
                $(document).ready(function() {
                  $('#country').trigger("change");
                });
            @endif

            // Old Google Maps code removed - using Leaflet now
            @if(false)

            function initializeRegisterMap() {
                if (typeof google === 'undefined' || typeof google.maps === 'undefined' || typeof google.maps.Map === 'undefined') {
                    console.error('Google Maps API not loaded properly');
                    var mapElement = document.getElementById('register-location-map');
                    if (mapElement) {
                        mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;"><i class="las la-exclamation-circle"></i> <p>عفوًا، حدث خطأ.</p><p style="font-size: 14px; margin-top: 10px;">لم تحمل هذه الصفحة خرائط Google بشكل صحيح. راجع وحدة تحكم JavaScript للاطلاع على التفاصيل التقنية.</p><p style="font-size: 12px; margin-top: 10px; color: #999;">يرجى التحقق من إعدادات Google Maps API Key في لوحة التحكم.</p></div>';
                    }
                    setTimeout(waitForGoogleMapsAndInit, 1000);
                    return;
                }
                
                var mapElement = document.getElementById('register-location-map');
                if (!mapElement) {
                    console.error('Map element not found');
                    return;
                }

                // Check if map is already initialized
                if (registerMap) {
                    console.log('Map already initialized, refreshing...');
                    try {
                        google.maps.event.trigger(registerMap, 'resize');
                        registerMap.setCenter({ lat: defaultLat, lng: defaultLng });
                    } catch(e) {
                        console.error('Error refreshing map:', e);
                    }
                    return;
                }
                
                // Check if element is visible
                var isVisible = mapElement.offsetParent !== null && 
                               mapElement.style.display !== 'none' && 
                               mapElement.offsetWidth > 0 && 
                               mapElement.offsetHeight > 0;
                
                if (!isVisible) {
                    console.log('Map element not visible, will retry...');
                    setTimeout(waitForGoogleMapsAndInit, 500);
                    return;
                }
                
                try {
                    registerGeocoder = new google.maps.Geocoder();
                } catch(e) {
                    console.error('Error creating geocoder:', e);
                    mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;"><i class="las la-exclamation-circle"></i> <p>عفوًا، حدث خطأ.</p><p style="font-size: 14px; margin-top: 10px;">لم تحمل هذه الصفحة خرائط Google بشكل صحيح. راجع وحدة تحكم JavaScript للاطلاع على التفاصيل التقنية.</p></div>';
                    return;
                }
                
                var mapOptions = {
                    zoom: 13,
                    center: { lat: defaultLat, lng: defaultLng },
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    fullscreenControl: true,
                    gestureHandling: 'cooperative',
                    disableDefaultUI: false
                };
                
                try {
                    // Clear loading message
                    mapElement.innerHTML = '';
                    
                    registerMap = new google.maps.Map(mapElement, mapOptions);
                    
                    console.log('Map initialized successfully');
                    
                    // Force resize and center after a short delay
                    setTimeout(function() {
                        if (registerMap) {
                            try {
                                google.maps.event.trigger(registerMap, 'resize');
                                registerMap.setCenter({ lat: defaultLat, lng: defaultLng });
                                console.log('Map resized and centered');
                            } catch(e) {
                                console.error('Error resizing map:', e);
                            }
                        }
                    }, 500);
                    
                    // Also try after longer delay to ensure visibility
                    setTimeout(function() {
                        if (registerMap) {
                            try {
                                google.maps.event.trigger(registerMap, 'resize');
                            } catch(e) {
                                console.error('Error resizing map (second attempt):', e);
                            }
                        }
                    }, 1500);
                } catch (error) {
                    console.error('Error initializing map:', error);
                    var errorMsg = error.message || 'خطأ غير معروف';
                    mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: #666;"><i class="las la-exclamation-circle"></i> <p>عفوًا، حدث خطأ.</p><p style="font-size: 14px; margin-top: 10px;">لم تحمل هذه الصفحة خرائط Google بشكل صحيح. راجع وحدة تحكم JavaScript للاطلاع على التفاصيل التقنية.</p><p style="font-size: 12px; margin-top: 10px; color: #999;">Error: ' + errorMsg + '</p></div>';
                    return;
                }

                // Create marker
                registerMarker = new google.maps.Marker({
                    map: registerMap,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    title: 'موقعك',
                    icon: {
                        url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                        scaledSize: new google.maps.Size(40, 40)
                    }
                });

                // Get current location on map load
                getCurrentLocation();

                // Handle map click
                registerMap.addListener('click', function(event) {
                    placeMarkerAndGetLocation(event.latLng);
                });

                // Handle marker drag
                registerMarker.addListener('dragend', function(event) {
                    updateLocationFromCoordinates(event.latLng.lat(), event.latLng.lng());
                });
            }

            function getCurrentLocation() {
                var statusDiv = document.getElementById('location-status');
                statusDiv.innerHTML = '<i class="las la-spinner la-spin"></i> <span>جاري طلب إذن الموقع...</span>';
                statusDiv.style.color = '#FFD700';

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            var lat = position.coords.latitude;
                            var lng = position.coords.longitude;
                            
                            statusDiv.innerHTML = '<i class="las la-check-circle"></i> <span>تم تحديد الموقع بنجاح! جاري الحصول على العنوان...</span>';
                            statusDiv.style.color = '#000000';
                            
                            placeMarkerAndGetLocation(new google.maps.LatLng(lat, lng));
                        },
                        function(error) {
                            console.error('Error getting location:', error);
                            var errorMsg = 'تعذر الحصول على موقعك. يرجى النقر على الخريطة أو الضغط على زر "تحديد موقعي".';
                            if (error.code === error.PERMISSION_DENIED) {
                                errorMsg = 'تم رفض إذن الموقع. يرجى السماح بالوصول إلى الموقع في إعدادات المتصفح أو النقر على الخريطة لتحديد الموقع يدوياً.';
                            } else if (error.code === error.POSITION_UNAVAILABLE) {
                                errorMsg = 'معلومات الموقع غير متاحة. يرجى النقر على الخريطة لتحديد موقعك.';
                            } else if (error.code === error.TIMEOUT) {
                                errorMsg = 'انتهت مهلة طلب الموقع. يرجى المحاولة مرة أخرى أو النقر على الخريطة.';
                            }
                            statusDiv.innerHTML = '<i class="las la-exclamation-circle"></i> <span>' + errorMsg + '</span>';
                            statusDiv.style.color = '#666';
                            
                            // Set default location
                            placeMarkerAndGetLocation(new google.maps.LatLng(defaultLat, defaultLng));
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 15000,
                            maximumAge: 0
                        }
                    );
                } else {
                    statusDiv.innerHTML = '<i class="las la-exclamation-circle"></i> <span>المتصفح لا يدعم تحديد الموقع. يرجى النقر على الخريطة لتحديد موقعك.</span>';
                    statusDiv.style.color = '#666';
                    placeMarkerAndGetLocation(new google.maps.LatLng(defaultLat, defaultLng));
                }
            }

            function placeMarkerAndGetLocation(location) {
                if (!registerMarker) return;
                
                registerMarker.setPosition(location);
                registerMap.setCenter(location);
                registerMap.setZoom(16);
                
                // Add bounce animation
                registerMarker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function() {
                    if (registerMarker) {
                        registerMarker.setAnimation(null);
                    }
                }, 2000);
                
                updateLocationFromCoordinates(location.lat(), location.lng());
            }

            function updateLocationFromCoordinates(lat, lng) {
                document.getElementById('selected_latitude').value = lat;
                document.getElementById('selected_longitude').value = lng;

                var statusDiv = document.getElementById('location-status');
                statusDiv.innerHTML = '<i class="las la-spinner la-spin"></i> <span>جاري الحصول على العنوان...</span>';
                statusDiv.style.color = '#FFD700';

                var latlng = { lat: lat, lng: lng };
                registerGeocoder.geocode({ location: latlng }, function(results, status) {
                    if (status === 'OK' && results[0]) {
                        var addressComponents = results[0].address_components;
                        var countryName = '';
                        var cityName = '';
                        var areaName = '';

                        for (var i = 0; i < addressComponents.length; i++) {
                            var component = addressComponents[i];
                            var types = component.types;

                            if (types.includes('country')) {
                                countryName = component.long_name;
                            }
                            if (types.includes('locality') || types.includes('administrative_area_level_2')) {
                                cityName = component.long_name;
                            }
                            if (types.includes('sublocality') || types.includes('sublocality_level_1') || types.includes('neighborhood')) {
                                areaName = component.long_name;
                            }
                        }

                        statusDiv.innerHTML = '<i class="las la-check-circle"></i> <span>تم تحديد الموقع: ' + results[0].formatted_address + '</span>';
                        statusDiv.style.color = '#000000';

                        // Try to match with database cities and areas
                        if (cityName) {
                            matchCityAndArea(cityName, areaName, countryName);
                        }
                    } else {
                        statusDiv.innerHTML = '<i class="las la-exclamation-circle"></i> <span>تعذر تحديد العنوان من الإحداثيات. يرجى المحاولة مرة أخرى.</span>';
                        statusDiv.style.color = '#666';
                    }
                });
            }

            function matchCityAndArea(cityName, areaName, countryName) {
                // Try to find matching city in the database
                var countryId = $('#country').val();
                if (!countryId) {
                    return;
                }

                $.ajax({
                    method: 'post',
                    url: "{{ route('user.country.city') }}",
                    data: {
                        country_id: countryId,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(res) {
                        if (res.status == 'success' && res.cities) {
                            var matchedCity = null;
                            
                            // Try exact match first
                            for (var i = 0; i < res.cities.length; i++) {
                                if (res.cities[i].service_city.toLowerCase() === cityName.toLowerCase()) {
                                    matchedCity = res.cities[i];
                                    break;
                                }
                            }

                            // Try partial match
                            if (!matchedCity) {
                                for (var i = 0; i < res.cities.length; i++) {
                                    if (res.cities[i].service_city.toLowerCase().includes(cityName.toLowerCase()) || 
                                        cityName.toLowerCase().includes(res.cities[i].service_city.toLowerCase())) {
                                        matchedCity = res.cities[i];
                                        break;
                                    }
                                }
                            }

                            if (matchedCity) {
                                $('#service_city').val(matchedCity.id).trigger('change');
                                
                                // Wait for areas to load, then try to match area
                                setTimeout(function() {
                                    matchArea(matchedCity.id, areaName);
                                }, 500);
                            }
                        }
                    }
                });
            }

            function matchArea(cityId, areaName) {
                if (!areaName) return;

                $.ajax({
                    method: 'post',
                    url: "{{ route('user.city.area') }}",
                    data: {
                        city_id: cityId,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(res) {
                        if (res.status == 'success' && res.areas) {
                            var matchedArea = null;
                            
                            // Try exact match first
                            for (var i = 0; i < res.areas.length; i++) {
                                if (res.areas[i].service_area.toLowerCase() === areaName.toLowerCase()) {
                                    matchedArea = res.areas[i];
                                    break;
                                }
                            }

                            // Try partial match
                            if (!matchedArea) {
                                for (var i = 0; i < res.areas.length; i++) {
                                    if (res.areas[i].service_area.toLowerCase().includes(areaName.toLowerCase()) || 
                                        areaName.toLowerCase().includes(res.areas[i].service_area.toLowerCase())) {
                                        matchedArea = res.areas[i];
                                        break;
                                    }
                                }
                            }

                            // Area field removed, no need to set it
                        }
                    }
                });
            }

            // Get Current Location Button
            $('#get-current-location-btn').on('click', function() {
                getCurrentLocation();
            });

            // Function to wait for Google Maps API and initialize map
            var initAttempts = 0;
            var maxInitAttempts = 150; // 30 seconds max
            var mapInitInProgress = false;
            
            function waitForGoogleMapsAndInit() {
                // Prevent multiple simultaneous initialization attempts
                if (mapInitInProgress && registerMap) {
                    return;
                }
                
                initAttempts++;
                
                if (initAttempts > maxInitAttempts) {
                    console.error('❌ Max initialization attempts reached (' + maxInitAttempts + ')');
                    var mapElement = document.getElementById('register-location-map');
                    if (mapElement && !registerMap) {
                        mapElement.innerHTML = '<div style="padding: 30px 20px; text-align: center; color: #666; background: #fff; border-radius: 8px;"><div style="font-size: 48px; margin-bottom: 15px; color: #999;">⚠️</div><p style="font-size: 18px; font-weight: 600; margin-bottom: 10px; color: #333;">عفوًا، حدث خطأ.</p><p style="font-size: 14px; margin-top: 10px; color: #666; line-height: 1.6;">لم تحمل هذه الصفحة خرائط Google بشكل صحيح. راجع وحدة تحكم JavaScript للاطلاع على التفاصيل التقنية.</p><p style="font-size: 12px; margin-top: 15px; color: #999;">يرجى تحديث الصفحة أو التحقق من إعدادات Google Maps API Key.</p></div>';
                    }
                    mapInitInProgress = false;
                    return;
                }
                
                var mapElement = document.getElementById('register-location-map');
                if (!mapElement) {
                    console.log('📍 Map element not found, retrying... (' + initAttempts + ')');
                    setTimeout(waitForGoogleMapsAndInit, 300);
                    return;
                }

                // Check if element is visible
                var isVisible = mapElement.offsetParent !== null && 
                               mapElement.style.display !== 'none' && 
                               mapElement.offsetWidth > 0 && 
                               mapElement.offsetHeight > 0;

                if (!isVisible) {
                    console.log('👁️ Map element not visible yet, retrying... (' + initAttempts + ')');
                    setTimeout(waitForGoogleMapsAndInit, 300);
                    return;
                }

                // Check if Google Maps API is loaded
                if (typeof google !== 'undefined' && typeof google.maps !== 'undefined' && typeof google.maps.Map !== 'undefined') {
                    if (!registerMap) {
                        mapInitInProgress = true;
                        console.log('🗺️ Initializing map... (attempt ' + initAttempts + ')');
                        try {
                            initializeRegisterMap();
                            initAttempts = 0; // Reset on success
                            mapInitInProgress = false;
                        } catch (error) {
                            console.error('❌ Error initializing map:', error);
                            mapInitInProgress = false;
                            setTimeout(waitForGoogleMapsAndInit, 500);
                        }
                    } else {
                        console.log('✅ Map already initialized');
                        initAttempts = 0; // Reset on success
                        mapInitInProgress = false;
                    }
                } else {
                    console.log('⏳ Google Maps API not ready, retrying... (' + initAttempts + ')');
                    setTimeout(waitForGoogleMapsAndInit, 300);
                }
            }

            // Initialize map when entering service area step
            $(document).on('click', '.user-information .next', function() {
                setTimeout(function() {
                    initAttempts = 0; // Reset attempts
                    waitForGoogleMapsAndInit();
                }, 800);
            });

            // Initialize map when going back to service area step
            $(document).on('click', '.terms-conditions .previous', function() {
                setTimeout(function() {
                    initAttempts = 0; // Reset attempts
                    waitForGoogleMapsAndInit();
                }, 800);
            });

            // Initialize map on page load if already on service area step
            $(document).ready(function() {
                setTimeout(function() {
                    if ($('.service-area').is(':visible') && $('#register-location-map').length) {
                        initAttempts = 0; // Reset attempts
                        waitForGoogleMapsAndInit();
                    }
                }, 1000);
            });

            // Also try to initialize when fieldset becomes visible
            $(document).ready(function() {
                var observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' || mutation.type === 'childList') {
                            var fieldset = document.querySelector('.service-area');
                            var mapElement = document.getElementById('register-location-map');
                            if (fieldset && mapElement && !registerMap) {
                                var isVisible = fieldset.offsetParent !== null && 
                                               fieldset.style.display !== 'none' &&
                                               fieldset.offsetWidth > 0 &&
                                               fieldset.offsetHeight > 0;
                                if (isVisible) {
                                    initAttempts = 0; // Reset attempts
                                    setTimeout(waitForGoogleMapsAndInit, 300);
                                }
                            }
                        }
                    });
                });

                // Observe the service area fieldset and its parent
                var serviceAreaFieldset = document.querySelector('.service-area');
                if (serviceAreaFieldset) {
                    observer.observe(serviceAreaFieldset, {
                        attributes: true,
                        attributeFilter: ['style', 'class'],
                        childList: true,
                        subtree: true
                    });
                    
                    // Also observe parent container
                    var parent = serviceAreaFieldset.parentElement;
                    if (parent) {
                        observer.observe(parent, {
                            attributes: true,
                            attributeFilter: ['style', 'class'],
                            childList: true,
                            subtree: false
                        });
                    }
                }
                
                // Also observe the map element itself
                var mapElement = document.getElementById('register-location-map');
                if (mapElement) {
                    observer.observe(mapElement, {
                        attributes: true,
                        attributeFilter: ['style', 'class'],
                        childList: true,
                        subtree: false
                    });
                }
            });
            @endif

           // select city (area field removed)
            $(document).on('change','#service_city', function() {
                // City selected, no need to load areas anymore
            })
            //confirm service area
            $('.service-area .next').on('click', function() {
                    var service_city = $('#service_city').val();
                    var country = $('#country').val();
                    var department = $('#department').val();
                    var user_type = $('#get_user_type').val();
                    var latitude = $('#selected_latitude').val();
                    var longitude = $('#selected_longitude').val();
                    var job_type = $('#job_type').val();
                    var experience = $('#experience').val();
                    var resume_file = $('#resume_file').val();

                    // check seller service area filed is required or null
                     var  check_service_area_seller_type = null;
                    @if(empty(get_static_option('seller_service_area_required')))
                       var check_service_area_seller_type = $('#get_user_type').val();
                    @endif

                    if(check_service_area_seller_type == 0){
                        // For seller/technician, all fields are required
                        var department = $('#department').val();
                        if (country == '' || department == '' || latitude == '' || longitude == '' || job_type == '' || experience == '' || resume_file == '') {

                            //error msg
                            Command: toastr["warning"]("{{__('Please fill all fields including job type, experience, and resume!')}}", "{{__('Warning')}}")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            return false;
                        }
                        else {
                            var current_fs, next_fs, previous_fs;
                            var opacity;
                            var current = 1;
                            var steps = $("fieldset").length;
                            current_fs = $(this).parent();
                            next_fs = $(this).parent().next();

                            $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass(
                                "active");

                            next_fs.show();
                            current_fs.animate({
                                opacity: 0
                            }, {
                                step: function(now) {
                                    opacity = 1 - now;
                                    current_fs.css({
                                        'display': 'none',
                                        'position': 'relative'
                                    });
                                    next_fs.css({
                                        'opacity': opacity
                                    });
                                },
                                duration: 500
                            });
                        }
                    }else {
                        if (country == '' || latitude == '' || longitude == '') {

                            //error msg
                            Command: toastr["warning"]("{{__('Please fill all fields!')}}", "{{__('Warning')}}")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            return false;
                        }
                        else {
                            var current_fs, next_fs, previous_fs;
                            var opacity;
                            var current = 1;
                            var steps = $("fieldset").length;
                            current_fs = $(this).parent();
                            next_fs = $(this).parent().next();

                            $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass(
                                "active");

                            next_fs.show();
                            current_fs.animate({
                                opacity: 0
                            }, {
                                step: function(now) {
                                    opacity = 1 - now;
                                    current_fs.css({
                                        'display': 'none',
                                        'position': 'relative'
                                    });
                                    next_fs.css({
                                        'opacity': opacity
                                    });
                                },
                                duration: 500
                            });
                        }
                    }

                })
            $(document).on('submit', '.user-register-form', function(e) {
                    if (!$('.terms-conditions .check-input').is(":checked")) {
                        //error msg
                        Command: toastr["warning"]("{{__('Please agree with terms and conditions.!')}}","{{__('Warning')}}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                });

            });
        })(jQuery);
    </script>
@endsection

