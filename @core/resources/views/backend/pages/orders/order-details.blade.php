@extends('backend.admin-master')
@section('site-title')
    {{__('Order Details')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        @if(!empty($order_details))
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <label><strong>{{ __('Order ID:') }} </strong>#{{ $order_details->id }}</label> <br>
                                <label><strong>{{ __('Invoice No:') }} </strong>{{ $order_details->invoice }}</label>
                                @if($order_details->tracking_code)
                                <br><label><strong>{{ __('Tracking Code:') }} </strong>{{ $order_details->tracking_code }}</label>
                                @endif
                                @if($order_details->invoice_number)
                                <br><label><strong>{{ __('Invoice Number:') }} </strong>{{ $order_details->invoice_number }}</label>
                                @endif
                            </div>
                            
                            @if($order_details->status >= 2)
                            <div class="mt-3">
                                @if($order_details->hasInvoice())
                                <a href="{{ route('admin.orders.invoice.view', $order_details->id) }}" target="_blank" class="btn btn-success btn-sm mr-2">
                                    <i class="ti-file"></i> {{__('View Invoice')}}
                                </a>
                                <a href="{{ route('admin.orders.invoice.download', $order_details->id) }}" class="btn btn-outline-success btn-sm mr-2">
                                    <i class="ti-download"></i> {{__('Download Invoice')}}
                                </a>
                                @else
                                <a href="{{ route('admin.orders.invoice', $order_details->id) }}" class="btn btn-success btn-sm mr-2">
                                    <i class="ti-file"></i> {{__('Generate Invoice')}}
                                </a>
                                @endif

                                @if($order_details->hasWarranty())
                                <a href="{{ route('admin.orders.warranty.view', $order_details->id) }}" target="_blank" class="btn btn-info btn-sm mr-2">
                                    <i class="ti-shield"></i> {{__('View Warranty')}}
                                </a>
                                <a href="{{ route('admin.orders.warranty.download', $order_details->id) }}" class="btn btn-outline-info btn-sm mr-2">
                                    <i class="ti-download"></i> {{__('Download Warranty')}}
                                </a>
                                @else
                                <a href="{{ route('admin.orders.warranty', $order_details->id) }}" class="btn btn-info btn-sm mr-2">
                                    <i class="ti-shield"></i> {{__('Generate Warranty')}}
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Seller Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Name:') }} </strong>{{ optional($order_details->seller)->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ optional($order_details->seller)->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ optional($order_details->seller)->phone }}</label>
                                </div>
                                @if($order_details->is_order_online !=1)
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ optional($order_details->seller)->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional(optional($order_details->seller)->city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional(optional($order_details->seller)->area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ optional($order_details->seller)->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional(optional($order_details->seller)->country)->country }}</label>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>   
                </div>
                @if($order_details->order_from_job != 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5>{{ __('Service Details') }}</h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Title:') }} </strong>{{ optional($order_details->service)->title }}</label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        {!! render_image_markup_by_attachment_id(optional($order_details->service)->image,'','thumb') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if($order_details->order_from_job == 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5>{{ __('Job Details') }}</h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Title:') }} </strong>{{ optional($order_details->job)->title }}</label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        {!! render_image_markup_by_attachment_id(optional($order_details->job)->image,'','thumb') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Buyer Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Name:') }} </strong>{{ $order_details->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ $order_details->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ $order_details->phone }}</label>
                                </div>
                                @if($order_details->is_order_online !=1)
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ $order_details->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional($order_details->service_city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional($order_details->service_area)->service_area }}</label>
                                </div>
                                @if($order_details->region)
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Region:') }} </strong>{{ $order_details->region->name }}</label>
                                </div>
                                @endif
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ $order_details->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional($order_details->service_country)->country }}</label>
                                </div>
                               @endif
                               
                               @if($order_details->technician)
                               <!-- Premium Technician Card -->
                               <div class="technician-card-wrapper mt-4 mb-4">
                                   <div class="technician-premium-card">
                                       <!-- Card Header with Logo -->
                                       <div class="technician-card-header">
                                           <div class="technician-card-logo">
                                               {!! render_image_markup_by_attachment_id(get_static_option('site_logo'), 'logo') !!}
                                           </div>
                                           <div class="technician-card-title">
                                               <h4 class="mb-0">{{ __('Assigned Technician') }}</h4>
                                               <p class="text-muted mb-0" style="font-size: 12px;">{{ __('Technician Information') }}</p>
                                           </div>
                                       </div>
                                       
                                       <!-- Verification Badge -->
                                       @if($order_details->technician->verified_by_national_id)
                                       <div class="technician-verified-badge">
                                           <i class="las la-check-circle"></i>
                                           <span>{{ __('Verified by National ID') }}</span>
                                       </div>
                                       @endif
                                       
                                       <!-- Card Body -->
                                       <div class="technician-card-body">
                                           <div class="technician-info-grid">
                                               <!-- Name -->
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-user"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Name') }}</label>
                                                       <p>{{ $order_details->technician->name }}</p>
                                                   </div>
                                               </div>
                                               
                                               <!-- Employee Number -->
                                               @if($order_details->technician->employee_number)
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-id-card"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Employee Number') }}</label>
                                                       <p>{{ $order_details->technician->employee_number }}</p>
                                                   </div>
                                               </div>
                                               @endif
                                               
                                               <!-- Job Type -->
                                               @if($order_details->technician->job_type)
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-briefcase"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Job Type') }}</label>
                                                       <p>{{ $order_details->technician->job_type }}</p>
                                                   </div>
                                               </div>
                                               @endif
                                               
                                               <!-- Phone -->
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-phone"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Phone') }}</label>
                                                       <p>
                                                           <a href="tel:{{ $order_details->technician->phone }}" style="color: inherit; text-decoration: none;">
                                                               {{ $order_details->technician->phone ?? __('N/A') }}
                                                           </a>
                                                       </p>
                                                   </div>
                                               </div>
                                               
                                               <!-- Email -->
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-envelope"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Email') }}</label>
                                                       <p>
                                                           <a href="mailto:{{ $order_details->technician->email }}" style="color: inherit; text-decoration: none;">
                                                               {{ $order_details->technician->email ?? __('N/A') }}
                                                           </a>
                                                       </p>
                                                   </div>
                                               </div>
                                               
                                               <!-- Assigned At -->
                                               @if($order_details->assigned_at)
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-calendar-check"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Assigned At') }}</label>
                                                       <p>{{ $order_details->assigned_at->format('Y-m-d H:i:s') }}</p>
                                                   </div>
                                               </div>
                                               @endif
                                               
                                               <!-- Assigned By -->
                                               @if($order_details->assignedBy)
                                               <div class="technician-info-item">
                                                   <div class="technician-info-icon">
                                                       <i class="las la-user-tie"></i>
                                                   </div>
                                                   <div class="technician-info-content">
                                                       <label>{{ __('Assigned By') }}</label>
                                                       <p>{{ $order_details->assignedBy->name }}</p>
                                                   </div>
                                               </div>
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               @endif
                               
                               @if($order_details->urgency_level)
                               <div class="checkbox-inlines mt-3">
                                   <label><strong>{{ __('Urgency Level:') }} </strong>
                                       <span class="badge badge-{{ $order_details->urgency_level == 'emergency' ? 'danger' : ($order_details->urgency_level == 'urgent' ? 'warning' : 'info') }}">
                                           {{ __(ucfirst($order_details->urgency_level)) }}
                                       </span>
                                   </label>
                               </div>
                               @endif
                               
                               @if($order_details->warranty_code)
                               <div class="border-bottom mb-3 mt-4">
                                   <h5>{{ __('Warranty Information') }}</h5>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong>{{ __('Warranty Code:') }} </strong>{{ $order_details->warranty_code }}</label>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong>{{ __('Warranty Days:') }} </strong>{{ $order_details->warranty_days ?? 30 }} {{ __('Days') }}</label>
                               </div>
                               @if($order_details->warranty_issued_at)
                               <div class="checkbox-inlines">
                                   <label><strong>{{ __('Warranty Issued At:') }} </strong>{{ $order_details->warranty_issued_at->format('Y-m-d H:i:s') }}</label>
                               </div>
                               @endif
                               @endif
                            </div>

                            @if(!empty($order_details->issue_images) && count($order_details->issue_images) > 0)
                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Issue Images') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="row">
                                    @foreach($order_details->issue_images as $image)
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ asset($image) }}" target="_blank">
                                            <img src="{{ asset($image) }}" 
                                                 alt="{{__('Issue Image')}}" 
                                                 class="img-thumbnail" 
                                                 style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @elseif($order_details->issue_image)
                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Issue Image') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <a href="{{ asset($order_details->issue_image) }}" target="_blank" class="d-inline-block">
                                        <img src="{{ asset($order_details->issue_image) }}" 
                                             alt="{{__('Issue Image')}}" 
                                             class="img-thumbnail" 
                                             style="max-width: 300px; max-height: 300px; cursor: pointer;">
                                    </a>
                                    <p class="text-muted mt-2">
                                        <small><i class="ti-image"></i> {{__('Click to view full size')}}</small>
                                    </p>
                                </div>
                            </div>
                            @endif

                            @if($order_details->order_note)
                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Order Notes') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <p class="bg-light p-3 rounded">{{ $order_details->order_note }}</p>
                                </div>
                            </div>
                            @endif

                            @if($order_details->is_order_online !=1)
                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Date & Schedule') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Date:') }} </strong>
                                        @if($order_details->date)
                                            @php
                                                try {
                                                    $date = \Carbon\Carbon::parse($order_details->date);
                                                    \Carbon\Carbon::setLocale('ar');
                                                    echo $date->translatedFormat('l d F Y');
                                                } catch (\Exception $e) {
                                                    // If parsing fails, try to translate common English month names
                                                    $dateStr = $order_details->date;
                                                    $dateStr = str_replace(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], 
                                                        ['الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'], $dateStr);
                                                    $dateStr = str_replace(['January', 'February', 'March', 'April', 'May', 'June', 
                                                        'July', 'August', 'September', 'October', 'November', 'December'],
                                                        ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 
                                                        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'], $dateStr);
                                                    echo $dateStr;
                                                }
                                            @endphp
                                        @else
                                            {{ __('N/A') }}
                                        @endif
                                    </label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Schedule:') }} </strong>
                                        @if($order_details->schedule)
                                            @php
                                                try {
                                                    $time = \Carbon\Carbon::parse($order_details->schedule);
                                                    \Carbon\Carbon::setLocale('ar');
                                                    $formatted = $time->translatedFormat('g:i A');
                                                    // Translate AM/PM
                                                    $formatted = str_replace(['AM', 'PM'], ['ص', 'م'], $formatted);
                                                    echo $formatted;
                                                } catch (\Exception $e) {
                                                    // If parsing fails, try to translate common time formats
                                                    $timeStr = $order_details->schedule;
                                                    $timeStr = str_replace(['am', 'pm', 'AM', 'PM'], ['ص', 'م', 'ص', 'م'], $timeStr);
                                                    echo $timeStr;
                                                }
                                            @endphp
                                        @else
                                            {{ __('N/A') }}
                                        @endif
                                    </label>
                                </div>
                            </div>
                            @endif

                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Amount Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Package Fee:') }} </strong>{{ float_amount_with_currency_symbol($order_details->package_fee) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Extra Service:') }} </strong>{{ float_amount_with_currency_symbol($order_details->extra_service) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Sub Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->sub_total) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Tax:') }} </strong>{{ float_amount_with_currency_symbol($order_details->tax) }}</label>
                                </div>
                                @if(!empty($order_details->coupon_amount))
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Coupon Amount:') }} </strong>{{ float_amount_with_currency_symbol($order_details->coupon_amount) }}</label>
                                </div>
                                @endif
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->total) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Admin Commission:') }} </strong>{{ float_amount_with_currency_symbol($order_details->commission_amount) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Gateway:') }} </strong><b class="text-success">{{ __(ucwords(str_replace("_", " ", $order_details->payment_gateway))) }}</b></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Status:') }} </strong>{{ __(ucfirst($order_details->payment_status)) }}</label>
                                    <span>
                                        @if($order_details->payment_status=='pending') 
                                        <span><x-status-change :url="route('admin.order.change.status',$order_details->id)"/></span>
                                        @endif
                                    </span>
                                </div>
                                @if($order_details->payment_gateway=='manual_payment')
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Manual Payment Attachment:') }} </strong></label>
                                    <img src="{{ asset('assets/uploads/manual-payment/'.$order_details->manual_payment_image) }}" alt="">
                                </div>
                                @endif
                            </div>

                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Order Status') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Order Status:') }}</strong>
                                        @if ($order_details->status == 0) <span>{{ __('Pending') }}</span>@endif
                                        @if ($order_details->status == 1) <span>{{ __('Active') }}</span>@endif
                                        @if ($order_details->status == 2) <span>{{ __('Completed') }}</span>@endif
                                        @if ($order_details->status == 3) <span>{{ __('Delivered') }}</span>@endif
                                        @if ($order_details->status == 4) <span>{{ __('Cancelled') }}</span>@endif
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                </div>
                @if($order_details->order_from_job != 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <h5>{{ __('Include Details:')}}</h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            @if($order_details->is_order_online !=1)
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
                                            <td>{{ float_amount_with_currency_symbol($include->price * $include->quantity) }}</td>
                                            @php $package_fee += $include->price * $include->quantity @endphp
                                            @endif
                                        </tr>
                                        @endforeach
                                        <tr>
                                            @if($order_details->is_order_online !=1)
                                                <td><strong>{{ __('Package Fee') }}</strong></td>
                                                <td><strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong></td>
                                            @else
                                                <td colspan="3"><strong>{{ __('Package Fee') .float_amount_with_currency_symbol($order_details->package_fee)}}</strong></td>
                                            @endif

                                        </tr>
                                    </tbody>
                                </table>

                                @if($order_additionals->count() >= 1)
                                <h5>{{ __('Additional Services:')}}</h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $extra_service =0; @endphp
                                        @foreach($order_additionals as $additional)
                                        <tr>
                                            <td>{{ $additional->title }}</td>
                                            <td>{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                                            @php $extra_service += $additional->price * $additional->quantity @endphp
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong>{{ __('Extra Service') }}</strong></td>
                                            <td><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif


                                @if(optional($order_details->extraSevices)->count() >= 1)
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Extra Service Details') }}</h5>
                                                </div>
                                                <span class="info-text d-block mb-4">{{__('This is not included in the main service order calculation')}}</span>

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Amount') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order_details->extraSevices as $ex_service)
                                                        <tr>
                                                            <td>{{ $ex_service->title }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity) }}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($order_details->coupon_code))
                                <h5>{{ __('Coupon Details:')}}</h5> <br>
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
                                            <td>{{ $order_details->coupon_type }}</td>
                                            <td>
                                                @if(!empty($order_details->coupon_amount))
                                                {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif

                {{-- قسم تقرير الفني والتسعير --}}
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mb-3">
                                <h5>{{ __('Technician Report') }}</h5>
                            </div>

                            @if($order_details->technician_report_submitted_at)
                                {{-- عرض التقرير الموجود --}}
                                <div class="alert alert-info">
                                    <strong>{{ __('Report Submitted At:') }}</strong> 
                                    {{ \Carbon\Carbon::parse($order_details->technician_report_submitted_at)->format('Y-m-d H:i:s') }}
                                </div>

                                @if($order_details->technician_report)
                                <div class="mb-3">
                                    <label><strong>{{ __('Report Details:') }}</strong></label>
                                    <div class="bg-light p-3 rounded" style="white-space: pre-wrap; word-wrap: break-word; min-height: 100px;">
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

                                {{-- قسم تأكيد التقرير من الأدمن --}}
                                @if($order_details->technician_report_submitted_at && !$order_details->technician_report_confirmed_at)
                                <div class="border-top pt-4 mt-4">
                                    <h5 class="mb-3">{{ __('Confirm Technician Report') }}</h5>
                                    <div class="alert alert-warning">
                                        <i class="ti-info-alt"></i>
                                        <strong>{{ __('Report Pending Confirmation:') }}</strong> 
                                        {{ __('The technician has submitted a report. Please review and confirm it. Once confirmed, the technician will not be able to modify or delete it.') }}
                                    </div>
                                    <form action="{{ route('admin.orders.confirm.report', $order_details->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to confirm this report? Once confirmed, the technician will not be able to modify it.') }}');">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="ti-check"></i> {{ __('Confirm Report') }}
                                        </button>
                                    </form>
                                </div>
                                @elseif($order_details->technician_report_confirmed_at)
                                <div class="border-top pt-4 mt-4">
                                    <div class="alert alert-success">
                                        <i class="ti-check"></i>
                                        <strong>{{ __('Report Confirmed:') }}</strong> 
                                        {{ \Carbon\Carbon::parse($order_details->technician_report_confirmed_at)->format('Y-m-d H:i:s') }}
                                        @if($order_details->technicianReportConfirmedBy)
                                            <br><small>{{ __('Confirmed by:') }} {{ $order_details->technicianReportConfirmedBy->name }}</small>
                                        @endif
                                        <br><small class="text-muted">{{ __('This report is locked and cannot be modified by the technician as per governance policy.') }}</small>
                                    </div>
                                </div>
                                @endif

                                {{-- قسم التسعير --}}
                                <div class="border-top pt-4 mt-4">
                                    <h5 class="mb-3">{{ __('Admin Pricing') }}</h5>
                                    
                                    @if($order_details->admin_pricing)
                                        <div class="alert alert-success">
                                            <strong>{{ __('Service Price:') }}</strong> 
                                            {{ float_amount_with_currency_symbol($order_details->admin_pricing) }}
                                            @if($order_details->admin_pricing_at)
                                                <br><small>{{ __('Priced At:') }} {{ \Carbon\Carbon::parse($order_details->admin_pricing_at)->format('Y-m-d H:i:s') }}</small>
                                            @endif
                                            @if($order_details->adminPricingBy)
                                                <br><small>{{ __('Priced By:') }} {{ $order_details->adminPricingBy->name }}</small>
                                            @endif
                                        </div>
                                        @if($order_details->admin_pricing_notes)
                                        <div class="mb-3">
                                            <label><strong>{{ __('Pricing Notes:') }}</strong></label>
                                            <div class="bg-light p-3 rounded">
                                                {{ $order_details->admin_pricing_notes }}
                                            </div>
                                        </div>
                                        @endif
                                    @endif

                                    {{-- نموذج التسعير --}}
                                    <form action="{{ route('admin.orders.set.pricing', $order_details->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="admin_pricing"><strong>{{ __('Service Price:') }}</strong> <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   name="admin_pricing" 
                                                   id="admin_pricing" 
                                                   class="form-control" 
                                                   step="0.01" 
                                                   min="0" 
                                                   value="{{ old('admin_pricing', $order_details->admin_pricing ?? '') }}" 
                                                   required>
                                            @error('admin_pricing')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="admin_pricing_notes"><strong>{{ __('Pricing Notes:') }}</strong></label>
                                            <textarea name="admin_pricing_notes" 
                                                      id="admin_pricing_notes" 
                                                      class="form-control" 
                                                      rows="3" 
                                                      placeholder="{{ __('أضف ملاحظات حول التسعير (اختياري)') }}">{{ old('admin_pricing_notes', $order_details->admin_pricing_notes ?? '') }}</textarea>
                                            @error('admin_pricing_notes')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">
                                                <i class="ti-money"></i> {{ $order_details->admin_pricing ? __('Update Pricing') : __('Set Service Price') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    {{ __('No technician report submitted yet.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="justify-content-end mt-4">
                <span class="header-title">{{ __('Order not found') }}</span>
            </div>
        @endif
    </div>
@endsection

@section('script')
 <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                    });
                });
                
              });
        })(jQuery);
    </script>
