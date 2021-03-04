<?php
$count = STReview::get_avg_rate();
if(!empty($count)){
    $list_review_stats =STReview::get_review_stats(get_the_ID());
    if(!empty($list_review_stats)){
        ?>
        <ul class="list_review">
            <?php foreach ($list_review_stats as $key => $value) {

                $rating_score=STReview::get_avg_stat(get_the_ID(),$value['title']);
                if ($rating_score) {
                    ?>
                    <li>
                        <?php
                        if(!empty($value['icon'])){
                            echo '<img src="'.esc_url($value['icon']).'" width="73" height="73" alt="review-icon">';
                        }
                        ?>
                        <p class="rating_title"><?php echo esc_attr($value['title']); ?>&nbsp;</p>
                        <p class="score"><?php echo number_format($rating_score, 1,'.',''); ?></p>
                    </li>
                <?php }
            } ?>
        </ul>
        <?php
    }
}
