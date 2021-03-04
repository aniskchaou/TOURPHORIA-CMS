<?php
$star = STHotel::getStar();
if($star): ?>
    <div class="booking-item-meta">
        <div class="booking-item-rating" style="border-bottom:0px;">
            <?php if(isset($title)){?>
                <h4 class="lh1em"><?php echo esc_html($title) ?></h4>
            <?php }?>
            <ul class="icon-list icon-group booking-item-rating-stars hotel-stars">
                <?php
                echo  TravelHelper::rate_to_string($star);
                ?>
            </ul>
            <span class="booking-item-rating-number"><?php printf(__('<b>%d</b> of 5 <small class="text-smaller">star</small>',ST_TEXTDOMAIN),$star)?></span>
        </div>
    </div>
<?php endif; ?>