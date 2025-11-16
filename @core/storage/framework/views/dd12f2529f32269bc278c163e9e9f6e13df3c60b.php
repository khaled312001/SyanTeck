
<?php $__env->startSection('page-meta-data'); ?>
    <title><?php echo e($service_details_for_book->title); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    <?php echo e(__(ucwords(str_replace("-", " ", $page_info)))); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('inner-title'); ?>
    <?php echo e($service_details_for_book->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #999;
        }

        .wallet-payment-gateway-wrapper label{
            padding: 10px;
            font-weight: bold;
        }

        .wallet-payment-gateway-wrapper input{
            transform: scale(1.3);
        }
        .show-schedule {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .paymentGateway_add__item {
            width: calc(100% / 5 - 16px);
            overflow: hidden;
        }
        @media screen and (max-width: 1199px) and (min-width: 992px) {
            .paymentGateway_add__item {
                width: calc(100% / 3 - 13.33px);
            }
        }
        @media only screen and (max-width: 991px) {
            .paymentGateway_add__item {
                width: calc(100% / 4 - 15px);
            }
        }
        @media only screen and (max-width: 767px) {
            .paymentGateway_add__item {
                width: calc(100% / 3 - 13.33px);
            }
        }
        @media only screen and (max-width: 425px) {
            .paymentGateway_add__item {
                width: calc(100% / 2 - 10px);
            }
        }
        .custom_radio__inline__two .custom_radio__single{
            width: calc(56% - 8px);
        }

        .coupon_amount_for_apply_code {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }


    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $service_country =  optional(optional($service_details_for_book->serviceCity)->countryy)->id;
        $country_tax =  App\Tax::select('id','tax')->where('country_id',$service_country)->first();
    ?>

            <!-- Service Details area start -->
    <div class="new_service_details_area padding-top-100 padding-bottom-100">
        <div class="container">

            <div class="new_stepForm">
                <form action="<?php echo e(route('service.create.order')); ?>" id="msform" class="msform ms-order-form" method="post" name="msOrderForm" enctype="multipart/form-data" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="row g-4 mt-1">
                        <!-- Hidden data for request -->
                        <input type="hidden" name="service_id" value="<?php echo e($service_details_for_book->id); ?>">
                        <input type="hidden" name="seller_id" value="<?php echo e(optional($service_details_for_book->seller)->id); ?>">

                        <?php if($service_details_for_book->is_service_online == 1): ?>
                            <input type="hidden" name="is_service_online_" value="<?php echo e($service_details_for_book->is_service_online); ?>">
                            <input type="hidden" name="online_service_package_fee" value="<?php echo e($service_details_for_book->price); ?>">
                        <?php endif; ?>
                        <input type="hidden" name="date">
                        <input type="hidden" name="schedule">
                        <input type="hidden" id="payment_form_services" name="services[]">
                        <input type="hidden" id="payment_form_additionals" name="additionals[]">

                        <div class="col-12">

                            <!--for coupon code and other -->
                            <input type="hidden" id="service_id" value="<?php echo e($service_details_for_book->id); ?>">
                            <input type="hidden" id="seller_id" value="<?php echo e($service_details_for_book->seller_id); ?>">

                            <div class="new_serviceDetails radius-10">
                                <div class="new_serviceDetails__flex">
                                    <div class="new_serviceDetails__author">
                                        <div class="new_serviceDetails__author__flex">
                                            <div class="new_serviceDetails__author__thumb"
                                                 <?php if(empty(render_image_markup_by_attachment_id($service_details_for_book->image))): ?> style="height: 82px; width: 92px"  <?php endif; ?>>
                                                <a href="javascript:void(0)">
                                                    <?php if(empty(render_image_markup_by_attachment_id($service_details_for_book->image))): ?>
                                                        <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg', 'thumb')); ?>" alt="no-image" />
                                                    <?php else: ?>
                                                        <?php echo render_image_markup_by_attachment_id($service_details_for_book->image,'','thumb'); ?>

                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="new_serviceDetails__author__contents">
                                                <h4 class="new_serviceDetails__author__title">
                                                    <a href="<?php echo e(route('service.list.details',$service_details_for_book->slug)); ?>"><?php echo e($service_details_for_book->title); ?></a>
                                                </h4>
                                                <div class="d-flex justify-content-start" style="display: none !important;">
                                                    <!--service seller info -->

                                                    <p class="new_serviceDetails__author__para">
                                                        <?php if(!empty(optional(optional($service_details_for_book)->seller)->username)): ?>
                                                            <a href="<?php echo e(route('about.seller.profile', optional(optional($service_details_for_book)->seller)->username)); ?>">
                                                                <?php echo e(optional($service_details_for_book)->seller->name); ?></a>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Error message show -->
                            <div>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error_for_service_book','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error_for_service_book'); ?>
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
<?php endif; ?> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.session-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('session-msg'); ?>
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

                            <div class="new_stepForm_list step_list list_none mt-5">
                                <?php if($service_details_for_book->is_service_online != 1): ?>
                                    <!--Location -->
                                    <div class="new_stepForm_list__item active full_address_get_next_page edit_location">
                                        <div class="new_stepForm_list__item__flex">
                                            <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                                <span class="new_stepForm_list__item__click__icon"><i class="fa-solid fa-location-dot"></i></span>
                                                <div class="new_stepForm_list__item__click__contents">
                                                    <h6 class="new_stepForm_list__item__click__title"><?php echo e(__('Location')); ?></h6>
                                                    <span class="new_stepForm_list__item__click__para">
                                                    <?php if(empty(get_static_option('google_map_settings'))): ?>
                                                            <strong><?php echo e(__('Your Location:')); ?></strong>
                                                            <?php if(Auth::guard('web')->check()): ?>
                                                                <?php echo e(optional(Auth::guard('web')->user()->country)->country); ?>,
                                                                <?php echo e(optional(Auth::guard('web')->user()->city)->service_city); ?>

                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                </span>
                                                </div>
                                            </a>
                                            <div class="new_stepForm_list__item__btn click_edit_address">
                                                <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5"><?php echo e(__('Edit')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Service info-->
                                <div class="new_stepForm_list__item  edit_service_info <?php if($service_details_for_book->is_service_online == 1): ?> active <?php endif; ?>">
                                    <div class="new_stepForm_list__item__flex">
                                        <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                            <span class="new_stepForm_list__item__click__icon"><i class="fa-regular fa-envelope"></i></span>
                                            <div class="new_stepForm_list__item__click__contents">
                                                <h6 class="new_stepForm_list__item__click__title"><?php echo e(__('Service')); ?></h6>
                                            </div>
                                        </a>
                                        <div class="new_stepForm_list__item__btn click_edit_service_info">
                                            <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5"><?php echo e(__('Edit')); ?></a>
                                        </div>
                                    </div>
                                </div>


                                <!--Booking Info -->
                                <div class="new_stepForm_list__item  edit_booking_info">
                                    <div class="new_stepForm_list__item__flex">
                                        <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                            <span class="new_stepForm_list__item__click__icon"><i class="fa-regular fa-envelope"></i></span>
                                            <div class="new_stepForm_list__item__click__contents">
                                                <h6 class="new_stepForm_list__item__click__title"><?php echo e(get_static_option('service_booking_information_title') ?? __('Booking Information')); ?></h6>
                                            </div>
                                        </a>
                                        <div class="new_stepForm_list__item__btn click_edit_info click_edit_booking_info">
                                            <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5"><?php echo e(__('Edit')); ?></a>
                                        </div>
                                    </div>
                                </div>

                                <?php if($service_details_for_book->is_service_online != 1): ?>
                                    <!--Date & Time-->
                                    <div class="confirm-overview-left new_stepForm_list__item edit_date_time_info">
                                        <div class="new_stepForm_list__item__flex">
                                            <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                                <span class="new_stepForm_list__item__click__icon"><i class="fa-regular fa-calendar-days"></i></span>
                                                <div class="new_stepForm_list__item__click__contents">
                                                    <h6 class="new_stepForm_list__item__click__title"><?php echo e(__('Date & Time')); ?> </h6>

                                                    <span class="new_stepForm_list__item__click__para">
                                                  <span class="details available_date"> </span>
                                                  <span class="details available_schedule"> </span>
                                                </span>
                                                </div>
                                            </a>
                                            <div class="new_stepForm_list__item__btn click_edit_schedule click_edit_date_time">
                                                <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5"><?php echo e(__('Edit')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!--payment Confirmation -->
                                <div class="new_stepForm_list__item all_check_for_order edit_payment_option">
                                    <div class="new_stepForm_list__item__flex">
                                        <a class="new_stepForm_list__item__click" href="javascript:void(0)">
                                            <span class="new_stepForm_list__item__click__icon"><i class="fa-solid fa-circle-check"></i></span>
                                            <div class="new_stepForm_list__item__click__contents">
                                                <h6 class="new_stepForm_list__item__click__title"><?php echo e(__('Confirmation')); ?> </h6>
                                            </div>
                                        </a>
                                        <div class="new_stepForm_list__item__btn click_edit_schedule">
                                            <a href="javascript:void(0)" class="new_stepForm_list__item__btn__edit radius-5"><?php echo e(__('Edit')); ?></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php if($service_details_for_book->is_service_online != 1): ?>
                                <!-- Location  -->
                                <fieldset class="padding-top-50 confirm-location">
                                    <div class="row">

                                        <?php if(empty(get_static_option('google_map_settings'))): ?>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title"><?php echo e(__('Service Country')); ?></label>
                                                    <div class="single-input-select radius-5">
                                                        <select name="choose_service_country" id="choose_service_country"  class="select2_activation">
                                                            <?php if(!empty($country)): ?>
                                                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title"><?php echo e(__('Service City')); ?></label>
                                                    <div class="single-input-select radius-5">
                                                        <select name="choose_service_city" id="choose_service_city" class="select2_activation get_service_city">
                                                            <?php if($service_details_for_book->is_service_all_cities === 1): ?>
                                                                <?php $cities = App\ServiceCity::select('id','service_city')->where('country_id',$service_country)->where('status',1)->get(); ?>
                                                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->service_city); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php if(!empty($city)): ?>
                                                                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->service_city); ?></option>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title"><?php echo e(__('Choose Area')); ?></label>
                                                    <div class="single-input-select radius-5">
                                                        <select name="choose_service_area" id="choose_service_area" class="select2_activation get_service_area">
                                                            <option value=""><?php echo e(__('Select Area')); ?></option>
                                                            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($area->id); ?>"><?php echo e($area->service_area); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                        <div class="col-lg-4 col-sm-6">
                                            <div class="single-input">
                                                <label class="label-title"><?php echo e(__('Service Location')); ?></label>
                                                <div class="single-input-select radius-5">
                                                    <select name="user_address" id="user_address" class="select2_activation get_service_location_area">
                                                        <option value=""><?php echo e(__('Select Area')); ?></option>
                                                        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $regionName = (app()->getLocale() == 'ar' && !empty($region->name_ar)) ? $region->name_ar : $region->name;
                                                            ?>
                                                            <option value="<?php echo e($regionName); ?>"><?php echo e($regionName); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Auth User Check - Removed login requirement -->
                                    <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                        <input type="button" name="next" class="next stepForm_btn radius-5" value="<?php echo e(__('Next')); ?>"/>
                                    </div>
                                </fieldset>
                            <?php endif; ?>

                            <!-- Service Info -->
                            <fieldset class="padding-top-50 edit_style_service_info">
                                <div class="custom-form">
                                    <div class="row g-4">
                                        <div class="col-sm-12">

                                            <div class="new_packageBook__details">
                                                <!-- Hide "What's Included" section -->
                                                <div class="new_packageBook__details__item" style="display: none;">
                                                    <!-- Heading start -->
                                                    <div class="new_packageBook__header">
                                                        <div class="new_packageBook__header__left">
                                                            <h4 class="new_packageBook__details__title"><?php echo e(get_static_option('service_main_attribute_title') ?? __('What\'s Included')); ?></h4>
                                                        </div>
                                                    </div>
                                                    <!-- Heading send -->
                                                    <?php if($service_details_for_book->is_service_online == 1): ?>
                                                        <ul class="new_packageBook__list list_none mt-4">
                                                            <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="list_show new_packageBook__addFeature__title"><?php echo e($include->include_service_title); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php else: ?>
                                                        <!--Service customize start -->
                                                        <div class="row g-4 mt-1 service_include_edit_show_hide">
                                                            <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="col-lg-6 single-include include_service_id_<?php echo e($include->id); ?>">
                                                                    <div class="new_packageBook__addFeature radius-10">
                                                                        <div class="new_packageBook__addFeature__flex">
                                                                            <div class="new_packageBook__addFeature__contents">
                                                                                <ul class="new_packageBook__list list_none mt-4">
                                                                                    <li class="list_show new_packageBook__addFeature__title"><?php echo e($include->include_service_title); ?></li>
                                                                                </ul>

                                                                                <?php if($service_details_for_book->is_service_online !=1): ?>
                                                                                    <p class="new_packageBook__addFeature__price mt-2"
                                                                                       id="include_service_unit_price_<?php echo e($include->id); ?>" style="display: none;">
                                                                                        <?php echo e(amount_with_currency_symbol($include->include_service_price)); ?>

                                                                                    </p>
                                                                                <?php endif; ?>
                                                                            </div>

                                                                            <?php if($service_details_for_book->is_service_online !=1): ?>
                                                                                <div class="btn-wrapper">
                                                                                    <div class="package_quantity">
                                                                                    <span class="substract package_quantity__icon include_service_qty_decrement">
                                                                                        <i class="fa-solid fa-minus"></i></span>
                                                                                        <input type="number" min="1"
                                                                                               class="quantity-input package_quantity__input inc_dec_include_service"
                                                                                               data-id="<?php echo e($include->id); ?>"
                                                                                               data-price="<?php echo e($include->include_service_price); ?>"
                                                                                               value="<?php echo e($include->include_service_quantity); ?>"  oninput="validateNumberInput(this)">
                                                                                        <span class="plus package_quantity__icon inc_dec_include_service"><i class="fa-solid fa-plus"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="btn-wrapper">
                                                                                    <div class="package_quantity remove-service-list"
                                                                                         data-id="<?php echo e($include->id); ?>">
                                                                                        <a class="remove text-danger" href="javascript:void(0)"><?php echo e(__('Remove')); ?></a>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <!--Service customize end -->
                                                    <?php endif; ?>
                                                </div>

                                                <!--Service Additional start - Show this section -->
                                                <div class="new_packageBook__details__item extra-services">
                                                    <h4 class="new_packageBook__details__title"><?php echo e(get_static_option('service_additional_attribute_title') ?? __('Upgrade your order with extras')); ?></h4>
                                                    <div class="new_packageBook__details__inner">
                                                        <?php if($service_additionals->count() > 0): ?>
                                                        <div class="row g-4 mt-1">
                                                            <?php $__currentLoopData = $service_additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="col-lg-6">
                                                                    <div class="new_packageBook__addFeature radius-10">
                                                                        <div class="new_packageBook__addFeature__flex">
                                                                            <div class="new_packageBook__addFeature__contents">
                                                                                <div class="checkbox-inlines">
                                                                                    <input class="check-input" type="checkbox" id="additional_<?php echo e($additional->id); ?>" value="<?php echo e($additional->id); ?>">
                                                                                    <label class="new_packageBook__addFeature__title" for="additional_<?php echo e($additional->id); ?>"> <?php echo e($additional->additional_service_title); ?> </label>
                                                                                </div>
                                                                                <p class="new_packageBook__addFeature__price price-value mt-2" style="display: none;">
                                                                                    <?php echo e(amount_with_currency_symbol($additional->additional_service_price)); ?>

                                                                                </p>
                                                                            </div>
                                                                            <div class="btn-wrapper">
                                                                                <div class="package_quantity">
                                                                                    <span class="values d-none" price="<?php echo e($additional->id); ?>"> <?php echo e($additional->additional_service_price); ?></span>
                                                                                    <span class="substract package_quantity__icon additional_service_qty_decrement"><i class="fa-solid fa-minus"></i></span>
                                                                                    <input  type="number"
                                                                                            min="1"
                                                                                            class="quantity-input package_quantity__input inc_dec_additional_service"
                                                                                            id="additional_service_quantity_<?php echo e($additional->id); ?>"
                                                                                            data-id="<?php echo e($additional->id); ?>"
                                                                                            data-price="<?php echo e($additional->additional_service_price); ?>"
                                                                                            value="<?php echo e($additional->additional_service_quantity); ?>" oninput="validateNumberInput(this)">

                                                                                    <span class="plus package_quantity__icon inc_dec_additional_service"><i class="fa-solid fa-plus"></i></span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <?php endif; ?>
                                                        
                                                        <!-- Manual Additional Service Input -->
                                                        <div class="row g-4 mt-3">
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <label class="label-title"><?php echo e(__('Additional Service (Optional)')); ?></label>
                                                                    <textarea 
                                                                        class="form--control radius-5" 
                                                                        id="manual_additional_service" 
                                                                        name="manual_additional_service" 
                                                                        rows="3" 
                                                                        placeholder="<?php echo e(__('Enter any additional service or special request (optional)')); ?>"></textarea>
                                                                    <small class="form-text text-muted"><?php echo e(__('You can add any additional service or special request here')); ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Service Additional end -->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                    <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5
                                        <?php if($service_details_for_book->is_service_online == 1): ?> d-none <?php endif; ?>" value="<?php echo e(__('Previous')); ?>"/>
                                    <input type="button" name="next" class="next stepForm_btn radius-5" value="<?php echo e(__('Next')); ?>"/>
                                </div>




                                <!-- service faq and benefits  -->
                                <?php if($service_benifits->count() >1): ?>
                                    <div class="overview-single padding-top-60">
                                        <h4 class="title"><?php echo e(get_static_option('service_benifits_title') ?? __('Benefits of the Package:')); ?></h4>
                                        <ul class="new_packageBook__list list_none mt-4">
                                            <?php $__currentLoopData = $service_benifits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benifit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list_show"><?php echo e($benifit->benifits); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if($service_details_for_book->is_service_online == 1): ?>
                                    <?php if($service_faqs && count($service_faqs) > 0): ?>
                                        <div class="faq-area" data-padding-top="70" data-padding-bottom="100">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 margin-top-30">
                                                        <div class="faq-contents">
                                                            <?php $__currentLoopData = $service_faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(empty($faq->title )): ?> <?php continue; ?>  <?php endif; ?>
                                                                <div class="faq-item">
                                                                    <div class="faq-title">
                                                                        <?php echo e($faq->title); ?>

                                                                    </div>
                                                                    <div class="faq-panel">
                                                                        <p class="faq-para"><?php echo e($faq->description); ?></p>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </fieldset>


                            <!-- Booking Info -->
                            <fieldset class="confirm-information padding-top-50 edit_style_booking_info">
                                <div class="custom-form">
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="single-input">
                                                <label class="label-title"> <?php echo e(__('Your Name')); ?> <span class="text-danger">*</span> </label>
                                                <input class="form--control radius-5" type="text" name="name" id="name" placeholder="<?php echo e(__('Enter Full Name')); ?>"
                                                       <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(Auth::user()->name); ?>" <?php else: ?> value="" <?php endif; ?>>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="single-input">
                                                <label class="label-title"><?php echo e(__('Your Email')); ?> <span class="text-danger">*</span> </label>
                                                <input type="text" class="form--control radius-5" name="email" id="email" placeholder="<?php echo e(__('Type Your Email')); ?>"
                                                       <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(Auth::user()->email); ?>" <?php else: ?> value="" <?php endif; ?>>
                                            </div>
                                        </div>

                                        <div class="<?php if(empty(get_static_option('google_map_settings'))): ?> col-sm-6 <?php else: ?> col-sm-12 <?php endif; ?>">
                                            <div class="single-input">
                                                <label class="label-title"><?php echo e(__('Phone Number')); ?> <span class="text-danger">*</span> </label>
                                                <input type="number" class="form--control radius-5" name="phone" id="phone" placeholder="<?php echo e(__('Type Your Number')); ?>"
                                                       <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(Auth::user()->phone); ?>" <?php else: ?> value="" <?php endif; ?>>
                                            </div>
                                        </div>

                                        <?php if(empty(get_static_option('google_map_settings'))): ?>
                                            <div class="col-sm-6">
                                                <div class="single-input">
                                                    <label class="label-title"><?php echo e(__('Post Code')); ?> <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form--control radius-5" name="post_code" id="post_code" placeholder="<?php echo e(__('Type Post Code')); ?>"
                                                           <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(Auth::user()->post_code); ?>" <?php else: ?> value="" <?php endif; ?>>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                        <div class="col-sm-12">
                                            <div class="single-input">
                                                <label class="label-title"><?php echo e(__('Your Address')); ?></label>
                                                <div class="input-with-icon">
                                                    <input type="text" class="form--control radius-5" name="address"
                                                           <?php if($service_details_for_book->is_service_online == 1): ?> id="user_address" <?php else: ?> id="address"  <?php endif; ?>
                                                           placeholder="<?php echo e(__('Type Your Address')); ?>"
                                                           <?php if(Auth::guard('web')->check()): ?> value="<?php echo e(Auth::user()->address); ?>"
                                                           <?php else: ?> value="" <?php endif; ?>>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="single-input">
                                                <label class="label-title"><?php echo e(__('Order Note')); ?></label>
                                                <textarea cols="30" rows="3" class="form--control radius-5" name="order_note" id="order_note" placeholder="<?php echo e(__('Type Order Note')); ?>"></textarea>
                                                <span><?php echo e(__('Max: 190 Character')); ?></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                    <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5" value="<?php echo e(__('Previous')); ?>"/>
                                    <input type="button" name="next" class="next stepForm_btn radius-5" value="<?php echo e(__('Next')); ?>"/>
                                </div>
                            </fieldset>

                            <?php if($service_details_for_book->is_service_online != 1): ?>
                                <!-- Schedule -->
                                <fieldset class="confirm-date-time padding-top-50 edit_style_schedule">
                                    <div class="row g-4 date-overview">
                                        <div class="col-xxl-4 col-xl-5 col-md-6">
                                            <h4 class="date-time-title"> <?php echo e(get_static_option('service_available_date_title') ?? __('Available Date')); ?> </h4>
                                            <div class="overview-location">
                                                <input type="hidden" class="flatpickr_calendar d-none" id="service_available_dates" name="service_available_dates">
                                                <ul class="date-time-list margin-top-20 show-date">
                                                    <span class="seller-id-for-schedule" style="display:none"><?php echo e($service_details_for_book->seller_id); ?></span>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-xxl-8 col-xl-7 col-md-6">
                                            <div class="schedule_radioInput mt-4">
                                                <div class="custom_radio custom_radio__inline">
                                                    <h4 class="date-time-title"><?php echo e(__('Select Time')); ?></h4>
                                                    <!-- Allow manual time input only -->
                                                    <div class="mt-3">
                                                        <label class="form-label"><?php echo e(__('Select Time')); ?> <span class="text-danger">*</span></label>
                                                        <input type="time" class="form-control" id="manual_time" name="manual_time" required>
                                                        <small class="form-text text-muted"><?php echo e(__('Please select your preferred time')); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                        <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5" value="<?php echo e(__('Previous')); ?>"/>
                                        <input type="button" name="next" class="next stepForm_btn radius-5" value="<?php echo e(__('Next')); ?>"/>
                                    </div>
                                </fieldset>
                            <?php endif; ?>

                            <!-- payment -->
                            <fieldset class="padding-top-50 edit_style_payment_option">
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <!-- Payment Information Message -->
                                        <div class="alert alert-info" style="background-color: #e7f3ff; border: 2px solid #2196F3; border-radius: 10px; padding: 25px;">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3" style="font-size: 32px;">ℹ️</div>
                                                <div>
                                                    <h4 class="alert-heading mb-3" style="color: #1976D2; font-weight: bold;">
                                                        <?php echo e(__('Payment Information')); ?>

                                                    </h4>
                                                    <p class="mb-2" style="font-size: 16px; line-height: 1.8; color: #333;">
                                                        <strong><?php echo e(__('Important:')); ?></strong> <?php echo e(__('The price for maintenance, repair, or installation will be calculated after the technician\'s inspection.')); ?>

                                                    </p>
                                                    <p class="mb-0" style="font-size: 16px; line-height: 1.8; color: #333;">
                                                        <strong><?php echo e(__('Payment Methods:')); ?></strong> <?php echo e(__('Cash, Visa, or STC Pay')); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden payment gateway field (required for form submission) -->
                                        <input type="hidden" name="selected_payment_gateway" value="cash_on_delivery">

                                        <!--agree button -->
                                        <div class="schedule_radioInput mt-4" style="float: right">
                                            <div class="checkbox-inlines bottom-checkbox terms-and-conditions">
                                                <input class="check-input" type="checkbox" id="check3" required>
                                                <label class="checkbox-label" for="check3"><?php echo e(__('I agree with')); ?>

                                                    <a href="<?php echo e(url('/'.get_static_option('select_terms_condition_page'))); ?>" target="_blank"><?php echo e(__('terms and conditions')); ?> <span class="text-danger">*</span></a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper btn_flex justify-content-end mt-4">
                                    <input type="button" name="stepPrevious" class="stepPrevious stepForm_btn__previous radius-5" value="<?php echo e(__('Previous')); ?>"/>
                                    <input type="submit" class="stepForm_btn radius-5" value="<?php echo e(get_static_option('service_order_confirm_title') ?? __('Confirm Your Order')); ?>">
                                </div>
                            </fieldset>
                        </div>



                        <!--Booking Summary section - Hidden -->
                        <div class="col-xl-3 col-lg-4" style="display: none;">
                            <div class="new_serviceDetails__side">
                                <div class="new_serviceDetails__side__item">
                                    <div class="new_serviceBooking__summary">
                                        <h4 class="new_serviceBooking__summary__title"> <?php echo e(get_static_option('service_booking_title') ?? __('Booking Summery')); ?> </h4>
                                        <div class="new_serviceBooking__summary__contents">
                                            <div class="new_serviceBooking__summary__contents__inner">

                                                <div class="mt-4">
                                                    <h4 class="new_serviceBooking__summary__sub_title border_top">
                                                        <?php if($service_details_for_book->is_service_online != 1): ?>
                                                            <?php echo e(get_static_option('service_appoinment_package_title') ?? __('Appointment Package Service')); ?>

                                                        <?php else: ?>
                                                            <ul class='onlilne-special-list'>
                                                                <li><i class="las la-clock"></i> <?php echo e(__('Delivery Days').': '.$service_details_for_book->delivery_days); ?></li>
                                                                <li class="margin-bottom-30"><i class="las la-redo-alt"></i> <?php echo e(__('Revisions').': '.$service_details_for_book->revision); ?></li>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </h4>
                                                </div>
                                                <!--Service additional -->
                                                <ul class="summery_list border_top list_none <?php if($service_details_for_book->is_service_online == 1): ?> d-none <?php endif; ?>">
                                                    <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list include_service_id_<?php echo e($include->id); ?> include_service_list">
                                                            <input type="hidden" class="includeServiceID" value="<?php echo e($include->id); ?>">
                                                            <span class="item__title"><?php echo e($include->include_service_title); ?></span>
                                                            <?php if($service_details_for_book->is_service_online !=1): ?>
                                                                <span class="item_count include_service_quantity service_quantity_count" id="include_service_quantity_3_<?php echo e($include->id); ?>">
                                                                <?php echo e($include->include_service_quantity); ?>

                                                            </span>
                                                                <span class="value_count room-count" style="display: none;"><?php echo e(amount_with_currency_symbol($include->include_service_price)); ?></span>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>

                                                <!--Package fee - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"><?php echo e(get_static_option('service_package_fee_title') ?? __('Package Fee')); ?></span>
                                                        <span class="value_count package-fee"><?php echo e(amount_with_currency_symbol($service_details_for_book->price)); ?></span>
                                                    </li>
                                                </ul>
                                                <h4 class="new_serviceBooking__summary__sub_title border_top"><?php echo e(get_static_option('service_extra_title') ?? __('Extra Service')); ?></h4>
                                                <input type="hidden" name="package_fee_input_hiddend_field_for_js_calculation" value="<?php echo e($service_details_for_book->price); ?>">

                                                <!--additional service for display data-->
                                                <ul class="summery_list list_none extra-service-list">

                                                </ul>

                                                <!--additional service for backend request data-->
                                                <ul class="summery_list extra-service-list-2 d-none">

                                                </ul>

                                                <!--extra service count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"> <?php echo e(get_static_option('service_extra_title') ?? __('Extra Service')); ?></span>
                                                        <span class="value-count extra-service-fee"><?php echo e(amount_with_currency_symbol(0)); ?></span>
                                                    </li>
                                                </ul>

                                                <!--sub-total count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"> <?php echo e(get_static_option('service_subtotal_title') ?? __('Subtotal')); ?></span>
                                                        <span class="value-count service-subtotal"><?php echo e(amount_with_currency_symbol(0)); ?></span>
                                                    </li>
                                                </ul>

                                                <!--Tax Count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"> <?php echo e(__('Tax(+)')); ?>

                                                             <span class="service-tax"><?php echo e(optional($country_tax)->tax ?? 0); ?></span> %
                                                        </span>
                                                        <span class="value-count tax-amount"><?php echo e(amount_with_currency_symbol(0)); ?></span>
                                                    </li>
                                                </ul>

                                                <!--service Sub Total value -->
                                                <input type="hidden" name="service_subtotal_input_hidden_field_for_js_calculation" value="">

                                                <!--Total count - Hidden -->
                                                <ul class="new_serviceBooking__summary__list list_none border_top" style="display: none;">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="item__title"><strong><?php echo e(get_static_option('service_total_amount_title') ?? __('Total')); ?></strong></span>
                                                        <span class="value-count total-amount total_amount_for_coupon" id="total_amount_for_coupon"><?php echo e(amount_with_currency_symbol(0)); ?></span>
                                                    </li>
                                                </ul>


                                                <ul class="new_serviceBooking__summary__list list_none mt-3">
                                                    <li class="new_serviceBooking__summary__list__item">
                                                        <span class="coupon_amount_for_apply_code"> </span>
                                                    </li>
                                                </ul>


                                                <ul class="new_serviceBooking__summary__list list_none border_top coupon_input_field">
                                                    <li class="result-list">
                                                        <input type="text" name="coupon_code" class="form-control coupon_code" placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
                                                        <button class="apply-coupon"><?php echo e(__('Apply')); ?></button>
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Service Details area end -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.pages.services.service-book-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SyanTeck\@core\resources\views/frontend/pages/services/service-book.blade.php ENDPATH**/ ?>