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
?>
<div class="pm-info">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-card-info st-stripe-card-info stripe-card-form">
                <div id="st_strip_card_form"></div>
                <div class="st_strip_alert alert alert-danger" style="margin-top: 15px;"></div>
            </div>
            <input name="token_stripe" type="hidden" value="" id="st_strip_token"/>
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

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});
            var st_strip_alert = $('.st_strip_alert');
            var st_strip_token = $('#st_strip_token');
            var wait_validate_st_stripe = $('input[name=wait_validate_st_stripe]');

            st_strip_alert.hide();

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#st_strip_card_form');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                if (event.error) {
                    st_strip_alert.html(event.error.message).show();
                } else {
                    st_strip_alert.hide();
                }
            });

            var tokenRequest = function (type) {
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        st_strip_alert.html(result.error.message).show();
                    } else {
                        st_strip_token.val(result.token.id);
                        wait_validate_st_stripe.val('run');

                        switch (type){
                            case 'modal':
                                $('.booking_modal_form').STSendModalBookingAjax();
                                break;
                            case 'form':
                                $('#cc-form').STSendAjax();
                                break;
                            case 'package':
                                var myForm = document.getElementById('mpk-form');
                                myForm.token.value = result.token.id;
                                myForm.submit();
                                break;
                        }
                    }
                });
            };

            $(function () {
                /* Modal */
                $(".booking_modal_form", 'body').on('st_wait_checkout_modal', function (e) {
                    var payment = $('input[name="st_payment_gateway"]:checked', this).val();
                    if (payment === 'st_stripe') {
                        tokenRequest('modal');
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

                $('#cc-form','body').on('st_wait_checkout', function (e) {
                    var payment = $('input[name="st_payment_gateway"]:checked', this).val();
                    if (payment === 'st_stripe') {
                        tokenRequest('form');
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
                        tokenRequest('package');
                        return false;
                    }
                    return true;
                });
            });
        });
    </script>