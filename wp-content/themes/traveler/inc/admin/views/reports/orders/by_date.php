<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/24/2018
 * Time: 2:46 PM
 */
global $wpdb;

$ranges=[
    'year'=>esc_html__('Years',ST_TEXTDOMAIN),
    'last_month'=>esc_html__('Last month',ST_TEXTDOMAIN),
    'this_month'=>esc_html__('This month',ST_TEXTDOMAIN),
    'last_7_days'=>esc_html__('Last 7 days',ST_TEXTDOMAIN),
];


$post_types=[
    'st_hotel'=>[
        'title'=>esc_html__('Hotel',ST_TEXTDOMAIN),
        'icon'=>'fa fa-building fa-5x',
        'amount'=>0,
        'bg'=>'#337ab7'
    ],
    'hotel_room'=>[
        'title'=>esc_html__('Room',ST_TEXTDOMAIN),
        'icon'=>'fa fa-building fa-5x',
        'amount'=>0,
        'bg'=>'#337ab7'
    ],
    'st_rental'=>[
        'title'=>esc_html__('Rental',ST_TEXTDOMAIN),
        'icon'=>'fa fa-home fa-5x',
        'amount'=>0,
        'bg'=>'#e35b5a'
    ],
    'st_cars'=>[
        'title'=>esc_html__("Car",ST_TEXTDOMAIN),
        'icon'=>'fa fa-car fa-5x',
        'amount'=>0,
        'bg'=>'#44b6ae'
    ],
    'st_tours'=>[
        'title'=>esc_html__("Tour",ST_TEXTDOMAIN),
        'icon'=>'fa fa-flag-o fa-5x',
        'amount'=>0,
        'bg'=>'#8775a7'
    ],
    'st_activity'=>[
        'title'=>esc_html__("Activity",ST_TEXTDOMAIN),
        'icon'=>'fa fa-bolt fa-5x',
        'amount'=>0,
        'bg'=>'#27ae60'
    ],
    'st_flight'=>[
        'title'=>esc_html__("Flight",ST_TEXTDOMAIN),
        'icon'=>'fa fa-plane fa-5x',
        'amount'=>0,
        'bg'=>'#ff892d'
    ],
];
$sum_query = [];
if(!empty($post_types))
{
    foreach ($post_types as $post_type=>$data){
        $sum_query[]="SUM(CASE WHEN st_booking_post_type='{$post_type}' THEN total_order END) as ".$post_type;
    }

}
$current_range = STInput::get('range','last_7_days');
if(empty($current_range)) $current_range = 'last_7_days';
$chartData=[
    'labels'=>[],
    'datasets'=>[],
    'prefix'
];

$where =[];
$whereRaw='';


if($st_post_types = STInput::get('st_post_types') and is_array($st_post_types))
{
    $pl = array_fill(0, count($st_post_types), '%s');
    $whereRaw.=$wpdb->prepare(' st_booking_post_type in ('.implode(',', $pl).')',$st_post_types);
}

if(!empty(STInput::get('partner_id')))
{
    $where['partner_id']=(int)STInput::get('partner_id');
}
if($st_post_type = STInput::get('st_post_type'))
{
    $where['st_booking_post_type']=$st_post_type;
}


