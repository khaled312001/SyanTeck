@extends('client.layouts.master')

@section('site-title')
{{__('My Orders')}}
@endsection

@section('style')
<style>
    .orders-table-wrapper {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .table-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .table-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }
    
    .filter-section {
        padding: 20px 30px;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    
    .orders-table {
        margin: 0;
    }
    
    .orders-table thead {
        background: #f8f9fa;
    }
    
    .orders-table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
        padding: 15px;
        white-space: nowrap;
    }
    
    .orders-table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-active {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .status-completed {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #dee2e6;
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        color: #6c757d;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #adb5bd;
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12">
            <div class="orders-table-wrapper">
                <div class="table-header">
                    <h3><i class="ti-shopping-cart"></i> {{__('My Orders')}}</h3>
                    <a href="{{route('client.orders.create')}}" class="btn btn-light">
                        <i class="ti-plus"></i> {{__('New Request')}}
                    </a>
                </div>
                
                @if($orders->count() > 0)
                <div class="filter-section">
                    <form method="GET" action="{{route('client.orders')}}" class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">{{__('Filter by Status')}}</label>
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="">{{__('All Orders')}}</option>
                                <option value="0" {{request('status') == '0' ? 'selected' : ''}}>{{__('Pending')}}</option>
                                <option value="1" {{request('status') == '1' ? 'selected' : ''}}>{{__('Active')}}</option>
                                <option value="2" {{request('status') == '2' ? 'selected' : ''}}>{{__('Completed')}}</option>
                                <option value="3" {{request('status') == '3' ? 'selected' : ''}}>{{__('Cancelled')}}</option>
                            </select>
                        </div>
                        <div class="col-md-8 text-right">
                            <span class="text-muted">{{__('Total')}}: {{$orders->total()}} {{__('orders')}}</span>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table orders-table">
                        <thead>
                            <tr>
                                <th>{{__('Tracking Code')}}</th>
                                <th>{{__('Service')}}</th>
                                <th>{{__('Technician')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Total')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <strong class="text-primary">{{$order->tracking_code}}</strong>
                                </td>
                                <td>
                                    {{$order->service->title ?? __('N/A')}}
                                </td>
                                <td>
                                    {{$order->technician->name ?? __('Not Assigned')}}
                                </td>
                                <td>
                                    {{$order->created_at->format('Y-m-d')}}
                                </td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="status-badge status-pending">{{__('Pending')}}</span>
                                    @elseif($order->status == 1)
                                        <span class="status-badge status-active">{{__('Active')}}</span>
                                    @elseif($order->status == 2)
                                        <span class="status-badge status-completed">{{__('Completed')}}</span>
                                    @else
                                        <span class="status-badge status-cancelled">{{__('Cancelled')}}</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{amount_with_currency_symbol($order->total ?? 0)}}</strong>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{route('client.track', $order->tracking_code)}}" class="btn btn-sm btn-info" title="{{__('Track')}}">
                                            <i class="ti-eye"></i>
                                        </a>
                                        @if($order->status == 2)
                                        <a href="{{route('client.invoice', $order->id)}}" class="btn btn-sm btn-primary" title="{{__('Invoice')}}">
                                            <i class="ti-file"></i>
                                        </a>
                                        <a href="{{route('client.warranty', $order->id)}}" class="btn btn-sm btn-success" title="{{__('Warranty')}}">
                                            <i class="ti-shield"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination-wrapper p-3">
                    {{$orders->links()}}
                </div>
                @else
                <div class="empty-state">
                    <i class="ti-shopping-cart"></i>
                    <h4>{{__('No Orders Found')}}</h4>
                    <p>{{__('You haven\'t placed any orders yet.')}}</p>
                    <a href="{{route('client.orders.create')}}" class="btn btn-primary">
                        <i class="ti-plus"></i> {{__('Create New Request')}}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Auto-submit filter on change
    document.querySelectorAll('select[name="status"]').forEach(function(select) {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>
@endsection

