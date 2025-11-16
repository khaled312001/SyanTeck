

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Request Maintenance Service')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
<?php echo e(__('Request Maintenance Service')); ?> - <?php echo e(get_static_option('site_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
<?php echo render_site_title(__('Request Maintenance Service')); ?>

<meta name="description" content="<?php echo e(__('Request maintenance service quickly and easily through our platform')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- QR Request Page -->
<section class="qr-request-area enhanced-qr-section padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="qr-request-wrapper enhanced-qr-wrapper">
                    <!-- Header Section -->
                    <div class="request-header text-center margin-bottom-50">
                        <div class="qr-icon-wrapper margin-bottom-30">
                            <div class="qr-icon-circle">
                                <i class="las la-qrcode"></i>
                            </div>
                            <div class="qr-pulse-ring"></div>
                        </div>
                        <h1 class="request-title"><?php echo e(__('Request Maintenance Service')); ?></h1>
                        <p class="request-subtitle"><?php echo e(__('Fill out the form below to request a maintenance service. Our team will contact you shortly.')); ?></p>
                        <div class="request-badges mt-4">
                            <span class="badge-item"><i class="las la-clock"></i> <?php echo e(__('Quick Response')); ?></span>
                            <span class="badge-item"><i class="las la-shield-alt"></i> <?php echo e(__('Secure')); ?></span>
                            <span class="badge-item"><i class="las la-headset"></i> <?php echo e(__('24/7 Support')); ?></span>
                        </div>
                    </div>

                    <!-- Request Form -->
                    <div class="request-form-wrapper">
                        <form action="<?php echo e(route('qr.store')); ?>" method="POST" id="qr-request-form" class="request-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                            <!-- Service Selection -->
                            <div class="form-section margin-bottom-40">
                                <h3 class="section-title">
                                    <i class="las la-tools"></i>
                                    <?php echo e(__('Select Service')); ?>

                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Service Category')); ?> <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value=""><?php echo e(__('Select Category')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Service')); ?> <span class="text-danger">*</span></label>
                                        <select name="service_id" id="service_id" class="form-control" required>
                                            <option value=""><?php echo e(__('Select Service')); ?></option>
                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->id); ?>" data-category="<?php echo e($service->category_id); ?>">
                                                <?php echo e($service->title); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <small class="form-text text-muted"><?php echo e(__('The technician will determine the price after inspection')); ?></small>
                                    </div>
                                </div>
                                
                                <div class="selected-service-info margin-top-20" id="selected-service-info" style="display: none;">
                                    <div class="alert alert-info">
                                        <div>
                                            <strong id="selected-service-name"></strong>
                                            <p class="mb-0 mt-2"><?php echo e(__('The technician will determine the price after inspecting the issue or installation.')); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Information -->
                            <div class="form-section margin-bottom-40">
                                <h3 class="section-title">
                                    <i class="las la-user"></i>
                                    <?php echo e(__('Customer Information')); ?>

                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Full Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required placeholder="<?php echo e(__('Enter your full name')); ?>">
                                    </div>
                                    
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Email')); ?> <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" required placeholder="<?php echo e(__('Enter your email')); ?>">
                                    </div>
                                    
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Phone Number')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" required placeholder="<?php echo e(__('Enter your phone number')); ?>">
                                    </div>
                                    
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Region')); ?></label>
                                        <select name="region_id" id="region_id" class="form-control">
                                            <option value=""><?php echo e(__('Select Region')); ?></option>
                                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $regionName = (app()->getLocale() == 'ar' && !empty($region->name_ar)) ? $region->name_ar : $region->name;
                                                ?>
                                                <option value="<?php echo e($region->id); ?>"><?php echo e($regionName); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Address')); ?> <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control" rows="3" required placeholder="<?php echo e(__('Enter your full address')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Details -->
                            <div class="form-section margin-bottom-40">
                                <h3 class="section-title">
                                    <i class="las la-info-circle"></i>
                                    <?php echo e(__('Service Details')); ?>

                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Urgency Level')); ?> <span class="text-danger">*</span></label>
                                        <select name="urgency_level" class="form-control" required>
                                            <option value="normal"><?php echo e(__('Normal')); ?> - <?php echo e(__('Within 24 hours')); ?></option>
                                            <option value="urgent"><?php echo e(__('Urgent')); ?> - <?php echo e(__('Within 6 hours')); ?></option>
                                            <option value="emergency"><?php echo e(__('Emergency')); ?> - <?php echo e(__('Immediate')); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Preferred Date')); ?></label>
                                        <input type="date" name="preferred_date" class="form-control" min="<?php echo e(date('Y-m-d')); ?>">
                                    </div>
                                    
                                    <div class="col-12 margin-bottom-20">
                                        <label class="form-label"><?php echo e(__('Additional Notes')); ?></label>
                                        <textarea name="order_note" class="form-control" rows="4" placeholder="<?php echo e(__('Describe the issue or any additional information')); ?>"></textarea>
                                    </div>
                                    
                                    <div class="col-12 margin-bottom-20">
                                        <label class="form-label">
                                            <i class="las la-file-upload"></i>
                                            <?php echo e(__('Issue Image')); ?> <small class="text-muted">(<?php echo e(__('Optional')); ?>)</small>
                                        </label>
                                        <div class="image-upload-wrapper">
                                            <input type="file" name="issue_image" id="issue_image" class="form-control-file" accept="*/*" onchange="previewFile(this)">
                                            <small class="form-text text-muted"><?php echo e(__('Upload a photo, video, or file of the issue or problem (Max: 500MB, Any format)')); ?></small>
                                            <div id="file-preview" class="file-preview-container" style="display: none; margin-top: 15px;">
                                                <div id="preview-content"></div>
                                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeFile()">
                                                    <i class="las la-times"></i> <?php echo e(__('Remove File')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Summary Section -->
                            <div class="form-section margin-bottom-40">
                                <div class="order-summary">
                                    <h3 class="section-title">
                                        <i class="las la-info-circle"></i>
                                        <?php echo e(__('Important Information')); ?>

                                    </h3>
                                    <div class="summary-content">
                                        <div class="alert alert-warning mb-0">
                                            <i class="las la-exclamation-triangle"></i>
                                            <strong><?php echo e(__('Price Information')); ?>:</strong>
                                            <p class="mb-0 mt-2"><?php echo e(__('The technician will inspect the issue or installation and determine the final price. You will be notified of the price before any work begins.')); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-submit-section text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-request">
                                    <i class="las la-paper-plane"></i>
                                    <?php echo e(__('Submit Request')); ?>

                                </button>
                                <p class="form-note margin-top-20">
                                    <?php echo e(__('By submitting this form, you agree to our terms and conditions. Our team will contact you within 30 minutes.')); ?>

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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 80px 0;
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
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
    z-index: 0;
}

