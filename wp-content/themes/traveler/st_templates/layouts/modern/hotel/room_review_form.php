<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 20-11-2018
     * Time: 9:18 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    ?>
<div class="form-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="author"
                       placeholder="Name *">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="email" class="form-control" name="email"
                       placeholder="Email *">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="comment_title"
                       placeholder="Title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group f14 c-grey mt20">
                <span class="mr15"><?php echo __( 'Your rating', ST_TEXTDOMAIN ) ?></span>
                <span class="st-stars style-2">
                    <?php
                        for ( $i = 1; $i <= 5; $i++ ) {
                            echo '<i class="fa fa-star grey"></i>';
                        }
                    ?>
                </span>
                <input name="comment_rate" class="st_review_stats" type="hidden" value="1">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <textarea name="comment" class="form-control has-matchHeight"
                          placeholder="Content"></textarea>
            </div>
        </div>
    </div>
</div>