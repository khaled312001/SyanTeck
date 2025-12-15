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
            
            @if($order->status == 1)
            <!-- GPS Tracking Map -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="header-title">
                        <i class="ti-location-pin"></i> {{__('Live Location & Directions')}}
                    </h4>
                    <div id="technicianTrackingMap" style="height: 400px; width: 100%; border-radius: 8px; margin-top: 15px;"></div>
                    <div class="mt-3">
                        <p class="text-muted mb-2">
                            <i class="ti-info-alt"></i> 
                            <small>{{__('Your location will be automatically updated and shared with the client, support team, and admin.')}}</small>
                        </p>
                        <div id="locationInfo" class="alert alert-secondary mb-0" style="display: none;">
                            <strong>{{__('Last Update')}}:</strong> <span id="lastUpdateTime">-</span><br>
                            <strong>{{__('Distance to Client')}}:</strong> <span id="distanceToClient">-</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Actions')}}</h4>

                    @if($order->status == 0)
                    <!-- Accept/Reject Order -->
                    <form method="POST" action="{{ route('technician.orders.accept', $order->id) }}" class="mb-3" id="acceptOrderForm">
                        @csrf
                        <input type="hidden" name="latitude" id="acceptLatitude">
                        <input type="hidden" name="longitude" id="acceptLongitude">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="ti-check"></i> {{__('Accept Order')}}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('technician.orders.reject', $order->id) }}" class="mb-3" onsubmit="return confirmReject()" id="rejectOrderForm">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Rejection Reason')}} ({{__('Optional')}})</label>
                            <textarea name="rejection_reason" class="form-control" rows="3" placeholder="{{__('Please provide a reason for rejection...')}}"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="ti-close"></i> {{__('Reject Order')}}
                        </button>
                    </form>
                    @endif

                    @if($order->status == 1)
                    <!-- GPS Tracking Status -->
                    <div class="alert alert-info mb-3" id="gpsStatusAlert">
                        <i class="ti-location-pin"></i> 
                        <span id="gpsStatusText">{{__('Getting your location...')}}</span>
                    </div>
                    
                    <!-- Update Status with GPS -->
                    <form method="POST" action="{{ route('technician.orders.update.status', $order->id) }}" class="mb-3" id="updateStatusForm">
                        @csrf
                        <input type="hidden" name="latitude" id="statusLatitude">
                        <input type="hidden" name="longitude" id="statusLongitude">
                        <div class="form-group">
                            <label>{{__('Update Status')}}</label>
                            <select name="status" class="form-control" required id="statusSelect">
                                <option value="en_route" {{ $order->technician_order_status == 'en_route' ? 'selected' : '' }}>{{__('En Route')}}</option>
                                <option value="arrived" {{ $order->technician_order_status == 'arrived' ? 'selected' : '' }}>{{__('Arrived')}}</option>
                                <option value="started" {{ $order->technician_order_status == 'started' ? 'selected' : '' }}>{{__('Started')}}</option>
                                <option value="completed" {{ $order->technician_order_status == 'completed' ? 'selected' : '' }}>{{__('Completed')}}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="ti-reload"></i> {{__('Update Status')}}
                        </button>
                    </form>
                    
                    <!-- Start GPS Tracking Button -->
                    <button type="button" class="btn btn-info btn-block mb-3" id="startTrackingBtn">
                        <i class="ti-location-pin"></i> {{__('Start GPS Tracking')}}
                    </button>
                    <button type="button" class="btn btn-warning btn-block mb-3" id="stopTrackingBtn" style="display: none;">
                        <i class="ti-location-pin"></i> {{__('Stop GPS Tracking')}}
                    </button>
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

@push('style')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<!-- Leaflet Routing Machine CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
    #technicianTrackingMap {
        z-index: 1;
    }
    .leaflet-routing-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- Leaflet Routing Machine JS -->
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script>
let trackingMap;
let technicianMarker;
let clientMarker;
let routingControl;
let watchId = null;
let isTrackingActive = false;
let currentLatitude = null;
let currentLongitude = null;

// Client location (from order)
const clientLat = {{ $order->latitude ?? 'null' }};
const clientLng = {{ $order->longitude ?? 'null' }};

function confirmReject() {
    var message = '{{ addslashes(__("Are you sure you want to reject this order?")) }}';
    return confirm(message);
}

// Initialize Map
@if($order->status == 1)
function initTrackingMap() {
    // Default location (Riyadh, Saudi Arabia)
    const defaultLat = 24.7136;
    const defaultLng = 46.6753;
    
    // Initialize map
    trackingMap = L.map('technicianTrackingMap').setView([defaultLat, defaultLng], 13);
    
    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(trackingMap);
    
    // Add client marker if location available
    if (clientLat && clientLng) {
        clientMarker = L.marker([clientLat, clientLng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(trackingMap);
        clientMarker.bindPopup('<b>{{__("Client Location")}}</b><br>{{ $order->address }}').openPopup();
    }
    
    // Get current location
    getCurrentLocation();
}

// Get current location
function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                currentLatitude = position.coords.latitude;
                currentLongitude = position.coords.longitude;
                
                updateTechnicianMarker(currentLatitude, currentLongitude);
                updateLocationInfo();
                calculateRoute();
                
                // Update form hidden fields
                document.getElementById('statusLatitude').value = currentLatitude;
                document.getElementById('statusLongitude').value = currentLongitude;
                document.getElementById('acceptLatitude').value = currentLatitude;
                document.getElementById('acceptLongitude').value = currentLongitude;
            },
            function(error) {
                console.error('Geolocation error:', error);
                document.getElementById('gpsStatusText').textContent = '{{__("Location access denied. Please enable location services.")}}';
                document.getElementById('gpsStatusAlert').className = 'alert alert-warning mb-3';
            }
        );
    } else {
        document.getElementById('gpsStatusText').textContent = '{{__("Geolocation is not supported by your browser.")}}';
        document.getElementById('gpsStatusAlert').className = 'alert alert-warning mb-3';
    }
}

