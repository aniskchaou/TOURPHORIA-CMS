<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 14-11-2018
     * Time: 8:28 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    $star  = !isset( $star ) ? 5 : round($star, 0);
    $style = ( !isset( $style ) ) ? '' : 'style-2';
    $element = ( !isset( $element ) ) ? 'div' : $element;
?>
<<?php echo $element; ?> class="st-stars <?php echo esc_attr( $style ); ?>">
    <?php
        if($style == '') {
            for ( $i = 1; $i <= $star; $i++ ) {
                ?>
                <i class="fa fa-star"></i>
                <?php
            }
        }else{
            for($i = 1; $i<= 5; $i++){
                if($i <= $star){
                    echo '<i class="fa fa-star"></i>';
                }else{
                    echo '<i class="fa fa-star grey"></i>';
                }
            }
        }
    ?>
</<?php echo $element; ?>>

