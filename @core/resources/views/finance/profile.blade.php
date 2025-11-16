@extends('finance.layouts.master')

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
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('finance.profile.update') }}">
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
                    <p><strong>{{__('Role')}}:</strong> {{ $user->roles->first()->name ?? __('Finance') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Activity Log')}} - {{__('Recent Invoices')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Service')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                <tr>
                                    <td>#{{ $activity->id }}</td>
                                    <td>{{ $activity->service->title ?? 'N/A' }}</td>
                                    <td>{{ number_format($activity->total, 2) }} {{ get_static_option('site_global_currency') }}</td>
                                    <td>
                                        @if($activity->payment_status == 'complete')
                                            <span class="badge badge-success">{{__('Paid')}}</span>
                                        @else
                                            <span class="badge badge-warning">{{__('Pending')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ $activity->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{__('No activities found')}}</td>
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

