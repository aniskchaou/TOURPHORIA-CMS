<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 2:32 PM
 */
$general_data=ST_AffiliateWP::getGeneralData();
$data=array(
    array(
        'title'=>esc_html__('Paid',ST_TEXTDOMAIN),
        'val'=>!empty($general_data)?affwp_currency_filter( affwp_format_amount( $general_data->earnings ) ):0,
        'class'=>''
    ),
    array(
        'title'=>esc_html__('Unpaid',ST_TEXTDOMAIN),
        'val'=>!empty($general_data)?affwp_currency_filter( affwp_format_amount($general_data->unpaid_earnings) ):0,
        'class'=>'unpaid'
    ),
    array(
        'title'=>esc_html__('Total Referrals',ST_TEXTDOMAIN),
        'val'=>!empty($general_data)?$general_data->referrals:0,
        'class'=>'total-ref'
    ),
    array(
        'title'=>esc_html__('Total Visits',ST_TEXTDOMAIN),
        'val'=>!empty($general_data)?$general_data->visits:0,
        'class'=>'total-visit'
    ),
);

$visits=[];
?>
<div class="st-create">
    <h2><?php esc_html_e('Total Earnings Affiliate',ST_TEXTDOMAIN) ?></h2>
</div>
<div class="aff-statistic">
    <div class="row">

        <?php foreach ($data as $row)
        {
            ?>
            <div class="col-sm-3">
                <div class="aff-paid-item <?php echo esc_url($row['class']) ?>"><div class="title"><?php echo esc_html($row['title']) ?></div> <div class="value"><?php echo ($row['val']) ?></div></div>
            </div>
            <?php
        }?>
    </div>
</div>