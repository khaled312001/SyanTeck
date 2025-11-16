
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Buyer Reports')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
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
    <style>
        /* Ensure modal backdrop is clickable and below modal */
        .modal-backdrop {
            z-index: 1040 !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            pointer-events: auto !important;
        }
        /* Modal container */
        #reportModal.modal {
            z-index: 1050 !important;
            position: fixed !important;
        }
        #reportModal.modal.show {
            display: block !important;
        }
        /* Modal dialog - must be above backdrop */
        #reportModal .modal-dialog {
            z-index: 1051 !important;
            position: relative !important;
            margin: 1.75rem auto !important;
            pointer-events: none !important;
        }
        /* Modal content - must be clickable */
        #reportModal .modal-content {
            position: relative !important;
            z-index: 1052 !important;
            pointer-events: auto !important;
        }
        /* Ensure close button is clickable */
        #reportModal .close {
            position: relative !important;
            z-index: 1053 !important;
            opacity: 1 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
        }
        #reportModal .close:hover {
            opacity: 0.75 !important;
        }
        /* Ensure modal footer button is clickable */
        #reportModal .modal-footer button {
            position: relative !important;
            z-index: 1053 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
        }
        /* Ensure all interactive elements are clickable */
        #reportModal .modal-header,
        #reportModal .modal-body,
        #reportModal .modal-footer {
            pointer-events: auto !important;
        }
        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
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
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
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
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Seller Buyer Reports')); ?>  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th><?php echo e(__('Order ID')); ?></th>
                                <th><?php echo e(__('Report Details')); ?></th>
                                <th><?php echo e(__('Seller Details')); ?></th>
                                <th><?php echo e(__('Buyer Details')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($data->order_id); ?></td>
                                        <td>
                                            <p><strong><?php echo e(__('Report From:')); ?></strong> <?php echo e(__(ucfirst($data->report_from))); ?></p>
                                            <p><strong><?php echo e(__('Report To:')); ?></strong> <?php echo e(__(ucfirst($data->report_to))); ?></p>
                                            <p><strong><?php echo e(__('Report Date:')); ?></strong> <?php echo e(date('d-m-Y', strtotime($data->created_at))); ?></p>
                                            <p><strong><?php echo e(__('Description:')); ?></strong> <span class="btn btn-info btn-sm report_description" data-report="<?php echo e($data->report); ?>" style="cursor: pointer;"><i class="ti-eye"></i></span></p>
                                        </td>
                                        <td>
                                            <p><strong><?php echo e(__('Name:')); ?></strong> <?php echo e(optional($data->seller)->name); ?></p>
                                            <p><strong><?php echo e(__('Email:')); ?></strong> <?php echo e(optional($data->seller)->email); ?></p>
                                            <p><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e(optional($data->seller)->phone); ?></p>
                                            <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.order.report.chat.seller',$data->id.'/'.$data->seller_id)); ?>"><?php echo e(__('Chat To Seller')); ?></a>
                                        </td>
                                        <td>
                                            <p><strong><?php echo e(__('Name:')); ?></strong> <?php echo e(optional($data->buyer)->name); ?></p>
                                            <p><strong><?php echo e(__('Email:')); ?></strong> <?php echo e(optional($data->buyer)->email); ?></p>
                                            <p><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e(optional($data->buyer)->phone); ?></p>
                                            <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.order.report.chat.buyer',$data->id.'/'.$data->buyer_id)); ?>"><?php echo e(__('Chat To Buyer')); ?></a>
                                        </td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report-delete')): ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.order.report.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.order.report.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true" data-backdrop="true" data-keyboard="true">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal"><?php echo e(__('Report Details')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor: pointer; z-index: 1051;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong><?php echo e(__('Description:')); ?></strong></label>
                        <div class="p-3 bg-light rounded" style="min-height: 100px; white-space: pre-wrap; word-wrap: break-word;" id="report_description"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
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
                        title: '<?php echo e(__("Are you sure to change status complete? Once you done you can not revert this !!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, change it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click','.report_description',function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    let report_description = $(this).data('report');
                    if (report_description) {
                        $('#report_description').text(report_description);
                    } else {
                        $('#report_description').text('<?php echo e(__("No description available")); ?>');
                    }
                    // Show modal manually with proper options
                    $('#reportModal').modal({
                        backdrop: true,
                        keyboard: true,
                        show: true
                    });
                });

                // Handle backdrop click - close modal when clicking on backdrop
                $(document).on('click', '.modal-backdrop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $('#reportModal').modal('hide');
                });

                // Handle modal container click (when clicking outside modal-content)
                $(document).on('click', '#reportModal', function(e) {
                    // Only close if clicking directly on the modal container (not on modal-content or its children)
                    if ($(e.target).is('#reportModal')) {
                        e.preventDefault();
                        e.stopPropagation();
                        $('#reportModal').modal('hide');
                    }
                });

                // Prevent modal content clicks from closing the modal
                $(document).on('click', '#reportModal .modal-content, #reportModal .modal-content *', function(e) {
                    e.stopPropagation();
                });

                // Ensure close buttons work - use direct event handler with high priority
                $(document).on('click', '#reportModal .close', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    $('#reportModal').modal('hide');
                    return false;
                });

                $(document).on('click', '#reportModal [data-dismiss="modal"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    $('#reportModal').modal('hide');
                    return false;
                });

                $(document).on('click', '#reportModal .btn-secondary', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    $('#reportModal').modal('hide');
                    return false;
                });

                // Close modal on ESC key
                $(document).on('keydown', function(e) {
                    if (e.key === 'Escape' || e.keyCode === 27) {
                        if ($('#reportModal').hasClass('show')) {
                            $('#reportModal').modal('hide');
                        }
                    }
                });

                // Clean up when modal is hidden
                $('#reportModal').on('hidden.bs.modal', function () {
                    // Remove any duplicate backdrops
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                });

                // Also handle when modal is shown to ensure proper z-index
                $('#reportModal').on('shown.bs.modal', function () {
                    // Ensure modal dialog is above backdrop
                    $(this).css('z-index', '1050');
                    $('.modal-backdrop').css('z-index', '1040');
                    $(this).find('.modal-dialog').css('z-index', '1051');
                });

                // Initialize DataTable with Arabic language
                $('.table-wrap > table').DataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "sProcessing": "<?php echo e(__('Processing...')); ?>",
                        "sLengthMenu": "<?php echo e(__('Show')); ?> _MENU_ <?php echo e(__('entries')); ?>",
                        "sZeroRecords": "<?php echo e(__('No matching records found')); ?>",
                        "sEmptyTable": "<?php echo e(__('No data available in table')); ?>",
                        "sInfo": "<?php echo e(__('Showing')); ?> _START_ <?php echo e(__('to')); ?> _END_ <?php echo e(__('of')); ?> _TOTAL_ <?php echo e(__('entries')); ?>",
                        "sInfoEmpty": "<?php echo e(__('Showing')); ?> 0 <?php echo e(__('to')); ?> 0 <?php echo e(__('of')); ?> 0 <?php echo e(__('entries')); ?>",
                        "sInfoFiltered": "(<?php echo e(__('filtered from')); ?> _MAX_ <?php echo e(__('total entries')); ?>)",
                        "sInfoPostFix": "",
                        "sSearch": "<?php echo e(__('Search:')); ?>",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "<?php echo e(__('Loading...')); ?>",
                        "oPaginate": {
                            "sFirst": "<?php echo e(__('First')); ?>",
                            "sLast": "<?php echo e(__('Last')); ?>",
                            "sNext": "<?php echo e(__('Next')); ?>",
                            "sPrevious": "<?php echo e(__('Previous')); ?>"
                        },
                        "oAria": {
                            "sSortAscending": ": <?php echo e(__('activate to sort column ascending')); ?>",
                            "sSortDescending": ": <?php echo e(__('activate to sort column descending')); ?>"
                        }
                    }
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/backend/pages/orders/seller-buyer-report.blade.php ENDPATH**/ ?>