<section class="dynamic-page-content-area padding-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php if(!auth()->guard('web')->check() && in_array($page_post->visibility, ['all', 'public'])): ?>
                    <div class="dynamic-page-content-wrap">
                        <?php echo $page_post->page_content; ?>

                    </div>
                <?php elseif(auth()->guard('web')->check()): ?>
                    <div class="dynamic-page-content-wrap">
                        <?php echo $page_post->page_content; ?>

                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <p><a class="text-primary" href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a> <?php echo e(__('to see this page')); ?> </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/frontend/partials/dynamic-content.blade.php ENDPATH**/ ?>