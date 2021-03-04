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
    <tr id="title">
        <td style="padding: 10px; border-top: 1px solid #CCC;">
            <h3 style="text-align: center;"><strong>Hi,</strong></h3>
            <p style="text-align: center;">You added an email address to your account <br /> Click "confirm" to import the bookings you've made with that address <br /><br /> <a class="btn btn-primary" style="text-decoration: none; color: white; background: #5192FA; font-size: 30px; padding: 14px 30px 14px 30px;" href="[st_email_confirm_link]" target="_blank">Confirm</a><br /><br /> Can't see the button? Try this link: <a href="[st_email_confirm_link]" target="_blank">[st_email_confirm_link]</a></p>
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


























