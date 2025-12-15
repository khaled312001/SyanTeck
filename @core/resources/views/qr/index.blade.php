@extends('frontend.frontend-page-master')

@section('page-title')
{{__('Maintenance Emergency')}}
@endsection

@section('site-title')
{{__('Maintenance Emergency')}} - {{get_static_option('site_title')}}
@endsection

@section('page-meta-data')
{!! render_site_title(__('Maintenance Emergency')) !!}
<meta name="description" content="{{__('Request maintenance emergency service quickly and easily through our platform')}}">
@endsection

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- QR Request Page -->
<section class="qr-request-area enhanced-qr-section padding-top-100 padding-bottom-100">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="qr-request-wrapper enhanced-qr-wrapper">
                    <!-- Header Section -->
                    <div class="request-header text-center margin-bottom-50">
                        <div class="qr-icon-wrapper margin-bottom-30">
                            <div class="qr-icon-circle">
                                <i class="las la-qrcode"></i>
                            </div>
                            <div class="qr-pulse-ring"></div>
                        </div>
                        <h1 class="request-title">{{__('Maintenance Emergency')}}</h1>
                        <div class="request-badges mt-4">
                            <span class="badge-item"><i class="las la-clock"></i> {{__('Quick Response')}}</span>
                            <span class="badge-item"><i class="las la-shield-alt"></i> {{__('Secure')}}</span>
                            <span class="badge-item"><i class="las la-headset"></i> {{__('24/7 Support')}}</span>
                        </div>
                    </div>

                    <!-- Progress Steps -->
                    <div class="steps-progress-wrapper margin-bottom-50">
                        <div class="steps-progress">
                            <div class="step-item active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-label">{{__('Select Service')}}</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step-item" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-label">{{__('Your Information')}}</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step-item" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-label">{{__('Service Details')}}</div>
                            </div>
                            <div class="step-connector"></div>
                            <div class="step-item" data-step="4">
                                <div class="step-number">4</div>
                                <div class="step-label">{{__('Review & Submit')}}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Request Form -->
                    <div class="request-form-wrapper">
                        <form action="{{route('qr.store')}}" method="POST" id="qr-request-form" class="request-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="service_id" id="service_id" required>
                            
                            <!-- Step 1: Service Selection -->
                            <div class="form-step active" data-step="1">
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="las la-tools"></i>
                                        {{__('Select Service')}}
                                    </h3>
                                    
                                    <div class="services-grid">
                                        @foreach($services as $service)
                                            @php
                                                // استخدام helper function لتحديد الأيقونة
                                                $serviceIconData = get_service_icon($service->title);
                                                $serviceIcon = $serviceIconData['icon'];
                                                $iconColor = $serviceIconData['color'];
                                            @endphp
                                            <div class="service-card" data-service-id="{{$service->id}}" data-service-name="{{$service->title}}">
                                                <div class="service-card-icon-wrapper" style="background: #FFFFFF;">
                                                    <i class="{{$serviceIcon}}" style="color: #000000;"></i>
                                                    <div class="service-card-overlay">
                                                        <i class="las la-check-circle"></i>
                                                    </div>
                                                </div>
                                                <div class="service-card-content">
                                                    <h4 class="service-card-title">{{$service->title}}</h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="selected-service-info margin-top-20" id="selected-service-info" style="display: none;">
                                        <div class="alert alert-info">
                                            <div>
                                                <strong id="selected-service-name"></strong>
                                                <p class="mb-0 mt-2">{{__('The technician will determine the price after inspecting the issue or installation.')}}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Request Type Selection -->
                                        <div class="request-type-selection margin-top-30">
                                            <label class="form-label">
                                                <i class="las la-list"></i>
                                                {{__('اختر نوع الطلب')}} <span class="text-danger">*</span>
                                            </label>
                                            <div class="request-type-cards">
                                                <div class="request-type-card" data-request-type="maintenance">
                                                    <div class="request-type-icon">
                                                        <i class="las la-tools"></i>
                                                    </div>
                                                    <h4 class="request-type-title">{{__('طلب فني صيانة')}}</h4>
                                                    <p class="request-type-description">{{__('طلب فني صيانة لمعاينة وإصلاح المشكلة')}}</p>
                                                </div>
                                                
                                                <div class="request-type-card" data-request-type="consultation">
                                                    <div class="request-type-icon">
                                                        <i class="las la-phone"></i>
                                                    </div>
                                                    <h4 class="request-type-title">{{__('استشارة تلفونية فورية مجانية')}}</h4>
                                                    <p class="request-type-description">{{__('استشارة فورية عبر الهاتف مع فني متخصص')}}</p>
                                                </div>
                                                
                                                <div class="request-type-card" data-request-type="chat">
                                                    <div class="request-type-icon">
                                                        <i class="las la-comments"></i>
                                                    </div>
                                                    <h4 class="request-type-title">{{__('فتح محادثة مجانية مع الدعم الفني')}}</h4>
                                                    <p class="request-type-description">{{__('محادثة مباشرة مع فريق الدعم الفني')}}</p>
                                                </div>
                                            </div>
                                            <input type="hidden" name="request_type" id="request_type" required>
                                        </div>
                                        
                                        <!-- Issue Media Upload (only for maintenance) -->
                                        <div class="issue-image-upload-section margin-top-25" id="issue-image-section" style="display: none;">
                                            <label class="form-label">
                                                <i class="las la-camera"></i>
                                                {{__('رفع صورة أو فيديو أو تسجيل صوتي للمشكلة')}} <small class="text-muted">({{__('Optional')}})</small>
                                            </label>
                                            <p class="form-text text-muted margin-bottom-15">{{__('ارفع صورة أو فيديو أو سجل مقطع صوتي للمشكلة لمساعدة الفني على فهم المشكلة بشكل أفضل')}}</p>
                                            
                                            <!-- Upload Options Tabs -->
                                            <div class="upload-options-tabs margin-bottom-20">
                                                <button type="button" class="upload-tab-btn active" data-tab="upload" onclick="switchUploadTab('upload')">
                                                    <i class="las la-upload"></i> {{__('رفع ملف')}}
                                                </button>
                                                <button type="button" class="upload-tab-btn" data-tab="record" onclick="switchUploadTab('record')">
                                                    <i class="las la-microphone"></i> {{__('تسجيل صوتي')}}
                                                </button>
                                            </div>
                                            
                                            <!-- Upload Tab -->
                                            <div class="upload-tab-content active" id="upload-tab">
                                                <div class="camera-upload-wrapper">
                                                    <input type="file" name="issue_image" id="issue_image" class="camera-upload-input" accept="image/*,video/*,audio/*" onchange="previewFile(this)">
                                                    <label for="issue_image" class="camera-upload-label" id="camera-upload-label">
                                                        <div class="camera-icon-container">
                                                            <i class="las la-camera"></i>
                                                            <span class="camera-upload-text">{{__('انقر للرفع')}}</span>
                                                            <span class="camera-upload-hint">{{__('أو اسحب وأفلت')}}</span>
                                                        </div>
                                                    </label>
                                                    
                                                    <!-- Preview Container -->
                                                    <div id="file-preview-step1" class="file-preview-container" style="display: none;">
                                                        <div class="preview-header">
                                                            <span class="preview-title">{{__('Uploaded File')}}</span>
                                                            <button type="button" class="preview-remove-btn" onclick="removeFileStep1()" title="{{__('Remove')}}">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                        <div id="preview-content-step1" class="preview-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Record Tab -->
                                            <div class="upload-tab-content" id="record-tab" style="display: none;">
                                                <div class="audio-recorder-wrapper">
                                                    <div class="audio-recorder-container">
                                                        <div class="recorder-status" id="recorder-status">
                                                            <i class="las la-microphone"></i>
                                                            <span id="recorder-status-text">{{__('جاهز للتسجيل')}}</span>
                                                        </div>
                                                        <div class="recorder-controls">
                                                            <button type="button" class="btn-record" id="btn-start-record" onclick="startRecording()">
                                                                <i class="las la-play"></i>
                                                                <span>{{__('بدء التسجيل')}}</span>
                                                            </button>
                                                            <button type="button" class="btn-record btn-stop" id="btn-stop-record" onclick="stopRecording()" style="display: none;">
                                                                <i class="las la-stop"></i>
                                                                <span>{{__('إيقاف التسجيل')}}</span>
                                                            </button>
                                                            <button type="button" class="btn-record btn-save" id="btn-save-record" onclick="saveRecording()" style="display: none;">
                                                                <i class="las la-save"></i>
                                                                <span>{{__('حفظ التسجيل')}}</span>
                                                            </button>
                                                        </div>
                                                        <div class="recorder-timer" id="recorder-timer" style="display: none;">
                                                            <span id="timer-display">00:00</span>
                                                        </div>
                                                        <div class="recorder-waveform" id="recorder-waveform" style="display: none;">
                                                            <canvas id="waveform-canvas"></canvas>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Audio Preview -->
                                                    <div id="audio-preview-container" class="file-preview-container" style="display: none; margin-top: 20px;">
                                                        <div class="preview-header">
                                                            <span class="preview-title">{{__('التسجيل الصوتي')}}</span>
                                                            <button type="button" class="preview-remove-btn" onclick="removeAudioRecording()" title="{{__('Remove')}}">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                        <div id="audio-preview-content" class="preview-content">
                                                            <audio id="audio-preview-player" controls style="width: 100%; margin-top: 15px;"></audio>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <small class="form-text text-muted upload-hint-text">
                                                <i class="las la-info-circle"></i>
                                                {{__('الحد الأقصى: 500 ميجابايت | الصيغ: JPG, PNG, MP4, MP3, WAV, إلخ')}}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-navigation">
                                    <button type="button" class="btn btn-next" onclick="nextStep()" disabled>
                                        {{__('Next')}} <i class="las la-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Customer Information -->
                            <div class="form-step" data-step="2">
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="las la-user"></i>
                                        {{__('Customer Information')}}
                                    </h3>
                                    
                                    <div class="row">
                                        <div class="col-md-6 margin-bottom-20">
                                            <label class="form-label">{{__('Full Name')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" required placeholder="{{__('Enter your full name')}}">
                                        </div>
                                        
                                        <div class="col-md-6 margin-bottom-20">
                                            <label class="form-label">{{__('Email')}} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" required placeholder="{{__('Enter your email')}}">
                                        </div>
                                        
                                        <div class="col-md-6 margin-bottom-20">
                                            <label class="form-label">{{__('Phone Number')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" required placeholder="{{__('Enter your phone number')}}">
                                        </div>
                                        
                                        <div class="col-12 margin-bottom-20">
                                            <label class="form-label">{{__('حدد موقعك على الخريطة')}} <span class="text-danger">*</span></label>
                                            <div id="location-map-container" style="width: 100%; height: 500px; border-radius: 12px; overflow: hidden; border: 2px solid rgba(0, 0, 0, 0.15); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); position: relative;">
                                                <div id="location-map" style="width: 100%; height: 100%;"></div>
                                                <div id="map-loading" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #f5f5f5; display: flex; align-items: center; justify-content: center; z-index: 10;">
                                                    <div style="text-align: center;">
                                                        <i class="las la-spinner la-spin" style="font-size: 48px; color: #FFD700; margin-bottom: 15px;"></i>
                                                        <p style="color: #666; font-size: 16px;">{{__('جاري تحميل الخريطة...')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="address" id="address" required>
                                            <input type="hidden" name="latitude" id="latitude">
                                            <input type="hidden" name="longitude" id="longitude">
                                            <div id="location-status" style="margin-top: 15px; padding: 12px; background: #f8f9fa; border-radius: 8px; font-size: 14px; color: #666;">
                                                <i class="las la-info-circle" style="color: #FFD700;"></i>
                                                <span>{{__('سيتم اكتشاف موقعك تلقائياً. يمكنك سحب العلامة لتعديل موقعك الدقيق.')}}</span>
                                            </div>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="form-navigation">
                                    <button type="button" class="btn btn-prev" onclick="prevStep()">
                                        <i class="las la-arrow-left"></i> {{__('Previous')}}
                                    </button>
                                    <button type="button" class="btn btn-next" onclick="nextStep()">
                                        {{__('Next')}} <i class="las la-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Service Details -->
                            <div class="form-step" data-step="3">
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="las la-info-circle"></i>
                                        {{__('Service Details')}}
                                    </h3>
                                    
                                    <div class="row">
                                        <div class="col-md-6 margin-bottom-20">
                                            <label class="form-label">{{__('Urgency Level')}} <span class="text-danger">*</span></label>
                                            <select name="urgency_level" class="form-control" required>
                                                <option value="normal">{{__('Normal')}} - {{__('Within 24 hours')}}</option>
                                                <option value="urgent">{{__('Urgent')}} - {{__('Within 6 hours')}}</option>
                                                <option value="emergency">{{__('Emergency')}} - {{__('Immediate')}}</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6 margin-bottom-20">
                                            <label class="form-label">{{__('Preferred Date')}}</label>
                                            <input type="date" name="preferred_date" class="form-control" min="{{date('Y-m-d')}}">
                                        </div>
                                        
                                        <div class="col-12 margin-bottom-20">
                                            <label class="form-label">{{__('Additional Notes')}}</label>
                                            <textarea name="order_note" class="form-control" rows="4" placeholder="{{__('Describe the issue or any additional information')}}"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-navigation">
                                    <button type="button" class="btn btn-prev" onclick="prevStep()">
                                        <i class="las la-arrow-left"></i> {{__('Previous')}}
                                    </button>
                                    <button type="button" class="btn btn-next" onclick="nextStep()">
                                        {{__('Next')}} <i class="las la-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 4: Summary & Submit -->
                            <div class="form-step" data-step="4">
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="las la-check-circle"></i>
                                        {{__('Review & Submit')}}
                                    </h3>
                                    
                                    <div class="order-summary">
                                        <div class="summary-content">
                                            <div class="summary-section">
                                                <h4 class="summary-section-title">{{__('Selected Service')}}</h4>
                                                <div class="summary-item" id="summary-service">
                                                    <span class="summary-label">{{__('Service')}}:</span>
                                                    <span class="summary-value" id="summary-service-name">-</span>
                                                </div>
                                            </div>
                                            
                                            <div class="summary-section">
                                                <h4 class="summary-section-title">{{__('Your Information')}}</h4>
                                                <div class="summary-item">
                                                    <span class="summary-label">{{__('Name')}}:</span>
                                                    <span class="summary-value" id="summary-name">-</span>
                                                </div>
                                                <div class="summary-item">
                                                    <span class="summary-label">{{__('Email')}}:</span>
                                                    <span class="summary-value" id="summary-email">-</span>
                                                </div>
                                                <div class="summary-item">
                                                    <span class="summary-label">{{__('Phone')}}:</span>
                                                    <span class="summary-value" id="summary-phone">-</span>
                                                </div>
                                                <div class="summary-item">
                                                    <span class="summary-label">{{__('Address')}}:</span>
                                                    <span class="summary-value" id="summary-address">-</span>
                                                </div>
                                            </div>
                                            
                                            <div class="summary-section">
                                                <h4 class="summary-section-title">{{__('Service Details')}}</h4>
                                                <div class="summary-item">
                                                    <span class="summary-label">{{__('Urgency Level')}}:</span>
                                                    <span class="summary-value" id="summary-urgency">-</span>
                                                </div>
                                                <div class="summary-item">
                                                    <span class="summary-label">{{__('Preferred Date')}}:</span>
                                                    <span class="summary-value" id="summary-date">-</span>
                                                </div>
                                            </div>
                                            
                                            <div class="alert alert-warning mt-4 mb-0">
                                                <i class="las la-exclamation-triangle"></i>
                                                <strong>{{__('Price Information')}}:</strong>
                                                <p class="mb-0 mt-2">{{__('The technician will inspect the issue or installation and determine the final price. You will be notified of the price before any work begins.')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-navigation">
                                    <button type="button" class="btn btn-prev" onclick="prevStep()">
                                        <i class="las la-arrow-left"></i> {{__('Previous')}}
                                    </button>
                                    <button type="submit" class="btn btn-submit">
                                        <i class="las la-paper-plane"></i> {{__('Submit Request')}}
                                    </button>
                                </div>
                                
                                <p class="form-note margin-top-20 text-center">
                                    {{__('By submitting this form, you agree to our terms and conditions. Our team will contact you within 30 minutes.')}}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.enhanced-qr-section {
    background: #FFD700;
    min-height: 100vh;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

.enhanced-qr-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.4;
    z-index: 0;
}

.enhanced-qr-wrapper {
    background: #fff;
    border-radius: 30px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
    padding: 50px 60px;
    position: relative;
    z-index: 1;
    backdrop-filter: blur(10px);
    max-width: 100%;
    margin: 0 auto;
}

.request-header {
    padding-bottom: 40px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.12);
    margin-bottom: 40px;
}

.qr-icon-wrapper {
    position: relative;
    display: inline-block;
    margin: 0 auto;
}

.qr-icon-circle {
    width: 140px;
    height: 140px;
    background: #FFD700;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    animation: floatIcon 3s ease-in-out infinite;
}

.qr-icon-circle i {
    font-size: 70px;
    color: #fff !important;
}

.qr-pulse-ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 140px;
    height: 140px;
    border: 3px solid rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    animation: pulseRing 2s ease-out infinite;
    z-index: 1;
}

@keyframes floatIcon {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes pulseRing {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0;
    }
}

.request-badges {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.badge-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: rgba(0, 0, 0, 0.12);
    border-radius: 25px;
    color: #000000;
    font-weight: 600;
    font-size: 14px;
    border: 2px solid rgba(0, 0, 0, 0.25);
    transition: all 0.3s ease;
}

.badge-item:hover {
    background: rgba(0, 0, 0, 0.18);
    border-color: rgba(0, 0, 0, 0.35);
    transform: translateY(-2px);
}

.request-title {
    font-size: 48px;
    font-weight: 800;
    color: #000000;
    margin: 30px 0 20px;
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.request-subtitle {
    font-size: 19px;
    color: #4a5568;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
    font-weight: 400;
}

/* Steps Progress */
.steps-progress-wrapper {
    margin-bottom: 50px;
}

.steps-progress {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
}

.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 120px;
    position: relative;
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #FFFFFF;
    color: #000000;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid #000000;
    position: relative;
    z-index: 2;
}

.step-number::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.2);
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    z-index: -1;
}

.step-item.active .step-number {
    background: #FFD700;
    color: #000000;
    border-color: #000000;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    transform: scale(1.15);
    animation: pulseStep 2s ease-in-out infinite;
}

.step-item.active .step-number::before {
    width: 100%;
    height: 100%;
}

@keyframes pulseStep {
    0%, 100% {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }
    50% {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
    }
}

.step-item.completed .step-number {
    background: #000000;
    color: #FFFFFF;
    border-color: #000000;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.step-item.completed .step-number::after {
    content: '✓';
    position: absolute;
    font-size: 24px;
    animation: checkmarkAppear 0.5s ease;
}

.step-label {
    font-size: 14px;
    font-weight: 600;
    color: #999;
    text-align: center;
    transition: all 0.3s ease;
}

.step-item.active .step-label {
    color: #000000;
}

.step-connector {
    flex: 1;
    height: 4px;
    background: #FFFFFF;
    margin: 0 10px;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 30px;
    border-radius: 2px;
    position: relative;
    overflow: hidden;
}

.step-connector::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #FFD700;
    transition: left 0.5s ease;
}

.step-item.active ~ .step-connector::before,
.step-connector.completed::before {
    left: 0;
}

.step-item.completed ~ .step-connector::before {
    background: #000000;
}

/* Form Steps */
.form-step {
    display: none;
    animation: fadeInSlide 0.5s ease;
}

.form-step.active {
    display: block;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.form-section {
    padding: 40px 45px;
    background: #FFFFFF;
    border-radius: 20px;
    margin-bottom: 35px;
    border: 2px solid rgba(0, 0, 0, 0.12);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.form-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: #FFD700;
    transform: scaleY(0);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.form-section:hover::before {
    transform: scaleY(1);
}

.form-section:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
    border-color: rgba(0, 0, 0, 0.25);
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    color: #000000;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 15px;
    padding-left: 15px;
    position: relative;
}

.section-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 30px;
    background: #FFD700;
    border-radius: 2px;
}

.section-title i {
    font-size: 28px;
    color: #000000;
    background: rgba(0, 0, 0, 0.12);
    padding: 12px;
    border-radius: 12px;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.form-section:hover .section-title i {
    background: rgba(0, 0, 0, 0.18);
    transform: scale(1.05);
}

/* Services Grid */
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.service-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid transparent;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    position: relative;
    transform: translateY(0);
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
    pointer-events: none;
}

.service-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
    border-color: rgba(0, 0, 0, 0.4);
}

.service-card:hover::before {
    opacity: 0.05;
}

.service-card.selected {
    border-color: #000000;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
    transform: translateY(-8px) scale(1.03);
    background: #FFFFFF;
}

.service-card.selected::before {
    opacity: 0.1;
}

.service-card-icon-wrapper {
    position: relative;
    width: 100%;
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.service-card-icon-wrapper i {
    font-size: 80px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
}

.service-card:hover .service-card-icon-wrapper {
    background: #FFFFFF;
}

.service-card:hover .service-card-icon-wrapper i {
    transform: scale(1.2) rotate(5deg);
    filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
}

.service-card.selected .service-card-icon-wrapper i {
    animation: iconPulse 1.5s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% {
        transform: scale(1.2);
    }
    50% {
        transform: scale(1.3);
    }
}

.service-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #FFD700;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
}

.service-card.selected .service-card-overlay {
    opacity: 1;
    animation: pulseOverlay 2s ease-in-out infinite;
}

@keyframes pulseOverlay {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.02);
    }
}

