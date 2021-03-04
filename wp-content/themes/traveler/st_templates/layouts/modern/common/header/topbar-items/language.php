<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 13-11-2018
     * Time: 8:27 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    if ( function_exists( 'icl_get_languages' ) ) {
        $langs = icl_get_languages( 'skip_missing=0' );
    } else {
        $langs = [];
    }

    if(!isset($show_code))
        $show_code = false;

    if ( !empty( $langs ) ) {
        ?>
        <li class="dropdown dropdown-language hidden-xs hidden-sm">
            <?php
                foreach ( $langs as $key => $value ) {
                    $lang_name = $value['native_name'];
                    if($show_code)
                        $lang_name = strtoupper($value['language_code']);
                    if ( $value[ 'active' ] == 1 ) {
                        ?>
                        <a href="" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><?php echo $lang_name; ?> <i
                                    class="fa fa-angle-down"></i></a>
                        <?php
                        break;
                    }
                }
            ?>

            <ul class="dropdown-menu">
                <?php
                    foreach ( $langs as $key => $value ) {
                        if ( $value[ 'active' ] == 1 ) continue;
                        $lang_name = $value['native_name'];
                        if($show_code)
                            $lang_name = strtoupper($value['language_code']);
                        ?>
                        <li><a href="<?php echo esc_url( $value[ 'url' ] ) ?>"><?php echo $lang_name; ?></a>
                        </li>
                    <?php }
                ?>
            </ul>
        </li>
        <?php
    }
?>
