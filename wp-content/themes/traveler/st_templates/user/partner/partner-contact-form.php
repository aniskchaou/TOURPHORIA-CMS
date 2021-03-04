<?php
$partner_id = STInput::get('partner_id', '');
if (STUser_f::check_partner_in_element($partner_id)) {
    $current_user_upage = get_user_by('ID', $partner_id);
    $role = $current_user_upage->roles[0];
    $user_meta = get_user_meta($current_user_upage->ID);
    $user_meta = array_filter(array_map(function ($a) {
        return $a[0];
    }, $user_meta));

    $default = array(
        'title' => __('Contact partner', ST_TEXTDOMAIN),
        'font_size' => '4',
    );

    extract(wp_parse_args($atts, $default));
    ?>
    <div class="author-contact-form-wraper">
        <h<?php echo esc_attr($font_size); ?> class="author-review-box-title"><?php echo esc_attr($title); ?></h<?php echo esc_attr($font_size) ?>>
        <form method="post" action="" class="author-contact-form">
            <input type="hidden" name="partner_email"
                   value="<?php echo $current_user_upage->user_email; ?>"/>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group form-group-icon-left">
                        <label for="au_name"><?php echo __('Name', ST_TEXTDOMAIN); ?></label><i
                                class="fa fa-user input-icon"></i>
                        <input name="au_name" class="form-control" value=""
                               type="text" placeholder="<?php echo __('Your name', ST_TEXTDOMAIN); ?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group form-group-icon-left">
                        <label for="au_email"><?php echo __('Email', ST_TEXTDOMAIN); ?></label><i
                                class="fa fa-envelope input-icon"></i>
                        <input name="au_email" class="form-control" value=""
                               type="text" placeholder="<?php echo __('Your email', ST_TEXTDOMAIN); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group form-group-icon-left">
                <label for="au_message"><?php echo __('Message', ST_TEXTDOMAIN); ?></label>
                <textarea rows="10" class="form-control" name="au_message"></textarea>
            </div>
            <div id="author-message"></div>
            <input name="st_btn_update" type="submit" class="btn btn-primary"
                   value="<?php echo __('Send Message', ST_TEXTDOMAIN); ?>">
            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
        </form>
    </div>
<?php } ?>