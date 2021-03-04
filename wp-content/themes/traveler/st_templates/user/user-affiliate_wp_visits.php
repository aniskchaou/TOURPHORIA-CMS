<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 3:03 PM
 */
?>
<div class="st-create">
    <h2><?php esc_html_e('Affiliate Visits',ST_TEXTDOMAIN) ?></h2>
</div>
<?php
$per_page = 15;
$page = max(1, STInput::get('c_page'));

$affInfo = ST_AffiliateWP::getGeneralData();

if(empty($affInfo))echo esc_html__('--- Empty ---',ST_TEXTDOMAIN);

$data_get_visits = array(
    'number' => $per_page,
    'offset' => $per_page * ($page - 1),
    'affiliate_id' => $affInfo->affiliate_id,
    'order'            => 'DESC',
    'orderby'          => 'date',
);

$data_visits = affiliate_wp()->visits->get_visits($data_get_visits);
$total = ceil(affiliate_wp()->visits->count( $data_get_visits ) / $per_page);
?>
<div class="table-responsive mb30">
    <table>
        <thead>
            <tr>
                <th class="visit-url"><?php esc_html_e('IP',ST_TEXTDOMAIN) ?></th>
                <th class="referring-url"><?php esc_html_e('Referring URL',ST_TEXTDOMAIN) ?></th>
                <th class="referral-status"><?php esc_html_e('Converted',ST_TEXTDOMAIN)?></th>
                <th class="visit-date"><?php esc_html_e('Date',ST_TEXTDOMAIN)?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($data_visits))
            foreach ($data_visits as $row)
            {
                ?>
                <tr>
                    <td><?php echo esc_html($row->ip) ?></td>
                    <td><?php echo esc_html($row->url) ?></td>
                    <td><?php echo ($row->referral_id)?esc_html__('Yes',ST_TEXTDOMAIN):esc_html__('No',ST_TEXTDOMAIN) ?></td>
                    <td><?php echo date_i18n(get_option('date_format'),strtotime($row->date)) ?></td>
                </tr>
                <?php
            }
            else{
                printf('<tr><td colspan="4" class="text-center">%s</td></tr>',esc_html__('--- Empty ---',ST_TEXTDOMAIN));
            }?>
        </tbody>
    </table>

</div>

<nav class="navigation paging-navigation" role="navigation">
    <div class="pagination loop-pagination pagination">
        <?php echo  paginate_links([
            'format'=>'?sc=affiliate_wp_referrals&c_page=%#%',
            'total'=>$total,
            'current'=>$page
        ]); ?>
    </div>
    <!-- .pagination -->
</nav><!-- .navigation -->