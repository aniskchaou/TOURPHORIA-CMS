<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 3:03 PM
 */
?>
<div class="st-create">
    <h2><?php esc_html_e('Affiliate Referrals',ST_TEXTDOMAIN) ?></h2>
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
    'status'       => array( 'paid', 'unpaid', 'rejected' ),
);

$data_visits = affiliate_wp()->referrals->get_referrals($data_get_visits);
$total = ceil(affiliate_wp()->referrals->count( $data_get_visits ) / $per_page);
?>
<div class="table-responsive mb30">
    <table>
        <thead>
            <tr>
                <th class="referral-amount"><?php esc_html_e( 'Reference', ST_TEXTDOMAIN ); ?></th>
                <th class="referral-amount"><?php esc_html_e( 'Amount', ST_TEXTDOMAIN ); ?></th>
                <th class="referral-description"><?php esc_html_e( 'Description', ST_TEXTDOMAIN ); ?></th>
                <th class="referral-status"><?php esc_html_e( 'Status', ST_TEXTDOMAIN ); ?></th>
                <th class="referral-date"><?php esc_html_e( 'Date', ST_TEXTDOMAIN ); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_visits as $referral)
            {
                $reference = ST_AffiliateWP::reference_link_frontend($referral->context, $referral->reference);
                ?>
                <tr>
                    <td class="referral-reference" data-th="<?php esc_html_e( 'Reference', ST_TEXTDOMAIN ); ?>"><?php echo $reference ?></td>
                    <td class="referral-amount" data-th="<?php esc_html_e( 'Amount', ST_TEXTDOMAIN ); ?>"><?php echo affwp_currency_filter( affwp_format_amount( $referral->amount ) ); ?></td>
                    <td class="referral-description" data-th="<?php esc_html_e( 'Description', ST_TEXTDOMAIN ); ?>"><?php echo wp_kses_post( nl2br( $referral->description ) ); ?></td>
                    <td class="referral-status <?php echo $referral->status; ?>" data-th="<?php esc_html_e( 'Status', ST_TEXTDOMAIN ); ?>"><?php echo affwp_get_referral_status_label( $referral ); ?></td>
                    <td class="referral-date" data-th="<?php esc_html_e( 'Date', ST_TEXTDOMAIN ); ?>"><?php echo esc_html( $referral->date_i18n( 'datetime' ) ); ?></td>
                </tr>
                <?php
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
