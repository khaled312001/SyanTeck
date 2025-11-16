@extends('support.layouts.master')

@section('site-title')
{{__('Customer Details')}} - {{ $customer->name }}
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Customer Information')}}</h4>
                    <p><strong>{{__('Name')}}:</strong> {{ $customer->name }}</p>
                    <p><strong>{{__('Email')}}:</strong> {{ $customer->email }}</p>
                    <p><strong>{{__('Phone')}}:</strong> {{ $customer->phone }}</p>
                    <p><strong>{{__('Address')}}:</strong> {{ $customer->address }}</p>
                    @if($customer->region)
                    <p><strong>{{__('Region')}}:</strong> {{ $customer->region->name }}</p>
                    @endif
                </div>
            </div>

            <!-- Statistics -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="header-title">{{__('Statistics')}}</h4>
                    <p><strong>{{__('Total Orders')}}:</strong> {{ $stats['total_orders'] }}</p>
                    <p><strong>{{__('Total Spent')}}:</strong> {{ amount_with_currency_symbol($stats['total_spent']) }}</p>
                    <p><strong>{{__('Completed Orders')}}:</strong> {{ $stats['completed_orders'] }}</p>
                    <p><strong>{{__('Pending Orders')}}:</strong> {{ $stats['pending_orders'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Customer Orders -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Customer Orders')}}</h4>
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
                                @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->tracking_code ?? __('N/A') }}</td>
                                    <td>{{ $order->service->title ?? __('N/A') }}</td>
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
                                        <a href="{{ route('support.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                                            <i class="ti-eye"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

