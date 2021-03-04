<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 2/25/2019
 * Time: 3:51 PM
 */
global $post;
$url = get_the_permalink();
if(isset($_GET['check_in']) && isset($_GET['check_out']) && !isset($other_room)) {
    $price = isset($post->st_price) ? $post->st_price : 0;
    $url = add_query_arg(STInput::get(), $url);
}else{
    $price = get_post_meta(get_the_ID(), 'price', true);
}

$booking_directly = st()->get_option('st_hotel_alone_directly_book_now', 'off');
if(isset($other_room)){
    $booking_directly = 'off';
}

$number_bed = get_post_meta(get_the_ID(), 'bed_number', true);
$number_bath = get_post_meta(get_the_ID(), 'bath_number', true);
$room_footage = get_post_meta(get_the_ID(), 'room_footage', true);

$gallery = get_post_meta(get_the_ID(), 'gallery', true);
?>
<div class="col-sm-6">
    <div class="item has-matchHeight">
        <?php
        if(!empty($gallery)){
            ?>
            <div class="thumb slider">
                    <div class="owl-carousel st-thumb-slider">
                        <?php
                        $gallery = explode(',', $gallery);
                        foreach ($gallery as $k => $v) {
                            $image_src = wp_get_attachment_image_url($v, array(570, 400));
                            if (!empty($image_src)) {
                                ?>
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <img class="owl-lazy" data-src="<?php echo esc_url($image_src); ?>"
                                         alt="<?php echo get_the_title(); ?>">
                                </a>
                            <?php }
                        } ?>
                    </div>
            </div>
            <?php
        }else {
            echo '<div class="thumb">';
            if (has_post_thumbnail()) {
                echo '<a href="' . esc_url($url) . '">';
                the_post_thumbnail(array(570, 400), array('class' => 'img-responsive'));
                echo '<i class="fa fa-picture-o"></i>';
                echo '</a>';
            }
            echo '</div>';
        }
        ?>
        <div class="content">
            <p class="price">
                <?php
                echo sprintf(__('FROM %s', ST_TEXTDOMAIN), '<span>'. TravelHelper::format_money($price) .'</span>');
                ?>
            </p>
            <h2 class="title"><a href="<?php echo esc_url($url); ?>"
                                 class="sts-pf-font"><?php echo get_the_title(); ?></a></h2>
            <div class="desc"><?php echo New_Layout_Helper::cutStringByNumWord(get_the_excerpt(), 24) ?></div>
            <div class="facility">
                <ul>
                    <?php if(!empty($number_bed)){ ?>
                        <li>
                            <?php echo TravelHelper::getNewIcon('ico_bed_1', '#333', '35px', '35px', true) ?>
                            <?php
                            $number_bed = esc_attr($number_bed);
                            if($number_bed == 0)
                                echo __('No beds', ST_TEXTDOMAIN);
                            elseif ($number_bed == 1)
                                echo sprintf(__('%d bed', ST_TEXTDOMAIN), $number_bed);
                            elseif ($number_bed > 1)
                                echo sprintf(__('%d beds', ST_TEXTDOMAIN), $number_bed);
                            ?>
                        </li>
                    <?php } ?>
                    <?php if(!empty($room_footage)){ ?>
                        <li>
                            <?php echo TravelHelper::getNewIcon('ico_square_1', '#333', '35px', '35px', true) ?>
                            <?php
                            $room_footage = esc_attr($room_footage);
                            echo $room_footage . ' ft<sup>2</sup>';
                            ?>
                        </li>
                    <?php } ?>
                    <?php if(!empty($number_bath)){ ?>
                        <li>
                            <?php echo TravelHelper::getNewIcon('ico_bathroom_1', '#333', '35px', '35px', true) ?>
                            <?php
                            $number_bath = esc_attr($number_bath);
                            if ($number_bath == 1)
                                echo sprintf(__('%d bathroom', ST_TEXTDOMAIN), $number_bath);
                            elseif ($number_bath > 1)
                                echo sprintf(__('%d bathrooms', ST_TEXTDOMAIN), $number_bath);
                            ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="action">
                <div class="message alert alert-danger"></div>
                <?php
                $room_external = get_post_meta(get_the_ID(), 'st_room_external_booking', true);
                $room_external_link = get_post_meta(get_the_ID(), 'st_room_external_booking_link', true);
                if($room_external == 'on' && !empty($room_external_link)){
                    ?>
                    <a class="btn btn-white sts-btn"
                       href="<?php echo esc_url($room_external_link); ?>"><span><?php echo __('VIEW MORE', ST_TEXTDOMAIN); ?></span></a>
                    <?php
                }else {
                    if (isset($_GET['check_in']) && isset($_GET['check_out'])) {
                        if ($booking_directly == 'on') {
                            //$remaining_room = isset($post->remaining_number) ? $post->remaining_number : get_post_meta(get_the_ID(), 'number_room', true);
                            $remaining_room = get_post_meta(get_the_ID(), 'number_room', true);
                            $remaining_room = (int)$remaining_room;
                            ?>
                            <form class="form-booking-inpage hotel-alone-booking-inpage" method="post">
                                <input type="hidden" name="check_in" value="<?php echo STInput::get('check_in'); ?>">
                                <input type="hidden" name="check_out" value="<?php echo STInput::get('check_out'); ?>">
                                <input type="hidden" name="adult_number"
                                       value="<?php echo STInput::get('adult_num_search', 1); ?>">
                                <input type="hidden" name="child_number"
                                       value="<?php echo STInput::get('children_num_search', 0); ?>">
                                <input name="action" value="st_add_to_cart" type="hidden">
                                <input name="item_id"
                                       value="<?php echo get_post_meta(get_the_ID(), 'room_parent', true); ?>"
                                       type="hidden">
                                <input name="room_id" value="<?php echo get_the_ID(); ?>" type="hidden">
                                <input type="hidden" name="start" value="<?php echo STInput::get('check_in'); ?>">
                                <input type="hidden" name="end" value="<?php echo STInput::get('check_out'); ?>">
                                <input type="hidden" name="is_search_room" value="true">
                                <select class="form-control" name="room_num_search">
                                    <option value=""><?php echo __('Number of rooms', ST_TEXTDOMAIN); ?></option>
                                    <?php
                                    $room_num_search = STInput::get('room_num_search', '');
                                    for ($i = 1; $i <= $remaining_room; $i++) {
                                        $selected = '';
                                        if ($room_num_search == $i)
                                            $selected = 'selected';
                                        echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                                <a class="btn btn-default sts-btn btn-booknow"
                                   href="<?php echo esc_url($url); ?>"><span><?php echo __('BOOK NOW', ST_TEXTDOMAIN); ?><i
                                                class="fa fa-spinner fa-spin"></i></span></a>
                                <?php echo st()->load_template( 'layouts/modern/single_hotel/elements/extras', '' ); ?>
                            </form>
                        <?php } else { ?>
                            <a class="btn btn-white  sts-btn"
                               href="<?php echo esc_url($url); ?>"><span><?php echo __('VIEW MORE', ST_TEXTDOMAIN); ?></span></a>
                            <?php
                        }
                    } else {
                        ?>
                        <a class="btn btn-white  sts-btn"
                           href="<?php echo esc_url($url); ?>"><span><?php echo __('VIEW MORE', ST_TEXTDOMAIN); ?></span></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
