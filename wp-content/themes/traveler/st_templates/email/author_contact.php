<table id="booking-infomation" class="wrapper" style="width: 800px;" width="90%" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td style="padding: 20px 10px; background: #ED8323;" width="20%"><a href="http://travelerdata.wpengine.com">
                <img class="alignnone wp-image-7442 size-full"
                     src="https://travelerwp.com/wp-content/uploads/2014/11/logo-white.png" alt="logo" width="110"
                     height="40"/> </a></td>
        <td style="background: #ed8323 none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 21px 45px; text-align: right;"
            width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a
                style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a
                style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a
                style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a
                style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
    </tr>
    </tbody>
</table>
<table id="" class="wrapper" style="padding-top: 70px; width: 800px; color: #666;" width="90%" cellspacing="0"
       align="center">
    <tbody>
    <tr>
        <td style="padding: 20px 0; font-size: 20px;">Hello <strong
                style="font-size: 25px;"><?php echo esc_html($data[0]['value']); ?></strong>,
        </td>
    </tr>
    <tr>
        <td>You have a message from <strong style="color: #ed8323;"><?php echo esc_html($data[1]['value']); ?></strong>. Please check info below:
        </td>
    </tr>
    <tr>
        <td style="padding: 30px 0; font-size: 30px; font-weight: 600;">Contact Information</td>
    </tr>
    <tr>
        <td style="padding-top: 30px;">
            <table style="width: 100%; border-collapse: collapse; color: #666;" border="1">
                <tbody>
                <tr>
                    <td style="padding: 20px 30px;">Full Name:</td>
                    <td style="padding: 20px 30px; color: #ed8323;"><?php echo esc_html($data[1]['value']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 20px 30px;">Email:</td>
                    <td style="padding: 20px 30px;"><?php echo esc_html($data[2]['value']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 20px 30px;">Content:</td>
                    <td style="padding: 20px 30px;"><?php echo esc_html($data[3]['value']); ?></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<table style="color: #818181; width: 800px;" width="100%" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td style="padding-top: 20px;" align="center">
            <p style="text-align: center">Booking, reviews and advices on hotels, resorts, flights, vacation
                rentals, travel packages, and lots more!</p>
            <ul style="list-style: none; text-align: center;">
                <li style="display: inline-block;"><a style="color: #818181; text-decoration: none;" href="#">About
                        us</a> |
                </li>
                <li style="display: inline-block;"><a style="color: #818181; text-decoration: none;" href="#">Contact
                        us</a> |
                </li>
                <li style="display: inline-block;"><a style="color: #818181; text-decoration: none;"
                                                      href="#">News</a></li>
            </ul>
        </td>
    </tr>
    </tbody>
</table>