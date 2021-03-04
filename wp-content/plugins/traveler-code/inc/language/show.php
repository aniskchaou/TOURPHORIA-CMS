<div class="wrap">
    <div id="icon-tools" class="icon32"></div>
    <h2><?php _e('ST Language',STP_TEXTDOMAIN) ?></h2>
</div>
<?php
echo STLanguage::get_msg();
?>
<?php
$list_language = STLanguage::load_list_language();
$language_default = self::get_language_default();
?>
<div>
    <form action="" method="get">
        <input name="page" value="st-language" type="hidden">
        <input name="action" value="set_default" type="hidden">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="start_of_week"><?php _e('Set Language default',STP_TEXTDOMAIN) ?> :</label></th>
                <td>
                    <select id="id" name="id">
                         <?php
                         foreach($list_language as $k => $v){
                             if($language_default == $v['slug']){
                                 echo '<option value="'.$v['slug'].'" selected="selected">'.$v['name'].'</option>';
                             }else{
                                 echo '<option value="'.$v['slug'].'">'.$v['name'].'</option>';
                             }
                         }
                         ?>
                    </select>
                    <input type="submit" value="<?php _e('Save Changes',STP_TEXTDOMAIN) ?>" class="button button-primary">
                    <a class="button button-primary" href="?page=st-language&action=add"><?php _e('Add New',STP_TEXTDOMAIN) ?></a>
                </td>
            </tr>
        </table>
    </form>
</div>

<div>
    <table class="widefat">
        <thead>
            <tr>
                <th style="width: 30%"><?php _e('Name Language',STP_TEXTDOMAIN) ?></th>
                <th style="width: 65%"><?php _e('Description',STP_TEXTDOMAIN) ?></th>
            </tr>
        </thead>
        <tbody>
        <?php  foreach($list_language as $k => $v): ?>
            <tr <?php if($k%2==0 )echo 'class="alternate"'; ?>  valign="top">
                <td>
                    <strong>
                        <a href="?page=st-language&action=list_file&id=<?php echo esc_attr($v['slug']) ?>" class="row-title"> <?php echo esc_html($v['name']) ?></a>
                    </strong>

                        <div class="row-actions">
                            <span><a href="?page=st-language&action=list_file&id=<?php echo esc_attr($v['slug']) ?>"><?php _e('Translate',STP_TEXTDOMAIN) ?></a> </span>
                            <?php if($v['slug'] != 'english'): ?>
                                |
                                <span><a  href="?page=st-language&action=del&id=<?php echo esc_attr($v['slug']) ?>" style="color: red"><?php _e('Delete',STP_TEXTDOMAIN) ?></a></span>
                            <?php endif; ?>
                        </div>
                </td>
                <td><?php echo esc_html($v['desc']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>