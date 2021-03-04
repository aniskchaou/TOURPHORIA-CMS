<?php
extract($atts);
?>
<div class="st-reservation-contact">
    <div class="title">
        <?php echo esc_html($title) ?>
    </div>
    <div class="desc">
        <?php echo esc_html($description) ?>
    </div>
    <?php if(!empty($phone)){ ?>
        <div class="phone">
            <i class="fa fa-phone"></i>
            <?php echo esc_html($phone) ?>
        </div>
    <?php } ?>
    <?php if(!empty($email)){ ?>
        <div class="email">
            <i class="fa fa-envelope-o"></i>
            <?php echo esc_html($email) ?>
        </div>
    <?php } ?>
</div>