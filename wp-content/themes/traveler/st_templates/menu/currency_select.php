<?php 
// currency dropdown
// from 1.1.9

if (empty($class)) {$class = "nav-drop nav-symbol" ;}
$currency =TravelHelper::get_currency();

?>
<?php echo '<'.esc_attr($container).' class="'.esc_attr($class).'">'; ?>
    <a class="cursor" ><?php $current_currency=TravelHelper::get_current_currency();
            if(isset($current_currency['name']))
            {
                echo esc_html( $current_currency['name']);

            }
            if(isset($current_currency['symbol']))
            {
                echo esc_html(' '.$current_currency['symbol']);

            }

        ?> 
            <?php if( !empty( $currency ) and count($currency) >= 2): ?>
                <i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
            <?php endif; ?>
        </a>
    <ul class="list nav-drop-menu">
        <?php 
            if(!empty($currency)){
                foreach($currency as $key=>$value){
                    if($current_currency['name']!=$value['name'])
                    echo '<li><a href="'.esc_url(add_query_arg('currency',$value['name'])).'">'.$value['name'].'<span class="right">'.$value['symbol'].'</span></a>
                          </li>';
                }
            }
        ?>
    </ul>
<?php echo  '</'.esc_attr($container).'>' ;?>