<div class="wrap">
    <div id="icon-tools" class="icon32"></div>
    <h2><?php _e('Edit Language : ',STP_TEXTDOMAIN) ?>
    <?php echo STLanguage::get_title_language(STInput::get('id')) ?>
    </h2>
    <h3><?php _e('File : ',STP_TEXTDOMAIN) ?>
        <?php echo STInput::get('file') ?>
    </h3>
</div>
<?php
echo STLanguage::get_msg();
$list_language = STLanguage::get_modun_language(STInput::get('id'),STInput::get('file'));
?>
<div>
    <form action="" method="post">
        <p class="submit">
            <a class="button" href="?page=st-language&action=list_file&id=<?php echo STInput::get('id') ?>"><?php _e('Back',STP_TEXTDOMAIN) ?></a>
        </p>
        <input name="id" value="<?php echo STInput::get('id') ?>" type="hidden">
        <input name="file" value="<?php echo STInput::get('file') ?>" type="hidden">
        <table class="widefat">
            <thead>
                <tr>
                    <th scope="row" style="text-align: right;width: 25%">
                        <label><strong><?php _e('Title',STP_TEXTDOMAIN) ?></strong></label>
                    </th>
                    <th style="width: 75%"><strong><?php _e('Translate',STP_TEXTDOMAIN) ?></strong></th>
                </tr>
            </thead>
            <?php $i=0; foreach($list_language as $k=>$v): ?>
                <tr <?php if($i%2==0 )echo 'class="alternate"'; ?>>
                    <th scope="row" style="text-align: right">
                        <label><?php echo $k  ?></label>
                    </th>
                    <td>
                        <input  class="regular-text" value="<?php echo $v  ?>" name='key[<?php echo $k  ?>]' type="text" style="width: 400px">
                    </td>
                </tr>
            <?php $i++; endforeach ?>
        </table>
        <p class="submit">
            <input type="submit" value="<?php _e('Save Change',STP_TEXTDOMAIN) ?>" class="button button-primary" id="submit" name="btn_change_language">
            <a class="button" href="?page=st-language&action=list_file&id=<?php echo STInput::get('id') ?>"><?php _e('Cancel',STP_TEXTDOMAIN) ?></a>
        </p>
    </form>
</div>