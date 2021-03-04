<?php
?>
<div class="st-contact-info">
    <div class="info-bg">
        <?php
        if(!empty($contact_bg)){
            $img = wp_get_attachment_image_url(esc_html($contact_bg), 'full');
            echo '<img src="'. $img .'" class="img-responsive" alt="Background Contact Info"/>';
        }
        ?>
    </div>
    <div class="info-content">
        <?php if(!empty($company_name)){ ?>
        <h3><?php echo esc_html($company_name); ?></h3>
        <?php } ?>
        <?php if(!empty($content)){ ?>
        <div class="sub">
            <?php echo $content; ?>
            <!--<p>Tell. + 00 222 444 33</p>
            <p>Email. hello@yoursite.com</p>
            <p class="address">1355 Market St, Suite 900San, Francisco, CA 94103 United States</p>-->
        </div>
        <?php  } ?>
    </div>
</div>