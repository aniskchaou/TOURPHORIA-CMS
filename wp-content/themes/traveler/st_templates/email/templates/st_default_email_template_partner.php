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
        <td style="padding-bottom: 20px; font-size: 20px;">
            <strong style="font-size: 30px;">Hello Partner</strong>,
        </td>
    </tr>
    <tr>
        <td>
            <span style="text-decoration: underline;">[st_email_booking_first_name] [st_email_booking_last_name]</span> booked a service in your system. Below are customer"s booking details:
        </td>
    </tr>
    <tr>
    </tr>
    </tbody>
</table>

    <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td style="" width="65%">
            [st_email_booking_thumbnail]
        </td>
        <td  width="35%" style="">

            <table style=" width: 100%; text-align: left; padding-left: 19px; top: 20px; color: #666;">
                <tr>
                    <td colspan="2" style="font-size: 22px; font-weight: bold;">
                        [st_email_booking_item_link]
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;" colspan="2">
                        [st_email_booking_item_address]
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;" colspan="2">
                        [st_email_booking_item_website]
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;" colspan="2">
                        [st_email_booking_item_email]
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;" colspan="2">
                        [st_email_booking_item_phone]
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;" colspan="2">
                        [st_email_booking_item_fax]
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;" colspan="2">
                        [st_email_booking_guest_name]
                    </td>
                </tr>
            </table>


        </td>
    </tr>

    </tbody>
</table>


    <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td style="padding-bottom: 20px; text-align: center; font-size: 30px; font-weight: bold;">
            Client Informations
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="1px" style="color: #666;	border-collapse: collapse;">
                <tr>
                    <td width="50%" colspan="2" style="text-align: center; padding: 10px; font-weight: bold;">
                        Booking Code: <span style="background-color: #ccffcc; color: #339933; padding: 3px 10px;">
                            [st_email_booking_id]
                        </span>
                    </td>
                    <td width="50%" colspan="2" style="text-align: center; padding: 10px; font-weight: bold;">
                        Status: <span style="background-color: #ffcccc; color: #993333; padding: 3px 10px;" >
                            [st_email_booking_status]
                        </span>
                    </td>
                </tr>
                <tr>
                    <td  style="padding: 10px 20px;">
                        <strong>First Name:</strong>
                    </td>
                    <td  style="padding: 10px 20px; ; color: #cc3333 ;border-color:#666">
                        <strong>[st_email_booking_first_name]</strong>
                    </td>
                    <td  style="padding: 10px 20px;">
                        <strong>Last Name:</strong>
                    </td>
                    <td  style="padding: 10px 20px; ; color: #cc3333 ;border-color:#666">
                        <strong>[st_email_booking_last_name]</strong>
                    </td>
                </tr>
                <tr>
                    <td  style="padding: 10px 20px;">
                        <strong>Phone:</strong>
                    </td>
                    <td  style="padding: 10px 20px; ; color: #cc3333 ;border-color:#666">
                        [st_email_booking_phone]
                    </td>
                    <td  style="padding: 10px 20px;">
                        <strong>Country:</strong>
                    </td>
                    <td  style="padding: 10px 20px; ;">
                        [st_email_booking_country]
                    </td>
                </tr>
                <tr>
                    <td  style="padding: 10px 20px;">
                        <strong>Email:</strong>
                    </td>
                    <td  style="padding: 10px 20px;">
                        [st_email_booking_email]
                    </td>
                    <td  style="padding: 10px 20px;">
                        <strong>City:</strong>
                    </td>
                    <td  style="padding: 10px 20px; ;">
                        [st_email_booking_city]
                    </td>
                </tr>
                <tr>
                    <td  style="padding: 10px 20px;">
                        <strong>Address Line 1:</strong>
                    </td>
                    <td colspan="3" style="padding: 10px 20px;">
                        [st_email_booking_address]
                    </td>
                </tr>
                <tr>
                    <td   style="padding: 10px 20px;">
                        <strong>Special Requirements:</strong>
                    </td>
                    <td colspan="3" style="padding: 10px 20px;">
                        [st_email_booking_note]
                    </td>
                </tr>
                <tr>
                    <td   style="padding: 10px 20px;">
                        <strong>Date:</strong>
                    </td>
                    <td colspan="3" style="padding: 10px 20px;">
                        [st_email_booking_date]
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
    </tr>
    </tbody>
</table>



    <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td style="padding-bottom: 20px; text-align: center; font-size: 30px; font-weight: bold;">
            Booking Details
        </td>
    </tr>
    <tr>
        <td>
            <div style="text-align: center; padding: 10px 0px; font-weight: bold;border: solid 1px #666">
                Payment Method: [st_email_booking_payment_method]
            </div>
            <div>
                [st_email_booking_room_name tag="" title="Room Name:"]
            </div>
            <div>
                [st_email_booking_number_item]
            </div>
            <div style="text-align: center; padding: 10px 0px; font-weight: bold;border-left: solid 1px #666;border-right: solid 1px #666;border-bottom: solid 1px #666;">
                [st_email_booking_item_price]
                [st_email_booking_adult_info]
                [st_email_booking_children_info]
                [st_email_booking_infant_info]
            </div>
            <div style="text-align: center; padding: 10px 0px; font-weight: bold;border-left: solid 1px #666;border-right: solid 1px #666;border-bottom: solid 1px #666;">
                <span style="text-align: left; width: 48%; display: inline-block; padding-left: 10px;">
                            [st_check_in_out_title]
                </span>
                <span style="text-align: right; width: 48%; display: inline-block;">
                    [st_check_in_out_value]
                </span>
            </div>
            <div>
                [st_email_booking_extra_items title="Extra service:"]
                [st_email_booking_package]
                [st_email_booking_equipments title="Equipments"]
            </div>
            <div style="padding: 10px 0px; border-left: solid 1px #666;border-right: solid 1px #666;border-bottom: solid 1px #666;">
                <table width="100%" style="padding: 15px; color:#666">
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" style="padding-bottom: 20px;">
                            Origin Price:
                        </td>
                        <td width="25%" style="text-align: right">
                            <strong>[st_email_booking_origin_price]</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" colspan="2" style="">
                            [st_email_booking_extra_price] [st_email_booking_package_price] [st_email_booking_equipment_price]
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" style="padding-bottom: 20px;">
                            Sale Price:
                        </td>
                        <td width="25%" style="text-align: right">
                            <strong>[st_email_booking_sale_price]</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" style="padding-bottom: 20px;">
                            Tax:
                        </td>
                        <td width="25%" style="text-align: right">
                            <strong>[st_email_booking_tax]</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" style="padding-bottom: 20px;">
                            Total Price ( with tax ):
                        </td>
                        <td width="25%" style="text-align: right">
                            <strong>[st_email_booking_price_with_tax]</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" colspan="2" style="">
                            [st_email_booking_deposit_price]
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="25%" style="padding-bottom: 20px;">
                            <strong>Pay Amount:</strong>
                        </td>
                        <td width="25%" style="text-align: right">
                            <strong style="font-size: 30px; color: #cc3333">[st_email_booking_total_price]</strong>
                        </td>
                    </tr>
                </table>
            </div>

        </td>
    </tr>
    <tr>
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



