.service-card-overlay i {
    font-size: 60px;
    color: #fff;
    animation: checkmarkPop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes checkmarkPop {
    0% {
        transform: scale(0) rotate(-180deg);
        opacity: 0;
    }
    100% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }
}

.service-card-content {
    padding: 20px;
    text-align: center;
}

.service-card-title {
    font-size: 16px;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
    line-height: 1.4;
}

.service-card.selected .service-card-title {
    color: #000000;
}

/* Form Controls */
.form-label {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 10px;
    display: block;
    font-size: 15px;
    letter-spacing: 0.3px;
}

.form-control {
    border: 2px solid rgba(0, 0, 0, 0.15);
    border-radius: 12px;
    padding: 16px 20px;
    font-size: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #FFFFFF;
    color: #000000;
    font-weight: 400;
    width: 100%;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #000000;
    box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.15), 0 4px 12px rgba(0, 0, 0, 0.1);
    outline: none;
    transform: translateY(-2px);
    background: #FFFFFF;
}

.form-control:hover:not(:focus) {
    border-color: rgba(0, 0, 0, 0.3);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transform: translateY(-1px);
}

.form-control.error {
    border-color: #dc3545;
    box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15);
    animation: shake 0.5s ease;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

.form-control::placeholder {
    color: #a0aec0;
    font-weight: 400;
}

