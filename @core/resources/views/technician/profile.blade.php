@extends('technician.layouts.master')

@section('site-title')
{{__('My Profile')}}
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Profile Information')}}</h4>
                    
                    <form method="POST" action="{{ route('technician.profile.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>{{__('Email')}}</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label>{{__('Phone')}} <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                        </div>

                        <div class="form-group">
                            <label>{{__('Address')}}</label>
                            <textarea name="address" class="form-control" rows="3">{{ $user->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>{{__('About')}}</label>
                            <textarea name="about" class="form-control" rows="5">{{ $user->about }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="is_available" class="form-check-input" id="is_available" value="1" {{ $user->is_available ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">{{__('Available for new orders')}}</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{__('Update Profile')}}</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Account Information')}}</h4>
                    <p><strong>{{__('Email')}}:</strong> {{ $user->email }}</p>
                    <p><strong>{{__('Member Since')}}:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
                    <p><strong>{{__('Status')}}:</strong>
                        @if($user->is_available)
                            <span class="badge badge-success">{{__('Available')}}</span>
                        @else
                            <span class="badge badge-warning">{{__('Not Available')}}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Activity Log')}} - {{__('My Orders')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Service')}}</th>
                                    <th>{{__('Region')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities ?? [] as $activity)
                                <tr>
                                    <td>#{{ $activity->id }}</td>
                                    <td>{{ $activity->service->title ?? 'N/A' }}</td>
                                    <td>{{ $activity->region->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($activity->status == 0)
                                            <span class="badge badge-warning">{{__('Pending')}}</span>
                                        @elseif($activity->status == 1)
                                            <span class="badge badge-info">{{__('Active')}}</span>
                                        @elseif($activity->status == 2)
                                            <span class="badge badge-success">{{__('Completed')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('Cancelled')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($activity->total, 2) }} {{ get_static_option('site_global_currency') }}</td>
                                    <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('technician.orders.show', $activity->id) }}" class="btn btn-sm btn-primary">
                                            <i class="ti-eye"></i> {{__('View')}}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{__('No orders found')}}</td>
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

