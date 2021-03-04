<?php
extract($data);
global $wp_query;
Hotel_Alone_Helper::inst()->search_room($data);
if(have_posts()) {
    $list_item = array();
    if(have_posts()) {
        while( have_posts() ) {
            the_post();
            $list_item['nav'][get_the_ID()] = st_hotel_alone_load_view('elements/st-list-feature-hotel-room/loop-style-1/nav',false);
            $list_item['content'][get_the_ID()] = st_hotel_alone_load_view('elements/st-list-feature-hotel-room/loop-style-1/content',false);
        }
    }
?>
    <div class="st-list-feature-hotel-room style-1">
        <div id="roomHelios">
            <div class="ContainerRoom">
                <div class="luxuryRoom">
                    <div class="titleRoom">
                        <div class="BestOur textBlue">
                            <?php echo esc_html($title) ?>
                        </div>
                        <div class="HeliosLuxuRy">
                            <?php echo esc_html($description) ?>
                        </div>
                    </div>
                    <div class="listRoom">
                        <?php
                        if(!empty( $list_item['nav'] )) {
                            foreach( $list_item['nav'] as $k => $v ) {
                                echo do_shortcode($v);
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="detailRoom">
                    <?php
                    if(!empty( $list_item['content'] )) {
                        foreach( $list_item['content'] as $k => $v ) {
                            echo do_shortcode($v);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php wp_reset_query(); ?>
