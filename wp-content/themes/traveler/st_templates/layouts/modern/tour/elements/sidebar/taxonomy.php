<div class="sidebar-item pag st-icheck">
    <div class="item-title">
        <h4><?php echo $title; ?></h4>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="item-content">
        <ul>
            <?php New_Layout_Helper::listTaxTreeFilter($taxonomy, 0, -1, 'st_tours'); ?>
        </ul>
        <button class="btn btn-link btn-more-item"><?php echo __('More', ST_TEXTDOMAIN); ?> <i class="fa fa-caret-down"></i></button>
    </div>
</div>