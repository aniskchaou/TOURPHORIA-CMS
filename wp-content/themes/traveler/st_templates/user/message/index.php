<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 2:03 PM
 */
$messages = ST_Message_Factory::findAll([
    'page'=>STInput::get('c_page')
]);
$total = ST_Message_Factory::getTotal();
?>
<div class="st-create">
    <h2><?php esc_html_e('Message',ST_TEXTDOMAIN) ?>
    </h2>
</div>
<ul class="booking-list">
    <?php if(!empty($messages))
    {
        foreach ($messages as $message)
        {
            $service = $message->getService();
            if(empty($service)) continue;
            ?>
            <li>
                <a href="<?php echo esc_url($message->getDetailUrl())?>">
                    <div class="row">
                        <div class="col-md-3">
                            <?php $service->getFeatureImage([800,600]) ?>
                        </div>
                        <div class="col-md-9">
                            <h5 class="booking-item-title"><?php echo esc_html($service->getTitle()) ?></h5>
                            <?php
                            if($address  = $service->getAddress()){
                                printf('<p class="booking-item-address"> <i class="fa fa-map-marker"></i> %s</p>',esc_html($address));
                            }
                            if($excerpt  = $service->getExcerpt()){
                                printf('<p class="booking-item-description">%s</p>',esc_html($excerpt));
                            }

                            ?>
                        </div>
                    </div>
                </a>
            </li>
            <?php
        }
    }?>
</ul>
<nav class="navigation paging-navigation" role="navigation">
    <div class="pagination loop-pagination pagination">
        <?php echo paginate_links([
            'format'=>'?sc=message&c_page=%#%',
            'current'=>max(1,STInput::get('c_page')),
            'total'=>$total
        ])?>
    </div>
    <!-- .pagination -->
</nav><!-- .navigation -->