select.form-control {
    width: 100% !important;
    min-width: 100%;
    max-width: 100%;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23FF6B2C' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 12px;
    padding-right: 45px;
    box-sizing: border-box;
}

[dir="rtl"] select.form-control {
    background-position: left 20px center;
    padding-left: 45px;
    padding-right: 20px;
}

/* Form Navigation */
.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
    gap: 20px;
}

.btn {
    padding: 15px 40px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.btn-prev {
    background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
    color: #666;
    border: 2px solid transparent;
}

.btn-prev:hover {
    background: linear-gradient(135deg, #e8e8e8 0%, #d0d0d0 100%);
    transform: translateX(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    color: #333;
}

.btn-next, .btn-submit {
    background: #FFD700;
    color: #000000;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
}

.btn-next::before, .btn-submit::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-next:hover::before, .btn-submit:hover::before {
    width: 400px;
    height: 400px;
}

.btn-next:hover, .btn-submit:hover {
    transform: translateX(5px) translateY(-2px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
    background: #FFD700;
}

.btn-next:active, .btn-submit:active {
    transform: translateX(3px) translateY(0);
}

.btn-next:disabled {
    background: #e0e0e0;
    color: #999;
    cursor: not-allowed;
    box-shadow: none;
}

.btn-next:disabled:hover {
    transform: none;
}

.btn-submit {
    background: #000000;
    color: #FFFFFF;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

.btn-submit:hover {
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
}

/* Summary */
.order-summary {
    background: #FFFFFF;
    border: 2px solid rgba(0, 0, 0, 0.25);
    border-radius: 15px;
    padding: 30px;
}

.summary-section {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.summary-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.summary-section-title {
    font-size: 18px;
    font-weight: 700;
    color: #000000;
    margin-bottom: 15px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    font-size: 15px;
}

.summary-label {
    font-weight: 600;
    color: #666;
}

.summary-value {
    font-weight: 500;
    color: #2d3748;
    text-align: right;
}

.selected-service-info {
    animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.selected-service-info .alert {
    border-radius: 15px;
    border: 2px solid rgba(0, 0, 0, 0.2);
    background: #FFFFFF;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.issue-image-upload-section {
    margin-top: 25px;
    padding-top: 25px;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
}

.issue-image-upload-section .form-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    margin-bottom: 10px;
}

.issue-image-upload-section .form-label i {
    font-size: 20px;
    color: #000000;
}

/* Camera Upload Design */
.camera-upload-wrapper {
    position: relative;
    margin: 20px 0;
}

.camera-upload-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    overflow: hidden;
}

.camera-upload-label {
    display: block;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.camera-icon-container {
    background: #FFFFFF;
    border: 3px dashed rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    padding: 50px 30px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.camera-icon-container::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(0, 0, 0, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
}

.camera-icon-container:hover::before {
    width: 300px;
    height: 300px;
}

.camera-icon-container:hover {
    border-color: #000000;
    background: #FFFFFF;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.camera-icon-container i {
    font-size: 64px;
    color: #000000;
    display: block;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.camera-icon-container:hover i {
    transform: scale(1.1) rotate(5deg);
    color: #FFD700;
}

.camera-upload-text {
    display: block;
    font-size: 18px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
    transition: color 0.3s ease;
}

.camera-icon-container:hover .camera-upload-text {
    color: #000000;
}

.camera-upload-hint {
    display: block;
    font-size: 14px;
    color: #718096;
    position: relative;
    z-index: 1;
    transition: color 0.3s ease;
}

.camera-icon-container:hover .camera-upload-hint {
    color: #000000;
}

.upload-hint-text {
    margin-top: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #718096;
}

.upload-hint-text i {
    font-size: 16px;
    color: #000000;
}

/* File Preview Container */
.file-preview-container {
    margin-top: 20px;
    background: #FFFFFF;
    border-radius: 15px;
    border: 2px solid rgba(0, 0, 0, 0.2);
    overflow: hidden;
    animation: slideDown 0.3s ease;
}

.preview-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #FFFFFF;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.preview-title {
    font-weight: 600;
    color: #2d3748;
    font-size: 15px;
}

.preview-remove-btn {
    background: #ff4444;
    color: #fff;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
}

.preview-remove-btn:hover {
    background: #cc0000;
    transform: scale(1.1) rotate(90deg);
    box-shadow: 0 4px 12px rgba(255, 68, 68, 0.4);
}

.preview-content {
    padding: 20px;
    text-align: center;
}

.preview-content img,
.preview-content video,
.preview-content audio {
    max-width: 100%;
    max-height: 400px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}

.preview-content p {
    margin: 10px 0 0 0;
    font-size: 14px;
    color: #4a5568;
}

/* Drag and Drop States */
.camera-upload-label.drag-over .camera-icon-container {
    border-color: #000000;
    background: #FFFFFF;
    transform: scale(1.02);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.camera-upload-label.drag-over .camera-icon-container i {
    transform: scale(1.2);
    color: #FFD700;
}

.camera-upload-label.has-file .camera-icon-container {
    border-color: #000000;
    background: #FFFFFF;
}

.camera-upload-label.has-file .camera-icon-container i {
    color: #FFD700;
}

.camera-upload-label.has-file .camera-upload-text {
    color: #000000;
}

.form-note {
    font-size: 15px;
    color: #4a5568;
    max-width: 700px;
    margin: 25px auto 0;
    line-height: 1.7;
    font-weight: 400;
}

.image-upload-wrapper {
    padding: 15px;
    background: #FFF5F0;
    border-radius: 10px;
    border: 2px dashed rgba(255, 107, 44, 0.2);
    transition: all 0.3s ease;
}

.image-upload-wrapper:hover {
    border-color: rgba(255, 107, 44, 0.4);
    background: #FFE8DC;
}

.image-upload-wrapper input[type="file"] {
    padding: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #fff;
    width: 100%;
}

.file-preview-container {
    text-align: center;
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    border: 2px solid rgba(255, 107, 44, 0.2);
}

.file-preview-container img,
.file-preview-container video {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

@media (max-width: 991px) {
    .enhanced-qr-section {
        padding: 40px 0;
    }
    
    .enhanced-qr-wrapper {
        padding: 40px 35px;
        border-radius: 20px;
    }
    
    .request-title {
        font-size: 36px;
    }
    
    .request-subtitle {
        font-size: 17px;
    }
    
    .form-section {
        padding: 30px 25px;
    }
    
    .section-title {
        font-size: 22px;
    }
    
    .services-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }
    
    .step-item {
        min-width: 80px;
    }
    
    .step-label {
        font-size: 12px;
    }
}

@media (max-width: 768px) {
    .enhanced-qr-section {
        padding: 30px 0;
    }
    
    .enhanced-qr-wrapper {
        padding: 35px 25px;
        border-radius: 20px;
    }
    
    .request-header {
        padding-bottom: 30px;
        margin-bottom: 30px;
    }
    
    .request-title {
        font-size: 32px;
    }
    
    .request-subtitle {
        font-size: 16px;
    }
    
    .qr-icon-circle {
        width: 110px;
        height: 110px;
    }
    
    .qr-icon-circle i {
        font-size: 55px;
    }
    
    .form-section {
        padding: 25px 20px;
    }
    
    .section-title {
        font-size: 20px;
        padding-left: 12px;
    }
    
    .section-title::before {
        width: 3px;
        height: 25px;
    }
    
    .section-title i {
        width: 45px;
        height: 45px;
        font-size: 24px;
        padding: 10px;
    }
    
    .form-control {
        padding: 14px 18px;
        font-size: 15px;
    }
    
    .services-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
    }
    
    .service-card-image {
        height: 140px;
    }
    
    .request-badges {
        gap: 10px;
        flex-direction: column;
        align-items: center;
    }
    
    .badge-item {
        font-size: 13px;
        padding: 8px 18px;
    }
    
    .form-navigation {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .steps-progress {
        flex-wrap: wrap;
    }
    
    .step-connector {
        display: none;
    }
    
    .step-item {
        min-width: 60px;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .step-label {
        font-size: 11px;
    }
    
    /* Camera upload mobile */
    .camera-icon-container {
        padding: 40px 20px;
    }
    
    .camera-icon-container i {
        font-size: 48px;
    }
    
    .camera-upload-text {
        font-size: 16px;
    }
    
    .camera-upload-hint {
        font-size: 12px;
    }
    
    .preview-content img,
    .preview-content video,
    .preview-content audio {
        max-height: 250px;
    }
}

/* GPS Location Button Styles */
.address-input-wrapper {
    position: relative;
}

.btn-get-location {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #FFD700;
    color: #000000;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.btn-get-location:hover:not(:disabled) {
    background: #FFD700;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
}

.btn-get-location:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-get-location i {
    font-size: 18px;
}

#address {
    padding-left: 180px;
    min-height: 100px;
}

#location-status {
    margin-top: 10px;
    font-size: 14px;
    padding: 8px 12px;
    border-radius: 6px;
    background: #f8f9fa;
}

[dir="rtl"] .btn-get-location {
    left: auto;
    right: 10px;
}

    [dir="rtl"] #address {
        padding-left: 20px;
        padding-right: 180px;
    }

@media (max-width: 768px) {
    .btn-get-location {
        position: relative;
        top: auto;
        left: auto;
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    #address {
        padding-left: 20px;
    }
    
    [dir="rtl"] #address {
        padding-right: 20px;
    }
}

/* Ensure footer is visible and matches main page - Light grey background */
/* Override inline styles from footer-03.blade.php */
footer.footer-area[style*="background"],
footer.footer-area {
    background: #F2F3F5 !important;
    color: #333333 !important;
    position: relative;
    z-index: 1;
}

footer.footer-area .footer-top[style*="background"],
footer.footer-area .footer-top {
    background: #F2F3F5 !important;
}

footer.footer-area .copyright-area[style*="background"],
footer.footer-area .copyright-area {
    background: #DDDDDD !important;
    border-top: 1px solid rgba(0, 0, 0, 0.1) !important;
}

footer.footer-area .widget-title {
    color: #333333 !important;
    font-weight: 700 !important;
}

footer.footer-area .footer-link-list a,
footer.footer-area .footer-link-list a[style*="color"],
footer.footer-area .footer-link-address a,
footer.footer-area .footer-link-address a[style*="color"],
footer.footer-area .footer-link-address span,
footer.footer-area .footer-link-address span[style*="color"],
footer.footer-area .footer-para,
footer.footer-area .footer-para[style*="color"] {
    color: #333333 !important;
}

footer.footer-area .footer-social-list a,
footer.footer-area .footer-social-list a[style*="background"] {
    background: #F2F3F5 !important;
    color: #333333 !important;
}

footer.footer-area .footer-link-list a:hover,
footer.footer-area .footer-link-address a:hover {
    color: #FFD700 !important;
}

footer.footer-area .footer-social-list a:hover {
    background: #FFD700 !important;
    color: #000000 !important;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

footer.footer-area .copyright-text,
footer.footer-area .copyright-text[style*="color"],
footer.footer-area .copyright-links,
footer.footer-area .copyright-links[style*="color"],
footer.footer-area .copyright-links a,
footer.footer-area .copyright-links a[style*="color"] {
    color: #666666 !important;
}

footer.footer-area .footer-link-list .list i,
footer.footer-area .footer-link-list .list i[style*="color"],
footer.footer-area .footer-link-address .list i,
footer.footer-area .footer-link-address .list i[style*="color"] {
    color: #FFD700 !important;
}

footer.footer-area .widget-title::after {
    background: #FFD700 !important;
}

/* Request Type Selection Styles */
.request-type-selection {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 2px solid rgba(0, 0, 0, 0.1);
}

.request-type-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.request-type-card {
    background: #FFFFFF;
    border: 3px solid rgba(0, 0, 0, 0.15);
    border-radius: 20px;
    padding: 30px 25px;
    text-align: center;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.request-type-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: #FFD700;
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.request-type-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    border-color: rgba(0, 0, 0, 0.3);
}

.request-type-card:hover::before {
    transform: scaleX(1);
}

.request-type-card.selected {
    border-color: #000000;
    background: #FFFFFF;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    transform: translateY(-8px) scale(1.02);
}

.request-type-card.selected::before {
    transform: scaleX(1);
    background: #000000;
}

.request-type-icon {
    width: 80px;
    height: 80px;
    background: rgba(0, 0, 0, 0.08);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    transition: all 0.4s ease;
}

.request-type-icon i {
    font-size: 40px;
    color: #000000;
    transition: all 0.3s ease;
}

.request-type-card:hover .request-type-icon {
    background: rgba(0, 0, 0, 0.12);
    transform: scale(1.1);
}

.request-type-card.selected .request-type-icon {
    background: #FFD700;
    transform: scale(1.15);
}

.request-type-card.selected .request-type-icon i {
    color: #000000;
    animation: iconPulse 1.5s ease-in-out infinite;
}

.request-type-title {
    font-size: 18px;
    font-weight: 700;
    color: #000000;
    margin: 0 0 12px 0;
    line-height: 1.4;
}

.request-type-description {
    font-size: 14px;
    color: #666;
    margin: 0;
    line-height: 1.6;
}

.request-type-card.selected .request-type-description {
    color: #333;
}

@media (max-width: 768px) {
    .request-type-cards {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .request-type-card {
        padding: 25px 20px;
    }
    
    .request-type-icon {
        width: 70px;
        height: 70px;
    }
    
    .request-type-icon i {
        font-size: 35px;
    }
    
    .request-type-title {
        font-size: 16px;
    }
    
    .request-type-description {
        font-size: 13px;
    }
}

/* Upload Options Tabs */
.upload-options-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}

.upload-tab-btn {
    padding: 12px 24px;
    background: transparent;
    border: none;
    border-bottom: 3px solid transparent;
    color: #666;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.upload-tab-btn:hover {
    color: #000;
    background: rgba(0, 0, 0, 0.05);
}

.upload-tab-btn.active {
    color: #000;
    border-bottom-color: #FFD700;
    background: rgba(255, 215, 0, 0.1);
}

.upload-tab-btn i {
    font-size: 18px;
}

.upload-tab-content {
    display: none;
}

.upload-tab-content.active {
    display: block;
}

/* Audio Recorder Styles */
.audio-recorder-wrapper {
    width: 100%;
}

.audio-recorder-container {
    background: #FFFFFF;
    border: 3px dashed rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.audio-recorder-container.recording {
    border-color: #dc3545;
    background: rgba(220, 53, 69, 0.05);
    animation: pulseRecording 2s ease-in-out infinite;
}

@keyframes pulseRecording {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
    }
}

.recorder-status {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 25px;
    font-size: 18px;
    font-weight: 600;
    color: #2d3748;
}

.recorder-status.recording {
    color: #dc3545;
}

.recorder-status.recording i {
    animation: pulseMic 1s ease-in-out infinite;
}

@keyframes pulseMic {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
}

.recorder-status i {
    font-size: 32px;
    color: #FFD700;
}

.recorder-status.recording i {
    color: #dc3545;
}

.recorder-controls {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.btn-record {
    padding: 14px 28px;
    background: #FFD700;
    color: #000000;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-record:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    background: #FFA500;
}

.btn-record:active {
    transform: translateY(0);
}

.btn-record.btn-stop {
    background: #dc3545;
    color: #fff;
}

.btn-record.btn-stop:hover {
    background: #c82333;
}

.btn-record.btn-save {
    background: #28a745;
    color: #fff;
}

.btn-record.btn-save:hover {
    background: #218838;
}

.btn-record i {
    font-size: 20px;
}

.recorder-timer {
    font-size: 32px;
    font-weight: 700;
    color: #dc3545;
    margin: 20px 0;
    font-family: 'Courier New', monospace;
}

.recorder-waveform {
    width: 100%;
    height: 100px;
    margin-top: 20px;
    background: rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    padding: 10px;
}

#waveform-canvas {
    width: 100%;
    height: 100%;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .upload-options-tabs {
        flex-direction: column;
        gap: 0;
    }
    
    .upload-tab-btn {
        width: 100%;
        justify-content: center;
        padding: 14px 20px;
    }
    
    .recorder-controls {
        flex-direction: column;
    }
    
    .btn-record {
        width: 100%;
        justify-content: center;
    }
    
    .audio-recorder-container {
        padding: 30px 20px;
    }
}
</style>

<script>
let currentStep = 1;
const totalSteps = 4;

document.addEventListener('DOMContentLoaded', function() {
    // Service card selection
    const serviceCards = document.querySelectorAll('.service-card');
    const serviceIdInput = document.getElementById('service_id');
    const nextButton = document.querySelector('.form-step[data-step="1"] .btn-next');
    
    // Auto-select service if preselectedServiceId is provided
    @if(isset($preselectedServiceId) && $preselectedServiceId)
        const preselectedServiceId = {{ $preselectedServiceId }};
        const preselectedCard = document.querySelector(`.service-card[data-service-id="${preselectedServiceId}"]`);
        if (preselectedCard) {
            // Simulate click on the preselected card
            preselectedCard.click();
            // Scroll to the selected service card
            setTimeout(() => {
                preselectedCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 300);
        }
    @endif
    
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            serviceCards.forEach(c => c.classList.remove('selected'));
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Set service ID
            const serviceId = this.getAttribute('data-service-id');
            const serviceName = this.getAttribute('data-service-name');
            serviceIdInput.value = serviceId;
            
            // Update service info display
            const serviceInfo = document.getElementById('selected-service-info');
            const serviceNameElement = document.getElementById('selected-service-name');
            if (serviceNameElement) {
                serviceNameElement.textContent = serviceName;
            }
            if (serviceInfo) {
                serviceInfo.style.display = 'block';
            }
            
            // Enable next button only after request type is selected
            if (nextButton) {
                nextButton.disabled = true; // Keep disabled until request type is selected
            }
        });
    });
    
    // Request type card selection
    const requestTypeCards = document.querySelectorAll('.request-type-card');
    const requestTypeInput = document.getElementById('request_type');
    const nextButtonStep1 = document.querySelector('.form-step[data-step="1"] .btn-next');
    const issueImageSection = document.getElementById('issue-image-section');
    
    requestTypeCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            requestTypeCards.forEach(c => c.classList.remove('selected'));
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Set request type
            const requestType = this.getAttribute('data-request-type');
            if (requestTypeInput) {
                requestTypeInput.value = requestType;
            }
            
            // Show/hide issue image section based on request type
            if (issueImageSection) {
                if (requestType === 'maintenance') {
                    issueImageSection.style.display = 'block';
                } else {
                    issueImageSection.style.display = 'none';
                    // Clear file input if not maintenance
                    const issueImageInput = document.getElementById('issue_image');
                    if (issueImageInput) {
                        issueImageInput.value = '';
                        removeFileStep1();
                    }
                }
            }
            
            // Enable next button
            if (nextButtonStep1) {
                nextButtonStep1.disabled = false;
            }
        });
    });
    
    // Camera upload drag and drop
    setupCameraUpload();
    
    // GPS Location functionality
    setupGPSLocation();
    
    // Form validation on step change
    setupFormValidation();
});

