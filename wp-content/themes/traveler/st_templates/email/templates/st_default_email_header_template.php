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

echo '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>';