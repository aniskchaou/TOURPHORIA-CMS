<?php
/**
 * Template Name: Hotel Activity
 */
?>
<?php get_header('hotel-activity');?>



<!-- <section id="slider-activity" class="main-slider">
    <div class="search-form-wrapper slider">
        <div class="fotorama st-bg-slider" data-transition="dissolve" data-fit="cover" data-arrows="false" data-autoplay="3000" data-width="100%" data-height="780" data-loop="true" data-stopautoplayontouch="false" data-minwidth="100%">
            <div data-img="https://travelerwp.com/wp-content/uploads/2014/11/hotel_the_cliff_bay_spa_suite_2048x1310.jpg">
                <div class="search-form-text">
                    <div class="container">
                        <h1 class="st-heading">EXCLUSIVE OFFERS</h1>
                        <div class="sub-heading">Discover our amazing exclusive deals and get the very best for less</div>
                        <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-danger" href="https://acmap.travelerwp.com/become-local-expert/" title="">LEARN MORE</a>
                    </div>
                </div>
                <div class="promotion__overlay"></div>
            </div>

           <div data-img="https://acmap.travelerwp.com/wp-content/uploads/2019/01/Indipendant-Travel1-2000x1250.jpg">
                <div class="search-form-text">
                    <div class="container">
                        <h1 class="st-heading">EXCLUSIVE OFFERS</h1>
                        <div class="sub-heading">Discover our amazing exclusive deals and get the very best for less</div>
                        <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-danger" href="https://acmap.travelerwp.com/become-local-expert/" title="">LEARN MORE</a>
                    </div>
                </div>
                <div class="promotion__overlay"></div>
            </div>
            <div data-img="https://travelerwp.com/wp-content/uploads/2014/11/hotel_the_cliff_bay_spa_suite_2048x1310.jpg">
                <div class="search-form-text">
                    <div class="container">
                        <h1 class="st-heading">EXCLUSIVE OFFERS</h1>
                        <div class="sub-heading">Discover our amazing exclusive deals and get the very best for less</div>
                        <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-danger" href="https://acmap.travelerwp.com/become-local-expert/" title="">LEARN MORE</a>
                    </div>
                </div>
                <div class="promotion__overlay"></div>
            </div>
        </div>
    </div>
</section> -->

  <div id="main-content">
        <div class="container">
            <?php
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
                wp_reset_query();
                ?>
        </div>

    </div>