function setupCameraUpload() {
    const cameraLabel = document.getElementById('camera-upload-label');
    const cameraInput = document.getElementById('issue_image');
    
    if (!cameraLabel || !cameraInput) return;
    
    // Drag and drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        cameraLabel.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        cameraLabel.addEventListener(eventName, () => {
            cameraLabel.classList.add('drag-over');
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        cameraLabel.addEventListener(eventName, () => {
            cameraLabel.classList.remove('drag-over');
        }, false);
    });
    
    cameraLabel.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            cameraInput.files = files;
            previewFile(cameraInput);
        }
    }, false);
    
    // Update label when file is selected
    cameraInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            cameraLabel.classList.add('has-file');
        } else {
            cameraLabel.classList.remove('has-file');
        }
    });
}

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            // Update summary before moving to step 4
            if (currentStep === 3) {
                updateSummary();
            }
            
            // Hide current step
            document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
            
            // Update progress
            updateProgress(currentStep, false);
            
            currentStep++;
            
            // Show next step
            document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
            
            // Update progress
            updateProgress(currentStep, true);
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        // Hide current step
        document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
        
        // Update progress
        updateProgress(currentStep, false);
        
        currentStep--;
        
        // Show previous step
        document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
        
        // Update progress
        updateProgress(currentStep, true);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function updateProgress(step, isActive) {
    const stepItem = document.querySelector(`.step-item[data-step="${step}"]`);
    if (stepItem) {
        if (isActive) {
            stepItem.classList.add('active');
            // Mark previous steps as completed
            for (let i = 1; i < step; i++) {
                const prevStepItem = document.querySelector(`.step-item[data-step="${i}"]`);
                if (prevStepItem) {
                    prevStepItem.classList.remove('active');
                    prevStepItem.classList.add('completed');
                }
            }
        } else {
            stepItem.classList.remove('active');
        }
    }
}

