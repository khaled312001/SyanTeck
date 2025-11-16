<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-4">
        <ul class="list-none">
            <button type="button btn-sm" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li> <?php echo e($error); ?></li> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/components/msg/error_for_service_book.blade.php ENDPATH**/ ?>