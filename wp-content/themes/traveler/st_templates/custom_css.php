<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/6/15
 * Time: 4:04 PM
 */

$main_color =st()->get_option('main_color','#ed8323');
$background_mega =st()->get_option('mega_menu_background','#ffffff');
$color_mega =st()->get_option('mega_menu_color','#333333');

if(isset($_GET['main_color']))
{
    $main_color.='#'.$_GET['main_color'];
}
if(isset($main_color_char))
{
    $main_color=$main_color_char;
}

if(!$main_color) $main_color='#ed8323';

$hex=st_hex2rgb($main_color);
$star_color=st()->get_option('star_color',$main_color);

?>
#calendar-add-starttime span{
background: <?php echo esc_attr($main_color); ?>
}

#setting_inventory .fn-gantt .fn-label .inventory-edit-room-number{
color: <?php echo esc_attr($main_color)?>;
}
#st_stripe_card_cvc.is-focused,
#st_stripe_card_expiry.is-focused,
#st_stripe_card_number.is-focused{
border-color: <?php echo esc_attr($main_color)?>;
}

.st-inbox-body .inbox-navigation ul li a {
border: 1px solid <?php echo esc_attr($main_color)?>;
color: <?php echo esc_attr($main_color)?>;
}
.st-inbox-body .inbox-navigation ul li a:hover {
background: <?php echo esc_attr($main_color)?>;
}

.map_type .st-map-type{
background-color: <?php echo esc_attr($main_color)?>;
}
#gmap-control{
background-color: <?php echo esc_attr($main_color)?>;
}
.gmapzoomminus , .gmapzoomplus{
background-color: <?php echo esc_attr($main_color)?>;
}

.sort_icon .active,
.woocommerce-ordering .sort_icon a.active{
color:<?php echo esc_attr($main_color)?>;
cursor: default;
}
.package-info-wrapper .icon-group i:not(".fa-star"):not(".fa-star-o"){
   color:<?php echo esc_attr($main_color)?>;
}
a,
a:hover,
.list-category > li > a:hover,
.pagination > li > a,
.top-user-area .top-user-area-list > li > a:hover,
.sidebar-widget.widget_archive ul> li > a:hover,
.sidebar-widget.widget_categories ul> li > a:hover,
.comment-form .add_rating,
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand span,
.form-group.form-group-focus .input-icon.input-icon-hightlight,
.booking-item-payment .booking-item-rating-stars .fa-star,
.booking-item-raiting-summary-list > li .booking-item-rating-stars,
.woocommerce .woocommerce-breadcrumb .last,
.product-categories li.current-cat:before,
.product-categories li.current-cat-parent:before,
.product-categories li.current-cat>a,
.product-categories li.current-cat>span,
.woocommerce .star-rating span:before,
.woocommerce ul.products li.product .price,
.woocommerce .woocommerce_paging a,
.woocommerce .product_list_widget ins .amount,
#location_header_static i,
.booking-item-reviews > li .booking-item-rating-stars,
.booking-item-payment .booking-item-rating-stars .fa-star-half-o,
#top_toolbar .top_bar_social:hover,
.woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a,
.booking-item-rating .booking-item-rating-stars ,
body .box-icon-border.box-icon-white:hover,body  [class^="box-icon-border"].box-icon-white:hover,body  [class*=" box-icon-border"].box-icon-white:hover,body  .box-icon-border.box-icon-to-white:hover:hover,body  [class^="box-icon-border"].box-icon-to-white:hover:hover,body  [class*=" box-icon-border"].box-icon-to-white:hover:hover,
#main-footer .text-color,
.change_same_location:focus,
ul.slimmenu.slimmenu-collapsed li ul li a,
ul.slimmenu.collapsed li ul li a,
.st_category_header h4,.st_tour_box_style ul a.text-darken:hover,
.st_accordion.st_tour_ver .panel-default > .panel-heading,
.st_social.style2 >a:hover,
.color-main,.main-color
{
color:<?php echo esc_attr($main_color)?>
}
body .st_tour_grid .text-color,body .color-text,
body .st_tour_grid .text-color-hover:hover,body .st_tour_grid .color-text-hover:hover,body .st_tour_grid .text-darken.text-color-hover:hover,body .st_tour_grid .text-darken.color-text-hover:hover,
body .st_tour_list .text-color,body .color-text,
body .st_tour_list .text-color-hover:hover,body .st_tour_list .color-text-hover:hover,body .st_tour_list .text-darken.text-color-hover:hover,body .st_tour_list .text-darken.color-text-hover:hover
{
color:<?php echo esc_attr($main_color)?>
}
<?php if(!New_Layout_Helper::isNewLayout()){ ?>
::selection {
background: <?php echo esc_attr($main_color)?>;
color: #fff;
}
<?php } ?>
.share ul li a:hover{
color:<?php echo esc_attr($main_color)?>!important;
}

    .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a {
         color: <?php echo esc_attr($main_color)?> !important;
    }


