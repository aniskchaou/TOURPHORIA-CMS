<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/16/2015
 * Time: 6:03 PM
 */
?>
<?php
$enable_token = st()->get_option('stripe_enable_token', 'off');
if($enable_token == 'on'){
    wp_enqueue_script( 'st-stripe-js' );
	wp_enqueue_style('stripe-css');
}
if($enable_token == 'off'){ ?>
    <div class="pm-info">
        <div class="row">
            <div class="col-sm-6">
                <div class="col-card-info">
                    <div class="form-group">
                        <label for="st_stripe_card_number"><?php _e('Card number (*)',ST_TEXTDOMAIN) ?></label>
                        <div class="controls">
                            <input type="text" class="form-control" align="" name="st_stripe_card_number" id="st_stripe_card_number" placeholder="<?php _e('Your card number',ST_TEXTDOMAIN) ?>">
                        </div>
                    </div>
                    <div class="card-code-expiry">
                        <div class="form-group expiry-date">
                            <label for="st_stripe_card_expiry_month"><?php _e('Expiry date (*)',ST_TEXTDOMAIN) ?></label>
                            <div class="controls clearfix">
                                <div class="form-control-wrap">
                                    <select name="st_stripe_card_expiry_month" id="st_stripe_card_expiry_month" class="form-control app required">
                                        <optgroup label="<?php _e('Month',ST_TEXTDOMAIN)?>">
                                            <?php
                                            for($i=1;$i<=12;$i++){
                                                printf('<option value="%s">%s</option>',$i,$i);
                                            } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-control-wrap">
                                    <select name="st_stripe_card_expiry_year" id="st_stripe_card_expiry_year" class="form-control app required">
                                        <optgroup label="<?php _e('Year',ST_TEXTDOMAIN)?>">
                                            <?php
                                            $y=date('Y');
                                            for($i=date('Y');$i<$y+49;$i++){
                                                printf('<option value="%s">%s</option>',$i,$i);
                                            } ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group card-code">
                            <label for="st_stripe_card_code"><?php _e('Card code (*)',ST_TEXTDOMAIN) ?></label>
                            <div class="controls">
                                <input type="text" class="form-control" align="" name="st_stripe_card_code" id="st_stripe_card_code required">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}else{ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <div class="pm-info">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-card-info st-stripe-card-info stripe-card-form">
                    <div class="form-group">
                        <label for="st_stripe_card_holder"><?php _e('Card holder (*)',ST_TEXTDOMAIN) ?></label>
                        <div class="controls">
                            <input type="text" class="form-control field is-empty" align="" name="st_stripe_card_holder" id="st_stripe_card_holder" placeholder="<?php _e('Your card holder',ST_TEXTDOMAIN) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="st_stripe_card_number"><?php _e('Card number (*)',ST_TEXTDOMAIN) ?></label>
                        <div class="controls">
                            <div id="st_stripe_card_number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="stripe-othird-width">
                            <label for="st_stripe_card_expiry"><?php _e('Expiration (*)',ST_TEXTDOMAIN) ?></label>
                            <div class="controls">
                                <div id="st_stripe_card_expiry"></div>
                            </div>
                        </div>
                        <div class="stripe-othird-width">
                            <label for="st_stripe_card_cvc"><?php _e('CVC (*)',ST_TEXTDOMAIN) ?></label>
                            <div class="controls">
                                <div id="st_stripe_card_cvc"></div>
                            </div>
                        </div>
                        <div class="stripe-othird-width last-child">
                            <label for="st_stripe_card_zipcode"><?php _e('ZIP (*)',ST_TEXTDOMAIN) ?></label>
                            <div class="controls">
                                <input type="text" class="form-control field is-empty" align="" name="st_stripe_card_zipcode" id="st_stripe_card_zipcode" placeholder="<?php _e('Zipcode',ST_TEXTDOMAIN) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="outcome">
                        <div class="error" role="alert"></div>
                        <div class="success"></div>
                    </div>
                </div>
                <input name="token" type="hidden" value="" id="token"/>
                <input type="hidden" name="wait_validate_st_stripe" value="wait">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            'use strict';
            var stripePublishKey = st_stripe_params.stripe.publishKey;

            if(st_stripe_params.stripe.sanbox == 'sandbox'){
                stripePublishKey = st_stripe_params.stripe.testPublishKey
            }

            if(stripePublishKey == ''){
                return false;
            }

            var stripe = Stripe(stripePublishKey);
            var elements = stripe.elements();

            var elementStyles = {
                base: {
                    color: '#32325D',
                    fontWeight: 500,
                    fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
                    fontSize: '14px',
                    fontSmoothing: 'antialiased',
                    '::placeholder': {
                        color: '#8d8d8d',
                    },
                    ':-webkit-autofill': {
                        color: '#e39f48',
                    },
                },
                invalid: {
                    color: '#E25950',

                    '::placeholder': {
                        color: '#FFCCA5',
                    },
                },
            };

            var elementClasses = {
                focus: 'is-focused',
                empty: 'is-empty',
                invalid: 'invalid',
            };

            var cardNumber = elements.create('cardNumber', {
                style: elementStyles,
                classes: elementClasses,
            });
            cardNumber.mount('#st_stripe_card_number');

            var cardExpiry = elements.create('cardExpiry', {
                style: elementStyles,
                classes: elementClasses,
            });
            cardExpiry.mount('#st_stripe_card_expiry');

            var cardCvc = elements.create('cardCvc', {
                style: elementStyles,
                classes: elementClasses,
            });
            cardCvc.mount('#st_stripe_card_cvc');

            var inputs = document.querySelectorAll('input.field');
            Array.prototype.forEach.call(inputs, function(input) {
                input.addEventListener('focus', function() {
                    input.classList.add('is-focused');
                });
                input.addEventListener('blur', function() {
                    input.classList.remove('is-focused');
                });
                input.addEventListener('keyup', function() {

                    if (input.value.length === 0) {
                        input.classList.add('is-empty');
                    } else {
                        input.classList.remove('is-empty');
                    }
                });
            });

            function setOutcome(result) {
                var successElement = document.querySelector('.success');
                var errorElement = document.querySelector('.error');
                successElement.classList.remove('visible');
                errorElement.classList.remove('visible');

                if (result.token) {
                    var myForm = document.getElementById('cc-form');
                    myForm.token.value = result.token.id;
                    myForm.wait_validate_st_stripe.value = 'run';
                    $('#cc-form').STSendAjax();
                } else if (result.error) {
                    errorElement.textContent = result.error.message;
                    errorElement.classList.add('visible');
                }
            }

            function setOutcomeModal(result) {
                var successElement = document.querySelector('.success');
                var errorElement = document.querySelector('.error');
                successElement.classList.remove('visible');
                errorElement.classList.remove('visible');

                if (result.token) {
                    var myForm = $('.booking_modal_form');
                    $('#token', myForm).val(result.token.id);
                    myForm.find('input[name="wait_validate_st_stripe"]').val('run');
                    $('.booking_modal_form').STSendModalBookingAjax();
                } else if (result.error) {
                    errorElement.textContent = result.error.message;
                    errorElement.classList.add('visible');
                }
            }

            function setOutcomePackage(result) {
                var successElement = document.querySelector('.success');
                var errorElement = document.querySelector('.error');
                successElement.classList.remove('visible');
                errorElement.classList.remove('visible');

                if (result.token) {
                    var myForm = document.getElementById('mpk-form');
                    myForm.token.value = result.token.id;
                    myForm.submit();
                } else if (result.error) {
                    errorElement.textContent = result.error.message;
                    errorElement.classList.add('visible');
                }
            }

            cardNumber.on('change', function(event) {
                setOutcome(event);
            });
            cardExpiry.on('change', function(event) {
                setOutcome(event);
            });
            cardCvc.on('change', function(event) {
                setOutcome(event);
            });
            var tokenRequest = function () {
                var form = $("#cc-form");

                var name = $('#st_stripe_card_holder', form).val();
                var address1 = $('input[name="st_address"]', form).val();
                var city = $('input[name="st_city"]', form).val();
                var state = $('input[name="st_province"]', form).val();
                var zip = $('#st_stripe_card_zipcode', form).val();

                var extraDetails = {
                    name: name ? name : undefined,
                    address_line1: address1 ? address1 : undefined,
                    address_city: city ? city : undefined,
                    address_state: state ? state : undefined,
                    address_zip: zip ? zip : undefined,
                };
                stripe.createToken(cardNumber, extraDetails).then(setOutcome);
            };

            var tokenRequestModal = function () {
                var form = $(".booking_modal_form");

                var name = $('#st_stripe_card_holder', form).val();
                var address1 = $('input[name="st_address"]', form).val();
                var city = $('input[name="st_city"]', form).val();
                var state = $('input[name="st_province"]', form).val();
                var zip = $('#st_stripe_card_zipcode', form).val();

                var extraDetails = {
                    name: name ? name : undefined,
                    address_line1: address1 ? address1 : undefined,
                    address_city: city ? city : undefined,
                    address_state: state ? state : undefined,
                    address_zip: zip ? zip : undefined,
                };
                stripe.createToken(cardNumber, extraDetails).then(setOutcomeModal);
            };

            var tokenRequestPackage = function () {
                var form = $("#mpk-form");

                var name = $('#st_stripe_card_holder', form).val();
                var address1 = $('input[name="st_address"]', form).val();
                var city = $('input[name="st_city"]', form).val();
                var state = $('input[name="st_province"]', form).val();
                var zip = $('#st_stripe_card_zipcode', form).val();

                var extraDetails = {
                    name: name ? name : undefined,
                    address_line1: address1 ? address1 : undefined,
                    address_city: city ? city : undefined,
                    address_state: state ? state : undefined,
                    address_zip: zip ? zip : undefined,
                };

                stripe.createToken(cardNumber, extraDetails).then(setOutcomePackage);
            };
            $(function () {
                /* Modal */
                $(".booking_modal_form", 'body').on('st_wait_checkout_modal', function (e) {
                    var payment = $('input[name="st_payment_gateway"]:checked', this).val();
                    if (payment === 'st_stripe') {
                        tokenRequestModal();
                        return false;
                    }
                    return true;
                });

                $(".booking_modal_form", 'body').on('st_before_checkout_modal', function (e) {
                    $('input[name="wait_validate_st_twocheckout"]', this).val('wait');
                    var check = true;
                    $('.stripe-card-form input.is-empty').removeClass('stripe-check-empty');
                    $('.stripe-card-form input.is-empty').each(function(){
                        var me = $(this);
                        if(me.val() == ''){
                            check = false;
                            me.addClass('stripe-check-empty');
                        }
                    })
                    if(!check){
                        return false;
                    }
                });
                /* End Modal */

                $("#cc-form", 'body').on('st_wait_checkout', function (e) {
                    var payment = $('input[name="st_payment_gateway"]:checked', this).val();
                    if (payment === 'st_stripe') {
                        tokenRequest();
                        return false;
                    }
                    return true;
                });
                $("#cc-form", 'body').on('st_before_checkout', function (e) {
                    $('input[name="wait_validate_st_stripe"]', this).val('wait');
                    var check = true;
                    $('.stripe-card-form input.is-empty').removeClass('stripe-check-empty');
                    $('.stripe-card-form input.is-empty').each(function(){
                        var me = $(this);
                        if(me.val() == ''){
                            check = false;
                            me.addClass('stripe-check-empty');
                        }
                    })
                    if(!check){
                        return false;
                    }
                });

                $("#mpk-form").submit(function(e) {
                    var payment = $('input[name="st_payment_gateway"]:checked', this).val();
                    if (payment === 'st_stripe') {
                        tokenRequestPackage();
                        return false;
                    }
                    return true;
                });
            });
        });
    </script>
<?php } ?>