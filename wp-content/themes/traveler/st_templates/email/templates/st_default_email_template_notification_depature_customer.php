<?php
$logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
if(empty($logo)){
    $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
}
$social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
?>
<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
        <tbody>
        <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="<?php echo site_url(); ?>"> <img class="alignnone wp-image-7442 size-full" src="<?php echo esc_html($logo); ?>" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
        </tr>
        </tbody>
    </table>


    <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td style="padding-bottom: 20px; font-size: 20px;"><strong style="font-size: 30px;">Hello [st_email_order_customer_name]</strong>,</td>
    </tr>
    <tr>
        <td>
            <p>Booking ID: <strong>#[st_email_order_booking_id]</strong></p>
            <p>You have booked [st_email_order_service_name] <span class="m_5151859965653427686il">service</span> in our system on [st_email_order_create_date].</p>
            <p>Your <span class="m_5151859965653427686il">service</span> will be starting on [st_email_order_departure_date] ( <span class="m_5151859965653427686il">About</span> [st_email_order_countdown_day] day(s) )</p>
            <p>Please check your information.</p>
            <p>Thank you.</p>
        </td>
    </tr>
    </tbody>
    </table>
    <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
        <tbody>
        <tr style="background: #F5F5F5;">
            <td style="width: 60%;padding: 25px;">
                <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
                <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
                <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
                <a href="#" style="color: #333; text-decoration: none">News</a>
            </td>
            <td style="width: 60%;padding: 25px; text-align: right">
                <?php echo esc_html($social_icon); ?>
            </td>
        </tr>
        </tbody>
    </table></div>