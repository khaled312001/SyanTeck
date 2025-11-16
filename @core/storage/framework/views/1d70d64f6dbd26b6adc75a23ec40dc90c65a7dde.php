<!-- Join area starts -->
<section class="new_join_area new-section-bg padding-top-100 padding-bottom-100" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>" style="background-color:<?php echo e($section_bg); ?>">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row align-items-center">
            <div class="col-lg-6">
                <div class="new_join__contents">
                    <h2 class="new_join__title" style="color:<?php echo e($title_text_color); ?>"><?php echo e($title); ?></h2>
                    <?php if(!empty($content_list_show_hide)): ?>
                        <ul class="new_join__list list_none mt-4">
                            <?php $__currentLoopData = $repeater_data['benifits_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $benifits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list"><?php echo e($benifits); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <div class="btn-wrapper mt-4 mt-lg-5">
                        <a href="<?php echo e($btn_link); ?>" class="cmn-btn btn-bg-1 radius-5" style="background:<?php echo e($btn_color); ?>"><?php echo e($btn_text); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 margin-top-30">
                <div class="new_join__thumb wow slideInRight" data-wow-delay=".2s">
                    <div class="new_join__thumb__main">
                        <?php echo $seller_image; ?>

                    </div>
                    <div class="new_join__shapes">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Join area end --><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\app\Providers/../PageBuilder/views/become-seller/become-seller-three.blade.php ENDPATH**/ ?>