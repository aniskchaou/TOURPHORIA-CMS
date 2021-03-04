<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 15/07/2015
 * Time: 1:58 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array();
?>
    <ul class="wc-order-item-meta-list mt5">
    <?php 
    // Deposit Amount
    if(isset($item_data['_st_deposit_money']))
    {
        $deposit=st_wc_parse_order_item_meta($item_data['_st_deposit_money']);
        if($deposit=unserialize($deposit)){
        ?>
        <li>
            <span class="meta-label"><?php printf(__('Deposit %s',ST_TEXTDOMAIN),$deposit['type']) ?>:</span>
            <span class="meta-data"><?php
                switch($deposit['type']){
                    case "percent":
                        echo esc_html($deposit['amount'].'%');
                        break;
                    case "amount":
                        echo TravelHelper::format_money($deposit['amount']);
                        break;

                }
                ?></span>
        </li>
        <li>
            <span class="meta-label"><?php echo __('Origin Price',ST_TEXTDOMAIN); ?>:</span>
            <span class="meta-data">
            <?php echo TravelHelper::format_money($deposit['old_price'])?></span>
        </li>
    <?php
    }}
    ?>
    
    
    </ul>