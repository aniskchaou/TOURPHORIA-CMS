<?php
if(!isset($main_color)) {
    $main_color = st()->get_option('st_hotel_alone_main_color','');
}
$style = '';
if(!empty($main_color)){
    $style .= '
.text-color {
  color: '.$main_color.';
}
.topbar .top-bar-style-1 .control-left .option-item .option-mid .btn-book {
  color: '.$main_color.';
}
.topbar .top-bar-style-1 .control-right .option-item .option-mid .dropdown {
  color: '.$main_color.';
}
.topbar .top-bar-style-1 .control-right .option-item .option-mid .dropdown .dropdown-menu li a:hover {
  color: '.$main_color.';
}
.topbar .top-bar-style-2 .control-left .option-item .option-mid .btn-book {
  color: '.$main_color.';
}
.topbar .top-bar-style-2 .control-left .option-item .option-mid .dropdown .dropdown-menu li a:hover {
  color: '.$main_color.';
}
.topbar .top-bar-style-2 .control-right .option-item .option-mid.room_book {
  background: '.$main_color.';
}
.topbar .top-bar-style-2 .control-right .option-item .option-mid .location-weather .icon {
  color: '.$main_color.';
}
.topbar .top-bar-style-3 .control-left .option-item .option-mid .email,
.topbar .top-bar-style-3 .control-left .option-item .option-mid .phone {
  color: '.$main_color.';
}
.topbar .top-bar-style-3 .control-left .option-item .option-mid .email:before {
  border-left: 1px solid '.$main_color.';
}
.topbar .top-bar-style-3 .control-right .option-item .option-mid .dropdown {
  color: '.$main_color.';
}
.topbar .top-bar-style-3 .control-right .option-item .option-mid .dropdown .dropdown-menu li a:hover {
  color: '.$main_color.';
}
.topbar .top-bar-style-3 .control-right .option-item .option-mid .location-weather .icon {
  color: '.$main_color.';
}
.topbar .top-bar-style-4 .control-left .option-item .option-mid .btn-book {
  color: '.$main_color.';
}
.topbar .top-bar-style-4 .control-right .option-item .option-mid .dropdown {
  color: '.$main_color.';
}
.topbar .top-bar-style-4 .control-right .option-item .option-mid .dropdown .dropdown-menu li a:hover {
  color: '.$main_color.';
}
.topbar .top-bar-style-4 .control-right .option-item .option-mid .location-weather .w-temp {
  color: '.$main_color.';
}
.topbar .top-bar-style-4 .control-right .option-item .option-mid .location-weather .location {
  color: '.$main_color.';
}
.st_main_menu .content-menu .current-menu-parent > a {
  color: '.$main_color.' !important;
}
.st_main_menu .content-menu .current_page_item > a {
  color: '.$main_color.' !important;
}
.st_main_menu .content-menu .current-menu-item > a {
  color: '.$main_color.' !important;
}
.st_main_menu .content-menu .current-menu-ancestor > a {
  color: '.$main_color.' !important;
}
.st_main_menu .content-menu .navbar-nav > li > a:hover,
.st_main_menu .content-menu .navbar-nav > li > a:focus {
  color: '.$main_color.';
}
.st_main_menu .content-menu .navbar-nav > li > .dropdown-menu > li > a:hover,
.st_main_menu .content-menu .navbar-nav > li > .dropdown-menu > li > a:focus {
  color: '.$main_color.';
}
.st_main_menu .content-menu .navbar-nav > li > .dropdown-menu > li > .dropdown-menu > li > a:hover,
.st_main_menu .content-menu .navbar-nav > li > .dropdown-menu > li > .dropdown-menu > li > a:focus {
  color: '.$main_color.';
}
.st_main_menu .menu-style-2 .st_menu > li:before {
  border-bottom: 3px solid '.$main_color.' !important;
}
.helios-slider.st-style-1 .content-slider .content-info .info .title {
  color: '.$main_color.';
}
.helios-slider.st-style-1 .content-slider .content-info .info .content {
  border-bottom: 1px solid '.$main_color.';
  border-top: 1px solid '.$main_color.';
}
.helios-slider.st-style-1 .content-slider .content-info .owl-nav .owl-prev {
  border: solid 1px '.$main_color.';
}
.helios-slider.st-style-1 .content-slider .content-info .owl-nav .owl-next {
  border: solid 1px '.$main_color.';
}
.helios-slider.st-style-1 .scroll .btn-scroll:hover .line-1 {
  background: '.$main_color.';
}
.helios-slider.st-style-1 .scroll .btn-scroll .line-1 {
  border: solid 1px '.$main_color.';
}
.helios-slider.st-style-1 .scroll .btn-scroll .line-2 {
  border: solid 1px '.$main_color.';
}
.helios-slider.st-style-1 .scroll .btn-scroll .line-3 {
  border: solid 1px '.$main_color.';
}
.helios-banner .center .scroll a:hover {
  background: '.$main_color.';
}
#breadcrumbs li a:hover {
  color: '.$main_color.';
}
.btn.btn-primary {
  border: 1px solid '.$main_color.';
  background: '.$main_color.';
}
.btn:hover {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.st-form-search-room .field .title {
  color: '.$main_color.';
}
.st-form-search-room .helios-form-control .options .month .fa {
  color: '.$main_color.';
}
.st-list-hotel-room.style-1 .control-header ul li.active {
  color: '.$main_color.';
}
.st-list-hotel-room.style-1 .control-header ul li:hover {
  color: '.$main_color.';
}
.st-list-hotel-room.style-1 .content .item .info .price {
  color: '.$main_color.';
}
.st-list-hotel-room.style-1 .content .item .info .facilities .icon-item:hover {
  color: '.$main_color.';
}
.st-list-hotel-room.style-1 .content .item .info .button a {
  color: '.$main_color.';
}
.st-list-hotel-room.style-1 .content .item:hover .name a {
  color: '.$main_color.';
}
.st-list-hotel-room.style-3 .control-header ul li.active {
  color: '.$main_color.';
}
.st-list-hotel-room.style-3 .control-header ul li:hover {
  color: '.$main_color.';
}
.st-list-hotel-room.style-3 .content .item .info .price {
  color: '.$main_color.';
}
.st-list-hotel-room.style-3 .content .item:hover .info {
  background: '.$main_color.';
}
.st-form-reservation-room .helios-form-control .options .month .fa {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-content .facilities .icon-item:hover {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-content .price {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-book .helios-more-extra .btn_extra.active {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-book .options a {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-book .options a:hover {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-book .list-extra.active .btn_extra {
  border: 1px solid '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-1 .room-book table thead {
  background: '.$main_color.' none repeat scroll 0 0;
}
.helios-reservation-content .content .loop-room-style-1 .room-book table .text-color {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .item .info .price {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .item .info .facilities .icon-item:hover {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .item .info .button a {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .item:hover .name a {
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .room-book .helios-more-extra .btn_extra.active {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .room-book .list-extra.active .btn_extra {
  border: 1px solid '.$main_color.';
}
.helios-reservation-content .content .loop-room-style-2 .room-book table thead {
  background: '.$main_color.' none repeat scroll 0 0;
}
.helios-reservation-content .content .loop-room-style-2 .room-book table .text-color {
  color: '.$main_color.';
}
.helios-reservation-content .pagination-room .wpbooking-pagination .page-numbers.current {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.helios-reservation-content .pagination-room .wpbooking-pagination .page-numbers:hover {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.st-reservation-contact .phone .fa,
.st-reservation-contact .email .fa {
  color: '.$main_color.';
}
.st-banner-single-room.st-style-1 .content-slider .content-info .info .breadcrumbs {
  color: '.$main_color.';
}
.st-banner-single-room.st-style-1 .content-slider .content-info .info .scroll a:hover {
  background: '.$main_color.';
}
.st-banner-single-room.st-style-1 .content-slider .content-info .owl-nav .owl-prev {
  color: '.$main_color.';
}
.st-banner-single-room.st-style-1 .content-slider .content-info .owl-nav .owl-next {
  color: '.$main_color.';
}
.st-banner-single-room.st-style-1 .scroll .btn-scroll:hover .line-1 {
  background: '.$main_color.';
}
.st-banner-single-room.st-style-1 .scroll .btn-scroll .line-1 {
  border: solid 1px '.$main_color.';
}
.st-banner-single-room.st-style-1 .scroll .btn-scroll .line-2 {
  border: solid 1px '.$main_color.';
}
.st-banner-single-room.st-style-1 .scroll .btn-scroll .line-3 {
  border: solid 1px '.$main_color.';
}
.st-banner-single-room.st-style-2 .content-slider .content-info .info .breadcrumbs {
  color: '.$main_color.';
}
.st-banner-single-room.st-style-2 .content-slider .content-info .info .scroll a:hover {
  background: '.$main_color.';
}
.st-banner-single-room.st-style-2 .scroll .btn-scroll:hover .line-1 {
  background: '.$main_color.';
}
.st-banner-single-room.st-style-2 .scroll .btn-scroll .line-1 {
  border: solid 1px '.$main_color.';
}
.st-banner-single-room.st-style-2 .scroll .btn-scroll .line-2 {
  border: solid 1px '.$main_color.';
}
.st-banner-single-room.st-style-2 .scroll .btn-scroll .line-3 {
  border: solid 1px '.$main_color.';
}
.st-form-booking-room.style-1 .control .phone .number {
  color: '.$main_color.';
}
.st-form-booking-room.style-1 .control .helios-more-extra .btn_extra {
  color: '.$main_color.';
}
.st-form-booking-room.style-1 .control .helios-more-extra .btn_extra.active {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.st-form-booking-room.style-1 .list-extra.active .btn_extra {
  border: 1px solid '.$main_color.';
}
.st-form-booking-room.style-1 .list-extra table thead {
  background: '.$main_color.' none repeat scroll 0 0;
}
.st-form-booking-room.style-1 .list-extra table .text-color {
  color: '.$main_color.';
}
.st-form-booking-room.style-1 .helios-form-control .options .month .fa {
  color: '.$main_color.';
}
.st-form-booking-room.style-2 .helios-form-control .options .month .fa {
  color: '.$main_color.';
}
.st-form-booking-room.style-2 .helios-more-extra .btn_extra.active {
  border: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.st-form-booking-room.style-2 .list-extra.active .btn_extra {
  border: 1px solid '.$main_color.';
}
.st-form-booking-room.style-2 .list-extra table thead {
  background: '.$main_color.' none repeat scroll 0 0;
}
.st-form-booking-room.style-2 .list-extra table .text-color {
  color: '.$main_color.';
}
.ui-widget-header {
  background: '.$main_color.';
  border-color: '.$main_color.';
}
.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
  color: '.$main_color.';
}
.helios-room-info.style-1 .info .price {
  color: '.$main_color.';
}
.helios-room-info.style-1 .info .guest,
.helios-room-info.style-1 .info .bed,
.helios-room-info.style-1 .info .size {
  color: '.$main_color.';
}
.helios-room-info.style-2 .info .price {
  color: '.$main_color.';
}
.helios-room-info.style-2 .info .guest,
.helios-room-info.style-2 .info .bed,
.helios-room-info.style-2 .info .size {
  color: '.$main_color.';
}
.helios-room-extra-info .title {
  color: '.$main_color.';
}
.helios-room-facilities-info .title {
  color: '.$main_color.';
}
.helios-room-featured-info .title {
  color: '.$main_color.';
}
.helios-room-featured-info .list-facilities .icon-item .fa {
  color: '.$main_color.';
}
.st-share li a:hover {
  color: '.$main_color.';
}
.st-list-related-room .content .item .info .price {
  color: '.$main_color.';
}
.st-list-related-room .content .item .info .facilities .icon-item:hover {
  color: '.$main_color.';
}
.st-list-related-room .content .item .info .button a {
  color: '.$main_color.';
}
.st-list-related-room .content .item:hover .name a {
  color: '.$main_color.';
}
.header-mobile .helios_dl_mobile_menu li.dl-back::after,
.header-mobile .helios_dl_mobile_menu li > a:not(:only-child)::after {
  color: '.$main_color.';
}
.header-mobile .helios_dl_mobile_menu .dl-menu li:hover > a,
.header-mobile .helios_dl_mobile_menu .dl-submenu li:hover > a {
  color: '.$main_color.';
}
.header-mobile .helios_dl_mobile_menu .current_page_item > a,
.header-mobile .helios_dl_mobile_menu .current-menu-parent > a {
  color: '.$main_color.' !important;
}
.header-mobile .control-left .option-item .option-mid .nav-icon-bar.dl-active {
  border: 1px solid '.$main_color.';
}
.header-mobile .control-left .option-item .option-mid .nav-icon-bar.dl-active .icon-bar {
  background-color: '.$main_color.';
}
.header-mobile .control-right .option-item .option-mid .search {
  color: '.$main_color.';
}
.header-mobile .content-footer .navbar-footer .control.contact .number {
  color: '.$main_color.';
}
.header-mobile .content-footer .navbar-footer .control.social-share ul > li:hover i {
  background: #000;
  color: '.$main_color.';
}
.header-mobile .style-light .dl-menu li:hover > a,
.header-mobile .style-light .dl-submenu li:hover > a {
  color: '.$main_color.';
}
.header-mobile .style-light .control-left .option-item .option-mid .nav-icon-bar.dl-active {
  border: 1px solid '.$main_color.';
}
.header-mobile .style-light .control-left .option-item .option-mid .nav-icon-bar.dl-active .icon-bar {
  background-color: '.$main_color.';
}
.header-mobile .style-light .control-right .option-item .option-mid .nav-icon-bar.dl-active {
  border: 1px solid '.$main_color.';
}
.header-mobile .style-light .control-right .option-item .option-mid .nav-icon-bar.dl-active .icon-bar {
  background-color: '.$main_color.';
}
.header-mobile .style-light .content-footer .navbar-footer .control.social-share ul > li:hover i {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .upload-avatar-image .helios-upload-avatar:hover {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .wpbooking-account-tab.edit_profile .wb-edit-profile-wrap .container-fluid .form-control:hover,
.wpbooking-myaccount-wrap .content-right .wpbooking-account-tab.edit_profile .wb-edit-profile-wrap .container-fluid .form-control:active {
  border-color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .wpbooking-account-tab.edit_profile .wb-edit-profile-wrap .container-fluid .btn-primary:hover {
  background: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .dashboard .profile .content .full_name p {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .dashboard .profile .content span {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .dashboard .profile .content .change-password .change_pass {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .dashboard .profile .content .db-edit-profile .edit-profile:hover {
  background: '.$main_color.';
}
@media (min-width: 992px) {
  .wpbooking-myaccount-wrap .content-right .dashboard .profile .content .db-edit-profile .edit-profile:hover {
    background: '.$main_color.';
  }
}
.wpbooking-myaccount-wrap .content-right .booking_history .wpbooking-account-table tbody td a {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .booking_history .wpbooking-account-table tbody td .order-number {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .booking_history .wpbooking-account-table tbody td.booking-price {
  color: '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .booking_history .wpbooking-account-table tbody td .label .pay-on-hold {
  color: '.$main_color.';
  border: solid 1px '.$main_color.';
}
.wpbooking-myaccount-wrap .content-right .wpbooking-account-tab.change_password .wb-form-change-password .btn-primary:hover {
  background: '.$main_color.';
}
.wpbooking-myaccount-wrap .control-tab .wb-account-nav li:hover a {
  color: '.$main_color.';
  border-color: '.$main_color.';
}
.wpbooking-myaccount-wrap .control-tab .wb-account-nav li.active a {
  color: '.$main_color.';
  border: 1px solid '.$main_color.';
}
.wpbooking-myaccount-wrap.dark .content-right .wpbooking-account-tab.edit_profile .wb-edit-profile-wrap .container-fluid .btn-primary:hover {
  background: '.$main_color.';
}
.wpbooking-myaccount-wrap.dark .content-right .wpbooking-account-tab.edit_profile .upload-avatar-image .helios-upload-avatar:hover {
  border-color: '.$main_color.';
}
.wpbooking-myaccount-wrap.dark .content-right .dashboard .profile .content .db-edit-profile .edit-profile:hover {
  background: '.$main_color.';
  color: #FFF;
}
.wpbooking-myaccount-wrap.dark .content-right .booking_history .control-filter .btn-primary:hover {
  background: '.$main_color.';
}
.wpbooking-myaccount-wrap.dark .content-right .wpbooking-account-tab.change_password .wb-form-change-password .btn-primary:hover {
  background: '.$main_color.';
}
.helios-checkout .helios-content-review .loop-room-style-1 .room-content .facilities .icon-item:hover {
  color: '.$main_color.';
}
.helios-checkout .helios-content-review .loop-room-style-1 .room-info-price .price {
  color: '.$main_color.';
}
.helios-checkout .helios-content-review .loop-room-style-1:hover {
  box-shadow: 0 0 20px '.$main_color.';
}
.helios-checkout .helios-content-review .review-date .check-in-out .fa {
  color: '.$main_color.';
}
.helios-checkout .helios-content-review .checkout-info-price .helios-checkout-price .checkout-form-title {
  color: '.$main_color.';
}
.helios-checkout .helios-content-review .checkout-info-price .helios-checkout-price .review-cart-item.total .total-title.text-up.text-bold {
  color: '.$main_color.';
}
.helios-checkout .helios-content-review .checkout-info-price .helios-checkout-price .review-cart-item.total .total-amount.text-up.text-bold {
  color: '.$main_color.';
}
.helios-checkout .helios-check-out-form-billing .billing_information .form-group input:focus,
.helios-checkout .helios-check-out-form-billing .billing_information .form-group textarea:focus {
  border-bottom: solid 1px '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .wpbooking-thankyou-message {
  color: '.$main_color.' !important;
}
.single-wpbooking_order .wpbooking-order-detail-page .order-head-info .head-info .head-info-content .price {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .order-head-info .head-info .on_hold,
.single-wpbooking_order .wpbooking-order-detail-page .order-head-info .head-info .completed_a_part {
  color: '.$main_color.';
  border: solid 1px '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .order-head-info .head-info .text-color {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .order-head-info .title-price {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .order-information-content .loop-room-style-1 .room-content .facilities .icon-item:hover {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .order-information-content .loop-room-style-1 .room-info-price .price {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .order-information-content .loop-room-style-1:hover {
  box-shadow: 0 0 20px '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .review-date .check-in-out .fa {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .checkout-info-price .helios-checkout-price .checkout-form-title {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .checkout-info-price .helios-checkout-price .review-cart-item.total .total-title.text-up.text-bold {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .checkout-info-price .helios-checkout-price .review-cart-item.total .total-amount.text-up.text-bold {
  color: '.$main_color.';
}
.single-wpbooking_order .wpbooking-order-detail-page .text-color {
  color: '.$main_color.' !important;
}

a {
  color: '.$main_color.';
}
.main-color {
  color: '.$main_color.';
}
.st-post-grid.style-1:hover .caption-post .title a {
  color: '.$main_color.';
}
.st-post-grid.style-2 .header-thumb .time {
  background: '.$main_color.';
}
.st-post-grid.style-2 .caption-post .read-more {
  color: '.$main_color.';
}
.st-post-grid.style-2 .caption-post .read-more i {
  color: '.$main_color.';
}
.st-post-grid.style-3:hover .caption-post .title a {
  color: '.$main_color.';
}
.st-post-list.style-1 .create-time .day {
  color: '.$main_color.';
}
.st-post-list.style-1:hover .title a {
  color: '.$main_color.';
}
.st-social-lists.style-1 .socials li a:hover {
  color: '.$main_color.';
}
.st-weather .icon-weather {
  color: '.$main_color.';
}
.st-about.style-1 .icon i {
  color: '.$main_color.';
}
.st-about.style-1 .caption .title a:hover {
  color: '.$main_color.';
}
.st-about.style-2 .icon i {
  color: '.$main_color.';
}
.st-about.style-2 .caption .title a:hover {
  color: '.$main_color.';
}
.st-about.style-2.light .caption .title a:hover {
  color: '.$main_color.';
}
.st-testimonials.style-1 .item .test-avatar:after {
  background: '.$main_color.';
}
.st-testimonials.style-1 .item .rating {
  color: '.$main_color.';
}
.st-testimonials.style-1 .item .name-position .name {
  color: '.$main_color.';
}
.st-testimonials .owl-nav .owl-prev,
.st-testimonials .owl-nav .owl-next {
  color: '.$main_color.';
}
.st-testimonials .owl-dots .owl-dot:not(.active):hover span {
  border-color: '.$main_color.';
}
.st-testimonials .owl-dots .owl-dot:not(.active):hover span:after {
  background: '.$main_color.';
}
.st-testimonials .owl-dots .owl-dot.active span {
  border-color: '.$main_color.';
}
.st-testimonials .owl-dots .owl-dot.active span:before {
  background: '.$main_color.';
}
.st-testimonials.dark .owl-dots .owl-dot.active span:before {
  background: '.$main_color.';
}
.st-mailchip form p input[type=email]:focus,
.st-mailchip form p input[type=text]:focus {
  border-color: '.$main_color.';
}
.st-mailchip form p input[type=submit] {
  background: '.$main_color.';
}
.st-video.style-1 .caption .st-play span {
  color: '.$main_color.';
}
.st-video.style-1 .caption .st-play .btn-play-video {
  background: '.$main_color.';
}
.st-video.style-2 .caption .st-play .btn-play-video {
  background: '.$main_color.';
}
.highlight {
  color: '.$main_color.';
}
.maincolor {
  color: '.$main_color.' !important;
}
.helios-heading .sub-title {
  color: '.$main_color.';
}
.helios-heading:after {
  border-bottom: 1px solid '.$main_color.';
}
.site-footer ul li a:hover {
  color: '.$main_color.';
}
.st-single-post .post-format .owl-nav .owl-prev:hover,
.st-single-post .post-format .owl-nav .owl-next:hover {
  color: '.$main_color.';
}
.st-single-post .caption-header-post .meta-date {
  color: '.$main_color.';
}
.st-single-post .owl-nav .owl-prev,
.helios_archive_page .owl-nav .owl-prev,
.st-posts .owl-nav .owl-prev,
.st-special-services .owl-nav .owl-prev,
.st-offer-banner.style-1 .owl-nav .owl-prev,
.offer-related-carousel .owl-nav .owl-prev,
.offer-carousel-slider-3 .owl-nav .owl-prev,
.st-restaurant-bar .owl-nav .owl-prev,
.st-single-post .owl-nav .owl-next,
.helios_archive_page .owl-nav .owl-next,
.st-posts .owl-nav .owl-next,
.st-special-services .owl-nav .owl-next,
.st-offer-banner.style-1 .owl-nav .owl-next,
.offer-related-carousel .owl-nav .owl-next,
.offer-carousel-slider-3 .owl-nav .owl-next,
.st-restaurant-bar .owl-nav .owl-next {
  color: '.$main_color.';
}
.blog-item-meta-footer .blog-item-meta .list-social li a:hover {
  color: '.$main_color.';
}
.blog-item-meta-author .info .social a:hover {
  color: '.$main_color.';
}
.st-single-post .form-control:focus {
  border-color: '.$main_color.';
}
.st-single-post .st_form_comment small a,
.st-single-post .comment-respond small a {
  color: '.$main_color.';
}
.st-single-post .st_form_comment #submit,
.st-single-post .comment-respond #submit {
  background: '.$main_color.' none repeat scroll 0 0;
}
.st-single-post .comment-list .comment .info .entry-reply-link a,
.st-single-post .comment-list .pingback .info .entry-reply-link a {
  color: '.$main_color.';
}
.st-single-post .comment-list .comment .info .entry-reply-link a:hover:before,
.st-single-post .comment-list .pingback .info .entry-reply-link a:hover:before {
  color: '.$main_color.';
}
.sidebar .widget ul li:hover > a {
  color: '.$main_color.';
}
.sidebar .widget a:hover {
  color: '.$main_color.';
}
.sidebar .widget.widget_helioslistpostswidget .group-listing .item_post .info .entry-title a:hover {
  color: '.$main_color.';
}
.sidebar .widget.widget_helioslistpostswidget .group-listing .item_post .info .entry-category {
  color: '.$main_color.';
}
.sidebar .widget.widget_helioslistpostswidget .group-listing .item_post:hover .entry-title a {
  color: '.$main_color.';
}
.sidebar .widget.widget_mc4wp_form_widget input[type=submit] {
  background: '.$main_color.' none repeat scroll 0 0;
}
.sidebar .widget.widget_categories ul li:hover {
  color: '.$main_color.';
}
.sidebar .widget.widget_heliosauthorpostswidget .info .name:before {
  color: '.$main_color.';
}
.sidebar .widget.widget_heliosauthorpostswidget .info .social a:hover {
  color: '.$main_color.';
}
.sidebar .widget.widget_search .search-submit {
  background: '.$main_color.' none repeat scroll 0 0;
}
.tagcloud a:hover {
  background: '.$main_color.';
}
blockquote:before {
  color: '.$main_color.';
}
.st-post-list.style-2 a:hover {
  color: '.$main_color.';
}
.st-post-list.style-2 .blog-item-meta-category a {
  border-top: 1px solid '.$main_color.';
  color: '.$main_color.';
}
.st-post-list.style-2 .blog-item-meta-desc span {
  color: '.$main_color.';
}
.st-post-list.style-2 .blog-item-meta-footer .blog-item-meta a:hover {
  color: '.$main_color.';
}
.st-post-list.style-2 .blog-item-meta-footer .blog-item-meta .share li a:hover {
  color: '.$main_color.';
}
.st-post-list.style-2:hover .blog-item-title a {
  color: '.$main_color.';
}
.st-post-list.style-2:hover .blog-item-meta-footer .blog-item-link a {
  color: '.$main_color.';
}
.st-signature.left .name-pos .name {
  color: '.$main_color.';
}
.st-signature.center .name-pos .name {
  color: '.$main_color.';
}
.st-post-slider.style-2 .title a:hover {
  color: '.$main_color.';
}
.post-carousels .owl-nav > div:hover {
  color: '.$main_color.' !important;
}
.st-post-isotope.style-1 .caption-post .time .meta-category a {
  color: '.$main_color.';
}
.st-post-isotope.style-1:hover .caption-post .title a {
  color: '.$main_color.';
}
.st-post-isotope.style-2 .blog-meta .meta-date {
  color: '.$main_color.';
}
.st-post-isotope.style-2 .blog-meta .title a:hover {
  color: '.$main_color.';
}
.st-post-isotope.style-2 .blog-meta .blog-item-meta-category a:before {
  border-bottom: 1px solid '.$main_color.';
}
.st-post-isotope.style-2 .blog-meta .in-line .share .list-social li a:hover {
  color: '.$main_color.';
}
.st-post-isotope.style-2 .blog-meta .in-line .author a .text-up {
  color: '.$main_color.';
}
.isotope-filter ul li a:hover {
  border-color: '.$main_color.';
}
.isotope-filter ul li a.active {
  border-color: '.$main_color.';
}
.st-our-team.style-1 .t-social ul li a:hover {
  color: '.$main_color.';
}
.st-our-team.style-1:hover .info .name {
  color: '.$main_color.';
}
.st-contact.style-1 .icon {
  color: '.$main_color.';
}
.st-large-marker-hotel .caption .hotel-star {
  color: '.$main_color.';
}
.st-contact-form input[type=text]:focus,
.st-contact-form input[type=email]:focus,
.st-contact-form textarea:focus,
.st-contact-form input[type=text]:hover,
.st-contact-form input[type=email]:hover,
.st-contact-form textarea:hover {
  border-color: '.$main_color.';
}
.st-contact-form input[type=submit] {
  background: '.$main_color.';
}
#st-loader {
  border-top: 5px solid '.$main_color.';
  border-left: 5px solid '.$main_color.';
  border-right: 5px solid '.$main_color.';
}
.error-404 .content-404 .back-home:hover {
  color: '.$main_color.';
}
.st-special-services.style-1 .special-services-carousel .item.even-item .caption {
  background: '.$main_color.';
}
.st-special-services.style-1 .owl-nav .owl-prev,
.st-special-services.style-1 .owl-nav .owl-next {
  color: '.$main_color.';
}
.st-special-services.style-1 .owl-nav .owl-prev:hover,
.st-special-services.style-1 .owl-nav .owl-next:hover {
  background: '.$main_color.';
}
.st-special-services.style-2 .item-service .caption-center .title {
  color: '.$main_color.';
}
.st-special-services.style-2 .item-service .caption-center a:before {
  border-bottom: 1px solid '.$main_color.';
}
.st-special-services.style-2 .item-service .caption-bottom .title {
  color: '.$main_color.';
}
.st-special-services.style-3 .item-service .img-thumb:before {
  background: '.$main_color.';
}
.st-special-services.style-3 .item-service .caption .cell a:hover i {
  color: '.$main_color.';
}
.st-special-services.style-4 .item-service .img-thumb:before {
  background: '.$main_color.';
}
.st-special-services.style-4 .item-service .caption .cell .title a:hover {
  color: '.$main_color.';
}
.st-special-services.style-5 .item-service .img-thumb:before {
  background: '.$main_color.';
}
.st-special-services.style-5 .item-service .caption .cell .title a:hover {
  color: '.$main_color.';
}
.st-offer-element.style-1 .offer-text .description-offer .title:before {
  border-bottom: 1px solid '.$main_color.';
}
.st-offer-element.style-1 .offer-text .description-offer .sub_title {
  color: '.$main_color.';
}
.st-offer-element.style-1 .offer-text .offer-carousel-text .item .offer-price .o-price {
  color: '.$main_color.';
}
.st-offer-element.style-1 .slick-next {
  background: '.$main_color.';
}
.st-offer-element.style-2 .offer-list-2 .offer-item .header-thumb .book-now {
  color: '.$main_color.';
}
.st-offer-element.style-2 .offer-list-2 .offer-item .caption .d-flex .offer-price .o-price {
  color: '.$main_color.';
}
.st-offer-element.style-3 .offer-carousel-slider-3 .owl-nav > div:hover {
  background: '.$main_color.';
}
.st-offer-banner.style-1 .caption-title .offer-breadcrumb {
  color: '.$main_color.';
}
.st-offer-banner.style-2 .offer-gallery-carousel .owl-dots .owl-dot:not(.active):hover span {
  border-color: '.$main_color.';
}
.st-offer-banner.style-2 .offer-gallery-carousel .owl-dots .owl-dot:not(.active):hover span:after {
  background: '.$main_color.';
}
.st-offer-banner.style-2 .offer-gallery-carousel .owl-dots .owl-dot.active span {
  border-color: '.$main_color.';
}
.st-offer-banner.style-2 .offer-gallery-carousel .owl-dots .owl-dot.active span:before {
  background: '.$main_color.';
}
.st-offer-banner.style-3 .caption-title .title .sale-off {
  color: '.$main_color.';
}
.st-single-offer .offer-info-box .title-price .title .sale-off {
  color: '.$main_color.';
}
.st-single-offer .offer-info-box .title-price .offer-price .o-price {
  color: '.$main_color.';
}
.st-single-offer .offer-info-box .contact .phone i {
  color: '.$main_color.';
}
.st-single-offer .offer-info-box .contact .email i {
  color: '.$main_color.';
}
.st-single-offer.style-2 .offer-info-box .title-price .title .sale-off {
  color: '.$main_color.';
}
.st-single-offer.style-2 .offer-info-box .title-price .offer-price .o-price {
  color: '.$main_color.';
}
.st-single-offer.style-2 .offer-info-box .contact .phone i,
.st-single-offer.style-2 .offer-info-box .contact .email i {
  color: '.$main_color.';
}
.st-single-offer .offer-list-services .item i {
  color: '.$main_color.';
}
.st-single-offer .offer-mailchimp .o-form-mailchimp input[type=email]:focus {
  border-color: '.$main_color.';
}
.st-single-offer .caption-title .sub_title {
  color: '.$main_color.';
}
.related-offer-item.style-1 .caption .offer-price .o-price {
  font-size: 18px;
  color: '.$main_color.';
}
.related-offer-item.style-1 .caption .book-now a {
  color: '.$main_color.';
}
.related-offer-item.style-1.even-item {
  background: '.$main_color.';
}
.related-offer-item.style-3 .caption .offer-price .o-price {
  color: '.$main_color.';
}
.related-offer-item.style-3 .caption .book-now a {
  color: '.$main_color.';
}
.caption-title.style-2 .offer-breadcrumb {
  color: '.$main_color.';
}
.st-hotel-info-element .info .hotline-booking .hotline,
 .helios-slider.st-style-3 .content-slider .content-info .owl-nav .fa,
 .topbar .top-bar-style-4 .control-right .option-item .option-mid .location-weather .icon{
  color: '.$main_color.';
}
.related-offer-item.style-1.even-item .caption:after,
.helios-slider.st-style-3 .content-slider .content-info .info .view-more a {
  background: '.$main_color.';
}





.ld-menu .menu-item a:hover{
    color: '.$main_color.';
}
.ld-explore{
    background: '.$main_color.';
}
.ld-row .item:hover .title a{
    background: '.$main_color.';
    color: #FFF;
}
.buy-now:hover{
    background: '.$main_color.';
    border-color: '.$main_color.';
}
.ld-show-case .show-case-title{
    color: '.$main_color.';
}
.ld-social li a:hover{
    color: '.$main_color.';
    border-color: '.$main_color.';
}
.lb-thanks .div-table .table-cell h2{
    color: '.$main_color.';
}
.t-head .stars-re i{
    color: '.$main_color.';
}
.ld-install-theme:before{
    background: '.$main_color.';
}
.ld-show-case .sc-item .item .title a:hover{
    color: '.$main_color.';
}

.ld-show-case .more-case{
    color: '.$main_color.';
    border: 2px dashed '.$main_color.';
}
.demo_changer .demo-icon,
 .blog-item-meta-footer .blog-item-meta .sticky,
 .meta-date .sticky,
 .sidebar .widget.widget_calendar a,
 .st-list-rooms.style-4 .content-left .tab-controls .item-room .caption-right .title,
 .st-list-rooms.style-4 .content-left .tab-controls .item-room .caption-right .room-price,
 .topbar .top-bar-style-1 .control-left .form-search-content .form-search-content-mid .form-search-room .title,
 .topbar .top-bar-style-1 .control-left .form-search-content .form-search-content-mid .form-search-room .helios-form-control .options .month .fa,
 .topbar .top-bar-style-1 .control-left .form-search-content .info-form-book .phone .fa, .topbar .top-bar-style-1 .control-left .form-search-content .info-form-book .email .fa,
 .st-list-feature-hotel-room.style-2 .owl-nav .owl-prev,
 .st-list-feature-hotel-room.style-2 .content .item .info .price,
 .st-list-feature-hotel-room.style-2 .content .item .info .button a,
 .st-list-feature-hotel-room.style-2 .content .item:hover .name a,
 .st-list-feature-hotel-room.style-2 .owl-nav .owl-next,
 .st-single-post .owl-nav .owl-prev, .helios_archive_page .owl-nav .owl-prev, .st-posts .owl-nav .owl-prev, .st-special-services .owl-nav .owl-prev, .st-list-hotel-room .owl-nav .owl-prev, .st-offer-banner.style-1 .owl-nav .owl-prev, .offer-related-carousel .owl-nav .owl-prev, .offer-carousel-slider-3 .owl-nav .owl-prev, .st-restaurant-bar .owl-nav .owl-prev, .st-single-post .owl-nav .owl-next, .helios_archive_page .owl-nav .owl-next, .st-posts .owl-nav .owl-next, .st-special-services .owl-nav .owl-next, .st-list-hotel-room .owl-nav .owl-next, .st-offer-banner.style-1 .owl-nav .owl-next, .offer-related-carousel .owl-nav .owl-next, .offer-carousel-slider-3 .owl-nav .owl-next,
  .st-restaurant-bar .owl-nav .owl-next,
  .helios-slider.st-style-2 .content-slider .content-info .info .title,
  .st-list-feature-hotel-room.style-1 .textBlue,
  .st-list-feature-hotel-room.style-3 .ButtonDiscover .fa,
  .st-list-feature-hotel-room.style-3 .ButtonNextsDiscover .fa{
    color: '.$main_color.';
}
.topbar-scroll .content-menu .current-menu-ancestor > a{
    color: '.$main_color.' !important;
}
.demo-buy-now,
.st-list-rooms.style-4 .content-right .item-room .desc-extra-service,
.st-list-feature-hotel-room.style-1 .HeliosLuxuRy:before,
.st-list-feature-hotel-room.style-1 .Room.active:before,
.st-list-feature-hotel-room.style-1 .navDetailRoom,
.st-list-feature-hotel-room.style-3 .TabClassicSingle,
.st-list-feature-hotel-room.style-3 .btnNow a:hover,
.st-list-feature-hotel-room.style-3 .ButtonDiscover:hover,
.st-list-feature-hotel-room.style-3 .ButtonNextsDiscover:hover{
    background: '.$main_color.';
}
.home_demo .item a:before,
input[type=submit],
.helios-slider.st-style-2 .content-slider .content-info .info .view-more a,
.st-list-hotel-room.style-5 .list-room-carousel .owl-nav .owl-prev:hover,
 .st-list-hotel-room.style-5 .list-room-carousel .owl-nav .owl-next:hover{
    background: '.$main_color.';
}
.sidebar .widget.widget_search .form-control:hover, .sidebar .widget.widget_search .form-control:focus,
.single-page .entry-title:before,
.st-list-rooms.style-4 .content-left .tab-controls .item-room:before{
    border-color: '.$main_color.';
}
.helios-pagination .page-numbers li span,.page-links > span {
    border-color: '.$main_color.';
    color: '.$main_color.';
}
.helios-pagination .page-numbers li a:hover,.page-links a:hover {
    border-color: '.$main_color.';
    background: '.$main_color.';
}
.st-list-feature-hotel-room.style-2 .owl-nav .owl-prev:hover,
 .st-list-feature-hotel-room.style-2 .owl-nav .owl-next:hover{
    background: '.$main_color.' none repeat scroll 0 0;
    box-shadow: 0 0 5px '.$main_color.';
}

.topbar-scroll .content-menu .current-menu-parent > a {
  color: '.$main_color.' !important;
}
.topbar-scroll .content-menu .current_page_item > a {
  color: '.$main_color.' !important;
}
.topbar-scroll .content-menu .current-menu-item > a {
  color: '.$main_color.' !important;
}
.topbar-scroll .content-menu .current-menu-ancestor > a {
  color: '.$main_color.' !important;
}
.topbar-scroll .content-menu .navbar-nav > li > a:hover,
.topbar-scroll .content-menu .navbar-nav > li > a:focus {
  color: '.$main_color.';
}
.topbar-scroll .content-menu .navbar-nav > li > .dropdown-menu > li > a:hover,
.topbar-scroll .content-menu .navbar-nav > li > .dropdown-menu > li > a:focus {
  color: '.$main_color.';
}
.topbar-scroll .content-menu .navbar-nav > li > .dropdown-menu > li > .dropdown-menu > li > a:hover,
.topbar-scroll .content-menu .navbar-nav > li > .dropdown-menu > li > .dropdown-menu > li > a:focus {
  color: '.$main_color.';
}
.topbar-scroll .menu-style-2 .st_menu > li:before {
  border-bottom: 3px solid '.$main_color.' !important;
}
.info-form-book .phone .fa,
.info-form-book .email .fa,
.item-search-content .fa{
    color: '. $main_color .' !important;
}
.helios-reservation-content .content .loop-room-style-1:hover{
    box-shadow: 0 0 20px '. $main_color .' !important;
}

.btn-hotel-alone-booking,
.btn-hotel-alone-booking-external,
.helios-reservation-content .content .loop-room-style-2 a.btn-hotel-alone-st-add-cart{
color: '. $main_color .' !important;
}

.helios-submit-button.btn-st-add-cart.loading,
.helios-submit-button.btn-st-add-cart.loading:hover{
    background: ' . $main_color . ' !important;
    border: 1px solid ' . $main_color . ' !important;
}
.highlight{
    color: ' . $main_color . ' !important;
}
.my-account  .dropdown-toggle i{
    color: ' . $main_color . ' !important;
}
.my-account .dropdown-menu a:hover {
    color: ' . $main_color . ' !important;
}
    ';
}

if(!empty($style)) print $style;