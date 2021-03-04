<?php 
// currency dropdown
// from 1.1.9

if (empty($container)){$container = "div"; }
if (empty($class)) {$class = "nav-drop nav-symbol" ;}
 ?>


    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none" >
        <a href="#">
            <?php $current_currency=TravelHelper::get_current_currency();
            if(isset($current_currency['name']))
            {
                echo esc_html( $current_currency['name']);

            }
            if(isset($current_currency['symbol']))
            {
                echo esc_html(' '.$current_currency['symbol']);

            }

            ?>

        </a>
        <ul class="sub-menu" style="display: none;">

            <?php $currency =TravelHelper::get_currency();
            if(!empty($currency)){
                foreach($currency as $key=>$value){
                    if($current_currency['name']!=$value['name'])
                        echo '<li><a href="'.esc_url(add_query_arg('currency',$value['name'])).'"> '.$value['name'].' <span class="right"> '.$value['symbol'].' </span></a>
                          </li>';
                }
            }
            ?>
        </ul>
    </li>