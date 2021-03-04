<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/31/2017
 * Version: 1.0
 */

extract($atts);
$tabs = array(
    'overview' => array(esc_html__('OVERVIEW', ST_TEXTDOMAIN),esc_html__('OVERVIEW TOUR',ST_TEXTDOMAIN), 'fa fa-info'),
    'itinerary' => array(esc_html__('ITINERARY', ST_TEXTDOMAIN), esc_html__('ITINERARY',ST_TEXTDOMAIN), 'fa fa-cutlery'),
    'review' => array(esc_html__('REVIEWS',ST_TEXTDOMAIN), esc_html__('REVIEWS',ST_TEXTDOMAIN) ,'fa fa-comments-o'),
    'gallery' => array(esc_html__('GALLERY',ST_TEXTDOMAIN), esc_html__('GALLERY',ST_TEXTDOMAIN),'fa fa-picture-o'),
    'payment' => array(esc_html__('PRICES & PAYMENT',ST_TEXTDOMAIN), esc_html__('PRICES & PAYMENT',ST_TEXTDOMAIN),'fa fa-credit-card'),
    'request' => array(esc_html__('REQUEST TO BOOK',ST_TEXTDOMAIN),esc_html__('REQUEST TO BOOK',ST_TEXTDOMAIN), 'fa fa-calendar'),
);

if(!empty($display_tabs)){
$display_tabs = explode(',', $display_tabs);
?>
<div class="search-tabs st-tour-tabs-content no-border">
    <div class="tabbable">
        <ul class="nav nav-tabs text-center" id="myTab">
            <?php
            $inti = 0;
            foreach($display_tabs as $key => $val){
                if(!empty($val)){
                    $active = '';
                    if($inti == 0){
                        $active = 'active';
                    }
                    ?>
                    <li class="<?php echo esc_attr($active); ?>">
                        <a href="#<?php echo esc_attr($val)?>" title="<?php echo esc_attr($tabs[$val][0])?>" class="<?php echo esc_attr($val); ?>" data-toggle="tab" aria-expanded="true"><i class="<?php echo esc_attr($tabs[$val][2])?> show-in-mobile"></i>
                            <span><?php echo esc_attr($tabs[$val][0]); ?></span></a>
                    </li>
                    <?php
                }
                $inti++;
            }
            ?>
        </ul>
        <div class="st-tab-line st-new-fullwidth"></div>
        <div class="tab-content">
            <?php
            $inti = 0;
            foreach($display_tabs as $key => $val){
                if(!empty($val)){
                    $active = '';
                    if($inti == 0){
                        $active = 'active in';
                    }
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="<?php echo esc_attr($val)?>">
                        <h2 class="tab-title text-center"><?php echo esc_attr($tabs[$val][1]); ?></h2>
                        <div class="inner-content container">
                            <?php
                            $content = '';
                            switch($val){
                                case 'overview':
                                    if (have_posts()) {
                                        while (have_posts()) {
                                            the_post();
                                            the_content(get_the_ID());
                                        }
                                    }
                                    break;
                                case 'review' :
                                case 'gallery':
                                case 'request':
                                case 'itinerary':
                                case 'accommodation':
                                case 'payment':
                                    $content = st()->load_template('tours/elements/tabs-content/tab-'.$val,false, null);
                                    break;
                            }

                            echo do_shortcode($content);
                            ?>
                        </div>

                    </div>
                    <?php
                }
                $inti++;
            }
            ?>
          </div>
    </div>
</div>
<?php }?>