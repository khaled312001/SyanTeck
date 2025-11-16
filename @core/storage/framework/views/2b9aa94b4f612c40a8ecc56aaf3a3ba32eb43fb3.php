
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Order Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <?php if(!empty($order_details)): ?>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <label><strong><?php echo e(__('Order ID:')); ?> </strong>#<?php echo e($order_details->id); ?></label> <br>
                                <label><strong><?php echo e(__('Invoice No:')); ?> </strong><?php echo e($order_details->invoice); ?></label>
                                <?php if($order_details->tracking_code): ?>
                                <br><label><strong><?php echo e(__('Tracking Code:')); ?> </strong><?php echo e($order_details->tracking_code); ?></label>
                                <?php endif; ?>
                                <?php if($order_details->invoice_number): ?>
                                <br><label><strong><?php echo e(__('Invoice Number:')); ?> </strong><?php echo e($order_details->invoice_number); ?></label>
                                <?php endif; ?>
                            </div>
                            
                            <?php if($order_details->status >= 2): ?>
                            <div class="mt-3">
                                <?php if($order_details->hasInvoice()): ?>
                                <a href="<?php echo e(route('admin.orders.invoice.view', $order_details->id)); ?>" target="_blank" class="btn btn-success btn-sm mr-2">
                                    <i class="ti-file"></i> <?php echo e(__('View Invoice')); ?>

                                </a>
                                <a href="<?php echo e(route('admin.orders.invoice.download', $order_details->id)); ?>" class="btn btn-outline-success btn-sm mr-2">
                                    <i class="ti-download"></i> <?php echo e(__('Download Invoice')); ?>

                                </a>
                                <?php else: ?>
                                <a href="<?php echo e(route('admin.orders.invoice', $order_details->id)); ?>" class="btn btn-success btn-sm mr-2">
                                    <i class="ti-file"></i> <?php echo e(__('Generate Invoice')); ?>

                                </a>
                                <?php endif; ?>

                                <?php if($order_details->hasWarranty()): ?>
                                <a href="<?php echo e(route('admin.orders.warranty.view', $order_details->id)); ?>" target="_blank" class="btn btn-info btn-sm mr-2">
                                    <i class="ti-shield"></i> <?php echo e(__('View Warranty')); ?>

                                </a>
                                <a href="<?php echo e(route('admin.orders.warranty.download', $order_details->id)); ?>" class="btn btn-outline-info btn-sm mr-2">
                                    <i class="ti-download"></i> <?php echo e(__('Download Warranty')); ?>

                                </a>
                                <?php else: ?>
                                <a href="<?php echo e(route('admin.orders.warranty', $order_details->id)); ?>" class="btn btn-info btn-sm mr-2">
                                    <i class="ti-shield"></i> <?php echo e(__('Generate Warranty')); ?>

                                </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Seller Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Name:')); ?> </strong><?php echo e(optional($order_details->seller)->name); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Email:')); ?> </strong><?php echo e(optional($order_details->seller)->email); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Phone:')); ?> </strong><?php echo e(optional($order_details->seller)->phone); ?></label>
                                </div>
                                <?php if($order_details->is_order_online !=1): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Address:')); ?> </strong><?php echo e(optional($order_details->seller)->address); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('City:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->city)->service_city); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Area:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->area)->service_area); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Post Code:')); ?> </strong><?php echo e(optional($order_details->seller)->post_code); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Country:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->country)->country); ?></label>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>   
                </div>
                <?php if($order_details->order_from_job != 'yes'): ?>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5><?php echo e(__('Service Details')); ?></h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong><?php echo e(__('Title:')); ?> </strong><?php echo e(optional($order_details->service)->title); ?></label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        <?php echo render_image_markup_by_attachment_id(optional($order_details->service)->image,'','thumb'); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($order_details->order_from_job == 'yes'): ?>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5><?php echo e(__('Job Details')); ?></h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong><?php echo e(__('Title:')); ?> </strong><?php echo e(optional($order_details->job)->title); ?></label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        <?php echo render_image_markup_by_attachment_id(optional($order_details->job)->image,'','thumb'); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Buyer Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Name:')); ?> </strong><?php echo e($order_details->name); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Email:')); ?> </strong><?php echo e($order_details->email); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Phone:')); ?> </strong><?php echo e($order_details->phone); ?></label>
                                </div>
                                <?php if($order_details->is_order_online !=1): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Address:')); ?> </strong><?php echo e($order_details->address); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('City:')); ?> </strong><?php echo e(optional($order_details->service_city)->service_city); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Area:')); ?> </strong><?php echo e(optional($order_details->service_area)->service_area); ?></label>
                                </div>
                                <?php if($order_details->region): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Region:')); ?> </strong><?php echo e($order_details->region->name); ?></label>
                                </div>
                                <?php endif; ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Post Code:')); ?> </strong><?php echo e($order_details->post_code); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Country:')); ?> </strong><?php echo e(optional($order_details->service_country)->country); ?></label>
                                </div>
                               <?php endif; ?>
                               
                               <?php if($order_details->technician): ?>
                               <div class="border-bottom mb-3 mt-4">
                                   <h5><?php echo e(__('Assigned Technician')); ?></h5>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Technician Name:')); ?> </strong><?php echo e($order_details->technician->name); ?></label>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Technician Phone:')); ?> </strong><?php echo e($order_details->technician->phone ?? 'N/A'); ?></label>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Technician Email:')); ?> </strong><?php echo e($order_details->technician->email ?? 'N/A'); ?></label>
                               </div>
                               <?php if($order_details->assigned_at): ?>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Assigned At:')); ?> </strong><?php echo e($order_details->assigned_at->format('Y-m-d H:i:s')); ?></label>
                               </div>
                               <?php endif; ?>
                               <?php if($order_details->assignedBy): ?>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Assigned By:')); ?> </strong><?php echo e($order_details->assignedBy->name); ?></label>
                               </div>
                               <?php endif; ?>
                               <?php endif; ?>
                               
                               <?php if($order_details->urgency_level): ?>
                               <div class="checkbox-inlines mt-3">
                                   <label><strong><?php echo e(__('Urgency Level:')); ?> </strong>
                                       <span class="badge badge-<?php echo e($order_details->urgency_level == 'emergency' ? 'danger' : ($order_details->urgency_level == 'urgent' ? 'warning' : 'info')); ?>">
                                           <?php echo e(__(ucfirst($order_details->urgency_level))); ?>

                                       </span>
                                   </label>
                               </div>
                               <?php endif; ?>
                               
                               <?php if($order_details->warranty_code): ?>
                               <div class="border-bottom mb-3 mt-4">
                                   <h5><?php echo e(__('Warranty Information')); ?></h5>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Warranty Code:')); ?> </strong><?php echo e($order_details->warranty_code); ?></label>
                               </div>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Warranty Days:')); ?> </strong><?php echo e($order_details->warranty_days ?? 30); ?> <?php echo e(__('Days')); ?></label>
                               </div>
                               <?php if($order_details->warranty_issued_at): ?>
                               <div class="checkbox-inlines">
                                   <label><strong><?php echo e(__('Warranty Issued At:')); ?> </strong><?php echo e($order_details->warranty_issued_at->format('Y-m-d H:i:s')); ?></label>
                               </div>
                               <?php endif; ?>
                               <?php endif; ?>
                            </div>

                            <?php if(!empty($order_details->issue_images) && count($order_details->issue_images) > 0): ?>
                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Issue Images')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="row">
                                    <?php $__currentLoopData = $order_details->issue_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 mb-3">
                                        <a href="<?php echo e(asset($image)); ?>" target="_blank">
                                            <img src="<?php echo e(asset($image)); ?>" 
                                                 alt="<?php echo e(__('Issue Image')); ?>" 
                                                 class="img-thumbnail" 
                                                 style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;">
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php elseif($order_details->issue_image): ?>
                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Issue Image')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <a href="<?php echo e(asset($order_details->issue_image)); ?>" target="_blank" class="d-inline-block">
                                        <img src="<?php echo e(asset($order_details->issue_image)); ?>" 
                                             alt="<?php echo e(__('Issue Image')); ?>" 
                                             class="img-thumbnail" 
                                             style="max-width: 300px; max-height: 300px; cursor: pointer;">
                                    </a>
                                    <p class="text-muted mt-2">
                                        <small><i class="ti-image"></i> <?php echo e(__('Click to view full size')); ?></small>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($order_details->order_note): ?>
                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Order Notes')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <p class="bg-light p-3 rounded"><?php echo e($order_details->order_note); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($order_details->is_order_online !=1): ?>
                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Date & Schedule')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Date:')); ?> </strong>
                                        <?php if($order_details->date): ?>
                                            <?php
                                                try {
                                                    $date = \Carbon\Carbon::parse($order_details->date);
                                                    \Carbon\Carbon::setLocale('ar');
                                                    echo $date->translatedFormat('l d F Y');
                                                } catch (\Exception $e) {
                                                    // If parsing fails, try to translate common English month names
                                                    $dateStr = $order_details->date;
                                                    $dateStr = str_replace(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], 
                                                        ['الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'], $dateStr);
                                                    $dateStr = str_replace(['January', 'February', 'March', 'April', 'May', 'June', 
                                                        'July', 'August', 'September', 'October', 'November', 'December'],
                                                        ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 
                                                        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'], $dateStr);
                                                    echo $dateStr;
                                                }
                                            ?>
                                        <?php else: ?>
                                            <?php echo e(__('N/A')); ?>

                                        <?php endif; ?>
                                    </label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Schedule:')); ?> </strong>
                                        <?php if($order_details->schedule): ?>
                                            <?php
                                                try {
                                                    $time = \Carbon\Carbon::parse($order_details->schedule);
                                                    \Carbon\Carbon::setLocale('ar');
                                                    $formatted = $time->translatedFormat('g:i A');
                                                    // Translate AM/PM
                                                    $formatted = str_replace(['AM', 'PM'], ['ص', 'م'], $formatted);
                                                    echo $formatted;
                                                } catch (\Exception $e) {
                                                    // If parsing fails, try to translate common time formats
                                                    $timeStr = $order_details->schedule;
                                                    $timeStr = str_replace(['am', 'pm', 'AM', 'PM'], ['ص', 'م', 'ص', 'م'], $timeStr);
                                                    echo $timeStr;
                                                }
                                            ?>
                                        <?php else: ?>
                                            <?php echo e(__('N/A')); ?>

                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Amount Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Package Fee:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->package_fee)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Extra Service:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->extra_service)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Sub Total:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->sub_total)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Tax:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->tax)); ?></label>
                                </div>
                                <?php if(!empty($order_details->coupon_amount)): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Coupon Amount:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?></label>
                                </div>
                                <?php endif; ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Total:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->total)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Admin Commission:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->commission_amount)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Payment Gateway:')); ?> </strong><b class="text-success"><?php echo e(__(ucwords(str_replace("_", " ", $order_details->payment_gateway)))); ?></b></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Payment Status:')); ?> </strong><?php echo e(__(ucfirst($order_details->payment_status))); ?></label>
                                    <span>
                                        <?php if($order_details->payment_status=='pending'): ?> 
                                        <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-change','data' => ['url' => route('admin.order.change.status',$order_details->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.order.change.status',$order_details->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <?php if($order_details->payment_gateway=='manual_payment'): ?>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Manual Payment Attachment:')); ?> </strong></label>
                                    <img src="<?php echo e(asset('assets/uploads/manual-payment/'.$order_details->manual_payment_image)); ?>" alt="">
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="border-bottom mb-3 mt-4">
                                <h5><?php echo e(__('Order Status')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Order Status:')); ?></strong>
                                        <?php if($order_details->status == 0): ?> <span><?php echo e(__('Pending')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 1): ?> <span><?php echo e(__('Active')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 2): ?> <span><?php echo e(__('Completed')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 3): ?> <span><?php echo e(__('Delivered')); ?></span><?php endif; ?>
                                        <?php if($order_details->status == 4): ?> <span><?php echo e(__('Cancelled')); ?></span><?php endif; ?>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                </div>
                <?php if($order_details->order_from_job != 'yes'): ?>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <h5><?php echo e(__('Include Details:')); ?></h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <?php if($order_details->is_order_online !=1): ?>
                                            <th><?php echo e(__('Total')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $package_fee =0; ?>
                                        <?php $__currentLoopData = $order_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($include->title); ?></td>
                                            <?php if($order_details->is_order_online !=1): ?>
                                            <td><?php echo e(float_amount_with_currency_symbol($include->price * $include->quantity)); ?></td>
                                            <?php $package_fee += $include->price * $include->quantity ?>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if($order_details->is_order_online !=1): ?>
                                                <td><strong><?php echo e(__('Package Fee')); ?></strong></td>
                                                <td><strong><?php echo e(float_amount_with_currency_symbol($package_fee)); ?></strong></td>
                                            <?php else: ?>
                                                <td colspan="3"><strong><?php echo e(__('Package Fee') .float_amount_with_currency_symbol($order_details->package_fee)); ?></strong></td>
                                            <?php endif; ?>

                                        </tr>
                                    </tbody>
                                </table>

                                <?php if($order_additionals->count() >= 1): ?>
                                <h5><?php echo e(__('Additional Services:')); ?></h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Title')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $extra_service =0; ?>
                                        <?php $__currentLoopData = $order_additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($additional->title); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($additional->price * $additional->quantity)); ?></td>
                                            <?php $extra_service += $additional->price * $additional->quantity ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><strong><?php echo e(__('Extra Service')); ?></strong></td>
                                            <td><strong><?php echo e(float_amount_with_currency_symbol($extra_service)); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endif; ?>


                                <?php if(optional($order_details->extraSevices)->count() >= 1): ?>
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title"><?php echo e(__('Extra Service Details')); ?></h5>
                                                </div>
                                                <span class="info-text d-block mb-4"><?php echo e(__('This is not included in the main service order calculation')); ?></span>

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <th><?php echo e(__('Amount')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $order_details->extraSevices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($ex_service->title); ?></td>
                                                            <td><?php echo e(float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity)); ?></td>

                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(!empty($order_details->coupon_code)): ?>
                                <h5><?php echo e(__('Coupon Details:')); ?></h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Coupon Code')); ?></th>
                                            <th><?php echo e(__('Coupon Type')); ?></th>
                                            <th><?php echo e(__('Coupon Amount')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e($order_details->coupon_code); ?></td>
                                            <td><?php echo e($order_details->coupon_type); ?></td>
                                            <td>
                                                <?php if(!empty($order_details->coupon_amount)): ?>
                                                <?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="justify-content-end mt-4">
                <span class="header-title"><?php echo e(__('Order not found')); ?></span>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '<?php echo e(__("Are you sure to change status?")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                    });
                });
                
              });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/backend/pages/orders/order-details.blade.php ENDPATH**/ ?>