function validateCurrentStep() {
    const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
    const requiredFields = currentStepElement.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
            field.style.borderColor = '#dc3545';
        } else {
            field.classList.remove('error');
            field.style.borderColor = '';
        }
    });
    
    // Special validation for step 1 (service selection and request type)
    if (currentStep === 1) {
        const serviceId = document.getElementById('service_id').value;
        const requestType = document.getElementById('request_type').value;
        
        if (!serviceId) {
            isValid = false;
            alert('{{__("Please select a service")}}');
        }
        
        if (!requestType) {
            isValid = false;
            alert('{{__("Please select a request type")}}');
        }
    }
    
    if (!isValid) {
        alert('{{__("Please fill in all required fields")}}');
    }
    
    return isValid;
}

function setupFormValidation() {
    const form = document.getElementById('qr-request-form');
    form.addEventListener('submit', function(e) {
        if (!validateCurrentStep()) {
            e.preventDefault();
            return false;
        }
    });
}

function updateSummary() {
    // Service
    const serviceId = document.getElementById('service_id').value;
    const selectedCard = document.querySelector('.service-card.selected');
    if (selectedCard) {
        document.getElementById('summary-service-name').textContent = selectedCard.getAttribute('data-service-name');
    }
    
    // Customer info
    document.getElementById('summary-name').textContent = document.querySelector('input[name="name"]').value || '-';
    document.getElementById('summary-email').textContent = document.querySelector('input[name="email"]').value || '-';
    document.getElementById('summary-phone').textContent = document.querySelector('input[name="phone"]').value || '-';
    document.getElementById('summary-address').textContent = document.querySelector('textarea[name="address"]').value || '-';
    
    // Service details
    const urgencySelect = document.querySelector('select[name="urgency_level"]');
    const urgencyText = urgencySelect.options[urgencySelect.selectedIndex].text;
    document.getElementById('summary-urgency').textContent = urgencyText || '-';
    
    const preferredDate = document.querySelector('input[name="preferred_date"]').value;
    document.getElementById('summary-date').textContent = preferredDate || '-';
}

