@extends('technician.layouts.master')

@section('site-title')
{{__('My Orders')}}
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('My Orders')}}</h4>
                    
                    <!-- Filters -->
                    <form method="GET" action="{{ route('technician.orders') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label>{{__('Status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="">{{__('All Statuses')}}</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>{{__('Pending')}}</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{__('Active')}}</option>
                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>{{__('Completed')}}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">{{__('Filter')}}</button>
                            </div>
                        </div>
                    </form>

                    <div class="data-tables datatable-primary">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Tracking Code')}}</th>
                                    <th>{{__('Client')}}</th>
                                    <th>{{__('Service')}}</th>
                                    <th>{{__('Region')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td><strong>{{ $order->tracking_code ?? __('N/A') }}</strong></td>
                                    <td>
                                        {{ $order->name }}<br>
                                        <small class="text-muted">{{ $order->phone }}</small>
                                    </td>
                                    <td>{{ $order->service->title ?? __('N/A') }}</td>
                                    <td>{{ $order->region->name ?? __('N/A') }}</td>
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
                                        <a href="{{ route('technician.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">{{__('No orders found')}}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

