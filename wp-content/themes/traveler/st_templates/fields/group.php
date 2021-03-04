<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 9:16 AM
 */
?>
<div class="st-field-<?php echo esc_attr($data['type']); ?>">
    <?php
        if(!empty($data['label'])){
            echo '<p class="st-group-heading">'. $data['label'] .'</p>';
        }

        if(!empty($data['fields'])){
            echo '<div class="row">';
            foreach ($data['fields'] as $k => $v){
                $class_col = 'col-lg-12';
                if(!empty($v['col']))
                    $class_col = 'col-lg-' . $v['col'];
                ?>
                <div class="<?php echo esc_attr($class_col); ?> st-partner-field-item">
                    <?php echo st()->load_template('fields/' . $v['type'], '', array('data' => $v, 'post_id' => $post_id)); ?>
                </div>
                <?php
            }
            echo '</div>';
        }
    ?>

</div>
