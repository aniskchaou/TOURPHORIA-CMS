<?php
    /**
     * @since 1.0.9
     **/
    wp_enqueue_script( 'st-optimize' );
?>
<div class="wrap">
    <h1 class="title"><?php echo esc_html__( 'ST Optimize', ST_TEXTDOMAIN ) ?></h1>
    <br class="clear">
    <div class="postbox">
        <div class="inside">
            <h3><?php echo esc_html__( 'Optimizations', ST_TEXTDOMAIN ); ?></h3>
            <p>
                <small><strong>Warning:</strong> It is best practice to always make a backup of your database before any
                    major operation (optimizing, upgrading, etc.).
                </small>
            </p>
            <table id="" class="widefat" width="50%">
                <thead>
                <tr>
                    <th></th>
                    <th>Optimization</th>
                    <th>Notes</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <img id="" class="optimization_spinner display-none"
                             src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>"
                             style="display: none;"></td>
                    <td>Clean all post revisions</td>
                    <td class="st-optimize-message">
                        <?php echo STAdminOptimize::get_inst()->post_revision_get_info(); ?>
                    </td>
                    <td>
                        <button id="" class="button button-secondaryshow_on_default_sizes st-button-optimize"
                                data-action="st_post_revision_optimize" type="button">Run optimization
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img id="" class="optimization_spinner display-none"
                             src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>"
                             style="display: none;"></td>
                    <td>Clean all auto draft posts and posts in trash</td>
                    <td class="st-optimize-message">
                        <?php echo STAdminOptimize::get_inst()->post_draft_get_info(); ?>
                    </td>
                    <td>
                        <button id="" class="button button-secondaryshow_on_default_sizes st-button-optimize"
                                data-action="st_post_draft_optimize" type="button">Run optimization
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><img id="" class="optimization_spinner display-none"
                             src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>"
                             style="display: none;"></td>
                    <td>Remove spam comments and comments in trash</td>
                    <td class="st-optimize-message">
                        <?php echo STAdminOptimize::get_inst()->comment_spam_get_info(); ?>
                    </td>
                    <td>
                        <button id="" class="button button-secondaryshow_on_default_sizes st-button-optimize"
                                data-action="st_comment_spam_optimize" type="button">Run optimization
                        </button>

                    </td>
                </tr>
                <tr>
                    <td><img id="" class="optimization_spinner display-none"
                             src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>"
                             style="display: none;">
                    </td>
                    <td>Remove expired transient options</td>
                    <td class="st-optimize-message">
                        <?php echo STAdminOptimize::get_inst()->transient_get_info(); ?>
                    </td>
                    <td>
                        <button id="" class="button button-secondaryshow_on_default_sizes st-button-optimize"
                                data-action="st_transient_optimie" type="button">Run optimization
                        </button>
                    </td>
                </tr>
                <tr>
                    <td><img id="" class="optimization_spinner display-none"
                             src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>"
                             style="display: none;">
                    </td>
                    <td>Remove expired availability</td>
                    <td class="st-optimize-message">
                        <?php echo STAdminOptimize::get_inst()->availability_get_info(); ?>
                    </td>
                    <td>
                        <button id="" class="button button-secondaryshow_on_default_sizes st-button-optimize"
                                data-action="st_availability_optimize" type="button">Run optimization
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>