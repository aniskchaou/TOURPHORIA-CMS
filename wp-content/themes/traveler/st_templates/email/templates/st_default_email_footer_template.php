<?php
$social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
echo '
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
            '. $social_icon .'
        </td>
    </tr>
    </tbody>
</table></div>';