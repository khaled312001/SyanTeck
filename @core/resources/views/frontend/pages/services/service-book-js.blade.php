@section('scripts')
    <script>
        const UserSelectedLangSlug = "{{current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))}}";
    </script>
    <!--google map js -->
    @if(!empty(get_static_option('google_map_settings')))
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key={{get_static_option('service_google_map_api_key')}}"></script>
    @endif
    <script src="{{asset('assets/common/js/flatpickr.js')}}"></script>
    <script src="//npmcdn.com/flatpickr/dist/l10n/{{current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))}}.js"></script>
    <x-payment-gateway-js/>
    <script>
        (function($) {
            "use strict";

            $(document).ready(async function() {

                $('#kineticpay_bank').select2({

                });

                let site_default_currency_symbol = '{{ site_currency_symbol() }}';
                $('#choose_service_city').on('change',function(){
                    let city_id = $(this).val();
                    $.ajax({
                        method:'post',
                        url:"{{route('user.city.area')}}",
                        data:{city_id:city_id},
                        success:function(res){
                            if(res.status=='success'){
                                var alloptions = '<option value="">{{__("Select Area")}}</option>';
                                var allAreas = res.areas;
                                $.each(allAreas,function(index,value){
                                    alloptions +="<option value='" + value.id + "'>" + value.service_area + "</option>";
                                });
                                $(".get_service_area").html(alloptions);
                                // Don't update user_address dropdown as it now shows all regions, not just city-specific areas
                                $('#choose_service_area').niceSelect('update');
                            }
                        }
                    })
                })

                function extra_service_calculate(){
                    let additional_total_price = 0;
                    let additional_services = $("div.single-additional");

                    for (let i = 0; i < additional_services.length; i++) {
                        let service_data = $(additional_services[i]).find('.inc_dec_additional_service');
                        let service_count = service_data.find($('.room-count')).text();
                        let unit_price = service_data.find($('.value-count')).text().replace(site_default_currency_symbol, '');

                        additional_total_price += (service_count * unit_price);
                    }
                    $('.extra-service-fee').text(site_default_currency_symbol+additional_total_price);
                }

                function subtotal_calculate(){
                    let package_fee = parseInt($('input[name="package_fee_input_hiddend_field_for_js_calculation"]').val());
                    let extra_service_fee = parseInt($('.extra-service-fee').text().replace(',','').replace(site_default_currency_symbol,''));
                    let service_subtotal = package_fee+extra_service_fee;
                    $('.service-subtotal').text(site_default_currency_symbol+service_subtotal);
                    $('input[name="service_subtotal_input_hidden_field_for_js_calculation"]').val(service_subtotal);
                }
                subtotal_calculate();

                function total_amount(){
                    tax_calculate()
                    let subtotal = $('input[name="service_subtotal_input_hidden_field_for_js_calculation"]').val();
                    let tax = parseFloat($('.tax-amount').text().replace(',','').replace(site_default_currency_symbol,''));

                    let total_amount = parseInt(subtotal)+tax;
                    $('.total-amount').text(site_default_currency_symbol+total_amount);
                }
                total_amount()

                function tax_calculate(){
                    let subtotal = $('input[name="service_subtotal_input_hidden_field_for_js_calculation"]').val();
                    let service_tax = parseFloat($('.service-tax').text());
                    if(service_tax >0){
                        let tax_amount = (subtotal * service_tax)/100;
                        $('.tax-amount').text(site_default_currency_symbol+tax_amount);
                    }else{
                        let tax_amount = 0;
                        $('.tax-amount').text(site_default_currency_symbol+tax_amount);
                    }
                }

                //location
                $('#choose_service_area').on('change', function() {
                    let area_text = $("#choose_service_area :selected").text();
                    $('.area_name_text').text(area_text);
                })
                
                //service location (user_address)
                $('#user_address').on('change', function() {
                    let location_text = $("#user_address :selected").text();
                    $('.location_name_text').text(location_text);
                })

                //confirm-location
                $('.confirm-location .next').on('click', function() {

                    let area_name = $('#choose_service_area').val();
                    let location_name = $('#user_address').val();
                    let city_text = $('#choose_service_city').text();
                    let country_text = $('#choose_service_country').text();

                    var check_user_address = '';
                    
                    // Check if location (user_address) is selected
                    check_user_address = location_name == '';

                    $('.city_name_text').text(city_text);
                    $('.country_name_text').text(country_text);

                    if(check_user_address) {
                        Command: toastr["warning"]("{{ __('Please select service location!') }}", "{{ __('Aviso') }}");
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }else{

                        var current_fs, next_fs, previous_fs;
                        var opacity;
                        var current = 1;
                        var steps = $("fieldset").length;
                        current_fs = $(this).parent();
                        next_fs = $(this).parent().next();

                        $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass("active");

                        next_fs.show();
                        current_fs.animate({
                            opacity: 0
                        }, {
                            step: function(now) {
                                opacity = 1 - now;

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({
                                    'opacity': opacity
                                });
                            },
                            duration: 500
                        });
                    }

                })
                //location end



                //Service start
                $(document).on('click', '.remove-service-list', function() {
                    let include_service_id = $(this).data('id');
                    $('.include_service_id_' + include_service_id).remove();

                    var include_total_price = 0;
                    var quantity = Number($(this).val());

                    $('#include_service_quantity_2_' + include_service_id).text(quantity);
                    $('#include_service_quantity_3_' + include_service_id).text(quantity);

                    if (isNaN(quantity)) {
                        alert('Please Enter Numbers Only');
                    } else {
                        let included_services = $("div.single-include");

                        for (let i = 0; i < included_services.length; i++) {
                            let service_data = $(included_services[i]).find('.inc_dec_include_service');
                            let service_count = Number(service_data.val());
                            let service_total_price = Number(service_data.data('price'));
                            include_total_price += (service_count * service_total_price);
                        }
                        $('input[name="package_fee_input_hiddend_field_for_js_calculation"]').val(parseFloat(include_total_price));
                        $('.package-fee').text(site_default_currency_symbol+include_total_price);
                        subtotal_calculate();
                        total_amount();
                    }

                })

                //Increment Decrement include service
                $(document).on('keyup click', '.inc_dec_include_service, .include_service_qty_decrement', function() {

                    var include_total_price = 0;
                    var include_service_id = 0;
                    var quantity = 0;

                     include_service_id = $(this).prev('.inc_dec_include_service').data('id');
                     quantity = Number($(this).prev('.inc_dec_include_service').val());

                     if(typeof include_service_id === 'undefined'){
                         include_service_id = $(this).data('id');
                         quantity = Number($(this).val());
                     }

                     if(typeof include_service_id === 'undefined'){
                         include_service_id = $(this).next('.inc_dec_include_service').data('id');
                         quantity = Number($(this).next('.inc_dec_include_service').val());
                     }



                    $('#include_service_quantity_2_' + include_service_id).text(quantity);
                    $('#include_service_quantity_3_' + include_service_id).text(quantity);

                    if (isNaN(quantity)) {
                        console.log('Please Enter Numbers Only')
                    } else {

                        let included_services = $("div.single-include");

                        for (let i = 0; i < included_services.length; i++) {
                            let service_data = $(included_services[i]).find('.inc_dec_include_service');
                            let service_count = Number(service_data.val());
                            let service_total_price = Number(service_data.data('price'));
                            include_total_price += (service_count * service_total_price);
                        }

                        $('.package-fee').text(site_default_currency_symbol+include_total_price);
                        $('input[name="package_fee_input_hiddend_field_for_js_calculation"]').val(parseFloat(include_total_price));
                        subtotal_calculate();
                        total_amount();
                    }
                })

                //Upgrade order with extras
                $(document).on('click','.extra-services .check-input',function(){

                    let additional_service_id = $(this).val();
                    let service_name = $('label[for=' + additional_service_id + ']').text();
                    let unit_price = $('span[price=' + additional_service_id + ']').text().replace(site_default_currency_symbol, '');
                    let quantity = $('#additional_service_quantity_'+additional_service_id).val();

                    if($(this).is(":checked")) {
                        $('.extra-service-list').append('<div class="single-additional">\
                            <li class="list inc_dec_additional_service" id="additional_service_id_'+additional_service_id+'">\
                                <span class="rooms">'+ service_name +'</span>\
                                <span class="room-count service_quantity_count item_count">'+quantity+'</span>\
                                <span class="value-count">'+site_default_currency_symbol+unit_price+ '</span>\
                            </li>\
                        </div>');

                        $('.extra-service-list-2').append('<div class="single-additional-2">\
                            <li class="list inc_dec_additional_service additional_service_list" id="additional_service_id_2_'+additional_service_id+'">\
                                <input type="hidden" class="additionalServiceID" value="'+additional_service_id+'">\
                                <span class="rooms">'+ service_name +'</span>\
                                <span class="room-count additional_service_quantity service_quantity_count">'+quantity+'</span>\
                                <span class="value-count">'+site_default_currency_symbol+unit_price+ '</span>\
                            </li>\
                        </div>');

                        $('.extra-service-list').addClass('border_top');

                        extra_service_calculate();
                        subtotal_calculate();
                        total_amount();
                        tax_calculate()
                    }else{
                        $(".single-additional #additional_service_id_"+additional_service_id).remove();
                        $(".single-additional-2 #additional_service_id_2_"+additional_service_id).remove();
                        $('.extra-service-list').removeClass('border_top');
                        extra_service_calculate();
                        subtotal_calculate();
                        total_amount();
                    }
                })

                $(document).on('keyup click', '.inc_dec_additional_service, .additional_service_qty_decrement', function() {


                    var additional_service_id = 0;
                    var quantity = 0;

                        additional_service_id = $(this).prev('.inc_dec_additional_service').data('id');
                        quantity = Number($(this).prev('.inc_dec_additional_service').val());

                        if(typeof additional_service_id === 'undefined'){
                            additional_service_id = $(this).data('id');
                            quantity = Number($(this).val());
                        }

                        if(typeof additional_service_id === 'undefined'){
                            additional_service_id = $(this).next('.inc_dec_additional_service').data('id');
                            quantity = Number($(this).next('.inc_dec_additional_service').val());
                        }




                    $('.single-additional #additional_service_id_'+additional_service_id+' .room-count').text(quantity);
                    $('.single-additional-2 #additional_service_id_2_'+additional_service_id+' .room-count').text(quantity);

                    if (isNaN(quantity)) {
                        console.log('Please enter number only');
                    } else {
                        extra_service_calculate();
                        subtotal_calculate();
                        total_amount();
                        tax_calculate()
                    }
                })

                //confirm-service
                $('.confirm-service .next').on('click', function() {
                    $('.flatpickr-day.today').trigger('click');
                    var current_fs, next_fs, previous_fs;
                    var opacity;
                    var current = 1;
                    var steps = $("fieldset").length;
                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();

                    $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass(
                        "active");

                    next_fs.show();
                    current_fs.animate({
                        opacity: 0
                    }, {
                        step: function(now) {
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({
                                'opacity': opacity
                            });
                        },
                        duration: 500
                    });
                })

                //Service end

                //Date and time - Allow any date selection with Arabic locale
                $("#service_available_dates").flatpickr({
                    minDate: "today",
                    // Remove maxDate restriction to allow any future date
                    inline: true,
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    locale: UserSelectedLangSlug || "ar",
                    // Arabic locale settings
                    monthSelectorType: "static"
                });


                // Date selection - no schedule loading needed
                var date_string_format='';
                $(document).on('change','#service_available_dates',function(){
                    let date_string = $(this).val();
                    let day_date = new Date($(this).val());
                    date_string_format = day_date.toDateString();

                    //set value in confirmation fieldset
                    $('.confirm-overview-left .available_date').text(date_string);
                })

                // Manual time input only
                var available_schedule ='';
                $(document).on('change','#manual_time',function(){
                    let manualTime = $(this).val();
                    if(manualTime) {
                        // Convert 24h to 12h format for display
                        let timeParts = manualTime.split(':');
                        let hours = parseInt(timeParts[0]);
                        let minutes = timeParts[1];
                        let ampm = hours >= 12 ? 'pm' : 'am';
                        hours = hours % 12;
                        hours = hours ? hours : 12;
                        available_schedule = hours + ':' + minutes + ampm;
                        //set value in confirmation fieldset
                        $('.confirm-overview-left .available_schedule').text(available_schedule);
                    }
                })

                //confirm-date-time
                $('.confirm-date-time .next').on('click',function(){
                    // Check if date is selected
                    let selectedDate = $('#service_available_dates').val();
                    // Check if time is selected (either from schedule or manual input)
                    let selectedTime = $('input[name="time_schedule"]:checked').val() || $('#manual_time').val();
                    
                    if(!selectedDate || !selectedTime){
                        Command: toastr["warning"]("{{__('Please select date and time!')}}", "{{ __('Aviso') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }else{
                        // Update date_string_format and available_schedule for form submission
                        if(selectedDate) {
                            let day_date = new Date(selectedDate);
                            date_string_format = day_date.toDateString();
                        }
                        if(selectedTime) {
                            // If manual time, convert to 12h format
                            if($('#manual_time').val()) {
                                let timeParts = selectedTime.split(':');
                                let hours = parseInt(timeParts[0]);
                                let minutes = timeParts[1];
                                let ampm = hours >= 12 ? 'pm' : 'am';
                                hours = hours % 12;
                                hours = hours ? hours : 12;
                                available_schedule = hours + ':' + minutes + ampm;
                            } else {
                                available_schedule = selectedTime;
                            }
                        }
                        var current_fs, next_fs, previous_fs;
                        var opacity;
                        var current = 1;
                        var steps = $("fieldset").length;
                        current_fs = $(this).parent();
                        next_fs = $(this).parent().next();

                        $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass("active");

                        next_fs.show();
                        current_fs.animate({ opacity: 0 }, {
                            step: function(now) {
                                opacity = 1 - now;

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({ 'opacity': opacity });
                            },
                            duration: 500
                        });
                    }
                })

                //confirm-information
                $('.confirm-information .next').on('click',function(){

                    let name =  $('#name').val();
                    let email = $('#email').val();
                    let phone = $('#phone').val();
                    let post_code = $('#post_code').val();
                    let address =   $('#address').val();
                    let order_note = $('#order_note').val();
                    // Add manual additional service to order note if provided
                    let manual_additional = $('#manual_additional_service').val();
                    if(manual_additional && manual_additional.trim() !== '') {
                        if(order_note && order_note.trim() !== '') {
                            order_note += '\n\n' + '{{ __("Additional Service") }}' + ': ' + manual_additional;
                        } else {
                            order_note = '{{ __("Additional Service") }}' + ': ' + manual_additional;
                        }
                        // Update the order_note field with the combined value
                        $('#order_note').val(order_note);
                    }

                    //set value in confirmation fieldset
                    $('.booking-details .get_name').text(name);
                    $('.booking-details .get_email').text(email);
                    $('.booking-details .get_phone').text(phone);
                    $('.booking-details .get_post_code').text(post_code);
                    $('.booking-details .get_address').text(address);
                    $('.booking-details .get_order_note').text(order_note);
                    // Address is now optional, so we don't check it
                    @php
                        $hasGoogleMap = !empty(get_static_option('google_map_settings'));
                    @endphp
                    @if(empty(get_static_option('google_map_settings')))
                        if(name=='' || email=='' || phone=='' || post_code==''){
                    @else
                        if(name=='' || email=='' || phone==''){
                    @endif
                        Command: toastr["warning"]("{{__('Please fill all required fields!')}}", "{{ __('Aviso') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }else{
                        var current_fs, next_fs, previous_fs;
                        var opacity;
                        var current = 1;
                        var steps = $("fieldset").length;
                        current_fs = $(this).parent();
                            next_fs = $(this).parent().next();
                        $(".step-list li, .step-list-two li").eq($("fieldset").index(next_fs)).addClass("active");

                        next_fs.show();
                        current_fs.animate({ opacity: 0 }, {
                            step: function(now) {
                                opacity = 1 - now;

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({ 'opacity': opacity });
                            },
                            duration: 500
                        });
                    }
                })

                //Order Confirm
                $(document).on('submit','.ms-order-form',function(e){

                    if(!$('.terms-and-conditions .check-input').is(":checked")){
                        //error msg
                        Command: toastr["warning"]("{{__('Please agree with terms and conditions!')}}", "{{ __('Aviso') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                    if($('input[name="selected_payment_gateway"]').val() == ''){
                        //error msg
                        Command: toastr["warning"]("{{__('Please select payment gateway!')}}", "{{ __('Aviso') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }

                    let formContainer = $('#msform');

                    let available_date = $('.available_date').text();

                    formContainer.find('input[name=date]').val(available_date);
                    let available_schedule = $('.available_schedule').text();
                    formContainer.find('input[name=schedule]').val(available_schedule);
                    let coupon_code = $('.coupon_code').val();
                    formContainer.find('input[name=coupon_code]').val(coupon_code);

                    let services = [];
                    let included_services = $("li.include_service_list");

                    for (let i = 0; i < included_services.length; i++) {
                        let include_service_quantity = $(included_services[i]).find('.include_service_quantity').text();
                        let include_service_id = $(included_services[i]).find('.includeServiceID').val();
                        services.push({
                            id: include_service_id,
                            quantity: include_service_quantity
                        })
                        $('#msform').append('<input type="hidden" name="services['+i+'][id]" value="'+include_service_id+'"/>');
                        $('#msform').append('<input type="hidden" name="services['+i+'][quantity]" value="'+include_service_quantity+'"/>');
                    }

                    let additionals = [];
                    let additional_services = $("li.additional_service_list");

                    for (let i = 0; i < additional_services.length; i++) {
                        let additional_service_quantity = $(additional_services[i]).find('.additional_service_quantity').text();
                        let additional_service_id = $(additional_services[i]).find('.additionalServiceID').val();
                        additionals.push({
                            id: additional_service_id,
                            quantity: additional_service_quantity
                        })
                        $('#msform').append('<input type="hidden" name="additionals['+i+'][id]" value="'+additional_service_id+'"/>');
                        $('#msform').append('<input type="hidden" name="additionals['+i+'][quantity]" value="'+additional_service_quantity+'"/>');
                    }

                });

                //apply coupon code
                $(document).on('click','.apply-coupon',function(e){
                    e.preventDefault();
                    let total_amount = $('.total_amount_for_coupon').text().replace(',','').replace(site_default_currency_symbol,'');
                    let coupon_code = $('.coupon_code').val();
                    let seller_id = $('#seller_id').val();

                    $.ajax({
                        url:"{{ route('service.coupon.apply') }}",
                        method:"get",
                        data:{
                            coupon_code:coupon_code,
                            total_amount:total_amount,
                            seller_id:seller_id,
                        },
                        success:function(res){
                            console.log(res)
                            if (res.status == 'success') {
                                let coupon_amount = res.coupon_amount;
                                let new_total = (total_amount-coupon_amount)*1;
                                $('#total_amount_for_coupon').text(site_default_currency_symbol+new_total.toFixed(2));
                                $('.coupon_input_field').hide();
                                $('.coupon_amount_for_apply_code').html('<strong>{{__("Coupon Discount")}}</strong>' + site_default_currency_symbol+coupon_amount.toFixed(2))
                            }
                            if (res.status == 'invalid') {
                                Command: toastr["warning"]("{{__('Coupon is invalid!')}}", "{{ __('Aviso') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false;
                            }
                            if (res.status == 'expired') {
                                Command: toastr["warning"]("{{__('Coupon already expired!')}}", "{{ __('Aviso') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false;
                            }
                            if (res.status == 'notapplicable') {

                                Command: toastr["warning"]("{{__('Coupon is not applicable for this service!')}}", "{{ __('Aviso') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false;
                            }
                            if (res.status == 'emptycoupon') {
                                Command: toastr["warning"]("{{__('Please enter your coupon!')}}", "{{ __('Aviso') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false;
                            }


                        }
                    });
                })

                //order loader
                $('.order_loader').hide();
                $(document).on('click','.pay_and_confirm_order',function(e){
                    $('.order_loader').show();
                });

                // GPS Location functionality for service booking
                setupGPSLocationService();





            });
        })(jQuery);
    </script>

    <!-- for input qty validation -->
    <script>
        function validateNumberInput(input) {
            // Get the entered value
            var value = parseInt(input.value);
            // Check if the value is less than 1
            if (value < 1 || isNaN(value) || /^0/.test(input.value)) {
                // Set the input value to 1
                input.value = 1;
            }
        }
        
        function setupGPSLocationService() {
            const getLocationBtn = $('.btn-get-location-service');
            const addressField = $('#address, #user_address');
            const locationStatus = $('.location-status-service');
            
            if (getLocationBtn.length === 0 || addressField.length === 0) return;
            
            getLocationBtn.on('click', function() {
                if (!navigator.geolocation) {
                    locationStatus.html('<span style="color: #dc3545;">{{__("Geolocation is not supported by your browser")}}</span>');
                    return;
                }
                
                // Show loading state
                const $btn = $(this);
                $btn.prop('disabled', true);
                $btn.html('<i class="las la-spinner la-spin"></i> <span>{{__("Getting location...")}}</span>');
                locationStatus.html('<span style="color: #FFD700;">{{__("Please allow location access...")}}</span>');
                
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        
                        locationStatus.html('<span style="color: #FFD700;">{{__("Getting address...")}}</span>');
                        
                        // Use Google Geocoding API to get address
                        const apiKey = '{{get_static_option("service_google_map_api_key")}}';
                        if (!apiKey) {
                            // Fallback: use OpenStreetMap Nominatim API (free, no key required)
                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data && data.display_name) {
                                        addressField.val(data.display_name);
                                        addressField.prop('readonly', false);
                                        locationStatus.html('<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected successfully!")}}</span>');
                                    } else {
                                        addressField.val(`${latitude}, ${longitude}`);
                                        addressField.prop('readonly', false);
                                        locationStatus.html('<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected! You can edit the address if needed.")}}</span>');
                                    }
                                    $btn.prop('disabled', false);
                                    $btn.html('<i class="las la-map-marker-alt"></i> <span>{{__("Get Location")}}</span>');
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    addressField.val(`${latitude}, ${longitude}`);
                                    addressField.prop('readonly', false);
                                    locationStatus.html('<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected! You can edit the address if needed.")}}</span>');
                                    $btn.prop('disabled', false);
                                    $btn.html('<i class="las la-map-marker-alt"></i> <span>{{__("Get Location")}}</span>');
                                });
                        } else {
                            // Use Google Geocoding API
                            fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}&language={{app()->getLocale()}}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'OK' && data.results && data.results.length > 0) {
                                        addressField.val(data.results[0].formatted_address);
                                        addressField.prop('readonly', false);
                                        locationStatus.html('<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected successfully!")}}</span>');
                                    } else {
                                        addressField.val(`${latitude}, ${longitude}`);
                                        addressField.prop('readonly', false);
                                        locationStatus.html('<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected! You can edit the address if needed.")}}</span>');
                                    }
                                    $btn.prop('disabled', false);
                                    $btn.html('<i class="las la-map-marker-alt"></i> <span>{{__("Get Location")}}</span>');
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    addressField.val(`${latitude}, ${longitude}`);
                                    addressField.prop('readonly', false);
                                    locationStatus.html('<span style="color: #4CAF50;"><i class="las la-check-circle"></i> {{__("Location detected! You can edit the address if needed.")}}</span>');
                                    $btn.prop('disabled', false);
                                    $btn.html('<i class="las la-map-marker-alt"></i> <span>{{__("Get Location")}}</span>');
                                });
                        }
                    },
                    function(error) {
                        let errorMessage = '{{__("Error getting location")}}';
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
                        locationStatus.html(`<span style="color: #dc3545;"><i class="las la-exclamation-circle"></i> ${errorMessage}</span>`);
                        $btn.prop('disabled', false);
                        $btn.html('<i class="las la-map-marker-alt"></i> <span>{{__("Get Location")}}</span>');
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            });
            
            // Auto-detect location when booking info fieldset is shown
            $(document).on('click', '.confirm-information .next, .confirm-service .next', function() {
                setTimeout(function() {
                    if (!addressField.val() || addressField.val().trim() === '') {
                        getLocationBtn.trigger('click');
                    }
                }, 300);
            });
        }

        // Leaflet Map initialization for service book (Free, no API key needed)
        let bookMap;
        let bookMarker;
        let bookUserLocation = null;

        function showBookMapError(message) {
            const loadingElement = document.getElementById('map-loading');
            if (loadingElement) {
                loadingElement.innerHTML = '<div style="text-align: center; padding: 30px 20px;"><i class="las la-exclamation-triangle" style="font-size: 48px; color: #dc3545; margin-bottom: 15px;"></i><p style="color: #dc3545; font-size: 18px; font-weight: 600; margin-bottom: 10px;">{{__("عفوًا، حدث خطأ.")}}</p><p style="color: #666; font-size: 14px; line-height: 1.6;">' + message + '</p></div>';
            }
        }

        function initBookMap() {
            console.log('Initializing Leaflet Map for service book...');
            
            try {
                const mapElement = document.getElementById('location-map');
                const loadingElement = document.getElementById('map-loading');
                
                if (!mapElement) {
                    console.error('Map element not found');
                    return;
                }
                
                // Check if Leaflet is loaded
                if (typeof L === 'undefined') {
                    showBookMapError('{{__("جاري تحميل مكتبة الخريطة...")}}');
                    setTimeout(initBookMap, 500);
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
                bookMap = L.map('location-map', {
                    center: defaultCenter,
                    zoom: 15,
                    zoomControl: true
                });
                
                // Add OpenStreetMap tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(bookMap);
                
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
                bookMarker = L.marker(defaultCenter, {
                    draggable: true,
                    icon: redIcon
                }).addTo(bookMap);
                
                // Update address when marker is dragged
                bookMarker.on('dragend', function() {
                    updateBookAddressFromMarker();
                });
                
                // Update address when map is clicked
                bookMap.on('click', function(event) {
                    bookMarker.setLatLng(event.latlng);
                    updateBookAddressFromMarker();
                });
                
                // Get user location automatically
                getBookCurrentLocation();
            } catch (error) {
                console.error('Error in initBookMap:', error);
                showBookMapError('{{__("خطأ في تهيئة الخريطة. يرجى تحديث الصفحة.")}}');
            }
        }

        function getBookCurrentLocation() {
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
                    
                    bookUserLocation = { lat: latitude, lng: longitude };
                    
                    // Center map on user location
                    if (bookMap) {
                        bookMap.setView([bookUserLocation.lat, bookUserLocation.lng], 17);
                    }
                    
                    // Set marker position
                    if (bookMarker) {
                        bookMarker.setLatLng([bookUserLocation.lat, bookUserLocation.lng]);
                    }
                    
                    // Get address
                    updateBookAddressFromMarker();
                    
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

        function updateBookAddressFromMarker() {
            if (!bookMarker) return;
            
            const locationStatus = document.getElementById('location-status');
            const latlng = bookMarker.getLatLng();
            const lat = latlng.lat;
            const lng = latlng.lng;
            
            // Update hidden fields
            const latField = document.getElementById('latitude');
            const lngField = document.getElementById('longitude');
            const addressField = document.getElementById('user_address');
            
            if (latField) latField.value = lat;
            if (lngField) lngField.value = lng;
            
            // Get address from coordinates using Nominatim (OpenStreetMap geocoding - free) - silently in background
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language={{app()->getLocale()}}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        if (addressField) addressField.value = data.display_name;
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

        // Initialize map when location fieldset is shown
        $(document).on('click', '.confirm-location .next, .edit_location', function() {
            setTimeout(function() {
                if (!bookMap) {
                    initBookMap();
                }
            }, 500);
        });

        // Also initialize on page load if fieldset is visible
        $(document).ready(function() {
            setTimeout(function() {
                const locationFieldset = document.querySelector('.confirm-location');
                if (locationFieldset && locationFieldset.style.display !== 'none') {
                    initBookMap();
                }
            }, 1000);
        });
    </script>

    <x-payment-gateway-two-js/>
@endsection