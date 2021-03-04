<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/9/15
 * Time: 8:59 AM
 */
if(!isset($value))
{
    $value['number']=STInput::request('room_num_search');
    $value['data']=array(
        'adult_number'=>STInput::request('adult_number'),
        'child_number'=>STInput::request('child_number')
    );
}
$default=array(
    'number'=>1,
    'data'=>array(
        'adult_number'=>1,
        'child_number'=>0
    )
);
$value=wp_parse_args($value,$default);

$room_num=$value['number'];
$adult_number=$value['data']['adult_number'];
$child_number=$value['data']['child_number'];

if($room_num<2) return;
?>
<h4><?php  st_the_language('hotel_room_info') ?></h4>
<div class="room_num_config mb20" >
    <table class="noborder" width="100%" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th >&nbsp;</th>
            <th><?php st_the_language('adults')?></th>
            <th><?php st_the_language('host_name')?></th>
            <th><?php st_the_language('children')?></th>
            <th class=""><span class="age_of_children_col hidden"><?php st_the_language('age_of_children')?></span></th>
        </tr>

        </thead>
        <tbody>
            <?php
            for($k=1;$k<=$room_num;$k++){
                ?>
                <tr id="" class="room-item" data-room-num="<?php echo esc_attr($k) ?>">
                    <td class="room_num_text" width="" style="width:12%;">
                        <?php echo sprintf(st_get_language('hotel_room_s'),$k) ?>
                    </td>
                    <td class="room_num_adult" style="width:12%;">
                        <select name="room_data[<?php echo esc_attr( $k) ?>][adult_number]" class="room_num_adults_input" >
                            <?php
                            $max=st()->get_option('hotel_max_adult',14);


                            for($i=1;$i<=$max;$i++){
                                echo "<option ".selected($i,$adult_number)." value='$i'>{$i}</option>";
                            }?>
                        </select>
                    </td>
                    <td class="" style="width:12%;vertical-align: top">
                        <input class="room_num_host_name_input required form_input" name="room_data[<?php echo esc_attr( $k) ?>][host_name]" type="text" value="" placeholder="<?php st_the_language('host_name')?>" />
                    </td>
                    <td class="room_num_children" style="width:10%;">
                        <select name="room_data[<?php echo esc_attr( $k) ?>][child_num]" class="room_num_children_input">
                            <?php
                            $max=st()->get_option('hotel_max_child',14);
                            for($i=0;$i<=$max;$i++){
                                echo "<option value='$i' ".selected($i,$child_number).">{$i}</option>";
                            }?>
                        </select>
                    </td>
                    <td class=" ">
                        <div class="room_num_age_of_children ">
                            <?php
                                if($child_number>0)
                                for($k2=1;$k2<=$child_number;$k2++){
                                ?>
                                <select name="room_data[<?php echo esc_attr($k)?>][age_of_children][]"  class="age_of_child_input required">
                                    <option value="">- ? -</option>
                                    <option value="0"> < 1</option>
                                    <?php for($i=1;$i<=17;$i++){
                                        echo "<option value='{$i}'>{$i}</option>";
                                    }?>
                                </select>
                                <?php
                            }  ?>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
        <tfoot>
        <tr>
            <td class="">&nbsp;</td>
            <td class="" > <?php st_the_language('_aged_18_')?></td>
            <td class="" > &nbsp;</td>
            <td class="" > 0 - 17</td>
        </tr>
        </tfoot>
    </table>
</div>

<!-- Begin Example age_of_children       -->
<select id="example_age_of_child" class="hidden age_of_child_input">
    <option value="">- ? -</option>
    <option value="0"> < 1</option>
    <?php for($i=1;$i<=17;$i++){
        echo "<option value='{$i}'>{$i}</option>";
    }?>
</select>
<!-- End Example age_of_children       -->