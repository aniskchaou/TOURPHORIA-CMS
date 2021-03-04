<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 2:01 PM
 */
if(empty($_GET['message_id']))
{
    st()->load_template('user/message/index');
}
else{
    st()->load_template('user/message/detail');
}
