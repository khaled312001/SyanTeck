<style>
    :root {
        --main-color-one: #FFD700;
        --main-color-two: #FFD700;
        --main-color-three: #FFD700;
        --heading-color: #000000;
        --light-color: #666666;
        --extra-light-color: #999999;

        --heading-font: 'Almarai', <?php echo e(get_static_option('heading_font_family') ? get_static_option('heading_font_family') . ',' : ''); ?>sans-serif;
        --body-font: 'Almarai', <?php echo e(get_static_option('body_font_family') ? get_static_option('body_font_family') . ',' : ''); ?>sans-serif;

          <?php if(!empty(Auth::guard('web')->user()->user_typ) == 0): ?>
              <?php if(request()->is('seller/*')): ?>
                --main-color-one: #FFD700;
                --main-color-one-rgb: 255, 215, 0;
              <?php endif; ?>
           <?php endif; ?>
        }
    </style>



<?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/frontend/partials/root-style.blade.php ENDPATH**/ ?>