@extends('client.layouts.master')

@section('site-title')
{{__('Client Dashboard')}}
@endsection

@section('style')
<style>
    /* Responsive Styles for Dashboard */
    .main-content-inner {
        padding: 15px;
    }
    
    .card {
        margin-bottom: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .card-body {
        padding: 15px;
    }
    
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 24px;
        color: #fff;
        flex-shrink: 0;
    }
    
    .card-body h3 {
        font-size: 24px;
        font-weight: 600;
        margin: 5px 0 0 0;
    }
    
    .card-body p {
        font-size: 13px;
        margin: 0;
        color: #6c757d;
    }
    
    .data-tables {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table {
        width: 100%;
        min-width: 800px;
        margin-bottom: 0;
    }
    
    .table thead th {
        white-space: nowrap;
        font-size: 13px;
        font-weight: 600;
        padding: 12px 8px;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table tbody td {
        padding: 12px 8px;
        font-size: 13px;
        vertical-align: middle;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        white-space: nowrap;
    }
    
    .badge {
        font-size: 11px;
        padding: 4px 8px;
        white-space: nowrap;
    }
    
    @media (max-width: 768px) {
        .main-content-inner {
            padding: 10px;
        }
        
        .card-body {
            padding: 12px;
        }
        
        .icon-box {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
        
        .card-body h3 {
            font-size: 20px;
        }
        
        .card-body p {
            font-size: 12px;
        }
        
        .header-title {
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .table {
            font-size: 12px;
        }
        
        .table thead th {
            padding: 8px 6px;
            font-size: 11px;
        }
        
        .table tbody td {
            padding: 8px 6px;
            font-size: 11px;
        }
        
        .btn-sm {
            padding: 4px 8px;
            font-size: 11px;
        }
        
        .btn-primary {
            width: 100%;
            margin-top: 10px;
        }
    }
    
    @media (max-width: 576px) {
        .main-content-inner {
            padding: 8px;
        }
        
        .card-body {
            padding: 10px;
        }
        
        .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }
        
        .icon-box {
            align-self: flex-end;
            width: 35px;
            height: 35px;
            font-size: 18px;
        }
        
        .card-body h3 {
            font-size: 18px;
        }
        
        .table {
            min-width: 600px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 6px 4px;
            font-size: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-xl-3 col-lg-6 col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0">{{__('Total Orders')}}</p>
                            <h3 class="mt-2">{{ $stats['total'] }}</h3>
                        </div>
                        <div class="icon-box bg-primary">
                            <i class="ti-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0">{{__('Pending Orders')}}</p>
                            <h3 class="mt-2 text-warning">{{ $stats['pending'] }}</h3>
                        </div>
                        <div class="icon-box bg-warning">
                            <i class="ti-time"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0">{{__('Active Orders')}}</p>
                            <h3 class="mt-2 text-info">{{ $stats['active'] }}</h3>
                        </div>
                        <div class="icon-box bg-info">
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0">{{__('Completed Orders')}}</p>
                            <h3 class="mt-2 text-success">{{ $stats['completed'] }}</h3>
                        </div>
                        <div class="icon-box bg-success">
                            <i class="ti-check-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Recent Orders')}}</h4>
                    <div class="data-tables datatable-primary">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Tracking Code')}}</th>
                                    <th>{{__('Service')}}</th>
                                    <th>{{__('Technician')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td><strong>{{ $order->tracking_code ?? 'N/A' }}</strong></td>
                                    <td>{{ $order->service->title ?? 'N/A' }}</td>
                                    <td>{{ $order->technician->name ?? __('Not Assigned') }}</td>
                                    <td>
                                        @if($order->status == 0)
                                            <span class="badge badge-warning">{{__('Pending')}}</span>
                                        @elseif($order->status == 1)
                                            <span class="badge badge-info">{{__('Active')}}</span>
                                        @elseif($order->status == 2)
                                            <span class="badge badge-success">{{__('Completed')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ amount_with_currency_symbol($order->total) }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('client.track', $order->tracking_code) }}" class="btn btn-primary btn-sm">
                                            <i class="ti-eye"></i> {{__('View')}}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">{{__('No orders found')}}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($recentOrders->count() >= 5)
                        <div class="mt-3 text-center">
                            <a href="{{ route('client.orders') }}" class="btn btn-primary">{{__('View All Orders')}}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

