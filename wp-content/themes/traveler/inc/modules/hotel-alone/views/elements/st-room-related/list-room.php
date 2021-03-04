<?php
extract($atts);

$room_id = get_the_ID();

$hotel_id = intval(get_post_meta(get_the_ID(), 'room_parent', true));

$terms = wp_get_post_terms( $room_id, 'room_type' );

$list = array();

if(!empty($terms)){
    if(!empty($terms)){
        foreach($terms as $k=>$v){
            $list[]= $v->slug;
        }
    }
}

$arg = array(
    'post_type'      => 'hotel_room' ,
    'posts_per_page' => $number_post ,
    'post_status'    => 'publish' ,
    'meta_query' => [
        [
            'key' => 'room_parent',
            'value' => $hotel_id,
            'compare' => 'IN',
        ],
    ],
    'post__not_in'   => array(get_the_ID())
);
if(!empty($list))
{
    $arg['tax_query'][]=array(
        'taxonomy'=>'room_type',
        'field'  =>'slug',
        'terms'=>$list
    );
}
$rooms = new WP_Query($arg);
if($rooms->have_posts()) {
    ?>
    <div class="st-list-related-room">
        <div class="content">
            <div class="row list-room">
                <?php
                if($rooms->have_posts()) {
                    while( $rooms->have_posts() ) {
                        $rooms->the_post();
                        $terms = wp_get_post_terms( get_the_ID(), 'room_type' );
                        $cat = '';
                        if(!empty($terms)){
                            foreach($terms as $k=> $v){
                                $cat .= " filter-".esc_attr($v->term_id);
                            }
                        }
                        ?>
                        <div class="col-md-4 col-sm-6 item-room <?php echo esc_attr($cat) ?>">
                            <div class="item">
                                <div class="feature">
                                    <?php
                                    if (has_post_thumbnail() and get_the_post_thumbnail()) {
                                        the_post_thumbnail(array(340,240,'bfi_thumb' => true ), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
                                    } else {
                                        if (function_exists('st_get_default_image'))
                                            echo st_get_default_image();
                                    }
                                    ?>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_title() ?>
                                        </a>
                                    </div>
                                    <div class="price">
                                        <?php $price = get_post_meta(get_the_ID(),'price',true);echo TravelHelper::format_money($price); ?><span class="small"><?php esc_html_e("/night",ST_TEXTDOMAIN) ?></span>
                                    </div>
                                    <div class="desc">
                                        <?php
                                        $room_desc = get_post_meta( get_the_ID() , 'room_description' , true );
                                        if(!empty($room_desc)){
                                            echo wp_trim_words($room_desc, 9);
                                        }else{
                                            echo wp_trim_words(get_the_excerpt(), 9);
                                        }
                                        ?>
                                    </div>
                                    <div class="guest">
                                        <?php
                                        $number_adult = get_post_meta(get_the_ID(), 'adult_number', true);
                                        $number_child = get_post_meta(get_the_ID(), 'children_number', true);
                                        if (!empty($number_adult) || !empty($number_child)) {
                                            ?>
                                            <span>
                                                <?php echo esc_attr($number_adult + $number_child); ?> <?php esc_html_e("GUESTS",ST_TEXTDOMAIN) ?>
                                            </span>
                                        <?php } ?>
                                        <?php
                                        $room_size = get_post_meta(get_the_ID(),'room_footage',true);
                                        if(!empty($room_size)) {
                                            echo esc_attr($room_size);
                                            echo '<span>';
                                            echo ' m<sup>2</sup>';
                                            echo '</span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="facilities">
                                        <?php $term = get_the_terms(get_the_ID(), 'room_facilities'); ?>
                                        <?php if (is_array($term) && count($term)) { ?>
                                            <?php
                                            if ($term) {
                                                    $i=0;
                                                foreach ($term as $key => $value) {
                                                    if (!is_wp_error($term) and !empty($value->name)) {
                                                            if($i == 4){
                                                                continue;
                                                            }
                                                            $i++;
                                                            ?>
                                                            <span class="icon-item" data-toggle="tooltip" title="<?php echo esc_html($value->name) ?>">
                                                                <?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($value->term_id, 'st_icon')) { ?>
                                                                    <i class="<?php echo TravelHelper::handle_icon($icon) ?>"></i>
                                                                <?php } ?>
                                                            </span>
                                                            <?php
                                                        }
                                                    }
                                                }
                                        } ?>
                                    </div>
                                    <div class="button">
                                        <a href="<?php the_permalink() ?>"><?php esc_html_e("BOOK NOW",ST_TEXTDOMAIN) ?> <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>