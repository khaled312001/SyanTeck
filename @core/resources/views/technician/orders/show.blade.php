@extends('technician.layouts.master')

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
                                @endif
                            </p>
                            <p><strong>{{__('Urgency')}}:</strong> 
                                @if($order->urgency_level == 'normal')
                                    {{__('normal')}}
                                @elseif($order->urgency_level == 'urgent')
                                    {{__('urgent')}}
                                @elseif($order->urgency_level == 'emergency')
                                    {{__('emergency')}}
                                @else
                                    {{__('normal')}}
                                @endif
                            </p>
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

                    <!-- Upload Issue Files -->
                    <div class="mt-3">
                        <strong>{{__('Issue Images')}}:</strong>
                        <form method="POST" action="{{ route('technician.orders.upload.images', $order->id) }}" enctype="multipart/form-data" class="mt-2" id="uploadForm">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="issue_images[]" multiple 
                                       accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar" 
                                       class="form-control-file" 
                                       id="fileInput"
                                       required>
                                <small class="form-text text-muted">
                                    {{__('You can upload multiple files (Images, Videos, Documents) - Max 500MB each')}}
                                </small>
                                <div id="fileList" class="mt-2"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="ti-upload"></i> {{__('Upload Files')}}
                            </button>
                        </form>
                    </div>

                    <!-- Display Issue Files -->
                    @if(!empty($order->issue_images) && count($order->issue_images) > 0)
                    <div class="mt-3">
                        <strong>{{__('Uploaded Issue Images')}}:</strong>
                        <div class="row mt-2">
                            @foreach($order->issue_images as $file)
                            @php
                                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', '3gp', 'mkv'];
                                $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];
                                $archiveExtensions = ['zip', 'rar'];
                                $isImage = in_array($extension, $imageExtensions);
                                $isVideo = in_array($extension, $videoExtensions);
                                $isDocument = in_array($extension, $documentExtensions);
                                $isArchive = in_array($extension, $archiveExtensions);
                            @endphp
                            <div class="col-md-4 mb-3">
                                <div class="position-relative border rounded p-2" style="min-height: 200px;">
                                    @if($isImage)
                                        <a href="{{ asset($file) }}" target="_blank">
                                            <img src="{{ asset($file) }}" 
                                                 alt="{{__('Issue Image')}}" 
                                                 class="img-thumbnail" 
                                                 style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;">
                                        </a>
                                    @elseif($isVideo)
                                        <video controls style="width: 100%; height: 200px; object-fit: cover;">
                                            <source src="{{ asset($file) }}" type="video/{{ $extension }}">
                                            {{__('Your browser does not support the video tag.')}}
                                        </video>
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="height: 200px;">
                                            @if($isDocument)
                                                <i class="ti-file" style="font-size: 48px; color: #667eea;"></i>
                                            @elseif($isArchive)
                                                <i class="ti-zip" style="font-size: 48px; color: #667eea;"></i>
                                            @else
                                                <i class="ti-file" style="font-size: 48px; color: #667eea;"></i>
                                            @endif
                                            <p class="mt-2 mb-0 text-center">{{ basename($file) }}</p>
                                            <a href="{{ asset($file) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                                <i class="ti-download"></i> {{__('Download')}}
                                            </a>
                                        </div>
                                    @endif
                                    <button type="button" class="btn btn-danger btn-sm position-absolute" 
                                            style="top: 5px; right: 5px;"
                                            onclick="deleteImage('{{ $file }}')">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
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
                            <p><strong>{{__('Region')}}:</strong> {{ $order->region->name_ar ?? $order->region->name ?? __('N/A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Actions')}}</h4>

                    @if($order->status == 0)
                    <!-- Accept/Reject Order -->
                    <form method="POST" action="{{ route('technician.orders.accept', $order->id) }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">{{__('Accept Order')}}</button>
                    </form>

                    <form method="POST" action="{{ route('technician.orders.reject', $order->id) }}" class="mb-3" onsubmit="return confirmReject()">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block">{{__('Reject Order')}}</button>
                    </form>
                    @endif

                    @if($order->status == 1)
                    <!-- Update Status -->
                    <form method="POST" action="{{ route('technician.orders.update.status', $order->id) }}" class="mb-3">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Update Status')}}</label>
                            <select name="status" class="form-control" required>
                                <option value="en_route">{{__('En Route')}}</option>
                                <option value="arrived">{{__('Arrived')}}</option>
                                <option value="started">{{__('Started')}}</option>
                                <option value="completed">{{__('Completed')}}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">{{__('Update Status')}}</button>
                    </form>
                    @endif

                    @if($order->status >= 2)
                    <!-- Invoice & Warranty -->
                    <div class="mt-3 pt-3 border-top">
                        <h5 class="mb-3">{{__('Documents')}}</h5>
                        
                        @if($order->hasInvoice())
                        <a href="{{ route('technician.orders.invoice.view', $order->id) }}" target="_blank" class="btn btn-success btn-block mb-2">
                            <i class="ti-file"></i> {{__('View Invoice')}}
                        </a>
                        <a href="{{ route('technician.orders.invoice.download', $order->id) }}" class="btn btn-outline-success btn-block mb-2">
                            <i class="ti-download"></i> {{__('Download Invoice')}}
                        </a>
                        @else
                        <a href="{{ route('technician.orders.invoice', $order->id) }}" class="btn btn-success btn-block mb-2">
                            <i class="ti-file"></i> {{__('Generate Invoice')}}
                        </a>
                        @endif

                        @if($order->hasWarranty())
                        <a href="{{ route('technician.orders.warranty.view', $order->id) }}" target="_blank" class="btn btn-info btn-block mb-2">
                            <i class="ti-shield"></i> {{__('View Warranty')}}
                        </a>
                        <a href="{{ route('technician.orders.warranty.download', $order->id) }}" class="btn btn-outline-info btn-block mb-2">
                            <i class="ti-download"></i> {{__('Download Warranty')}}
                        </a>
                        @else
                        <a href="{{ route('technician.orders.warranty', $order->id) }}" class="btn btn-info btn-block mb-2">
                            <i class="ti-shield"></i> {{__('Generate Warranty')}}
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmReject() {
    var message = '{{ addslashes(__("Are you sure you want to reject this order?")) }}';
    return confirm(message);
}

// عرض قائمة الملفات المحددة
document.getElementById('fileInput').addEventListener('change', function(e) {
    var fileList = document.getElementById('fileList');
    fileList.innerHTML = '';
    
    if (this.files.length > 0) {
        var list = document.createElement('ul');
        list.className = 'list-group';
        
        for (var i = 0; i < this.files.length; i++) {
            var file = this.files[i];
            var fileSize = (file.size / (1024 * 1024)).toFixed(2); // MB
            var listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.innerHTML = '<span><i class="ti-file"></i> ' + file.name + ' (' + fileSize + ' MB)</span>';
            list.appendChild(listItem);
        }
        
        fileList.appendChild(list);
    }
});

function deleteImage(imagePath) {
    var confirmMessage = '{{ addslashes(__("Are you sure you want to delete this image?")) }}';
    if (!confirm(confirmMessage)) {
        return;
    }
    
    var deleteUrl = '{{ route("technician.orders.delete.image", $order->id) }}';
    var errorMessage = '{{ addslashes(__("Error deleting image")) }}';
    
    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            image_path: imagePath
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.error || errorMessage);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(errorMessage);
    });
}
</script>
@endpush
@endsection