// Preview file function - works for both step 1 and other steps
function previewFile(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 500 * 1024 * 1024; // 500MB
        const previewContainer = document.getElementById('file-preview-step1');
        const previewContent = document.getElementById('preview-content-step1');
        
        if (!previewContainer || !previewContent) {
            // Fallback to old preview if step1 elements don't exist
            const oldPreviewContainer = document.getElementById('file-preview');
            const oldPreviewContent = document.getElementById('preview-content');
            if (oldPreviewContainer && oldPreviewContent) {
                handleFilePreview(file, maxSize, oldPreviewContainer, oldPreviewContent, input);
            }
            return;
        }
        
        handleFilePreview(file, maxSize, previewContainer, previewContent, input);
    }
}

// Switch between upload and record tabs
function switchUploadTab(tab) {
    const uploadTab = document.getElementById('upload-tab');
    const recordTab = document.getElementById('record-tab');
    const uploadBtn = document.querySelector('.upload-tab-btn[data-tab="upload"]');
    const recordBtn = document.querySelector('.upload-tab-btn[data-tab="record"]');
    
    if (tab === 'upload') {
        uploadTab.classList.add('active');
        recordTab.classList.remove('active');
        uploadBtn.classList.add('active');
        recordBtn.classList.remove('active');
    } else {
        uploadTab.classList.remove('active');
        recordTab.classList.add('active');
        uploadBtn.classList.remove('active');
        recordBtn.classList.add('active');
    }
}

// Audio Recording Variables
let mediaRecorder = null;
let audioChunks = [];
let recordingStartTime = null;
let timerInterval = null;
let audioStream = null;
let audioContext = null;
let analyser = null;
let dataArray = null;
let canvasContext = null;

// Start audio recording
async function startRecording() {
    try {
        // Request microphone access
        audioStream = await navigator.mediaDevices.getUserMedia({ audio: true });
        
        // Create MediaRecorder
        mediaRecorder = new MediaRecorder(audioStream);
        audioChunks = [];
        
        // Setup audio visualization
        setupAudioVisualization(audioStream);
        
        // Start recording
        mediaRecorder.start();
        recordingStartTime = Date.now();
        
        // Update UI
        document.getElementById('btn-start-record').style.display = 'none';
        document.getElementById('btn-stop-record').style.display = 'inline-flex';
        document.getElementById('recorder-status').classList.add('recording');
        document.getElementById('recorder-status-text').textContent = '{{__("جاري التسجيل...")}}';
        document.getElementById('recorder-timer').style.display = 'block';
        document.getElementById('recorder-waveform').style.display = 'block';
        document.querySelector('.audio-recorder-container').classList.add('recording');
        
        // Start timer
        startTimer();
        
        // Handle data available
        mediaRecorder.ondataavailable = (event) => {
            if (event.data.size > 0) {
                audioChunks.push(event.data);
            }
        };
        
        // Handle stop
        mediaRecorder.onstop = () => {
            stopAudioVisualization();
        };
        
    } catch (error) {
        console.error('Error starting recording:', error);
        alert('{{__("خطأ في الوصول للميكروفون. يرجى التأكد من السماح بالوصول للميكروفون.")}}');
    }
}

// Stop audio recording
function stopRecording() {
    if (mediaRecorder && mediaRecorder.state !== 'inactive') {
        mediaRecorder.stop();
        stopTimer();
        
        // Stop all tracks
        if (audioStream) {
            audioStream.getTracks().forEach(track => track.stop());
        }
        
        // Update UI
        document.getElementById('btn-stop-record').style.display = 'none';
        document.getElementById('btn-save-record').style.display = 'inline-flex';
        document.getElementById('recorder-status').classList.remove('recording');
        document.getElementById('recorder-status-text').textContent = '{{__("تم إيقاف التسجيل")}}';
        document.querySelector('.audio-recorder-container').classList.remove('recording');
    }
}

// Save audio recording
function saveRecording() {
    if (audioChunks.length === 0) {
        alert('{{__("لا يوجد تسجيل لحفظه")}}');
        return;
    }
    
    // Create blob from chunks
    const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
    
    // Create file from blob
    const audioFile = new File([audioBlob], 'recording_' + Date.now() + '.webm', { type: 'audio/webm' });
    
    // Create a FileList-like object and assign to input
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(audioFile);
    const issueImageInput = document.getElementById('issue_image');
    issueImageInput.files = dataTransfer.files;
    
    // Preview audio
    const audioUrl = URL.createObjectURL(audioBlob);
    const audioPreviewContainer = document.getElementById('audio-preview-container');
    const audioPreviewPlayer = document.getElementById('audio-preview-player');
    
    audioPreviewPlayer.src = audioUrl;
    audioPreviewContainer.style.display = 'block';
    
    // Update UI
    document.getElementById('btn-save-record').style.display = 'none';
    document.getElementById('btn-start-record').style.display = 'inline-flex';
    document.getElementById('recorder-status-text').textContent = '{{__("تم حفظ التسجيل")}}';
    document.getElementById('recorder-timer').style.display = 'none';
    document.getElementById('recorder-waveform').style.display = 'none';
    
    // Switch to upload tab to show preview
    switchUploadTab('upload');
    
    // Trigger preview
    previewFile(issueImageInput);
}

// Remove audio recording
function removeAudioRecording() {
    audioChunks = [];
    mediaRecorder = null;
    
    const issueImageInput = document.getElementById('issue_image');
    issueImageInput.value = '';
    
    const audioPreviewContainer = document.getElementById('audio-preview-container');
    const audioPreviewPlayer = document.getElementById('audio-preview-player');
    
    if (audioPreviewPlayer.src) {
        URL.revokeObjectURL(audioPreviewPlayer.src);
        audioPreviewPlayer.src = '';
    }
    
    audioPreviewContainer.style.display = 'none';
    
    // Reset UI
    document.getElementById('btn-start-record').style.display = 'inline-flex';
    document.getElementById('btn-stop-record').style.display = 'none';
    document.getElementById('btn-save-record').style.display = 'none';
    document.getElementById('recorder-status').classList.remove('recording');
    document.getElementById('recorder-status-text').textContent = '{{__("جاهز للتسجيل")}}';
    document.getElementById('recorder-timer').style.display = 'none';
    document.getElementById('recorder-waveform').style.display = 'none';
    document.querySelector('.audio-recorder-container').classList.remove('recording');
    
    removeFileStep1();
}

// Start timer
function startTimer() {
    recordingStartTime = Date.now();
    timerInterval = setInterval(() => {
        const elapsed = Math.floor((Date.now() - recordingStartTime) / 1000);
        const minutes = Math.floor(elapsed / 60);
        const seconds = elapsed % 60;
        document.getElementById('timer-display').textContent = 
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
    }, 1000);
}

// Stop timer
function stopTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
    }
}

// Setup audio visualization
function setupAudioVisualization(stream) {
    try {
        audioContext = new (window.AudioContext || window.webkitAudioContext)();
        analyser = audioContext.createAnalyser();
        const source = audioContext.createMediaStreamSource(stream);
        source.connect(analyser);
        
        analyser.fftSize = 256;
        const bufferLength = analyser.frequencyBinCount;
        dataArray = new Uint8Array(bufferLength);
        
        const canvas = document.getElementById('waveform-canvas');
        canvasContext = canvas.getContext('2d');
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
        
        drawWaveform();
    } catch (error) {
        console.error('Error setting up visualization:', error);
    }
}

