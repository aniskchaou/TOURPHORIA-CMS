<?php
global $wp_query;
Hotel_Alone_Helper::inst()->search_room($data);
if(have_posts()) {
?>
    <?php
    $list_item = array();
    $i = 0;
    $k = 0;
    if(have_posts()) {
        while( have_posts() ) {
            the_post();
            $class = "controlRoomLeft";
            if($i == 1){
                $class = "controlRoomRight";
            }
            if($i == 2) {
                $k++;
                $i=0;
            }
            $list_item[$k][] = '<div class="'.$class.'">'.st_hotel_alone_load_view('elements/st-list-feature-hotel-room/loop-style-3',false).'</div>';
            $i++;
        }
    }
    ?>
    <div class="st-list-feature-hotel-room style-3">
        <div class="container-fluid">
            <div class="wrapbuttonPostion">
                <div class="wrapTwo">
                    <div class="caurolselWrapRoom owl-carousel">
                        <?php
                        if(!empty( $list_item )) {
                            foreach( $list_item as $k => $v ) {
                                ?>
                                <div class="item">
                                    <div class="wrapControl">
                                        <?php
                                        if(!empty( $v )) {
                                            foreach( $v as $key => $value ) {
                                                echo do_shortcode( $value );
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
                <div class="ButtonDiscover">
                    <i class="fa fa-long-arrow-left"></i>
                </div>
                <div class="ButtonNextsDiscover">
                    <i class="fa fa-long-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php wp_reset_query(); ?>
