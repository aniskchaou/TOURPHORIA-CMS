<?php
$langs = qtranxf_getSortedLanguages();
global $q_config;
global $pagenow ;
$flags = qtranxf_language_configured('flag');
$flag_dir = qtranxf_flag_location() ;

//Currency list
$currency_list = st()->get_option('booking_currency');
$mapping_currency = get_option('mapping_currency_' . $q_config['language']);

?>
<div class="">
    <!--<button class="btn btn-primary"><?php echo __('Reload', ST_TEXTDOMAIN); ?></button>-->
    <div class="mapping-currency">
        <div class="row-mapping">
            <div class="col-mapping-lang mapping-lang-head">
                <?php echo __('Languages', ST_TEXTDOMAIN); ?>
            </div>
            <div class="col-mapping-currency mapping-currency-head">
                <?php echo __('Default currency', ST_TEXTDOMAIN); ?>
            </div>
        </div>
        <?php $i = 0; foreach ($langs as $key => $value): ?>
            <?php $lang_name = $q_config['language_name'][$value]; ?>
            <div class="row-mapping-content" data-lang-code="<?php echo $value; ?>">
                <div class="col-mapping-lang" >
                    <img src="<?php echo esc_attr($flag_dir.$flags[$value]) ; ?>" class="img-responsive"/>
                    <?php echo $lang_name; ?>
                    <?php echo '( ' . $value . ' ) '; ?>
                </div>
                <div class="col-mapping-currency" >
                    <div class="">
                        <?php
                        $cur = $mapping_currency[$i][0];
                        if($cur == $value){
                            $cur_option = $mapping_currency[$i][1];
                        }
                        ?>
                        <select name="" class="mapping-currency-list">
                            <?php
                            foreach ($currency_list as $item_currency){
                                if($item_currency['name'] == $cur_option){
                                    echo '<option selected value="'. $item_currency['name'] .'">'. $item_currency['name'] .'</option>';
                                }else{
                                    echo '<option value="'. $item_currency['name'] .'">'. $item_currency['name'] .'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="spinner mapping-loading"></span>
                    </div>
                </div>
            </div>
            <?php $i++;  endforeach; ?>
    </div>
</div>
