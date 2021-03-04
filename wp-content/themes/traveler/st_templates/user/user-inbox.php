<div class="st-create">
    <h2><?php esc_html_e("Inbox",ST_TEXTDOMAIN) ?></h2>
</div>
<?php
$message = STInput::request('message_id');
if(!empty($message)){
    ?>
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <?php
            ST_Inbox_Admin::inst()->masked_as_read($message);
            echo st()->load_template('user/inbox/live',false,array('message_id'=>$message));
            ?>
        </div>
        <div class="col-lg-4 col-md-5">
            <?php
            ST_Inbox::inst()->getFormBook($message);
            ?>
        </div>
    </div>
    <?php
}else{
    echo st()->load_template('user/inbox/list');
}
?>