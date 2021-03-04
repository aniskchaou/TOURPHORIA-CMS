<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 4/16/2019
 * Time: 10:43 AM
 */
$custom_field = st()->get_option( $data['option_name'] );
if(!empty( $custom_field ) and is_array( $custom_field )) {
    ?>
    <div class="row">
        <?php
        foreach( $custom_field as $k => $v ) {
            $key   = str_ireplace( '-' , '_' , 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
            $class = 'col-md-12';
            if($v[ 'type_field' ] == "date-picker") {
                $class = 'col-md-4';
            }
            ?>
            <div class="<?php echo esc_attr( $class ) ?>">
                <div class="form-group">
                    <label for="<?php echo esc_attr( $key ) ?>"><?php echo esc_html($v[ 'title' ]) ?>:</label>
                    <?php if($v[ 'type_field' ] == "text") { ?>
                        <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text" placeholder="<?php _e( 'Enter your description here' , ST_TEXTDOMAIN ) ?>" class="form-control" value="<?php echo STInput::request($key,get_post_meta( $post_id , $key , true)) ?>">
                    <?php } ?>
                    <?php if($v[ 'type_field' ] == "date-picker") { ?>
                        <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text" placeholder="<?php _e( 'Enter your description here' , ST_TEXTDOMAIN ) ?>" class="date-pick form-control" value="<?php echo STInput::request($key,get_post_meta( $post_id , $key , true)) ?>">
                    <?php } ?>
                    <?php if($v[ 'type_field' ] == "textarea") { ?>
                        <textarea id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" class="form-control" ><?php echo get_post_meta( $post_id , $key , true); ?></textarea>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>