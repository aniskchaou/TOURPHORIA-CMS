<?php
    /**
     * @since 1.0.9
     **/
    wp_enqueue_script( 'update-fonticon' );
?>
<div class="wrap">
    <h2 class="title">Upload Custom Fonticon</h2>
    <br class="clear">
    <div id="col-container" class="container-upload-font">
        <div id="col-left" style="float: left;">
            <p class="text-danger">Recently, we only support to upload the font-icon zip files from <a
                    href="http://www.flaticon.com/" target="_blank">Flaticon</a></p>
            <p>Read more our document: <a target="_blank"
                                          href="http://shinetheme.com/demosd/documentation/how-to-upload-font-flaticon/">How
                    to upload font Flaticon</a></p>
            <p class="danger">

            </p>
            <form action="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=st-upload-custom-fonticon' ) ); ?>"
                  method="post" class="form" enctype="multipart/form-data">
                <label for="font-file">Choose a zip file:</label>
                <input type="file" value="" name="font-file" class="form-control" id="font-file">
                <input name="upload-font" id="upload-font" class="button button-primary button-large" value="Upload"
                       type="submit">
            </form>
        </div>
        <div id="col-right">
            <div class="col-wrap">
                <table class="widefat attributes-table wp-list-table ui-sortable" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col" colspan="2"><?php _e( 'Name', ST_TEXTDOMAIN ) ?></th>
                        <th scope="col"><?php _e( 'Number of fonts', ST_TEXTDOMAIN ) ?></th>
                    </tr>
                    </thead>
                    <?php

                        if ( is_array( $list_fonts ) && count( $list_fonts ) ):

                            foreach ( $list_fonts as $name => $list ):

                                $total = count( $list[ 'icon_list' ] );
                                ?>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=st-upload-custom-fonticon&listfont=' . $name ) ); ?>"><?php echo esc_html( $name ); ?></a>
                                        <div class="row-actions"><span class="delete">
                                                <a id="delete-custom-font"
                                                   href="<?php echo esc_url( admin_url( 'admin.php?page=st-upload-custom-fonticon&deletefont=' . $name ) ); ?>">
                                                    <?php _e( 'Delete', ST_TEXTDOMAIN ); ?></a></span>
                                        </div>
                                    </td>
                                    <td scope="col"><?php echo esc_html( $total ); ?></td>
                                </tr>
                            <?php endforeach; endif;
                    ?>
                </table>
            </div>
        </div>
    </div>