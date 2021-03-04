<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel loop room
 *
 * Created by ShineTheme
 *
 */

global $wp_query;
$post                  = STInput::request();
$post[ 'room_parent' ] = get_the_ID();
$hotel                 = new STHotel();
$hotel->search_room( $post );
?>
    <ul class="booking-list loop-room">
        <?php
        if(have_posts()) {
            while( have_posts() ) {
                the_post();
                echo st()->load_template( 'hotel/elements/loop-room-item' );
            }

        } else {

            echo st()->load_template( 'hotel/elements/loop-room-none' );
        }
        ?>
    </ul>
    <div class="div_paged_room">
        <?php echo TravelHelper::paging_room(); ?>
    </div>

<?php
wp_reset_query();
?>
