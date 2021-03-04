<?php
$list_extra   = array();
$list_extra   = get_post_meta( get_the_ID() , 'extra_price' , true );
extract($atts);
?>
<div class="helios-room-extra-info">
    <div class="title">
        <?php echo esc_html($title) ?>
    </div>
    <div class="info">
        <div class="list-extra">
            <?php if(!empty($list_extra)){ ?>
                    <?php foreach( $list_extra as $k => $v ) { ?>
                        <div class="item">
                            <div class="title">
                                <?php echo esc_html( $v[ 'title' ] ) ?> + <?php echo TravelHelper::format_money( $v[ 'extra_price' ] ); ?>
                            </div>
                            <div class="desc">
                                <?php
                                esc_html_e('The maximum number: ', ST_TEXTDOMAIN);
                                echo esc_html( $v[ 'extra_max_number' ]);
                                ?>
                            </div>
                        </div>
                    <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>