header#main-header,
.btn-primary,
.post .post-header,
.top-user-area .top-user-area-list > li.top-user-area-avatar > a:hover > img,

.booking-item:hover, .booking-item.active,
.booking-item-dates-change:hover,
.btn-group-select-num >.btn.active, .btn-group-select-num >.btn.active:hover,
.btn-primary:hover,
.booking-item-features > li:hover > i,
.form-control:active,
.form-control:focus,
.fotorama__thumb-border,
.sticky-wrapper.is-sticky .main_menu_wrap,
.woocommerce form .form-row.woocommerce-validated .select2-container,
.woocommerce form .form-row.woocommerce-validated input.input-text,
.woocommerce form .form-row.woocommerce-validated select,
.btn-primary:focus
{
border-color:<?php echo esc_attr($main_color)?>;
}
#menu1 {
  border-bottom: 2px solid <?php echo esc_attr($main_color)?>;
}
ul.slimmenu li>ul.mega-menu{
background-color: <?php echo esc_attr($background_mega)?>;
}

ul.slimmenu li>ul.mega-menu li a,
ul.slimmenu li>ul.mega-menu li,
ul.slimmenu li>ul.mega-menu h1,
ul.slimmenu li>ul.mega-menu h2,
ul.slimmenu li>ul.mega-menu h3,
ul.slimmenu li>ul.mega-menu h4,
ul.slimmenu li>ul.mega-menu h5,
ul.slimmenu li>ul.mega-menu h6,
ul.slimmenu li>ul.mega-menu p,
ul.slimmenu li>ul.mega-menu div{
color: <?php echo esc_attr($color_mega)?>;
}

