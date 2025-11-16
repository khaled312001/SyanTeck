@extends('support.layouts.master')

@section('site-title')
{{__('Customers')}}
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Customers List')}}</h4>
                    
                    <!-- Search -->
                    <form method="GET" action="{{ route('support.customers') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="{{__('Search by name, email, or phone')}}" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">{{__('Search')}}</button>
                            </div>
                        </div>
                    </form>

                    <div class="data-tables datatable-primary">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Address')}}</th>
                                    <th>{{__('Total Orders')}}</th>
                                    <th>{{__('Total Spent')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td><span class="badge badge-primary">{{ $customer->orders_count }}</span></td>
                                    <td>{{ amount_with_currency_symbol($customer->total_spent) }}</td>
                                    <td>
                                        <a href="{{ route('support.customers.show', $customer->email) }}" class="btn btn-primary btn-sm">
                                            <i class="ti-eye"></i> {{__('View')}}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{__('No customers found')}}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

