<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel card
 *
 * Created by ShineTheme
 *
 */

$default=array(
    'align'=>'right',
    'title'=>st_get_language('we_accepted_card')
);

if(isset($arg)){
    extract(wp_parse_args($arg,$default));
}else{
    extract($default);
}

$card_accepted=get_post_meta(get_the_ID(),'card_accepted',true);

?>

    <?php if(!empty($card_accepted) and is_array($card_accepted)):?>
        <?php if($title){
            echo "<h4 class='text-{$align}'>$title</h4>";
        }?>
    <ul class="list-card-accepted text-<?php echo esc_attr($align)?>">
    <?php
        foreach($card_accepted  as $key=>$value){
            $card=TravelerObject::get_card($value);
            if($card)
            echo "<li><img src='{$card['image']}' alt='{$card['title']}' title='{$card['title']}'></li>";
        }
        ?>
    </ul>
    <?php endif;?>

