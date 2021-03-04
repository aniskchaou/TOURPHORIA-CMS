<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental attribute
 *
 * Created by ShineTheme
 *
 */
if ( isset( $attr ) ) {
	$default = array(
		'item_col'  => '',
		'title'     => '',
		'font_size' => '4',
	);
	extract( wp_parse_args( $attr, $default ) );

	$rental_distance = get_post_meta( get_the_ID(), 'distance_closest', true );

	if ( ! empty( $rental_distance ) ) {
		?>
        <h<?php echo esc_attr( $font_size ) ?>><?php echo esc_html( $title ) ?></h<?php echo esc_attr( $font_size ) ?>>

        <ul class="booking-item-features booking-item-features-expand mb30 clearfix rental-distance">
			<?php
			foreach ( $rental_distance as $key2 => $value2 ) {
				?>
                <li class="<?php if ( $item_col )
					echo 'col-sm-' . $item_col ?>">
					<?php if ( ! empty( $value2['icon'] ) ): ?>
                        <img src="<?php echo esc_url( $value2['icon'] ); ?>"
                             alt="<?php esc_html( $value2['name'] ) ?>"/>
					<?php endif; ?>
					<?php if ( ! empty( $value2['name'] ) ): ?>
                        <span class="rental-distance-name">
                            <?php echo esc_html( $value2['name'] ) ?>
                        </span>
					<?php endif; ?>
					<?php if ( ! empty( $value2['distance'] ) ): ?>
                        <span class="rental-distance-value">
                            <?php echo esc_html( $value2['distance'] ) ?>
                        </span>
					<?php endif; ?>
                </li>
				<?php
			}
			?>
        </ul>
		<?php
	}
}