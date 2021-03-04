<li class="filter-review-score">
    <div class="form-extra-field dropdown">
        <button class="btn btn-link dropdown" type="button" id="dropdownMenuReviewScore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $title; ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu st-icheck" aria-labelledby="dropdownMenuReviewScore">
            <ul>
                <li class="st-icheck-item"><label><?php echo __('Excellent', ST_TEXTDOMAIN); ?><input type="checkbox" name="review_score" value="4" class="filter-item" data-type="star_rate"/><span class="checkmark fcheckbox"></span></label></li>
                <li class="st-icheck-item"><label><?php echo __('Very Good', ST_TEXTDOMAIN); ?><input type="checkbox" name="review_score" value="3" class="filter-item" data-type="star_rate"/><span class="checkmark fcheckbox"></span></label></li>
                <li class="st-icheck-item"><label><?php echo __('Average', ST_TEXTDOMAIN); ?><input type="checkbox" name="review_score" value="2" class="filter-item" data-type="star_rate"/><span class="checkmark fcheckbox"></span></label></li>
                <li class="st-icheck-item"><label><?php echo __('Poor', ST_TEXTDOMAIN); ?><input type="checkbox" name="review_score" value="1" class="filter-item" data-type="star_rate"/><span class="checkmark fcheckbox"></span></label></li>
                <li class="st-icheck-item"><label><?php echo __('Terrible', ST_TEXTDOMAIN); ?><input type="checkbox" name="review_score" value="zero" class="filter-item" data-type="star_rate"/><span class="checkmark fcheckbox"></span></label></li>
            </ul>
        </div>
    </div>
</li>