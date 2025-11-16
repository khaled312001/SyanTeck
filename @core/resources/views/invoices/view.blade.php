@if(Auth::guard('admin')->check())
    @extends('backend.admin-master')
@else
    @extends('support.layouts.master')
@endif

@section('site-title')
{{__('Invoice')}} - {{ $order->invoice_number }}
@endsection

@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="header-title">{{__('Invoice')}} - {{ $order->invoice_number }}</h4>
                        <div>
                            @if(Auth::guard('admin')->check())
                                <a href="{{ route('admin.orders.invoice.download', $order->id) }}" class="btn btn-success">
                                    <i class="ti-download"></i> {{__('Download PDF')}}
                                </a>
                                <a href="{{ route('admin.orders.details', $order->id) }}" class="btn btn-secondary">
                                    <i class="ti-arrow-right"></i> {{__('Back to Order')}}
                                </a>
                            @else
                                <a href="{{ route('support.orders.invoice.download', $order->id) }}" class="btn btn-success">
                                    <i class="ti-download"></i> {{__('Download PDF')}}
                                </a>
                                <a href="{{ route('support.orders.show', $order->id) }}" class="btn btn-secondary">
                                    <i class="ti-arrow-right"></i> {{__('Back to Order')}}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="invoice-preview" style="background: #fff; padding: 30px; border: 1px solid #ddd; border-radius: 8px;">
                        <iframe src="{{ Auth::guard('admin')->check() ? route('admin.orders.invoice.download', $order->id) : route('support.orders.invoice.download', $order->id) }}" 
                                style="width: 100%; height: 800px; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
