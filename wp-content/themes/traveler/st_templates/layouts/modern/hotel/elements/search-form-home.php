<?php
$result_page = st()->get_option( 'hotel_search_result_page' );
$class = '';
$id = 'id="sticky-nav"';
if(isset($in_tab)) {
    $class = 'in_tab';
    $id = '';
}

?>
<div class="search-form hotel-search-form-home hotel-search-form <?php echo $class; ?>" <?php echo $id; ?>>
    <form action="<?php echo esc_url( get_the_permalink( $result_page ) ); ?>" class="form" method="get">
        <div class="row">
            <div class="col-md-3 border-right">
                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/location', '', [ 'has_icon' => true ] ) ?>
            </div>
            <div class="col-md-3 border-right">
                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/date', '', [ 'has_icon' => true ] ) ?>
            </div>
            <div class="col-md-3 border-right">
                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/guest', '', [ 'has_icon' => true ] ) ?>
            </div>
            <div class="col-md-3">
                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/advanced', '' ) ?>
            </div>
        </div>
    </form>
</div>