switch ($current_range){
    case "year":
        $max_time = strtotime('today');
        $max_time = strtotime(date('Y-m-t',$max_time));
        $min_time = strtotime(date('Y-01-01',$max_time));

        $datasets=[
            'label'=>esc_html__('Total Money',ST_TEXTDOMAIN),
            'backgroundColor'=>'#ed8323',
            'data'=>[]
        ];

        for($i=$min_time;$i<=$max_time;$i+=MONTH_IN_SECONDS){

            $chartData['labels'][]=date_i18n('M Y',$i);

            if(!empty($sum_query)) ST_Order_Item_Model::inst()->select($sum_query);

            if(!empty($whereRaw))
            {
                ST_Order_Item_Model::inst()->where($whereRaw,null,true);
            }

            $query = ST_Order_Item_Model::inst()
                ->select('SUM(total_order) as total')
                ->where('created >=',date('Y-m-01',$i))
                ->where('created <=',date('Y-m-t',$i))
                ->where($where)
                ->get(1)->row();

            $datasets['data'][]=$query['total'];
            foreach ($post_types as $post_type=>$datga)
            {
                $post_types[$post_type]['amount']+= isset($query[$post_type])?(float)$query[$post_type]:0;
            }
        }

        $chartData['datasets'][]=$datasets;


        break;
    case "last_7_days":
    case "this_month":
    case "last_month":
    case "custom":
        $max_time = strtotime('today');
        $min_time = $max_time - DAY_IN_SECONDS*6;

        if($current_range=='this_month'){
            $min_time = strtotime(date('Y-m-01',$max_time));
        }

        if($current_range=='last_month'){
            $min_obj = new DateTime(date('Y-m-01',$max_time));
            $min_obj->modify('-1 day');
            $max_time = $min_obj->getTimestamp();
            $min_time =  strtotime(date('Y-m-01',$max_time));
        }

        if($current_range=='custom')
        {
            $start_date = STInput::get('start_date');
            $end_date = STInput::get('end_date');

            if(!$start_date_obj = date_create_from_format('m-d-Y',$start_date)) $min_time=false;
            else $min_time=$start_date_obj->getTimestamp();

            if(!$end_date_obj = date_create_from_format('m-d-Y',$end_date)) $max_time=false;
            else $max_time = $end_date_obj->getTimestamp();


        }

        if($max_time and $min_time){

            $datasets=[
                'label'=>esc_html__('Total Money',ST_TEXTDOMAIN),
                'backgroundColor'=>'#ed8323',
                'data'=>[]
            ];

            for($i=$min_time;$i<=$max_time;$i+=DAY_IN_SECONDS){

                $chartData['labels'][]=date_i18n('d M',$i);

                if(!empty($sum_query)) ST_Order_Item_Model::inst()->select($sum_query);

                if(!empty($whereRaw))
                {
                    ST_Order_Item_Model::inst()->where($whereRaw,null,true);
                }

                $query = ST_Order_Item_Model::inst()
                    ->select('SUM(total_order) as total')
                    ->where('created',date('Y-m-d',$i))
                    ->where($where)
                    ->get(1)->row();

                $datasets['data'][]=$query['total'];
                foreach ($post_types as $post_type=>$datga)
                {
                    $post_types[$post_type]['amount']+= isset($query[$post_type])?(float)$query[$post_type]:0;
                }
            }

            $chartData['datasets'][]=$datasets;
        }

        break;
}
?>
<div id="poststuff" class="st-reports-wrap">
    <div class="report-by-post_types">
        <?php if(!empty($post_types))
        {
            foreach ($post_types as $post_type=>$data)
            {
                ?>
                <div class="post-type-item-wrap">
                    <div class="post-type-item" style="background-color:<?php echo esc_attr($data['bg']) ?>">
                        <i class="post-type-icon <?php echo esc_attr($data['icon']) ?>"></i>
                        <div class="post-type-info">
                            <span class="amount"><?php echo TravelHelper::format_money($data['amount']) ?></span>
                            <span class="post-type-name"><?php echo esc_html($data['title']) ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
        }?>
    </div>
    <div class="postbox">
        <ul class="st_report_date_ranges">
            <?php foreach ($ranges as $id=>$range){
                $url = remove_query_arg(['start_date','end_date']);
                ?>
                <li class="<?php if($current_range==$id) echo 'active'; ?>">
                    <a href="<?php echo esc_url(add_query_arg(['range'=>$id],$url)); ?>" ><?php echo esc_html($range) ?></a>
                </li>
                <?php

            } ?>

            <li class="custom <?php if($current_range=='custom') echo 'active'; ?>">
                <form action="" method="get">
                    <span class="txt-custom"><?php esc_html_e('Custom',ST_TEXTDOMAIN) ?></span>
                    <?php if(!empty($_GET)){
                        foreach ($_GET as $k=>$v)
                        {
                            if(in_array($k,['range','_wpnonce','_wp_http_referer','start_date','end_date'])) continue;
                            if(empty($v)) continue;

                            if(is_array($v) and !empty($v)){
                                foreach ($v as $v2)
                                printf('<input value="%s" name="%s[]" type="hidden"/>',esc_attr($v2),$k);
                                continue;
                            }

                            printf('<input value="%s" name="%s" type="hidden"/>',esc_attr($v),$k);
                        }
                    }?>
                    <input type="hidden" name="range" value="custom">
                    <input type="text"  placeholder="mm-dd-yyyy" value="<?php if($current_range=='custom') echo esc_attr(STInput::get('start_date')); ?>" autocomplete="off" name="start_date" class="form-control datepicker_start" >
                    <span>–</span>
                    <input type="text" placeholder="mm-dd-yyyy" value="<?php if($current_range=='custom') echo esc_attr(STInput::get('end_date')); ?>" autocomplete="off" name="end_date" class="form-control datepicker_end" >
                    <button type="submit" class="button" value="Go"><?php esc_html_e('Filter',ST_TEXTDOMAIN) ?></button>
                    <?php wp_nonce_field('st_traveler_filter_reports') ?>
                </form>
            </li>
        </ul>
        <div class="inside st-reports-flex">
            <div class="report-sidebar">
                <form action="" method="get">
                    <?php if(!empty($_GET)){
                        foreach ($_GET as $k=>$v)
                        {
                            if(in_array($k,['_wpnonce','_wp_http_referer','partner_id','st_post_type'])) continue;
                            if(empty($v)) continue;
                            if(is_array($v) and !empty($v)){
                                foreach ($v as $v2)
                                    printf('<input value="%s" name="%s[]" type="hidden"/>',esc_attr($v2),$k);
                                continue;
                            }
                            printf('<input value="%s" name="%s" type="hidden"/>',esc_attr($v),$k);
                        }
                    }?>
                    <?php wp_nonce_field('st_traveler_filter_reports') ?>
                    <div class="filter-item">
<!--                        <select name="partner_id" class="select2-field" data-params="{type:partner}"></select>-->
                        <label class="filter-label"><?php esc_html_e('Filter by Partner',ST_TEXTDOMAIN) ?></label>
                        <?php
                        $init=['id'=>'','text'=>''];
                        if(STInput::get('partner_id')){
                            $user = new WP_User(STInput::get('partner_id'));
                            $init['id']=(int)STInput::get('partner_id');
                            $init['text']=$user->display_name.' - '.$user->ID;
                        }
                        ?>
                        <input name="partner_id" value="<?php echo esc_attr(STInput::get('partner_id')) ?>" data-init='<?php echo json_encode($init) ?>' data-placeholder="<?php esc_html_e('Filter by Partner',ST_TEXTDOMAIN) ?>" class="select2-field" type="hidden" data-params='{"type":"partner"}' />
                    </div>
                    <div class="filter-item">
                        <label class="filter-label"><?php esc_html_e('Filter by Type',ST_TEXTDOMAIN) ?></label>
<!--                        <select name="st_post_type" class="filter-control">-->
<!--                            <option value="">--- Select ---</option>-->
<!--                            --><?php //foreach ($post_types as $post_type=>$data){
//                                printf('<option value="%s" %s>%s</option>',$post_type,selected($post_type,STInput::get('st_post_type'),false),$data['title']);
//                            } ?>
<!--                        </select>-->
                        <div class="filter-checkbox-wrap" >
                            <?php foreach ($post_types as $post_type=>$data){
                                $checked = (is_array($st_post_types) and in_array($post_type,$st_post_types))?'checked':"";
                                printf('<label class="filter-checkbox" style="display: block;margin-bottom: 7px;"><input type="checkbox" value="%s" name="st_post_types[]" %s> %s</label>',$post_type,$checked,$data['title']);
                            } ?>
                        </div>
                    </div>
                    <div class="filter-item">
                        <button class="button" type="submit" value="filter" ><?php esc_html_e('Filter',ST_TEXTDOMAIN) ?></button>
                    </div>
                </form>
            </div>
            <div class="report-chart">
                <canvas id="report-chart-content"></canvas>
                <script>
                    (function ($) {

                        $(document).ready(function () {

                            var datepicker_end=$('.datepicker_end');
                            var datepicker_start=$('.datepicker_start');

                            datepicker_start.datepicker({
                                changeMonth: true,
                                dateFormat:'mm-dd-yy'
                            }).on( "change", function() {
                                datepicker_end.datepicker( "option", "minDate", datepicker_start.datepicker('getDate') );
                            });

                            datepicker_end.datepicker({
                                changeMonth: true,
                                dateFormat:'mm-dd-yy'
                            }).on( "change", function() {
                                datepicker_start.datepicker( "option", "maxDate",datepicker_end.datepicker('getDate') );
                            });


                            var chartData=<?php echo json_encode($chartData) ?>;
                            var ctx = document.getElementById('report-chart-content').getContext('2d');
                            window.myBar = new Chart(ctx, {
                                type: 'line',
                                data: chartData,
                                options: {
                                    // title: {
                                    //     display: true,
                                    //     text: 'Chart.js Bar Chart - Stacked'
                                    // },
                                    tooltips: {
                                        mode: 'index',
                                        intersect: false
                                    },
                                    responsive: true,
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                min: 0
                                            }
                                        }]
                                    }
                                }
                            });


                            // Select 2 Autocomplete Fields
                            if(typeof $.fn.select2 != 'undefined'){
                                $('.select2-field').each(function () {
                                    var p = $(this).data('params');
                                    var placeholder = $(this).data('placeholder');
                                    var init =$(this).data('init');

                                    $(this).select2({
                                        placeholder:placeholder,
                                        minimumInputLength: 1,
                                        ajax: {
                                            type:'post',
                                            url: st_params.ajax_url,
                                            data: function (term) {
                                                p.action = 'st_traveler_autocomplete';
                                                p.search = term;
                                                p._s = st_params._s;
                                                // Query parameters will be ?search=[term]&type=public
                                                return p;
                                            },
                                            results: function (data, page) {
                                                return { results: data.items };
                                            },
                                            cache: true
                                        },
                                        initSelection:function(e,callback)
                                        {
                                            callback(init);
                                        }
                                    });

                                })
                            }

                        });
                    })(jQuery)
                </script>
            </div>
        </div>
    </div>
</div>
