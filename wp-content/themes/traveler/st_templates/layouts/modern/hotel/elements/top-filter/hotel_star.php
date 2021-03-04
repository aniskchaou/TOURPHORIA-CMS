<li class="filter-review-score">
    <div class="form-extra-field dropdown">
        <button class="btn btn-link dropdown" type="button" id="dropdownMenuHotelStar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $title; ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu st-icheck" aria-labelledby="dropdownMenuHotelStar">
            <ul>
                <?php
                for ($i = 5; $i >= 1; $i--) {
                    echo '<li class="st-icheck-item"><label>';
                    $star = '';
                    for ($j = 1; $j <= $i; $j++) {
                        $star .= '<i class="fa fa-star"></i> ';
                    }
                    echo $star;
                    echo '<input type="checkbox" name="review_score" data-type="hotel_rate" value="' . $i . '" class="filter-item"/><span class="checkmark fcheckbox"></span>
                    </label>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</li>