// Draw waveform
function drawWaveform() {
    if (!analyser || !canvasContext) return;
    
    requestAnimationFrame(drawWaveform);
    
    analyser.getByteFrequencyData(dataArray);
    
    canvasContext.fillStyle = 'rgba(255, 255, 255, 1)';
    canvasContext.fillRect(0, 0, canvasContext.canvas.width, canvasContext.canvas.height);
    
    const barWidth = (canvasContext.canvas.width / dataArray.length) * 2.5;
    let barHeight;
    let x = 0;
    
    for (let i = 0; i < dataArray.length; i++) {
        barHeight = (dataArray[i] / 255) * canvasContext.canvas.height;
        
        canvasContext.fillStyle = `rgb(${255 - dataArray[i]}, ${dataArray[i]}, 50)`;
        canvasContext.fillRect(x, canvasContext.canvas.height - barHeight, barWidth, barHeight);
        
        x += barWidth + 1;
    }
}

// Stop audio visualization
function stopAudioVisualization() {
    if (audioContext) {
        audioContext.close();
        audioContext = null;
    }
    analyser = null;
    dataArray = null;
    canvasContext = null;
}

function handleFilePreview(file, maxSize, previewContainer, previewContent, input) {
    if (file.size > maxSize) {
        alert('{{__("File size must be less than 500MB")}}');
        input.value = '';
        const cameraLabel = document.getElementById('camera-upload-label');
        if (cameraLabel) {
            cameraLabel.classList.remove('has-file');
        }
        return;
    }
    
    // Clear previous preview
    previewContent.innerHTML = '';
    
    // Check file type
    const fileType = file.type;
    const fileName = file.name;
    const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
    
    // Update camera label
    const cameraLabel = document.getElementById('camera-upload-label');
    if (cameraLabel) {
        cameraLabel.classList.add('has-file');
    }
    
    if (fileType.startsWith('image/')) {
        // Image preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContent.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 400px; border-radius: 10px; border: 2px solid #e0e0e0; display: block; margin: 0 auto;">
                <p style="margin-top: 15px; margin-bottom: 0; font-size: 14px; color: #4a5568;"><strong>${fileName}</strong> (${fileSize})</p>
            `;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else if (fileType.startsWith('video/')) {
        // Video preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContent.innerHTML = `
                <video controls style="max-width: 100%; max-height: 400px; border-radius: 10px; border: 2px solid #e0e0e0; display: block; margin: 0 auto;">
                    <source src="${e.target.result}" type="${fileType}">
                    {{__('Your browser does not support the video tag.')}}
                </video>
                <p style="margin-top: 15px; margin-bottom: 0; font-size: 14px; color: #4a5568;"><strong>${fileName}</strong> (${fileSize})</p>
            `;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else if (fileType.startsWith('audio/')) {
        // Audio preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContent.innerHTML = `
                <div style="padding: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 10px; border: 2px solid #e0e0e0; text-align: center;">
                    <i class="las la-volume-up" style="font-size: 64px; color: #FFD700; margin-bottom: 15px;"></i>
                    <audio controls style="width: 100%; margin-top: 15px;">
                        <source src="${e.target.result}" type="${fileType}">
                        {{__('Your browser does not support the audio tag.')}}
                    </audio>
                    <p style="margin-top: 15px; margin-bottom: 0; font-size: 14px; color: #4a5568;"><strong>${fileName}</strong> (${fileSize})</p>
                </div>
            `;
            previewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        // Other file types - show file info only
        previewContent.innerHTML = `
            <div style="padding: 30px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 10px; border: 2px solid #e0e0e0; text-align: center;">
                <i class="las la-file" style="font-size: 64px; color: #FF6B2C; margin-bottom: 15px;"></i>
                <p style="margin: 10px 0; font-size: 16px; font-weight: 600; color: #2d3748;"><strong>${fileName}</strong></p>
                <p style="margin: 0; font-size: 14px; color: #718096;">${fileSize}</p>
            </div>
        `;
        previewContainer.style.display = 'block';
    }
}

function removeFileStep1() {
    const issueImageInput = document.getElementById('issue_image');
    if (issueImageInput) {
        issueImageInput.value = '';
    }
    const previewContent = document.getElementById('preview-content-step1');
    const previewContainer = document.getElementById('file-preview-step1');
    const cameraLabel = document.getElementById('camera-upload-label');
    
    if (previewContent) {
        previewContent.innerHTML = '';
    }
    if (previewContainer) {
        previewContainer.style.display = 'none';
    }
    if (cameraLabel) {
        cameraLabel.classList.remove('has-file');
    }
}

// Leaflet Map initialization (Free, no API key needed)
let map;
let marker;
let userLocation = null;

function showMapError(message) {
    const loadingElement = document.getElementById('map-loading');
    if (loadingElement) {
        loadingElement.innerHTML = '<div style="text-align: center; padding: 30px 20px;"><i class="las la-exclamation-triangle" style="font-size: 48px; color: #dc3545; margin-bottom: 15px;"></i><p style="color: #dc3545; font-size: 18px; font-weight: 600; margin-bottom: 10px;">{{__("عفوًا، حدث خطأ.")}}</p><p style="color: #666; font-size: 14px; line-height: 1.6;">' + message + '</p></div>';
    }
}

function initGoogleMap() {
    console.log('Initializing Leaflet Map...');
    
    try {
        const mapElement = document.getElementById('location-map');
        const loadingElement = document.getElementById('map-loading');
        
        if (!mapElement) {
            console.error('Map element not found');
            showMapError('{{__("عنصر الخريطة غير موجود.")}}');
            return;
        }
        
        // Check if Leaflet is loaded
        if (typeof L === 'undefined') {
            showMapError('{{__("جاري تحميل مكتبة الخريطة...")}}');
            // Wait a bit and try again
            setTimeout(initGoogleMap, 500);
            return;
        }
        
        // Hide loading
        if (loadingElement) {
            loadingElement.style.display = 'none';
        }
        
        // Default center (will be updated with user location)
        const defaultCenter = [21.4858, 39.1925]; // Makkah, Saudi Arabia
        
        console.log('Creating Leaflet Map...');
        // Initialize map
        map = L.map('location-map', {
            center: defaultCenter,
            zoom: 15,
            zoomControl: true
        });
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);
        
        console.log('Map created successfully');
        
        // Create custom red marker icon
        const redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        
        // Create draggable marker
        marker = L.marker(defaultCenter, {
            draggable: true,
            icon: redIcon
        }).addTo(map);
        
        // Update address when marker is dragged
        marker.on('dragend', function() {
            updateAddressFromMarker();
        });
        
        // Update address when map is clicked
        map.on('click', function(event) {
            marker.setLatLng(event.latlng);
            updateAddressFromMarker();
        });
        
        // Get user location automatically
        getCurrentLocation();
    } catch (error) {
        console.error('Error in initMap:', error);
        showMapError('{{__("خطأ في تهيئة الخريطة. يرجى تحديث الصفحة.")}}');
    }
}

function getCurrentLocation() {
    const locationStatus = document.getElementById('location-status');
    
    if (!navigator.geolocation) {
        if (locationStatus) {
            locationStatus.innerHTML = '<span style="color: #dc3545;"><i class="las la-exclamation-circle"></i> {{__("المتصفح لا يدعم تحديد الموقع الجغرافي")}}</span>';
        }
        return;
    }
    
    if (locationStatus) {
        locationStatus.innerHTML = '<span style="color: #FFD700;"><i class="las la-spinner la-spin"></i> {{__("جاري اكتشاف موقعك...")}}</span>';
    }
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            
            userLocation = { lat: latitude, lng: longitude };
            
            // Center map on user location
            if (map) {
                map.setView([userLocation.lat, userLocation.lng], 17);
            }
            
            // Set marker position
            if (marker) {
                marker.setLatLng([userLocation.lat, userLocation.lng]);
            }
            
            // Get address
            updateAddressFromMarker();
            
            if (locationStatus) {
                locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("تم اكتشاف الموقع! يمكنك سحب العلامة لتعديل موقعك الدقيق.")}}</span>';
            }
        },
        function(error) {
            let errorMessage = '{{__("خطأ في الحصول على الموقع")}}';
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = '{{__("تم رفض الوصول للموقع. يرجى تفعيل صلاحيات الموقع أو النقر على الخريطة لتحديد موقعك.")}}';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = '{{__("معلومات الموقع غير متاحة. يرجى النقر على الخريطة لتحديد موقعك.")}}';
                    break;
                case error.TIMEOUT:
                    errorMessage = '{{__("انتهت مهلة طلب الموقع. يرجى النقر على الخريطة لتحديد موقعك.")}}';
                    break;
            }
            if (locationStatus) {
                locationStatus.innerHTML = '<span style="color: #dc3545;"><i class="las la-exclamation-circle"></i> ' + errorMessage + '</span>';
            }
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

function updateAddressFromMarker() {
    if (!marker) return;
    
    const locationStatus = document.getElementById('location-status');
    const latlng = marker.getLatLng();
    const lat = latlng.lat;
    const lng = latlng.lng;
    
    // Update hidden fields
    const latField = document.getElementById('latitude');
    const lngField = document.getElementById('longitude');
    const addressField = document.getElementById('address');
    
    if (latField) latField.value = lat;
    if (lngField) lngField.value = lng;
    
    // Get address from coordinates using Nominatim (OpenStreetMap geocoding - free) - silently in background
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language={{app()->getLocale()}}`)
        .then(response => response.json())
        .then(data => {
            if (data && data.display_name) {
                if (addressField) addressField.value = data.display_name;
                // Update status silently without showing loading message
                if (locationStatus) {
                    const locationSelectedText = '{{__("تم تحديد الموقع!")}}';
                    locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> ' + locationSelectedText + '</span>';
                }
            } else {
                const addressText = lat.toFixed(6) + ', ' + lng.toFixed(6);
                if (addressField) addressField.value = addressText;
                if (locationStatus) {
                    const locationSelectedText = '{{__("تم تحديد الموقع!")}}';
                    locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> ' + locationSelectedText + '</span>';
                }
            }
        })
        .catch(error => {
            console.error('Error getting address:', error);
            const addressText = lat.toFixed(6) + ', ' + lng.toFixed(6);
            if (addressField) addressField.value = addressText;
            if (locationStatus) {
                const locationSelectedText = '{{__("تم تحديد الموقع!")}}';
                locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> ' + locationSelectedText + '</span>';
            }
        });
}

