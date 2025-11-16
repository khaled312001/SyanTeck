@extends('frontend.frontend-page-master')

@section('page-title')
{{__('How It Works')}}
@endsection

@section('site-title')
{{__('How It Works')}} - {{get_static_option('site_title')}}
@endsection

@section('page-meta-data')
{!! render_site_title(__('How It Works')) !!}
<meta name="description" content="{{__('Learn how SyanTeck platform works and how to request services')}}">
@endsection

@section('content')
<!-- How It Works area starts -->
<section class="how-it-works-area padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center margin-bottom-60">
                    <h2 class="title">{{__('How It Works')}}</h2>
                    <p class="subtitle">{{__('SyanTeck platform provides you with comprehensive solutions for managing home and technical maintenance services')}}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="how-it-works-wrapper">
                    <!-- Step 1 -->
                    <div class="single-step-item margin-bottom-50">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="step-content">
                                    <div class="step-number">01</div>
                                    <h3 class="step-title">{{__('Scan QR or Open Request Form')}}</h3>
                                    <p class="step-description">
                                        {{__('Start by scanning the QR code at your location or open the request form directly from the website. You can request service easily without needing to log in.')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="step-image text-center">
                                    <i class="las la-qrcode" style="font-size: 150px; color: #111d5c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="single-step-item margin-bottom-50">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-2">
                                <div class="step-content">
                                    <div class="step-number">02</div>
                                    <h3 class="step-title">{{__('Choose Service Type and Enter Data')}}</h3>
                                    <p class="step-description">
                                        {{__('Choose the required service type from the list (Electrical, Plumbing, HVAC, Appliances, Carpentry, Painting) and enter your data and location.')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-1">
                                <div class="step-image text-center">
                                    <i class="las la-tools" style="font-size: 150px; color: #111d5c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="single-step-item margin-bottom-50">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="step-content">
                                    <div class="step-number">03</div>
                                    <h3 class="step-title">{{__('Quick Confirmation from Support and Assign Technician')}}</h3>
                                    <p class="step-description">
                                        {{__('The support team receives your request immediately and verifies the data. An approved technician is automatically assigned based on area and specialization or manually by support.')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="step-image text-center">
                                    <i class="las la-user-check" style="font-size: 150px; color: #111d5c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="single-step-item margin-bottom-50">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-2">
                                <div class="step-content">
                                    <div class="step-number">04</div>
                                    <h3 class="step-title">{{__('Track Arrival and Complete Service')}}</h3>
                                    <p class="step-description">
                                        {{__('You can track your request status in real-time. The technician receives the request and updates the status (En Route, Arrived, Started, Completed).')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-1">
                                <div class="step-image text-center">
                                    <i class="las la-map-marked-alt" style="font-size: 150px; color: #111d5c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="single-step-item margin-bottom-50">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="step-content">
                                    <div class="step-number">05</div>
                                    <h3 class="step-title">{{__('Invoice and Digital Warranty')}}</h3>
                                    <p class="step-description">
                                        {{__('After completing the service, you receive a detailed electronic invoice and digital warranty. You can download the invoice and warranty in PDF format at any time.')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="step-image text-center">
                                    <i class="las la-file-invoice" style="font-size: 150px; color: #111d5c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="row margin-top-60">
            <div class="col-lg-12">
                <div class="cta-section text-center bg-light padding-40 radius-10">
                    <h3 class="margin-bottom-20">{{__('Ready to Request a Service?')}}</h3>
                    <p class="margin-bottom-30">{{__('Start Now and Request the Maintenance Service You Need')}}</p>
                    <a href="{{route('qr.index')}}" class="btn btn-primary btn-lg">{{__('Request Service Now')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.how-it-works-area {
    background-color: #f8f9fa;
}
.single-step-item {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.step-number {
    display: inline-block;
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    background: #111d5c;
    color: #fff;
    border-radius: 50%;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}
.step-title {
    font-size: 28px;
    font-weight: 700;
    color: #111d5c;
    margin-bottom: 15px;
}
.step-description {
    font-size: 16px;
    line-height: 1.8;
    color: #666;
}
.step-image {
    padding: 20px;
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

