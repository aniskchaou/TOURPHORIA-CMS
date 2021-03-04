<div class="sidebar-item st-icheck">
    <div class="item-title">
        <h4><?php echo $title; ?></h4>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="item-content">
        <ul>
            <?php
            for($i = 5; $i >= 1; $i--){
                echo '<li class="st-icheck-item"><label>';
                $star = '';
                for($j = 1; $j <= $i; $j++){
                    $star .= '<i class="fa fa-star"></i> ';
                }
                echo $star;
                echo '<input type="checkbox" name="review_score" data-type="hotel_rate" value="'. $i .'" class="filter-item"/><span class="checkmark fcheckbox"></span>
        </label>
        </li>';
            }
            ?>
        </ul>
    </div>
</div>