function setupGPSLocation() {
    console.log('Setting up GPS Location...');
    // Initialize map when step 2 is shown
    const step2Observer = new MutationObserver(function(mutations) {
        const step2 = document.querySelector('.form-step[data-step="2"]');
        if (step2 && step2.classList.contains('active')) {
            console.log('Step 2 is active, initializing map...');
            // Initialize map if not already initialized
            if (!map) {
                setTimeout(function() {
                    console.log('Calling initGoogleMap...');
                    initGoogleMap();
                }, 500);
            } else {
                console.log('Map already initialized');
            }
        }
    });
    
    const formWrapper = document.querySelector('.request-form-wrapper');
    if (formWrapper) {
        step2Observer.observe(formWrapper, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class']
        });
        
        // Also check immediately if step 2 is already active
        const step2 = document.querySelector('.form-step[data-step="2"]');
        if (step2 && step2.classList.contains('active')) {
            console.log('Step 2 already active on page load');
            setTimeout(function() {
                initGoogleMap();
            }, 500);
        }
    } else {
        console.error('Form wrapper not found');
    }
}

// Old GPS location code - kept for reference but not used
function oldSetupGPSLocation() {
    const getLocationBtn = document.getElementById('get-location-btn');
    const addressField = document.getElementById('address');
    const locationStatus = document.getElementById('location-status');
    
    if (!getLocationBtn || !addressField) return;
    
    getLocationBtn.addEventListener('click', function() {
        if (!navigator.geolocation) {
            locationStatus.innerHTML = '<span style="color: #dc3545;">{{__("Geolocation is not supported by your browser")}}</span>';
            return;
        }
        
        // Show loading state
        getLocationBtn.disabled = true;
        getLocationBtn.innerHTML = '<i class="las la-spinner la-spin"></i> <span>{{__("Getting location...")}}</span>';
        locationStatus.innerHTML = '<span style="color: #FFD700;">{{__("Please allow location access...")}}</span>';
        
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                locationStatus.innerHTML = '<span style="color: #FFD700;">{{__("Getting address...")}}</span>';
                
                // Use Google Geocoding API to get address
                const apiKey = '{{get_static_option("service_google_map_api_key")}}';
                if (!apiKey) {
                    // Fallback: use OpenStreetMap Nominatim API (free, no key required)
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.display_name) {
                                addressField.value = data.display_name;
                                addressField.removeAttribute('readonly');
                                locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("تم اكتشاف الموقع بنجاح!")}}</span>';
                            } else {
                                addressField.value = `${latitude}, ${longitude}`;
                                addressField.removeAttribute('readonly');
                                locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("تم اكتشاف الموقع! يمكنك تعديل العنوان إذا لزم الأمر.")}}</span>';
                            }
                            getLocationBtn.disabled = false;
                            getLocationBtn.innerHTML = '<i class="las la-map-marker-alt"></i> <span>{{__("Get My Location")}}</span>';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            addressField.value = `${latitude}, ${longitude}`;
                            addressField.removeAttribute('readonly');
                            locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected! You can edit the address if needed.")}}</span>';
                            getLocationBtn.disabled = false;
                            getLocationBtn.innerHTML = '<i class="las la-map-marker-alt"></i> <span>{{__("Get My Location")}}</span>';
                        });
                } else {
                    // Use Google Geocoding API
                    fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}&language={{app()->getLocale()}}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'OK' && data.results && data.results.length > 0) {
                                addressField.value = data.results[0].formatted_address;
                                addressField.removeAttribute('readonly');
                                locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("تم اكتشاف الموقع بنجاح!")}}</span>';
                            } else {
                                addressField.value = `${latitude}, ${longitude}`;
                                addressField.removeAttribute('readonly');
                                locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("تم اكتشاف الموقع! يمكنك تعديل العنوان إذا لزم الأمر.")}}</span>';
                            }
                            getLocationBtn.disabled = false;
                            getLocationBtn.innerHTML = '<i class="las la-map-marker-alt"></i> <span>{{__("Get My Location")}}</span>';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            addressField.value = `${latitude}, ${longitude}`;
                            addressField.removeAttribute('readonly');
                            locationStatus.innerHTML = '<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected! You can edit the address if needed.")}}</span>';
                            getLocationBtn.disabled = false;
                            getLocationBtn.innerHTML = '<i class="las la-map-marker-alt"></i> <span>{{__("Get My Location")}}</span>';
                        });
                }
            },
            function(error) {
                let errorMessage = '{{__("خطأ في الحصول على الموقع")}}';
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = '{{__("Location access denied. Please enable location permissions.")}}';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = '{{__("Location information unavailable.")}}';
                        break;
                    case error.TIMEOUT:
                        errorMessage = '{{__("Location request timed out.")}}';
                        break;
                }
                locationStatus.innerHTML = `<span style="color: #dc3545;"><i class="las la-exclamation-circle"></i> ${errorMessage}</span>`;
                getLocationBtn.disabled = false;
                getLocationBtn.innerHTML = '<i class="las la-map-marker-alt"></i> <span>{{__("Get My Location")}}</span>';
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    });
    
    // Auto-detect location when step 2 is shown
    const step2Observer = new MutationObserver(function(mutations) {
        const step2 = document.querySelector('.form-step[data-step="2"]');
        if (step2 && step2.classList.contains('active') && !addressField.value) {
            // Auto-trigger location detection
            setTimeout(() => {
                if (!addressField.value) {
                    getLocationBtn.click();
                }
            }, 500);
        }
    });
    
    const formWrapper = document.querySelector('.request-form-wrapper');
    if (formWrapper) {
        step2Observer.observe(formWrapper, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class']
        });
    }
    
    // Override footer inline styles to match main page colors
    function updateFooterStyles() {
        const footer = document.querySelector('footer.footer-area');
        if (footer) {
            footer.style.setProperty('background', '#F2F3F5', 'important');
            footer.style.setProperty('color', '#333333', 'important');
        }
        
        const footerTop = document.querySelector('.footer-top');
        if (footerTop) {
            footerTop.style.setProperty('background', '#F2F3F5', 'important');
        }
        
        const copyrightArea = document.querySelector('.copyright-area');
        if (copyrightArea) {
            copyrightArea.style.setProperty('background', '#DDDDDD', 'important');
            copyrightArea.style.setProperty('border-top', '1px solid rgba(0, 0, 0, 0.1)', 'important');
        }
        
        // Update text colors
        const footerLinks = document.querySelectorAll('.footer-link-list a, .footer-link-address a, .footer-link-address span, .footer-para');
        footerLinks.forEach(link => {
            if (link.tagName === 'A' || link.tagName === 'SPAN' || link.classList.contains('footer-para')) {
                link.style.setProperty('color', '#333333', 'important');
            }
        });
        
        // Update widget titles
        const widgetTitles = document.querySelectorAll('.footer-area .widget-title');
        widgetTitles.forEach(title => {
            title.style.setProperty('color', '#333333', 'important');
        });
        
        // Update copyright text
        const copyrightTexts = document.querySelectorAll('.copyright-text, .copyright-links, .copyright-links a');
        copyrightTexts.forEach(text => {
            text.style.setProperty('color', '#666666', 'important');
        });
        
        // Update social icons background - light grey background with dark icons
        const socialIcons = document.querySelectorAll('.footer-social-list a, .footer-social-list .lists a');
        socialIcons.forEach(icon => {
            icon.style.setProperty('background', '#F2F3F5', 'important');
            icon.style.setProperty('color', '#333333', 'important');
        });
        
        // Update icons color
        const icons = document.querySelectorAll('.footer-link-list .list i, .footer-link-address .list i');
        icons.forEach(icon => {
            icon.style.setProperty('color', '#FFD700', 'important');
        });
    }
    
    // Run on page load
    updateFooterStyles();
    
    // Also run after a short delay to ensure footer is loaded
    setTimeout(updateFooterStyles, 500);
    setTimeout(updateFooterStyles, 1000);
}
</script>
@endsection
