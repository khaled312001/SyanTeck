<div class="inner-wrap-contents">
    <p class="wrap-para"><?php echo e(__('Hello, Order Created By:')); ?> <?php echo e(optional($order_details->buyer)->name ?? optional($order_details->client)->name); ?> <br>
        <?php echo e(__('Order has been created successfully at:') .optional($order_details->created_at)->toFormattedDateString().','. ucwords(str_replace("_", " ", $order_details->payment_gateway))); ?>

    </p>
    <h4 class="earning-order-title"><?php echo e(__('Your Order ID')); ?> #<?php echo e($order_details->id); ?><br>
        <?php echo e(__('Total Amount')); ?> <?php echo e(float_amount_with_currency_symbol($order_details->total)); ?><br>
        <?php echo e(__('Tax Amount')); ?> <?php echo e(float_amount_with_currency_symbol($order_details->tax)); ?> <br> <br>
        <?php if($order_details->transaction_id !=''): ?>
            <?php echo e(__('Your Transaction Id')); ?> <?php echo e($order_details->transaction_id); ?> <br>
        <?php endif; ?>
    </h4>


</div>


<?php $package_fee =0;
    $order_includes = App\OrderInclude::where('order_id',$order_details->id)->get()
?>

<?php if($order_includes->count()>=1): ?>
    <h3 class="earning-title"><?php echo e(__('Order Include Details')); ?></h3>
    <table class="table table-bordered table-responsive" style="margin: 0 auto; border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom: 30px;overflow-x: auto;">
        <thead>
        <tr class="table-row">
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Title')); ?></th>
            <?php if($order_details->is_order_online !=1): ?>
                <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Unit Price')); ?></th>
                <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Quantity')); ?></th>
                <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;" class="table-heading"><?php echo e(__('Total')); ?></th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php $package_fee =0;
            $order_includes = App\OrderInclude::where('order_id',$order_details->id)->get()
        ?>
        <?php $__currentLoopData = $order_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="table-row">
                <td style="border: 1px solid #ddd; padding: 8px; text-align:left;"><?php echo e($include->title); ?></td>
                <?php if($order_details->is_order_online !=1): ?>
                    <td style="border: 1px solid #ddd; padding: 8px;text-align:left;"><?php echo e(float_amount_with_currency_symbol($include->price)); ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;text-align:left;"><?php echo e($include->quantity); ?></td>
                    <td style="border: 1px solid #ddd; padding: 8px;text-align:left;"><?php echo e(float_amount_with_currency_symbol($include->price * $include->quantity)); ?></td>
                    <?php $package_fee += $include->price * $include->quantity ?>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr class="table-row">
            <?php if($order_details->is_order_online !=1): ?>
                <td colspan="3" style="padding: 10px"><strong><?php echo e(get_static_option('service_package_fee_title') ??  __('Package Fee')); ?></strong></td>
                <td style="padding: 10px"><strong><?php echo e(float_amount_with_currency_symbol($package_fee)); ?></strong></td>
            <?php else: ?>
                <td style="padding: 10px; text-align:left;"><strong><?php echo e(__('Package Fee') . float_amount_with_currency_symbol($order_details->package_fee)); ?></strong></td>
            <?php endif; ?>
        </tr>
        </tbody>
    </table>
<?php endif; ?>


<?php $extra_service =0;
    $order_additionals = App\OrderAdditional::where('order_id',$order_details->id)->get()
?>

<?php if($order_additionals->count()>=1): ?>
    <h3 class="earning-title"><?php echo e(get_static_option('service_extra_title') ?? __('Order Additional Details')); ?></h3>
    <table class="table table-bordered" style="margin: 0 auto; border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom: 30px;">
        <thead>
        <tr>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Title')); ?></th>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Unit Price')); ?></th>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Quantity')); ?></th>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Total')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $order_additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($additional->title); ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e(float_amount_with_currency_symbol($additional->price)); ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($additional->quantity); ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e(float_amount_with_currency_symbol($additional->price * $additional->quantity)); ?></td>
                <?php $extra_service += $additional->price * $additional->quantity ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="3" style="padding: 10px"><strong><?php echo e(__('Additional Service Fee')); ?></strong></td>
            <td style="padding: 10px"><strong><?php echo e(float_amount_with_currency_symbol($extra_service)); ?></strong></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>

<?php if($order_details->coupon_code !=''): ?>
    <h3 class="earning-title"><?php echo e(__('Coupon Details')); ?></h3>
    <table class="table table-bordered" style="margin: 0 auto; border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom: 30px;">
        <thead>
        <tr>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Coupon Code')); ?></th>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Coupon Type')); ?></th>
            <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;"><?php echo e(__('Coupon Amount')); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($order_details->coupon_code); ?></td>
            <td style="border: 1px solid #ddd; padding: 8px;"><?php echo e($order_details->coupon_type); ?></td>
            <td style="border: 1px solid #ddd; padding: 8px;">
                <?php if($order_details->coupon_amount >0): ?>
                    <?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?>

                <?php endif; ?>
            </td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>

<?php if($order_details->is_order_online !=1): ?>
    <div class="earning-wrapper">
        <h3 class="earning-title"><?php echo e(__('Billing Details')); ?></h3><hr>
        <p class="wrap-para"><strong><?php echo e(__('Name:')); ?></strong> <?php echo e($order_details->name); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Email:')); ?></strong> <?php echo e($order_details->email); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e($order_details->phone); ?></p>
    </div>
    <div class="earning-wrapper">
        <h3 class="earning-title"><?php echo e(__('Shipping Details')); ?></h3><hr>
        <p class="wrap-para"><strong><?php echo e(__('Name:')); ?></strong> <?php echo e($order_details->name); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Email:')); ?></strong> <?php echo e($order_details->email); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e($order_details->phone); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('City:')); ?></strong> <?php echo e(optional($order_details->service_city)->service_city); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Area:')); ?></strong> <?php echo e(optional($order_details->service_area)->service_area); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Country:')); ?></strong> <?php echo e(optional($order_details->service_country)->country); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Address:')); ?></strong> <?php echo e($order_details->address); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Date:')); ?></strong> <?php echo e(__($order_details->date)); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Schedule:')); ?></strong> <?php echo e(__($order_details->schedule)); ?></p>
        <p class="wrap-para"><strong><?php echo e(__('Order Create Date:')); ?></strong> <?php echo e(optional($order_details->created_at)->toFormattedDateString()); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/mail/order-mail-body/new-order-mail.blade.php ENDPATH**/ ?>