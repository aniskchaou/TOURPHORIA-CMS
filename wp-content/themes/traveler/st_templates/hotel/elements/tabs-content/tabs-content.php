<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/31/2017
 * Version: 1.0
 */
extract($atts);
$tabs = array(
    'overview' => array(esc_html__('OVERVIEW',ST_TEXTDOMAIN),esc_html__('OVERVIEW',ST_TEXTDOMAIN), 'fa fa-info'),
    'facilities' => array(esc_html__('FACILITIES',ST_TEXTDOMAIN), esc_html__('FACILITIES',ST_TEXTDOMAIN), 'fa fa-cutlery'),
    'policies_fqa' => array(esc_html__('POLICIES',ST_TEXTDOMAIN), esc_html__('POLICIES',ST_TEXTDOMAIN) ,'fa fa-credit-card'),
    'reviews' => array(esc_html__('REVIEWS',ST_TEXTDOMAIN), esc_html__('REVIEWS',ST_TEXTDOMAIN) ,'fa fa-comments-o'),
    'gallery' => array(esc_html__('GALLERY',ST_TEXTDOMAIN), esc_html__('GALLERY',ST_TEXTDOMAIN),'fa fa-picture-o'),
    'check_availability' => array(esc_html__('CHECK AVAILABILITY',ST_TEXTDOMAIN),esc_html__('CHECK AVAILABILITY',ST_TEXTDOMAIN), 'fa fa-calendar'),
);
if(!empty($display_tabs)){
$display_tabs = explode(',', $display_tabs);
?>

<div class="search-tabs st-hotel-tabs-content">
    <div class="tabbable">
        <div class="bottom_line">
            <ul class="nav nav-tabs container text-center <?php echo esc_attr($tab_align) ?>" id="myTab">
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
        </div>
        <div class="tab-content container">
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
                        <div class="inner-content">
                            <?php
                            $content = '';
                            switch($val){
                                case 'overview':
                                    if (have_posts()) {
                                        while (have_posts()) {
                                            the_post();
                                            the_content();
                                        }
                                    }
                                    break;
                                case 'reviews' :
                                case 'gallery':
                                case 'check_availability':
                                case 'facilities':
                                case 'policies_fqa':
                                    $content = st()->load_template('hotel/elements/tabs-content/tab-'.$val,false, null);
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