// Update technician marker
function updateTechnicianMarker(lat, lng) {
    if (technicianMarker) {
        technicianMarker.setLatLng([lat, lng]);
    } else {
        technicianMarker = L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(trackingMap);
        technicianMarker.bindPopup('<b>{{__("Your Location")}}</b>').openPopup();
    }
    
    trackingMap.setView([lat, lng], 13);
}

// Calculate route to client
function calculateRoute() {
    if (!clientLat || !clientLng || !currentLatitude || !currentLongitude) {
        return;
    }
    
    // Remove existing route
    if (routingControl) {
        trackingMap.removeControl(routingControl);
    }
    
    // Add routing
    routingControl = L.Routing.control({
        waypoints: [
            L.latLng(currentLatitude, currentLongitude),
            L.latLng(clientLat, clientLng)
        ],
        routeWhileDragging: false,
        showAlternatives: false,
        addWaypoints: false,
        createMarker: function() { return null; }
    }).addTo(trackingMap);
    
    routingControl.on('routesfound', function(e) {
        const routes = e.routes;
        if (routes && routes.length > 0) {
            const distance = (routes[0].summary.totalDistance / 1000).toFixed(2);
            document.getElementById('distanceToClient').textContent = distance + ' km';
        }
    });
}

// Update location info
function updateLocationInfo() {
    const now = new Date();
    document.getElementById('lastUpdateTime').textContent = now.toLocaleString('{{app()->getLocale()}}');
    document.getElementById('locationInfo').style.display = 'block';
    document.getElementById('gpsStatusText').textContent = '{{__("Location tracking active")}}';
    document.getElementById('gpsStatusAlert').className = 'alert alert-success mb-3';
}

// Start GPS tracking
function startTracking() {
    if (watchId !== null) {
        return; // Already tracking
    }
    
    if (!navigator.geolocation) {
        alert('{{__("Geolocation is not supported by your browser.")}}');
        return;
    }
    
    isTrackingActive = true;
    document.getElementById('startTrackingBtn').style.display = 'none';
    document.getElementById('stopTrackingBtn').style.display = 'block';
    
    watchId = navigator.geolocation.watchPosition(
        function(position) {
            currentLatitude = position.coords.latitude;
            currentLongitude = position.coords.longitude;
            
            updateTechnicianMarker(currentLatitude, currentLongitude);
            updateLocationInfo();
            calculateRoute();
            
            // Send location to server
            sendLocationToServer(currentLatitude, currentLongitude);
        },
        function(error) {
            console.error('Geolocation error:', error);
            document.getElementById('gpsStatusText').textContent = '{{__("Location tracking error")}}';
            document.getElementById('gpsStatusAlert').className = 'alert alert-danger mb-3';
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

// Stop GPS tracking
function stopTracking() {
    if (watchId !== null) {
        navigator.geolocation.clearWatch(watchId);
        watchId = null;
        isTrackingActive = false;
        document.getElementById('startTrackingBtn').style.display = 'block';
        document.getElementById('stopTrackingBtn').style.display = 'none';
        document.getElementById('gpsStatusText').textContent = '{{__("Location tracking stopped")}}';
        document.getElementById('gpsStatusAlert').className = 'alert alert-warning mb-3';
    }
}

// Send location to server
function sendLocationToServer(lat, lng) {
    fetch('{{ route("technician.orders.update.location", $order->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            latitude: lat,
            longitude: lng
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Location updated:', data);
        }
    })
    .catch(error => {
        console.error('Error updating location:', error);
    });
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    @if($order->status == 1)
    initTrackingMap();
    
    document.getElementById('startTrackingBtn').addEventListener('click', startTracking);
    document.getElementById('stopTrackingBtn').addEventListener('click', stopTracking);
    
    // Update location on status form submit
    document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
        if (!currentLatitude || !currentLongitude) {
            getCurrentLocation();
        }
        document.getElementById('statusLatitude').value = currentLatitude;
        document.getElementById('statusLongitude').value = currentLongitude;
    });
    @endif
    
    // Update location on accept form submit
    @if($order->status == 0)
    document.getElementById('acceptOrderForm').addEventListener('submit', function(e) {
        if (!currentLatitude || !currentLongitude) {
            getCurrentLocation();
        }
        document.getElementById('acceptLatitude').value = currentLatitude;
        document.getElementById('acceptLongitude').value = currentLongitude;
    });
    @endif
});
</script>
@endif

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

