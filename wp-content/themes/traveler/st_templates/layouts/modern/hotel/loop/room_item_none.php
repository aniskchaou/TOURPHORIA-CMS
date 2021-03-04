<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 19-11-2018
     * Time: 9:51 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
?>
<?php echo st()->load_template( 'layouts/modern/common/message', '', [ 'status' => 'danger', 'message' => esc_html__( 'Sorry! No available rooms found', ST_TEXTDOMAIN ) ] ) ?>
