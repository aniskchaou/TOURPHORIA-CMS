<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 20-11-2018
     * Time: 9:18 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */ ?>
<div class="form-wrapper">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control"
                       name="author"
                       placeholder="Name *">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <input type="email" class="form-control"
                       name="email"
                       placeholder="Email *">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <input type="text" class="form-control"
                       name="comment_title"
                       placeholder="Title">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-push-8">
            <div class="form-group review-items has-matchHeight">
                <?php
                    $stats = STReview::get_review_stats( get_the_ID() );
                    if ( !empty( $stats ) ) {
                        foreach ( $stats as $stat ) {
                            ?>
                            <div class="item">
                                <label><?php echo $stat[ 'title' ]; ?></label>
                                <input class="st_review_stats" type="hidden"
                                       name="st_review_stats[<?php echo trim( $stat[ 'title' ] ); ?>]">
                                <div class="rates">
                                    <?php
                                        for ( $i = 1; $i <= 5; $i++ ) {
                                            echo '<i class="fa fa-smile-o grey"></i>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-8 col-md-pull-4">
            <div class="form-group">
                <textarea name="comment"
                          class="form-control has-matchHeight"
                          placeholder="Content"></textarea>
            </div>
        </div>
    </div>
</div>
