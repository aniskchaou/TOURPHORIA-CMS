<div class="wrap">
    <div id="icon-tools" class="icon32"></div>
    <h2><?php _e('Add Language',STP_TEXTDOMAIN) ?></h2>
</div>
<?php
echo STLanguage::get_msg();
?>
<div>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label><?php _e('Name Language',STP_TEXTDOMAIN) ?></label>
                </th>
                <td>
                    <input  class="regular-text" value="" id="name" name="name" type="text" style="width: 400px">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Description',STP_TEXTDOMAIN) ?></label>
                </th>
                <td>
                    <textarea name="desc" style="width: 400px"></textarea>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" value="<?php _e('Save',STP_TEXTDOMAIN) ?>" class="button button-primary" id="submit" name="btn_add_language">
            <a class="button" href="?page=st-language"><?php _e('Cancel',STP_TEXTDOMAIN) ?></a>
        </p>
    </form>
</div>