.woocommerce .woocommerce-message,.woocommerce .woocommerce-info {
  border-top-color:  <?php echo esc_attr($main_color)?>;

}
.main-bgr,.bgr-main,
.main-bgr-hover:hover,.bgr-main-hover:hover,
.pagination > li > a.current, .pagination > li > a.current:hover,
.btn-primary,input.btn-primary:focus,input.btn-primary,
ul.slimmenu li.active > a, ul.slimmenu li:hover > a,
.nav-drop > .nav-drop-menu > li > a:hover,
.btn-group-select-num >.btn.active, .btn-group-select-num >.btn.active:hover,
.btn-primary:hover,
.pagination > li.active > a, .pagination > li.active > a:hover,
.box-icon, [class^="box-icon-"], [class*=" box-icon-"]:not(.box-icon-white):not(.box-icon-border-dashed):not(.box-icon-border),
.booking-item-raiting-list > li > div.booking-item-raiting-list-bar > div, .booking-item-raiting-summary-list > li > div.booking-item-raiting-list-bar > div,
.irs-bar,
.nav-pills > li.active > a,
.search-tabs-bg > .tabbable > .nav-tabs > li.active > a,
.search-tabs-bg > .tabbable > .nav-tabs > li > a:hover > .fa,
.irs-slider,
.post-link,
.hover-img .hover-title, .hover-img [class^="hover-title-"], .hover-img [class*=" hover-title-"],
.post-link:hover,
#gotop:hover,
.shop-widget-title,
.woocommerce ul.products li.product .add_to_cart_button,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.sidebar_section_title,
.shop_reset_filter:hover,
.woocommerce .woocommerce_paging a:hover,
.pagination .page-numbers.current,
.pagination .page-numbers.current:hover,
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
.chosen-container .chosen-results li.highlighted,
#taSignIn,
.grid_hotel_room .grid , 
.grid_hotel_room .grid figure,
figure.effect-layla,
.st-page-sidebar-new .page-sidebar-menu .sub-menu.item .active > a,.st-page-sidebar-new .page-sidebar-menu > li.active > a,
.single-location .search-tabs-bg .tabbable .nav-tabs > li.active a  ,
.single-location .search-tabs-bg .tabbable .nav-tabs > li:hover a ,
.single-location .search-tabs-bg .tabbable .nav-tabs > li a:hover,
ul.slimmenu.collapsed li .sub-toggle,
ul.slimmenu.collapsed li ul li a:hover,
.end2,.end1,
body #gotop.go_top_tour_box,
.st_tab.st_tour_ver .nav-tabs>li.active>a,.st_tab.st_tour_ver .nav-tabs>li.active::before,
.st_accordion.st_tour_ver>.panel>.panel-heading>.panel-title>a[aria-expanded=true],
.st_social.style1 >a:hover,
.st_list_partner_nav .fa:hover,
.st_tour_grid .fotorama__arr,.st_tour_grid .fotorama__video-close,.st_tour_grid .fotorama__fullscreen-icon,
.st_tour_list .fotorama__arr,.st_tour_list .fotorama__video-close,.st_tour_list .fotorama__fullscreen-icon,
.st_tour_ver .div_review_half
{
    background:<?php echo esc_attr($main_color)?> ;
    border-color: <?php echo esc_attr($main_color)?> ;
}
.calendar-content .fc-state-default, .calendar-content .fc-toolbar, .calendar-content.fc-unthemed .btn.btn-available:hover , .calendar-content.fc-unthemed .st-active .btn.btn-available, .calendar-content.fc-unthemed .btn.btn-available.selected, .calendar-starttime-content .fc-state-default, .calendar-starttime-content .fc-toolbar, .calendar-starttime-content.fc-unthemed .btn.btn-available:hover , .calendar-starttime-content.fc-unthemed .st-active .btn.btn-available, .calendar-starttime-content.fc-unthemed .btn.btn-available.selected {
  background-color:<?php echo esc_attr($main_color)?> !important;
}
.calendar-content.fc-unthemed .fc-basic-view .fc-head, .calendar-starttime-content.fc-unthemed .fc-basic-view .fc-head{ color:  <?php echo esc_attr($main_color)?> !important; }
.calendar-content.fc-unthemed .btn.btn-available:hover , .calendar-starttime-content.fc-unthemed .btn.btn-available:hover, .datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:focus, .datepicker table tr td.active:hover:focus, .datepicker table tr td.active.disabled:focus, .datepicker table tr td.active.disabled:hover:focus, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:hover.active, .open .dropdown-toggle.datepicker table tr td.active, .open .dropdown-toggle.datepicker table tr td.active:hover, .open .dropdown-toggle.datepicker table tr td.active.disabled, .open .dropdown-toggle.datepicker table tr td.active.disabled:hover,
.calendar-content.fc-unthemed .st-active button.next_month,
.calendar-starttime-content.fc-unthemed .st-active button.next_month,
.calendar-content.fc-unthemed .btn.btn-available:not(.next_month):hover,
.calendar-starttime-content.fc-unthemed .btn.btn-available:not(.next_month):hover
{
  background-color:<?php echo esc_attr($main_color)?> !important;
  border-color: <?php echo esc_attr($main_color)?>;
}
.tagcloud a{
    background-color:<?php echo esc_attr($main_color)?> !important;
    color: <?php echo esc_attr($main_color)?> !important;
}
.datepicker table tr td.today:before, .datepicker table tr td.today:hover:before, .datepicker table tr td.today.disabled:before, .datepicker table tr td.today.disabled:hover:before{
border-bottom-color: <?php echo esc_attr($main_color)?>;
}
<?php if (!empty($hex)) {?>
.box-icon:hover, [class^="box-icon-"]:hover, [class*=" box-icon-"]:hover
{
background:rgba(<?php echo esc_attr($hex[0].','.$hex[1].','.$hex[2].',0.7') ?>);
}

.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover
{
    background:rgba(<?php echo esc_attr($hex[0].','.$hex[1].','.$hex[2].',0.7') ?>);
}
<?php } ;?>
.booking-item-reviews > li .booking-item-review-person-avatar:hover
{
-webkit-box-shadow: 0 0 0 2px <?php echo esc_attr($main_color)?>;
box-shadow: 0 0 0 2px <?php echo esc_attr($main_color)?>;
}
#main-header ul.slimmenu li.current-menu-item > a, #main-header ul.slimmenu li:hover > a,
#main-header .menu .current-menu-ancestor >a,
#main-header .product-info-hide .product-btn:hover,
.menu-style-2 ul.slimmenu li.current-menu-item > a, .menu-style-2 ul.slimmenu li:hover > a, .menu-style-2 .menu .current-menu-ancestor > a, .menu-style-2 .product-info-hide .product-btn:hover
{
background:<?php echo esc_attr($main_color)?>;
color:white;
}