.enhanced-qr-wrapper {
    background: #fff;
    border-radius: 25px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    padding: 60px;
    position: relative;
    z-index: 1;
    backdrop-filter: blur(10px);
}

.request-header {
    padding-bottom: 30px;
    border-bottom: 2px solid #f0f0f0;
}

.qr-icon-wrapper {
    position: relative;
    display: inline-block;
    margin: 0 auto;
}

.qr-icon-circle {
    width: 140px;
    height: 140px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
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
    border: 3px solid rgba(102, 126, 234, 0.5);
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
    background: rgba(102, 126, 234, 0.1);
    border-radius: 25px;
    color: #667eea;
    font-weight: 600;
    font-size: 14px;
    border: 2px solid rgba(102, 126, 234, 0.2);
}

.request-title {
    font-size: 42px;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 25px 0 15px;
    line-height: 1.2;
}

.request-subtitle {
    font-size: 18px;
    color: #666;
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.7;
}

.form-section {
    padding: 35px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 15px;
    margin-bottom: 30px;
    border: 1px solid rgba(102, 126, 234, 0.1);
    transition: all 0.3s ease;
}

.form-section:hover {
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.section-title {
    font-size: 22px;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-title i {
    font-size: 26px;
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
    padding: 10px;
    border-radius: 10px;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 14px 18px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: #fff;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.form-control:hover {
    border-color: #667eea;
}

.selected-service-info {
    animation: slideDown 0.3s ease;
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

.service-price-display {
    text-align: right;
}

.price-value {
    font-size: 24px;
    font-weight: 700;
    color: #111d5c;
}

.order-summary {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    border: 2px solid #667eea;
    border-radius: 15px;
    padding: 30px;
    position: sticky;
    top: 20px;
}

.summary-content {
    margin-top: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
}

.summary-row.total {
    border-top: 2px solid #667eea;
    border-bottom: none;
    margin-top: 15px;
    padding-top: 20px;
    font-size: 22px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    padding: 15px 20px;
    border-radius: 10px;
    margin-left: -20px;
    margin-right: -20px;
}

.summary-row.total span {
    color: #667eea;
}

.btn-request {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 18px 60px;
    font-size: 18px;
    font-weight: 700;
    border-radius: 50px;
    transition: all 0.3s ease;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.btn-request::before {
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

.btn-request:hover::before {
    width: 300px;
    height: 300px;
}

.btn-request:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
}

.btn-request:active {
    transform: translateY(-1px);
}

.form-note {
    font-size: 14px;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 991px) {
    .enhanced-qr-section {
        padding: 60px 0;
    }
    
    .enhanced-qr-wrapper {
        padding: 40px 30px;
    }
    
    .request-title {
        font-size: 32px;
    }
    
    .form-section {
        padding: 25px 20px;
    }
    
    .order-summary {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .enhanced-qr-wrapper {
        padding: 30px 20px;
        border-radius: 20px;
    }
    
    .request-title {
        font-size: 28px;
    }
    
    .request-subtitle {
        font-size: 16px;
    }
    
    .qr-icon-circle {
        width: 120px;
        height: 120px;
    }
    
    .qr-icon-circle i {
        font-size: 60px;
    }
    
    .form-section {
        padding: 20px 15px;
    }
    
    .section-title {
        font-size: 20px;
    }
    
    .btn-request {
        padding: 15px 40px;
        font-size: 16px;
        width: 100%;
    }
    
    .request-badges {
        gap: 10px;
    }
    
    .badge-item {
        font-size: 12px;
        padding: 6px 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_id');
    const serviceSelect = document.getElementById('service_id');
    const urgencySelect = document.querySelector('select[name="urgency_level"]');
    
    // Filter services by category
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        const options = serviceSelect.querySelectorAll('option');
        
        options.forEach(option => {
            if (option.value === '') {
                option.style.display = 'block';
            } else {
                const optionCategory = option.getAttribute('data-category');
                option.style.display = optionCategory == categoryId ? 'block' : 'none';
            }
        });
        
        serviceSelect.value = '';
        updateServiceInfo();
    });
    
    // Update service info when service is selected
    serviceSelect.addEventListener('change', function() {
        updateServiceInfo();
    });
    
    
    function updateServiceInfo() {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        const serviceInfo = document.getElementById('selected-service-info');
        
        if (serviceSelect.value && selectedOption.text) {
            const serviceName = selectedOption.text;
            
            document.getElementById('selected-service-name').textContent = serviceName;
            
            serviceInfo.style.display = 'block';
        } else {
            serviceInfo.style.display = 'none';
        }
    }
    
    function previewFile(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxSize = 500 * 1024 * 1024; // 500MB
            const previewContainer = document.getElementById('file-preview');
            const previewContent = document.getElementById('preview-content');
            
            if (file.size > maxSize) {
                alert('<?php echo e(__("File size must be less than 500MB")); ?>');
                input.value = '';
                return;
            }
            
            // Clear previous preview
            previewContent.innerHTML = '';
            
            // Check file type
            const fileType = file.type;
            const fileName = file.name;
            const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            
            if (fileType.startsWith('image/')) {
                // Image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContent.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 10px; border: 2px solid #e0e0e0;">
                        <p class="mt-2 mb-0"><strong>${fileName}</strong> (${fileSize})</p>
                    `;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else if (fileType.startsWith('video/')) {
                // Video preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContent.innerHTML = `
                        <video controls style="max-width: 100%; max-height: 300px; border-radius: 10px; border: 2px solid #e0e0e0;">
                            <source src="${e.target.result}" type="${fileType}">
                            <?php echo e(__('Your browser does not support the video tag.')); ?>

                        </video>
                        <p class="mt-2 mb-0"><strong>${fileName}</strong> (${fileSize})</p>
                    `;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                // Other file types - show file info only
                previewContent.innerHTML = `
                    <div style="padding: 20px; background: #f8f9fa; border-radius: 10px; border: 2px solid #e0e0e0; text-align: center;">
                        <i class="las la-file" style="font-size: 48px; color: #667eea;"></i>
                        <p class="mt-2 mb-0"><strong>${fileName}</strong></p>
                        <p class="mb-0 text-muted">${fileSize}</p>
                    </div>
                `;
                previewContainer.style.display = 'block';
            }
        }
    }
    
    function removeFile() {
        document.getElementById('issue_image').value = '';
        document.getElementById('preview-content').innerHTML = '';
        document.getElementById('file-preview').style.display = 'none';
    }
});
</script>

<style>
.image-upload-wrapper {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 2px dashed #e0e0e0;
    transition: all 0.3s ease;
}

.image-upload-wrapper:hover {
    border-color: #667eea;
    background: #f0f4ff;
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
    border: 2px solid #e0e0e0;
}

.file-preview-container img,
.file-preview-container video {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/qr/index.blade.php ENDPATH**/ ?>