@endsection

@push('style')
<style>
/* Premium Technician Card Styles for Admin Panel */
.technician-card-wrapper {
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
}

.technician-premium-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid rgba(255, 215, 0, 0.2);
    position: relative;
    transition: all 0.3s ease;
}

.technician-premium-card:hover {
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.technician-card-header {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    padding: 25px 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    overflow: hidden;
}

.technician-card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.technician-card-logo {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    backdrop-filter: blur(10px);
    flex-shrink: 0;
}

.technician-card-logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.technician-card-title {
    flex: 1;
    color: #1a1a1a;
    z-index: 1;
}

.technician-card-title h4 {
    color: #1a1a1a;
    font-weight: 700;
    font-size: 22px;
    margin-bottom: 5px;
}

.technician-verified-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: rgba(40, 167, 69, 0.95);
    color: white;
    padding: 8px 15px;
    border-radius: 25px;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    z-index: 10;
    animation: pulse 2s infinite;
}

.technician-verified-badge i {
    font-size: 16px;
}

@keyframes pulse {
    0%, 100% {
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    50% {
        box-shadow: 0 4px 20px rgba(40, 167, 69, 0.5);
    }
}

.technician-card-body {
    padding: 30px;
}

.technician-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.technician-info-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.technician-info-item:hover {
    background: rgba(255, 215, 0, 0.1);
    border-color: rgba(255, 215, 0, 0.3);
    transform: translateX(5px);
}

.technician-info-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1a1a1a;
    font-size: 20px;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
}

.technician-info-content {
    flex: 1;
}

.technician-info-content label {
    display: block;
    font-size: 12px;
    color: #666;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}

.technician-info-content p {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    word-break: break-word;
}

.technician-info-content a {
    color: #1a1a1a;
    text-decoration: none;
    transition: color 0.3s;
}

.technician-info-content a:hover {
    color: #FFD700;
}

@media (max-width: 768px) {
    .technician-card-header {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
    
    .technician-card-logo {
        margin: 0 auto;
    }
    
    .technician-info-grid {
        grid-template-columns: 1fr;
    }
    
    .technician-verified-badge {
        position: relative;
        top: 0;
        left: 0;
        margin-bottom: 15px;
        display: inline-flex;
    }
}
</style>
@endpush