#main-header .menu .current-menu-item > a
{
background:<?php echo esc_attr($main_color)?> !important;
color:white !important;
}

.i-check.checked, .i-radio.checked
{

border-color: <?php echo esc_attr($main_color)?>;
background: <?php echo esc_attr($main_color)?>;
}
.box-icon-border, [class^="box-icon-border"], [class*=" box-icon-border"]{
    border-color: <?php echo esc_attr($main_color)?>;
    color: <?php echo esc_attr($main_color)?>;
}
.box-icon-border:hover, [class^="box-icon-border"]:hover, [class*=" box-icon-border"]:hover{
background-color:<?php echo esc_attr($main_color)?>;
}
.border-main, .i-check.hover, .i-radio.hover,.st_list_partner_nav .fa
{
border-color: <?php echo esc_attr($main_color)?>;
}
.owl-controls .owl-buttons div:hover
{

    background: <?php echo esc_attr($main_color)?>;
    -webkit-box-shadow: 0 0 0 1px <?php echo esc_attr($main_color)?>;
    box-shadow: 0 0 0 1px <?php echo esc_attr($main_color)?>;
}

.irs-diapason{

background: <?php echo esc_attr($main_color)?>;
}
ul.slimmenu.slimmenu-collapsed li .slimmenu-sub-collapser {
 background:<?php echo esc_attr($main_color)?>
}

    .calendar-content .fc-toolbar,
.calendar-starttime-content .fc-toolbar{
    background-color: <?php echo esc_attr($main_color)?>;
    margin: 0;
    }
    .calendar-content.fc-unthemed .fc-basic-view .fc-head ,
.calendar-starttime-content.fc-unthemed .fc-basic-view .fc-head {
    color: <?php echo esc_attr($main_color)?>;
    }

    .calendar-content.fc-unthemed .btn.btn-available_allow_fist:hover::before,
.calendar-starttime-content.fc-unthemed .btn.btn-available_allow_fist:hover::before{
    border-color: <?php echo esc_attr($main_color)?> #ccc #ccc <?php echo esc_attr($main_color)?>;
    }
    .calendar-content.fc-unthemed .btn.btn-available_allow_last:hover::before,
.calendar-starttime-content.fc-unthemed .btn.btn-available_allow_last:hover::before {
    border-color: #ccc <?php echo esc_attr($main_color)?> <?php echo esc_attr($main_color)?> #ccc;

    }

