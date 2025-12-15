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

            <!-- Technician Information - Premium Card Design -->
            @if($order->technician)
            <div class="technician-card-wrapper mt-4">
                <div class="technician-premium-card">
                    <!-- Card Header with Logo -->
                    <div class="technician-card-header">
                        <div class="technician-card-logo">
                            {!! render_image_markup_by_attachment_id(get_static_option('site_logo'), 'logo') !!}
                        </div>
                        <div class="technician-card-title">
                            <h4 class="mb-0">{{__('Assigned Technician')}}</h4>
                            <p class="text-muted mb-0" style="font-size: 12px;">{{__('Technician Information')}}</p>
                        </div>
                    </div>
                    
                    <!-- Verification Badge -->
                    @if($order->technician->verified_by_national_id)
                    <div class="technician-verified-badge">
                        <i class="las la-check-circle"></i>
                        <span>{{__('Verified by National ID')}}</span>
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
                                    <label>{{__('Name')}}</label>
                                    <p>{{ $order->technician->name }}</p>
                                </div>
                            </div>
                            
                            <!-- Employee Number -->
                            @if($order->technician->employee_number)
                            <div class="technician-info-item">
                                <div class="technician-info-icon">
                                    <i class="las la-id-card"></i>
                                </div>
                                <div class="technician-info-content">
                                    <label>{{__('Employee Number')}}</label>
                                    <p>{{ $order->technician->employee_number }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Job Type -->
                            @if($order->technician->job_type)
                            <div class="technician-info-item">
                                <div class="technician-info-icon">
                                    <i class="las la-briefcase"></i>
                                </div>
                                <div class="technician-info-content">
                                    <label>{{__('Job Type')}}</label>
                                    <p>{{ $order->technician->job_type }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Phone -->
                            <div class="technician-info-item">
                                <div class="technician-info-icon">
                                    <i class="las la-phone"></i>
                                </div>
                                <div class="technician-info-content">
                                    <label>{{__('Phone')}}</label>
                                    <p>
                                        <a href="tel:{{ $order->technician->phone }}" style="color: inherit; text-decoration: none;">
                                            {{ $order->technician->phone ?? __('N/A') }}
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
                                    <label>{{__('Email')}}</label>
                                    <p>
                                        <a href="mailto:{{ $order->technician->email }}" style="color: inherit; text-decoration: none;">
                                            {{ $order->technician->email }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Assigned At -->
                            @if($order->assigned_at)
                            <div class="technician-info-item">
                                <div class="technician-info-icon">
                                    <i class="las la-calendar-check"></i>
                                </div>
                                <div class="technician-info-content">
                                    <label>{{__('Assigned At')}}</label>
                                    <p>{{ $order->assigned_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Premium Technician Card Styles */
.technician-card-wrapper {
    margin-top: 1.5rem;
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
@endsection

