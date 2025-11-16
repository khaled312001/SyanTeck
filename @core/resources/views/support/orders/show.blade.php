@extends('support.layouts.master')

@section('site-title')
{{__('Order Details')}} #{{ $order->id }}
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-8">
            <!-- Order Information -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Order Information')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{__('Tracking Code')}}:</strong> {{ $order->tracking_code ?? __('N/A') }}</p>
                            <p><strong>{{__('Service')}}:</strong> {{ $order->service->title ?? __('N/A') }}</p>
                            <p><strong>{{__('Status')}}:</strong>
                                @if($order->status == 0)
                                    <span class="badge badge-warning">{{__('Pending')}}</span>
                                @elseif($order->status == 1)
                                    <span class="badge badge-info">{{__('Active')}}</span>
                                @elseif($order->status == 2)
                                    <span class="badge badge-success">{{__('Completed')}}</span>
                                @elseif($order->status == 4)
                                    <span class="badge badge-danger">{{__('Cancelled')}}</span>
                                @endif
                            </p>
                            <p><strong>{{__('Urgency')}}:</strong> {{ ucfirst($order->urgency_level ?? 'normal') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{__('Total')}}:</strong> {{ amount_with_currency_symbol($order->total) }}</p>
                            <p><strong>{{__('Created At')}}:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                            @if($order->preferred_date)
                            <p><strong>{{__('Preferred Date')}}:</strong> {{ $order->preferred_date }}</p>
                            @endif
                        </div>
                    </div>

                    @if($order->order_note)
                    <div class="mt-3">
                        <strong>{{__('Order Notes')}}:</strong>
                        <p class="bg-light p-3 rounded">{{ $order->order_note }}</p>
                    </div>
                    @endif

                    <!-- Display Issue Images -->
                    @if(!empty($order->issue_images) && count($order->issue_images) > 0)
                    <div class="mt-3">
                        <strong>{{__('Issue Images')}}:</strong>
                        <div class="row mt-2">
                            @foreach($order->issue_images as $image)
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
                    @elseif($order->issue_image)
                    <div class="mt-3">
                        <strong>{{__('Issue Image')}}:</strong>
                        <div class="mt-2">
                            <a href="{{ asset($order->issue_image) }}" target="_blank" class="d-inline-block">
                                <img src="{{ asset($order->issue_image) }}" 
                                     alt="{{__('Issue Image')}}" 
                                     class="img-thumbnail" 
                                     style="max-width: 400px; max-height: 400px; cursor: pointer;">
                            </a>
                            <p class="text-muted mt-2">
                                <small><i class="ti-image"></i> {{__('Click to view full size')}}</small>
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Client Information -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="header-title">{{__('Client Information')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{__('Name')}}:</strong> {{ $order->name }}</p>
                            <p><strong>{{__('Phone')}}:</strong> {{ $order->phone }}</p>
                            <p><strong>{{__('Email')}}:</strong> {{ $order->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{__('Address')}}:</strong> {{ $order->address }}</p>
                            <p><strong>{{__('Region')}}:</strong> {{ $order->region->name ?? __('N/A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            @if($order->notes)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="header-title">{{__('Order Notes')}}</h4>
                    <div class="bg-light p-3 rounded" style="white-space: pre-line;">{{ $order->notes }}</div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Actions')}}</h4>

                    <!-- Assign Technician -->
                    <form method="POST" action="{{ route('support.orders.assign', $order->id) }}" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Assign Technician')}}</label>
                            <select name="technician_id" class="form-control" required>
                                <option value="">{{__('Select Technician')}}</option>
                                @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}" {{ $order->seller_id == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">{{__('Assign')}}</button>
                    </form>

                    <form method="POST" action="{{ route('support.orders.auto.assign', $order->id) }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-info btn-block" onclick="return confirm('{{__('Are you sure you want to auto-assign a technician?')}}')">
                            <i class="ti-magic"></i> {{__('Auto Assign')}}
                        </button>
                    </form>

                    <!-- Update Status -->
                    <form method="POST" action="{{ route('support.orders.update.status', $order->id) }}" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Update Status')}}</label>
                            <select name="status" class="form-control" required>
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>{{__('Pending')}}</option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>{{__('Active')}}</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>{{__('Completed')}}</option>
                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>{{__('Cancelled')}}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">{{__('Update Status')}}</button>
                    </form>

                    <!-- Update Region -->
                    <form method="POST" action="{{ route('support.orders.update.region', $order->id) }}" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Update Region')}}</label>
                            <select name="region_id" class="form-control">
                                <option value="">{{__('Select Region')}}</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ $order->region_id == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-block">{{__('Update Region')}}</button>
                    </form>

                    <!-- Add Note -->
                    <form method="POST" action="{{ route('support.orders.add.note', $order->id) }}" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Add Note')}}</label>
                            <textarea name="note" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">{{__('Add Note')}}</button>
                    </form>

                    @if($order->status >= 2)
                    <!-- Invoice & Warranty -->
                    <div class="mt-3 pt-3 border-top">
                        <h5 class="mb-3">{{__('Documents')}}</h5>
                        
                        @if($order->hasInvoice())
                        <a href="{{ route('support.orders.invoice.view', $order->id) }}" target="_blank" class="btn btn-success btn-block mb-2">
                            <i class="ti-file"></i> {{__('View Invoice')}}
                        </a>
                        <a href="{{ route('support.orders.invoice.download', $order->id) }}" class="btn btn-outline-success btn-block mb-2">
                            <i class="ti-download"></i> {{__('Download Invoice')}}
                        </a>
                        @else
                        <a href="{{ route('support.orders.invoice', $order->id) }}" class="btn btn-success btn-block mb-2">
                            <i class="ti-file"></i> {{__('Generate Invoice')}}
                        </a>
                        @endif

                        @if($order->hasWarranty())
                        <a href="{{ route('support.orders.warranty.view', $order->id) }}" target="_blank" class="btn btn-info btn-block mb-2">
                            <i class="ti-shield"></i> {{__('View Warranty')}}
                        </a>
                        <a href="{{ route('support.orders.warranty.download', $order->id) }}" class="btn btn-outline-info btn-block mb-2">
                            <i class="ti-download"></i> {{__('Download Warranty')}}
                        </a>
                        @else
                        <a href="{{ route('support.orders.warranty', $order->id) }}" class="btn btn-info btn-block mb-2">
                            <i class="ti-shield"></i> {{__('Generate Warranty')}}
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <!-- Technician Information -->
            @if($order->technician)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="header-title">{{__('Assigned Technician')}}</h4>
                    <p><strong>{{__('Name')}}:</strong> {{ $order->technician->name }}</p>
                    <p><strong>{{__('Phone')}}:</strong> {{ $order->technician->phone ?? __('N/A') }}</p>
                    <p><strong>{{__('Email')}}:</strong> {{ $order->technician->email }}</p>
                    @if($order->assigned_at)
                    <p><strong>{{__('Assigned At')}}:</strong> {{ $order->assigned_at->format('Y-m-d H:i:s') }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

