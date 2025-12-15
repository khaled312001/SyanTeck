@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{ __('Order Details') }}
@endsection
@section('style')
    <style>
        .line-top-contents{
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader/>
    @include('frontend.user.seller.partials.sidebar-two')
    <div class="dashboard__right">
        @include('frontend.user.buyer.header.buyer-header')
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <!-- Report section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    @if(!empty($order_details))
                        <div class="row">

                            <div class="col-md-4">
                                <div class="single-flex-middle">
                                    <div class="single-flex-middle-inner">
                                        <div class="line-charts-wrapper margin-top-40">

                                            <div class="line-top-contents mb-2">
                                                <h4 class="earning-title">{{ __('Buyer Details') }}</h4>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Name:') }} </strong>{{ $order_details->name }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Email:') }} </strong>{{ $order_details->email }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Phone:') }} </strong>{{ $order_details->phone }}
                                                    </label>
                                                </div>

                                                @if($order_details->is_order_online !=1)
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Address:') }} </strong>{{ $order_details->address }}
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('City:') }} </strong>{{ optional($order_details->service_city)->service_city }}
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Area:') }} </strong>{{ optional($order_details->service_area)->service_area }}
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Post Code:') }} </strong>{{ $order_details->post_code }}
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Country:') }} </strong>{{ optional($order_details->service_country)->country }}
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($order_details->is_order_online !=1)
                                                <div class="line-top-contents mb-2">
                                                    <h4 class="earning-title">{{ __('Date & Schedule') }}</h4>
                                                </div>
                                                <div class="single-checbox">
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Date:') }}
                                                                @if($order_details->date === 'No Date Created')
                                                                    <span>{{ __('No Date Created') }}</span>
                                                                @else
                                                            </strong>{{ Carbon\Carbon::parse($order_details->date)->format('d/m/y') }}
                                                            @endif

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Schedule:') }} </strong>{{ $order_details->schedule }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="line-top-contents mb-2">
                                                <h4 class="earning-title">{{ __('Amount Details') }}</h4>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Package Fee:') }} </strong>{{ float_amount_with_currency_symbol($order_details->package_fee) }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Extra Service:') }} </strong>{{ float_amount_with_currency_symbol($order_details->extra_service) }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Sub Total:') }}</strong>{{ float_amount_with_currency_symbol($order_details->sub_total) }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Tax:') }} </strong>{{ float_amount_with_currency_symbol($order_details->tax) }}
                                                    </label>
                                                </div>
                                                @if(!empty($order_details->coupon_amount))
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Coupon Amount:') }} </strong>{{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                                        </label>
                                                    </div>
                                                @endif
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->total) }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Admin Charge:') }} </strong>{{ float_amount_with_currency_symbol($order_details->commission_amount) }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Payment Gateway:') }} </strong>{{ __(ucwords(str_replace("_", " ", $order_details->payment_gateway))) }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Payment Status:') }} </strong>{{ __(ucfirst($order_details->payment_status)) }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="line-top-contents mb-2">
                                                <h4 class="earning-title">{{ __('Order Details') }}</h4>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Order ID:') }} </strong>{{ $order_details->id }}
                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Order Status:') }}</strong>
                                                        @if ($order_details->status == 0)
                                                            <span>{{ __('Pending') }}</span>
                                                        @endif
                                                        @if ($order_details->status == 1)
                                                            <span>{{ __('Active') }}</span>
                                                        @endif
                                                        @if ($order_details->status == 2)
                                                            <span>{{ __('Completed') }}</span>
                                                        @endif
                                                        @if ($order_details->status == 3)
                                                            <span>{{ __('Delivered') }}</span>
                                                        @endif
                                                        @if ($order_details->status == 4)
                                                            <span>{{ __('Cancelled') }}</span>
                                                        @endif
                                                    </label>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">

                                @if($order_details->order_from_job != 'yes')
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title">{{ __('Include Details') }}</h4>
                                                </div>
                                                <table class="table table-bordered mt-3">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        @if($order_details->is_order_online !=1)
                                                            <th>{{ __('Unit Price') }}</th>
                                                            <th>{{ __('Quantity') }}</th>
                                                            <th>{{ __('Total') }}</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $package_fee =0; @endphp
                                                    @foreach($order_includes as $include)
                                                        <tr>
                                                            <td>{{ $include->title }}</td>
                                                            @if($order_details->is_order_online !=1)
                                                                <td>{{ float_amount_with_currency_symbol($include->price) }}</td>
                                                                <td>{{ $include->quantity }}</td>
                                                                <td>{{ float_amount_with_currency_symbol($include->price * $include->quantity) }}</td>
                                                                @php $package_fee += $include->price * $include->quantity @endphp
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        @if($order_details->is_order_online !=1)
                                                            <td colspan="3"><strong>{{ __('Package Fee') }}</strong>
                                                            </td>
                                                            <td>
                                                                <strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong>
                                                            </td>
                                                        @else
                                                            <td colspan="3">
                                                                <strong>{{ __('Package Fee') .float_amount_with_currency_symbol($order_details->package_fee)}}</strong>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($order_additionals->count() >= 1)
                                    <div class="single-flex-middle mt-4">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title">{{ __('Additional Details') }}</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mt-3">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('Title') }}</th>
                                                            <th>{{ __('Unit Price') }}</th>
                                                            <th>{{ __('Quantity') }}</th>
                                                            <th>{{ __('Total') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $extra_service =0; @endphp
                                                        @foreach($order_additionals as $additional)
                                                            <tr>
                                                                <td>{{ $additional->title }}</td>
                                                                <td>{{ float_amount_with_currency_symbol($additional->price) }}</td>
                                                                <td>{{ $additional->quantity }}</td>
                                                                <td>{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                                                                @php $extra_service += $additional->price * $additional->quantity @endphp
                                                            </tr>
                                                        @endforeach

                                                        <tr>
                                                            <td colspan="3"><strong>{{ __('Extra Service') }}</strong></td>
                                                            <td>
                                                                <strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(optional($order_details->extraSevices)->count() >= 1)
                                    <div class="single-flex-middle mt-4">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title">{{ __('Extra Service Details') }}</h4>
                                                </div>
                                                <span class="info-text d-block mb-4">{{__('This is not included in the main service order calculation')}}</span>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('Title') }}</th>
                                                            <th>{{ __('Unit Price') }}</th>
                                                            <th>{{ __('Quantity') }}</th>
                                                            <th>{{ __('Amount') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($order_details->extraSevices as $ex_service)
                                                            <tr>
                                                                <td>{{ $ex_service->title }}</td>
                                                                <td>{{ float_amount_with_currency_symbol($ex_service->price) }}</td>
                                                                <td>{{ $ex_service->quantity }}</td>
                                                                <td>{{ float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity) }}</td>
                                                                <td>
                                                                    @if($ex_service->payment_status !== 'complete' && $order_details->payment_status === 'complete')
                                                                        <a href="#" data-url="{{route('seller.order.extra.service.delete')}}" data-id="{{ $ex_service->id }}" class="btn btn-danger extra_service_delete_btn">{{__('Delete')}}</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($order_details->coupon_code))
                                    <div class="single-flex-middle mt-4">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title">{{ __('Coupon Details') }}</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('Coupon Code') }}</th>
                                                            <th>{{ __('Coupon Type') }}</th>
                                                            <th>{{ __('Coupon Amount') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $order_details->coupon_code }}</td>
                                                            <td>{{ __($order_details->coupon_type) }}</td>
                                                            <td>
                                                                @if($order_details->coupon_amount >0)
                                                                    {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-sm-12">
                                @if(!empty($order_declines_history->count() >= 1))
                                    <div class="single-flex-middle mt-4">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title">{{ __('Order Decline History') }}</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mt-3">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('History ID') }}</th>
                                                            <th>{{ __('Buyer Details') }}</th>
                                                            <th>{{ __('Status') }} ({{ __('Decline Reason') }})</th>
                                                            <th>{{ __('Image File') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($order_declines_history as $history)
                                                            <tr>
                                                                <td>{{ $history->id }}</td>
                                                                <td>
                                                                    <strong>{{ __('Name:') }}</strong> {{ optional($history->buyer)->name }}
                                                                    <br>
                                                                    <strong>{{ __('Email:') }}</strong>{{ optional($history->buyer)->email }}
                                                                    <br>
                                                                    <strong>{{ __('Phone:') }}</strong>{{ optional($history->buyer)->phone }}
                                                                    <br>
                                                                </td>
                                                                <td>
                                                                    <strong>{{ __('Decline Reason:') }}</strong>{{ $history->decline_reason }}
                                                                </td>
                                                                <td>{!! render_image_markup_by_attachment_id($history->image,'','thumb') !!}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- قسم تقرير الفني --}}
                            <div class="col-sm-12 mt-4">
                                <div class="dashboard_table__wrapper dashboard_border padding-20 radius-10 bg-white">
                                    <div class="line-top-contents mb-3">
                                        <h4 class="earning-title">{{ __('Technician Report') }}</h4>
                                    </div>

                                    @if($order_details->technician_report_submitted_at)
                                        {{-- عرض التقرير الموجود --}}
                                        <div class="alert alert-info">
                                            <strong>{{ __('Report Submitted At:') }}</strong> 
                                            {{ \Carbon\Carbon::parse($order_details->technician_report_submitted_at)->format('Y-m-d H:i:s') }}
                                        </div>
                                        
                                        @if($order_details->technician_report_confirmed_at)
                                        {{-- عرض حالة التأكيد --}}
                                        <div class="alert alert-success">
                                            <i class="ti-check"></i>
                                            <strong>{{ __('Report Confirmed By Admin:') }}</strong> 
                                            {{ \Carbon\Carbon::parse($order_details->technician_report_confirmed_at)->format('Y-m-d H:i:s') }}
                                            @if($order_details->technicianReportConfirmedBy)
                                                <br><small>{{ __('Confirmed by:') }} {{ $order_details->technicianReportConfirmedBy->name }}</small>
                                            @endif
                                            <br><small class="text-muted">{{ __('This report is locked and cannot be modified as per governance policy.') }}</small>
                                        </div>
                                        @endif

                                        @if($order_details->technician_report)
                                        <div class="mb-3">
                                            <label><strong>{{ __('Report Details:') }}</strong></label>
                                            <div class="bg-light p-3 rounded" style="white-space: pre-wrap; word-wrap: break-word;">
                                                {{ $order_details->technician_report }}
                                            </div>
                                        </div>
                                        @endif

                                        @if(!empty($order_details->technician_images) && count($order_details->technician_images) > 0)
                                        <div class="mb-3">
                                            <label><strong>{{ __('Technician Images:') }}</strong></label>
                                            <div class="row mt-2">
                                                @foreach($order_details->technician_images as $image)
                                                <div class="col-md-3 mb-3">
                                                    <a href="{{ asset($image) }}" target="_blank">
                                                        <img src="{{ asset($image) }}" 
                                                             alt="{{__('Technician Image')}}" 
                                                             class="img-thumbnail" 
                                                             style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;">
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if(!empty($order_details->technician_videos) && count($order_details->technician_videos) > 0)
                                        <div class="mb-3">
                                            <label><strong>{{ __('Technician Videos:') }}</strong></label>
                                            <div class="row mt-2">
                                                @foreach($order_details->technician_videos as $video)
                                                <div class="col-md-6 mb-3">
                                                    <video controls style="width: 100%; max-height: 400px;" class="rounded">
                                                        <source src="{{ asset($video) }}" type="video/mp4">
                                                        {{ __('Your browser does not support the video tag.') }}
                                                    </video>
                                                    <a href="{{ asset($video) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                                        <i class="ti-download"></i> {{ __('Download Video') }}
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if(!$order_details->technician_report_confirmed_at)
                                        <div class="alert alert-warning">
                                            {{ __('You can update the report by submitting a new one below.') }}
                                        </div>
                                        @else
                                        <div class="alert alert-danger">
                                            <i class="ti-lock"></i>
                                            <strong>{{ __('Report Locked:') }}</strong> 
                                            {{ __('This report has been confirmed by admin and cannot be modified or deleted. This is part of our data governance policy.') }}
                                        </div>
                                        @endif
                                    @endif

                                    {{-- نموذج إرسال/تحديث التقرير --}}
                                    @if(!$order_details->technician_report_confirmed_at)
                                    <form action="{{ route('seller.order.submit.report', $order_details->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="technician_report"><strong>{{ __('Report Details:') }}</strong> <span class="text-danger">*</span></label>
                                            <textarea name="technician_report" id="technician_report" class="form-control" rows="8" required 
                                                placeholder="{{ __('اكتب تفاصيل العطل أو الصيانة كاملة...') }}">{{ old('technician_report', $order_details->technician_report ?? '') }}</textarea>
                                            @error('technician_report')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="technician_images"><strong>{{ __('Upload Images:') }}</strong></label>
                                            <input type="file" name="technician_images[]" id="technician_images" class="form-control-file" multiple accept="image/*">
                                            <small class="form-text text-muted">{{ __('يمكنك رفع عدة صور (حد أقصى 5 ميجابايت لكل صورة)') }}</small>
                                            @error('technician_images.*')
                                                <span class="text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="technician_videos"><strong>{{ __('Upload Videos:') }}</strong></label>
                                            <input type="file" name="technician_videos[]" id="technician_videos" class="form-control-file" multiple accept="video/*">
                                            <small class="form-text text-muted">{{ __('يمكنك رفع عدة فيديوهات (حد أقصى 50 ميجابايت لكل فيديو)') }}</small>
                                            @error('technician_videos.*')
                                                <span class="text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ti-check"></i> {{ $order_details->technician_report_submitted_at ? __('Update Report') : __('Submit Technician Report') }}
                                            </button>
                                        </div>
                                    </form>
                                    @else
                                    <div class="alert alert-info">
                                        <i class="ti-info-alt"></i>
                                        {{ __('The report form is disabled because the report has been confirmed by admin.') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{--  accept extra service modal --}}
        <div class="modal fade" id="acceptExtraServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
            <form action="{{ route('buyer.order.extra.service.accept') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Accept Extra Service Request') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="comments-flex-item">
                                <input type="hidden" name="id" class="form-control form-control-sm">
                                <input type="hidden" name="order_id" class="form-control form-control-sm">
                            </div>
                            {!! \App\Helpers\PaymentGatewayRenderHelper::renderPaymentGatewayForForm(false) !!}

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Pay Now') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endsection
        @section('scripts')
            <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
            <script>
                (function($){

                    "use strict";

                    $(document).ready(function (){
                        /* Delete */
                        //seller.order.extra.service.delete
                        $(document).on('click','.extra_service_delete_btn',function (e){
                            e.preventDefault();
                            var id = $(this).data('id');
                            var url = $(this).data('url')
                            Swal.fire({
                                title: '{{__("Are you sure?")}}',
                                text: '{{__("You would not be able to revert this item!")}}',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: "{{__('Yes, Delete it!')}}"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        "type" :"POST",
                                        'url' : url,
                                        data: {
                                            _token : "{{csrf_token()}}",
                                            id: id
                                        },
                                        success: function (data){
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'warning',
                                                title: "{{__('delete success')}}",
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                            location.reload();
                                        }
                                    })
                                }
                            });

                        });

                    });


                })(jQuery);
                //extra_service_edit_btn
            </script>
@endsection