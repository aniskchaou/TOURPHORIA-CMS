<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Email confirm
 *
 * Created by ShineTheme
 *
 */

$main_color=st()->get_option('main_color','#ed8323');
$title=__('Confirmation needed' , ST_TEXTDOMAIN);
echo st()->load_template('email/header',null,array('email_title'=>$title));
?>
<tr style="background: white">
    <td colspan="10" style="padding: 20px; text-align: center">
        You added an email address to your account <br/>
        Click "confirm" to import the bookings you've made with that address <br/><br/>
        <a class="btn btn-primary" style="text-decoration: none; padding-left: 30px; padding-right: 30px; padding-top: 14px; padding-bottom: 14px; color:white; background: #ED8323; font-size: 30px;
" href="[email_confirm_link]" target="_blank">Confirm</a>
        Can't see the button? Try this link: <a href="[email_confirm_link]" target="_blank">[email_confirm_link]</a></p>
    </td>
</tr>
<?php
echo st()->load_template('email/footer');
