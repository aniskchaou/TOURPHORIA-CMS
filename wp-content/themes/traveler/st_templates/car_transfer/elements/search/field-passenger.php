<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Hotel field adult
     *
     * Created by ShineTheme
     *
     */
    $default = [
        'title' => '',

    ];

    if ( isset( $data ) ) {
        extract( wp_parse_args( $data, $default ) );
    } else {
        extract( $default );
    }
    if ( $is_required == 'on' ) {
        $is_required = 'required';
    }

    if ( !isset( $field_size ) ) $field_size = 'lg';

    $old = STInput::get( 'passengers' );
?>
<div class="form-group form-group-<?php echo esc_attr( $field_size ) ?> form-group-select-plus">
    <label for="field-passengers"><?php echo esc_html( $title ) ?></label>
    <div class="btn-group btn-group-select-num <?php if ( $old >= 4 ) echo 'hidden'; ?>" data-toggle="buttons">
        <label class="btn btn-primary <?php echo ( !$old or $old == 1 ) ? 'active' : false; ?>">
            <input type="radio" value="1"/>1</label>
        <label class="btn btn-primary <?php echo ( $old == 2 ) ? 'active' : false; ?>">
            <input type="radio" value="2"/>2</label>
        <label class="btn btn-primary <?php echo ( $old == 3 ) ? 'active' : false; ?>">
            <input type="radio" value="3"/>3</label>
        <label class="btn btn-primary <?php echo ( $old == 4 ) ? 'active' : false; ?>">
            <input type="radio" value="4"/>3+</label>
    </div>
    <select  class="form-control <?php if ( $old < 4 ) echo 'hidden'; ?> <?php echo esc_attr($is_required) ?>" name="passengers">
        <?php $adult_max = 14;
            for ( $i = 1; $i <= $adult_max; $i++ ) {
                echo "<option " . selected( $old, $i, false ) . " value='{$i}'>{$i}</option>";
            }
        ?>
    </select>
</div>