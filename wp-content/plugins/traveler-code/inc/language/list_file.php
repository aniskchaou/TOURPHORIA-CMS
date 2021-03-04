<div class="wrap">
    <div id="icon-tools" class="icon32"></div>
    <h2><?php _e('Language : ',STP_TEXTDOMAIN) ?>
        <?php echo STLanguage::get_title_language(STInput::get('id')) ?>
    </h2>
</div>
<?php
echo STLanguage::get_msg();
?>
<?php
$list_file = STLanguage::load_list_modun(STInput::get('id'));
?>
<br>
<div>
    <table class="widefat">
        <thead>
        <tr>
            <th style="width: 30%"><?php _e('File Name',STP_TEXTDOMAIN) ?></th>
            <th style="width: 65%"><?php _e('Url',STP_TEXTDOMAIN) ?></th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($list_file as $k => $v): ?>
            <tr <?php if($k%2==0 )echo 'class="alternate"'; ?>  valign="top">
                <td>
                    <strong>
                        <a href="?page=st-language&action=translate&id=<?php echo STInput::get('id') ?>&file=<?php echo $v['name'] ?>" class="row-title"> <?php echo esc_html($v['name']) ?></a>
                    </strong>
                </td>
                <td><?php
                    $arg = explode('themes',$v['url']);
                    if(!empty($arg)){
                        echo "...".$arg[1];
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<p class="submit">
    <a class="button" href="?page=st-language"><?php _e('Back',STP_TEXTDOMAIN) ?></a>
</p>