<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 19-11-2018
     * Time: 8:56 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    $extra_price = get_post_meta( get_the_ID(), 'extra_price', true );
    if ( empty( $extra_price ) ) {
        return;
    }
    $extra = STInput::get( 'extra' );
    if ( empty( $extra ) ) {
        $extra = [];
    }

    if ( !empty( $extra[ 'value' ] ) ) {
        $extra_value = $extra[ 'value' ];
    }
?>
<div class="form-group form-more-extra">
    <a href="#dropdown-more-extra" class="dropdown"><?php echo esc_html__( 'More Option', ST_TEXTDOMAIN ) ?>
        <i class="fa fa-caret-down"></i></a>
    <ul class="extras">
        <?php foreach ( $extra_price as $key => $val ):
            if ( isset( $val[ 'extra_required' ] ) && $val[ 'extra_required' ] == 'on' ) {
                ?>
                <li class="item mt10">
                    <div class="st-flex space-between">
                        <span><?php echo $val['title']; ?>(<?php echo TravelHelper::format_money( $val[ 'extra_price' ] ) ?>) <span class="c-orange">*</span> </span>
                        <div class="select-wrapper" style="width: 50px;">
                            <?php
                                $max_item = intval( $val[ 'extra_max_number' ] );
                                if ( $max_item <= 0 ) $max_item = 1;
                            ?>
                            <select class="form-control app extra-service-select"
                                    name="extra_price[value][<?php echo $val[ 'extra_name' ]; ?>]"
                                    id="field-<?php echo $val[ 'extra_name' ]; ?>"
                                    data-extra-price="<?php echo $val[ 'extra_price' ]; ?>">
                                <?php
                                    $max_item = intval( $val[ 'extra_max_number' ] );
                                    if ( $max_item <= 0 ) $max_item = 1;
                                    $start_i = 0;
                                    if ( isset( $val[ 'extra_required' ] ) ) {
                                        if ( $val[ 'extra_required' ] == 'on' ) {
                                            $start_i = 1;
                                        }
                                    }
                                    for ( $i = $start_i; $i <= $max_item; $i++ ):
                                        $check = "";
                                        if ( !empty( $extra_value[ $val[ 'extra_name' ] ] ) and $i == $extra_value[ $val[ 'extra_name' ] ] ) {
                                            $check = "selected";
                                        }
                                        ?>
                                        <option <?php echo esc_html( $check ) ?>
                                                value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="extra_price[price][<?php echo $val[ 'extra_name' ]; ?>]"
                           value="<?php echo $val[ 'extra_price' ]; ?>">
                    <input type="hidden" name="extra_price[title][<?php echo $val[ 'extra_name' ]; ?>]"
                           value="<?php echo $val[ 'title' ]; ?>">
                </li>
            <?php } else { ?>
                <li class="item mt10">
                    <div class="st-flex space-between">
                        <span><?php echo $val['title']; ?>(<?php echo TravelHelper::format_money( $val[ 'extra_price' ] ) ?>)</span>
                        <div class="select-wrapper" style="width: 50px;">
                            <?php
                                $max_item = intval( $val[ 'extra_max_number' ] );
                                if ( $max_item <= 0 ) $max_item = 1;
                            ?>
                            <select class="form-control app extra-service-select"
                                    name="extra_price[value][<?php echo $val[ 'extra_name' ]; ?>]"
                                    id="field-<?php echo $val[ 'extra_name' ]; ?>"
                                    data-extra-price="<?php echo $val[ 'extra_price' ]; ?>">
                                <?php
                                    $max_item = intval( $val[ 'extra_max_number' ] );
                                    if ( $max_item <= 0 ) $max_item = 1;
                                    $start_i = 0;
                                    if ( isset( $val[ 'extra_required' ] ) ) {
                                        if ( $val[ 'extra_required' ] == 'on' ) {
                                            $start_i = 1;
                                        }
                                    }
                                    for ( $i = $start_i; $i <= $max_item; $i++ ):
                                        $check = "";
                                        if ( !empty( $extra_value[ $val[ 'extra_name' ] ] ) and $i == $extra_value[ $val[ 'extra_name' ] ] ) {
                                            $check = "selected";
                                        }
                                        ?>
                                        <option <?php echo esc_html( $check ) ?>
                                                value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="extra_price[price][<?php echo $val[ 'extra_name' ]; ?>]"
                           value="<?php echo $val[ 'extra_price' ]; ?>">
                    <input type="hidden" name="extra_price[title][<?php echo $val[ 'extra_name' ]; ?>]"
                           value="<?php echo $val[ 'title' ]; ?>">
                </li>
            <?php } ?>
        <?php endforeach; ?>
    </ul>
</div>