<!-- <div id="main-content">
    <div class="container">
        <div class="row" style="padding-bottom: 80px; padding-top: 80px;">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="content-text">
                    <div class="st-text-center">
                        <h2 class="text-center">Welcome</h2>
                        <div class="box__separator  hidden-thumb">
                        </div>
                        <p class="text-center">Welcome to Lustay Hotel, the 5-star hotel in which you can experience total wellbeing.</p>
                        <div class="button-color text-center">
                            <a href="" title="">Read our story</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <img src="<?php echo get_template_directory_uri()."/v2/images/html/img1.png";?>" style="object-fit: cover;width:100%" alt="">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <img src="<?php echo get_template_directory_uri()."/v2/images/html/img2.png";?>"  style="object-fit: cover; width:100%" alt="">
            </div>
        </div>
        <div class="box__separator_line"></div>
        <div class="row" style="padding-bottom: 0px; padding-top: 80px;">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="content-text">
                    <div class="st-text-center">
                        <h2 class="text-center">Room, Suites</h2>
                        <div class="box__separator  hidden-thumb">
                        </div>
                        <p class="text-center">Lustay offers 40 rooms and suites, each presenting luxurious and unrivalled comfort. </p>
                        <div class="button-color text-center">
                            <a href="" title="">View all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="item-room">
                    <div class="img-thumnail">
                        <img src="<?php echo get_template_directory_uri()."/v2/images/html/img3.png";?>"  alt="">
                    </div>
                    <div class="info-item">
                        <div class="info">
                            <span class="price">From $299</span>
                            <h4>Superion Room</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-bottom: 80px;">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="item-room">
                    <div class="img-thumnail">
                        <img src="<?php echo get_template_directory_uri()."/v2/images/html/img3.png";?>" alt="">
                    </div>
                    <div class="info-item">
                        <div class="info">
                            <span class="price">From $299</span>
                            <h4>Superion Room</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="item-room">
                    <div class="img-thumnail">
                        <img src="<?php echo get_template_directory_uri()."/v2/images/html/img3.png";?>" alt="">
                    </div>
                    
                    <div class="info-item">
                        <div class="info">
                            <span class="price">From $299</span>
                            <h4>Superion Room</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="item-room">
                    <div class="img-thumnail">
                        <img src="<?php echo get_template_directory_uri()."/v2/images/html/img3.png";?>" alt="">
                    </div>
                    <div class="info-item">
                        <div class="info">
                            <span class="price">From $299</span>
                            <h4>Superion Room</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box__separator_line"></div>
        <div class="row" style="padding-bottom: 80px; padding-top: 80px;">
            <div class="col-lg-12 col-mg-12 col-xs-12">
                <div class="content-text">
                    <h2 class="text-center">Room, Suites</h2>
                    <div class="box__separator hidden-thumb">
                    </div>
                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo. Mauris at convallis erat.</p>
                </div>
                <div class="item-table">
                    <div class="owl-carousel st-discover-slider">
                        <div class="item-tb">
                            <div class="st-item">
                                <div class="padd-on">
                                    <div class="icon text-center">
                                        <?php echo TravelHelper::getNewIcon('spa-lotus', '#ddddd', '83px', '64px'); ?>
                                    </div>
                                    <div class="content-text">
                                        <h2 class="text-center">Spa - Yoga</h2>
                                        <div class="box__separator hidden-thumb">
                                        </div>
                                        <p class="text-center">Morbi semper fames lobortis ac hac penatibus</p>
                                        <div class="button-color text-center">
                                            <a href="" title="">Discover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-tb">
                            <div class="st-item">
                                <div class="padd-on">
                                    <div class="icon text-center">
                                        <?php echo TravelHelper::getNewIcon('room-service-cart-food', '#ddddd', '83px', '64px'); ?>
                                    </div>
                                    <div class="content-text">
                                        <h2 class="text-center">Bar - Restaurant</h2>
                                        <div class="box__separator hidden-thumb">
                                        </div>
                                        <p class="text-center">Morbi semper fames lobortis ac hac penatibus</p>
                                        <div class="button-color text-center">
                                            <a href="" title="">Discover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-tb">
                            <div class="st-item">
                                <div class="padd-on">
                                    <div class="icon text-center">
                                        <?php echo TravelHelper::getNewIcon('wedding-bride-groom', '#ddddd', '83px', '64px'); ?>
                                    </div>
                                    <div class="content-text">
                                        <h2 class="text-center">Weddings</h2>
                                        <div class="box__separator hidden-thumb">
                                        </div>
                                        <p class="text-center">Morbi semper fames lobortis ac hac penatibus</p>
                                        <div class="button-color text-center">
                                            <a href="" title="">Discover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-tb">
                            <div class="st-item">
                                <div class="padd-on">
                                    <div class="icon text-center">
                                        <?php echo TravelHelper::getNewIcon('spa-lotus', '#ddddd', '83px', '64px'); ?>
                                    </div>
                                    <div class="content-text">
                                        <h2 class="text-center">Spa - Yoga</h2>
                                        <div class="box__separator hidden-thumb">
                                        </div>
                                        <p class="text-center">Morbi semper fames lobortis ac hac penatibus</p>
                                        <div class="button-color text-center">
                                            <a href="" title="">Discover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-bottom: 80px; padding-top: 80px;">
            <div class="col-lg-12 col-mg-12 col-xs-12">
                <div class="content-text">
                    <h2 class="text-center">From Blog</h2>
                    <div class="box__separator hidden-thumb">
                    </div>
                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="col-lg-4 col-mg-4 col-xs-12">
                <div class="blog-item">
                    <div class="header-thumb">
                        <img class="" alt="Just another WordPress site" src="https://homap.travelerwp.com/wp-content/uploads/2015/02/virgi_3-1024x1024-1024x1024.jpg">
                    </div>
                    <div class="caption-post">
                        <div class="category">
                            <a href="http://localhost/traveler/2014/11/26/">Event</a>
                        </div>
                        <h3 class="title">
                            <a href="http://localhost/traveler/2014/11/26/default-post-type/">Red Cabbage and Sweet Potato Smoothie</a>
                        </h3>
                        <div class="date">
                            <span ckass="date-post">20 JUN 2018</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-mg-4 col-xs-12">
                <div class="blog-item">
                    <div class="header-thumb">
                        <img class="" alt="Just another WordPress site" src="https://homap.travelerwp.com/wp-content/uploads/2015/02/san_francisco-1024x1024-1024x1024.jpg">
                    </div>
                    <div class="caption-post">
                        <div class="category">
                            <a href="http://localhost/traveler/2014/11/26/">Event</a>
                        </div>
                        <h3 class="title">
                            <a href="http://localhost/traveler/2014/11/26/default-post-type/">Red Cabbage and Sweet Potato Smoothie</a>
                        </h3>
                        <div class="date">
                            <span ckass="date-post">20 JUN 2018</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-mg-4 col-xs-12">
                <div class="blog-item">
                    <div class="header-thumb">
                        <img class="" alt="Just another WordPress site" src="https://homap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-1024x1024.jpg">
                    </div>
                    <div class="caption-post">
                        <div class="category">
                            <a href="http://localhost/traveler/2014/11/26/">Event</a>
                        </div>
                        <h3 class="title">
                            <a href="http://localhost/traveler/2014/11/26/default-post-type/">Red Cabbage and Sweet Potato Smoothie</a>
                        </h3>
                        <div class="date">
                            <span ckass="date-post">20 JUN 2018</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box__separator_line"></div>
        <div class="row" style="padding-bottom: 80px;padding-top: 80px;">
            <div class="col-md-12">
                <div class="instagrame">
                    <div class="title-insta">
                        <span><img src="<?php echo get_template_directory_uri()."/v2/images/assets/instagram.svg";?>" alt=""></span>
                        <span class="text">Follow us on Instagram</span>
                    </div>
                    <div class="text-insta">
                        Tag your Instagram photos <strong>#yourname</strong>
                    </div>
                    <div class="list-instagram">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="full-width">
        <div class="thm-instagram st_fix_gallery">
            <a class="hover-img popup-gallery-image" href="http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1.gif" data-effect="mfp-zoom-out"><img width="360" height="288" src="https://acmap.travelerwp.com/wp-content/uploads/2019/01/Family-Activities-Hong-Kong-17.png-680x500.jpeg" class="attachment-360x270 size-360x270" alt="Just another WordPress site" srcset="https://acmap.travelerwp.com/wp-content/uploads/2019/01/Family-Activities-Hong-Kong-17.png-680x500.jpeg 360w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Family-Activities-Hong-Kong-17.png-680x500.jpeg 768w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Family-Activities-Hong-Kong-17.png-680x500.jpeg 600w, http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1-800x600.gif 800w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Family-Activities-Hong-Kong-17.png-680x500.jpeg 278w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Family-Activities-Hong-Kong-17.png-680x500.jpeg 400w" sizes="(max-width: 360px) 100vw, 360px"></a>
        </div>
        <div class="thm-instagram st_fix_gallery">
            <a class="hover-img popup-gallery-image" href="http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1.gif" data-effect="mfp-zoom-out"><img width="360" height="288" src="https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg" class="attachment-360x270 size-360x270" alt="Just another WordPress site" srcset="https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg 360w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg 768w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg 600w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg 800w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg 278w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/Activities-Riad-Dar-Hassan-4x4-tour-photo-by-Ezy%C3%AA-Moleda-all-rights-reserved-680x500.jpg 400w" sizes="(max-width: 360px) 100vw, 360px"></a>
        </div>
        <div class="thm-instagram st_fix_gallery">
            <a class="hover-img popup-gallery-image" href="https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg" data-effect="mfp-zoom-out"><img width="360" height="288" src="https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg" class="attachment-360x270 size-360x270" alt="Just another WordPress site" srcset="https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg 360w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg 768w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg 600w, http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1-800x600.gif 800w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg 278w, https://acmap.travelerwp.com/wp-content/uploads/2019/01/dde17172-7bb1-4006-91b5-65bdd534ef4a-680x500.jpg 400w" sizes="(max-width: 360px) 100vw, 360px"></a>
            
        </div>
        <div class="thm-instagram st_fix_gallery">
            <a class="hover-img popup-gallery-image" href="http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1.gif" data-effect="mfp-zoom-out"><img width="360" height="288" src="https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg" class="attachment-360x270 size-360x270" alt="Just another WordPress site" srcset="https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg 360w, https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg 768w, https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg 600w, https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg 800w, https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg 278w, https://acmap.travelerwp.com/wp-content/uploads/2015/01/Tourist-Information-Hero-1-680x500.jpg 400w" sizes="(max-width: 360px) 100vw, 360px"></a>
        </div>
        <div class="thm-instagram st_fix_gallery">
            <a class="hover-img popup-gallery-image" href="http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1.gif" data-effect="mfp-zoom-out"><img width="360" height="288" src="https://acmap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-270x335.jpg" class="attachment-360x270 size-360x270" alt="Just another WordPress site" srcset="https://acmap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-270x335.jpg 360w, https://acmap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-270x335.jpg 768w, https://acmap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-270x335.jpg 600w, http://localhost/traveler/wp-content/uploads/2014/12/40BAC88-1-800x600.gif 800w, https://acmap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-270x335.jpg 278w, https://acmap.travelerwp.com/wp-content/uploads/2015/02/cheapest-car-insurance-in-new-jersey-nj-story-270x335.jpg 400w" sizes="(max-width: 360px) 100vw, 360px"></a>
            
        </div>
    </div>

    <div class="container">
        <div class="row" style="padding-bottom: 80px; padding-top: 80px;">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="logo-feature">
                    <a><img src="<?php echo get_template_directory_uri().'/v2/images/assets/logo_black.svg';?>" alt=""></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="st-form-send-mail">
                    <div class="st-text-newletter">
                        <div class="st-title-newlet">
                            <p>Newsletter sign up</p>
                        </div>
                        <div class="st-title-des">
                            <span>SIGN UP FOR SPECIAL OFFERS</span>
                        </div>
                    </div>
                    <div class="st-form-newleter">
                        <form action="" method="get" accept-charset="utf-8">
                            <div class="st-gr-input">
                                <input type="text" name="" value="" placeholder="Enter your email">
                                <button type="submit"><?php echo TravelHelper::getNewIcon('send-email-2', '#ddddd', '19px', '16px'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div> -->
<?php get_footer('hotel-activity');?>