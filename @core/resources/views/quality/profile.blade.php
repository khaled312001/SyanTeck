@extends('quality.layouts.master')

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
                    
                    <form method="POST" action="{{ route('quality.profile.update') }}">
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
                    <p><strong>{{__('Role')}}:</strong> {{ $user->roles->first()->name ?? __('Quality Agent') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Activity Log')}} - {{__('Quality Followups')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('Followup ID')}}</th>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Service')}}</th>
                                    <th>{{__('Rating')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                <tr>
                                    <td>#{{ $activity->id }}</td>
                                    <td>#{{ $activity->order_id }}</td>
                                    <td>{{ $activity->order->service->title ?? 'N/A' }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="ti-star {{ $i <= $activity->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        ({{ $activity->rating }}/5)
                                    </td>
                                    <td>
                                        @if($activity->status == 'completed')
                                            <span class="badge badge-success">{{__('Completed')}}</span>
                                        @elseif($activity->status == 'needs_improvement')
                                            <span class="badge badge-warning">{{__('Needs Improvement')}}</span>
                                        @else
                                            <span class="badge badge-info">{{__('Pending')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('quality.followups.show', $activity->id) }}" class="btn btn-sm btn-primary">
                                            <i class="ti-eye"></i> {{__('View')}}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{__('No followups found')}}</td>
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