.st-hotel-map-gallery .on_the_map .btn-on-map.active:hover {
background: <?php echo esc_attr($main_color)?>;
}
.st-hotel-map-gallery .review-price .review {
background: <?php echo esc_attr($main_color)?>;
}
.st-hotel-map-gallery .review-price .review:after {
border-bottom: 10px solid <?php echo esc_attr($main_color)?>;
}
.st-hotel-map-gallery .review-price .review-stars .active-half i:before {
color: <?php echo esc_attr($main_color)?>;
}
.st-hotel-map-gallery .review-price .review-stars .active i:before {
color: <?php echo esc_attr($main_color)?>;
}
.accommodation-gallery .caption-star .hotel-star {
color: <?php echo esc_attr($main_color)?>;
}
.st-hotel-title-address .location {
color: <?php echo esc_attr($main_color)?>;
}
.st-review-score-list .list_review li .score {
color: <?php echo esc_attr($main_color)?>;
}
.st-hotel-tabs-content .nav-tabs > li > a:hover {
color: <?php echo esc_attr($main_color)?>;
}
.st-hotel-tabs-content .nav-tabs > li.active > a {
color: <?php echo esc_attr($main_color)?>;
}
.st-more-info.style-2 .icon {
color: <?php echo esc_attr($main_color)?>;
}
.st-list ul li:before {
border: 1px solid <?php echo esc_attr($main_color)?>;
}
.tab-amenities .amenities-left .amenity .title i,
.tab-amenities .amenities-right .amenity .title i {
color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .content-policies .service-content-section .service-detail-item .service-detail-content .enforced_red {
color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .content-price-payment .service-content-section .service-detail-item .service-detail-content .enforced_red {
color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .content-price-payment .service-content-section .service-detail-item .service-detail-content ul li:before {
border: 1px solid <?php echo esc_attr($main_color)?>;
}

.single-st_hotel a.check_availability:hover span {
background-color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel #check_availability .contact .caption .content,
.single-st_hotel #check_availability .contact .caption a {
color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .hotel-item-1 .caption-content .location {
color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .hotel-item-1 .caption-content .price .item {
font-weight: 700;
}
.single-st_hotel .hotel-item-1 .caption-content .price .onsale {
color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .hotel-item-1 .caption-content .book-now:hover {
background: <?php echo esc_attr($main_color)?>;
border-color: <?php echo esc_attr($main_color)?>;
}
.single-st_hotel .hotel-item-1:hover .caption-content .title a {
color: <?php echo esc_attr($main_color)?>;
}

.tab-inner-gallery .popup-gallery-image:hover:before, .tab-inner-gallery .popup-gallery-image:hover:after, .tab-inner-gallery .popup-gallery-image:hover {
border-color: <?php echo esc_attr($main_color)?>;
}

.st_hotel_contact_info .contact .caption .content,
.st_hotel_contact_info .contact .caption a {
color:  <?php echo esc_attr($main_color)?>;
}

.booking-item-raiting-summary-list.stats-list-select > li .booking-item-rating-stars > li.selected {
color: <?php echo esc_attr($main_color)?>;
}

@media (max-width: 992px) {
.menu-style-1 ul.slimmenu li a .sub-toggle,
.menu-style-2 ul.slimmenu li a .sub-toggle{
background: <?php echo esc_attr($main_color)?> !important;
}
}


<?php if($star_color):?>
    .booking-item-rating .fa ,
    .booking-item.booking-item-small .booking-item-rating-stars,
    .comment-form .add_rating,
    .booking-item-payment .booking-item-rating-stars .fa-star,
    .st-item-rating .fa,
    li  .fa-star , li  .fa-star-o , li  .fa-star-half-o{
    color:<?php echo esc_attr($star_color)?>
    }
<?php endif;?>
<?php
      $bg_featured = st()->get_option('st_text_featured_bg','#3366cc');
      $bg_sale = st()->get_option('st_text_sale_bg','#3366cc');
?>
.feature_class{
 background: <?php echo esc_attr($bg_featured) ?>;
}
.feature_class::before {
   border-color: <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> transparent transparent;
}
.feature_class::after {
    border-color: <?php echo esc_attr($bg_featured) ?> transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>;
}
.featured_single .feature_class::before{
   border-color: transparent <?php echo esc_attr($bg_featured) ?> transparent transparent;
}
.item-nearby .st_featured::before {
    border-color: transparent transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>;
}
.item-nearby .st_featured::after {
   border-color: <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> transparent  ;
}

.st_sale_class{
    background-color: <?php echo esc_attr($bg_sale) ?>;
}
.st_sale_class.st_sale_paper * {color: <?php echo esc_attr($bg_sale) ;?> }
.st_sale_class .st_star_label_sale_div::after,.st_sale_label_1::before{
    border-color: <?php echo esc_attr($bg_sale) ;?> transparent transparent <?php echo esc_attr($bg_sale) ;?> ;
}
.st_sale_class .st_star_label_sale_div::after{
border-color: <?php echo esc_attr($bg_sale) ;?>

.st-tour-title-address .location,
.st-tour-tabs-content .nav-tabs>li.active>a,
.st-tour-tabs-content .nav-tabs>li>a:hover,
.st-tour-program .title_program span,
.tab-content-price .single-price .item,
.st-tab-payment .service-detail-item .service-detail-content .enforced_red,
.tour-item-1 .caption-content .location,
.tour-item-1:hover .caption-content .title a,
.tour-item-1 .caption-content .price .item{
color: <?php echo esc_attr($main_color)?>;
}
.st-tour-program .title_program span,
.st-tab-payment .service-detail-item .service-detail-content ul li::before,
.tour-item-1 .caption-content .book-now:hover{
border-color: <?php echo esc_attr($main_color)?>;
}
.tour-item-1 .caption-content .book-now:hover{
background-color: <?php echo esc_attr($main_color)?>;
}

.nav-pills>li.active>a:hover,
.st-option-wrapper1.option-wrapper1 .option:hover,
.st-flight-booking .flight-booking .flight-title{
background-color: <?php echo esc_attr($main_color)?>;
}
.input-error,
.st-booking-list .departure-title:before,
.st-booking-list .booking-item-flight-details .flight-layovers .flight-line:before,
.st-booking-list .booking-item-flight-details .flight-layovers .flight-line .origin > div:before,
.st-booking-list .booking-item-flight-details .flight-layovers .flight-line .destination > div:before,
.st-flight-booking .flight-booking,
.st-booking-list .booking-item-flight-details .flight-layovers .flight-line .stop > div:before{
border-color: <?php echo esc_attr($main_color)?>;
}
.st-booking-list .departure-title .icon-flight,
.st-flight-booking .flight-booking .your-booking-content .title,
.st-flight-booking .flight-booking .your-booking-content .st-flight-total-price{
color: <?php echo esc_attr($main_color)?>;
}
<?php
$st_sl_height = st()->get_option('st_sl_height','');
if (!empty($st_sl_height)){
    echo ".st_star_label_sale_div::after{border-top-width: ".((int)$st_sl_height*0.5)."px !important;border-bottom-width: ".((int)$st_sl_height*0.5)."px !important}";
}
$st_ft_label_w= st()->get_option('st_ft_label_w' ,'');
if (!empty($st_ft_label_w)){
    echo ".st_label_star_border_div::after{border-left-width: ".((int)$st_ft_label_w*0.5)."px !important;border-right-width: ".((int)$st_ft_label_w*0.5)."px !important}";
}
?>
<?php  if(st()->get_option('right_to_left') == 'on' ){ ?>
    .st_featured{
       padding: 0 13px 0 3px;
    }
    .featured_single .st_featured::before {
        border-color: <?php echo esc_attr($bg_featured) ?> transparent transparent transparent  ;
        right: -26px;
    }
    .item-nearby  .st_featured::before {
    border-color: <?php echo esc_attr($bg_featured) ?> transparent transparent <?php echo esc_attr($bg_featured) ?>;
    }

    .item-nearby .st_featured {
        bottom: 10px;
        left: -10px;
        right: auto;
        top: auto;
        padding-left:13px!important;
    }
    .item-nearby  .st_featured::before {
        left: 0;
        right: auto;
        bottom: -10px;
        top: auto;
    }
    .item-nearby .st_featured::before {
          border-color: transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>  transparent;
    }
    .item-nearby .st_featured::after {
        border-color:   transparent <?php echo esc_attr($bg_featured) ?> transparent transparent;
        border-width: 14px;
        right: -26px;
    }
    .featured_single {
        padding-left: 70px;
        padding-right: 0px;
    }
<?php } ?>
<?php 
  $header_bgr_color = st()->get_option('header_background' );
    $header_bgr_color=wp_parse_args($header_bgr_color,['background-color'=>'']);
  $header_bgr_color = $header_bgr_color['background-color'] ;
  if (st()->get_option('menu_style') =='2'):
?>
@media (min-width: 992px) { 
.menu_style2.header_transparent  #st_header_wrap {     
    background: -moz-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%, <?php echo esc_attr($header_bgr_color)?> 27%, rgba(0,0,0,0) 90%, rgba(0,0,0,0) 99%, rgba(0,0,0,0) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr($header_bgr_color)?>), color-stop(27%,<?php echo esc_attr($header_bgr_color)?>), color-stop(90%,rgba(0,0,0,0)), color-stop(99%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0)));
    background: -webkit-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%);
    background: -o-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%);
    background: -ms-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=0 );
  }
      ul.slimmenu li ul.mega-menu li:hover a {
      color: <?php echo esc_attr($main_color)?> !important;
      border-bottom: 1px solid rgba(0,0,0,.075) !important;
      }
}

  <?php endif; ?>

