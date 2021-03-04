<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/7/2019
 * Time: 4:17 PM
 */
$tax_in_room = st()->get_option('st_hotel_alone_tax_in_room_details');
if(!empty($tax_in_room)){
?>
<div class="service-attribute">
    <div class="row">
    <?php
    if(!empty($tax_in_room)){
        foreach ($tax_in_room as $k => $v){
            $obj = get_taxonomy( $v );
            if($obj) {
                $label = $obj->labels->name;
                $terms = get_the_terms(get_the_ID(), $v);
                $div_col = 'col-lg-12';
                if (count($tax_in_room) > 1) {
                    $div_col = 'col-md-6';
                }
                if (!empty($terms)) {
                    ?>
                    <div class="<?php echo $div_col ?>">
                        <h3 class="section-title sts-pf-font"><?php echo $label; ?></h3>
                        <ul class="row">
                            <?php
                            foreach ($terms as $kk => $vv) {
                                $icon = TravelHelper::getNewIcon('check-1', '#1A2B48', '20px', '20px', true);
                                echo '<li class="col-xs-6 has-matchHeight">' . $icon . $vv->name . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
    </div>
</div>
<?php } ?>
