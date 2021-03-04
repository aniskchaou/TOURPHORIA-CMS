<?php extract(shortcode_atts(array(
    'select_category'    => '',
    'order_by'       => '',
    'order'       	 => '',
    'number_items'   => '',
    'style'   => '',
  ), $attr));
	$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    if (is_front_page()) {
        $paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
    }
    $args = array(
        'post_type' => 'post',
        'orderby' => $order_by,
        'order' => $order,
        'posts_per_page' => (int)$number_items,
        'paged' => $paged,
    );
     
    $list_cat = '';
    if (!empty($select_category)) {
        $list_cat = explode(",", $select_category);
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $list_cat,
        );
    }
    $all_category = get_terms(array(
        'taxonomy' => 'category',
        'slug' =>  $list_cat,
    )
    );
    $index = 1;
    $cat_all_list=get_terms('category');
    $blog_query = new WP_Query($args);
  ?>
<style type="text/css" media="screen">
    .blog-st-single .tabbable-panel .row [class*=col-]:nth-child(3n+1) , .st-posts.post-row [class*=col-]:nth-child(3n+1){
        clear: both;
    }
    .loader-wrapper {position: relative; }
    .loader-wrapper:after {
        content: '';
        background: rgba(255, 255, 255, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9;
    }

    .loader-wrapper .st-loader {
        display: block;
        z-index: 10;
    }

    .st-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 50px;
        height: 6px;
        background: #5191FA;
        border-radius: 5px;
        margin-left: -25px;
        -webkit-animation: load 1.8s ease-in-out infinite;
        animation: load 1.8s ease-in-out infinite;
    }
    .st-loader:before, .st-loader:after {
        position: absolute;
        display: block;
        content: "";
        -webkit-animation: load 1.8s ease-in-out infinite;
        animation: load 1.8s ease-in-out infinite;
        height: 6px;
        border-radius: 5px;
    }
    .st-loader:before {
        top: -20px;
        left: 10px;
        width: 40px;
        background: #FA5636;
        margin-left: -20px;
    }
    .st-loader:after {
        bottom: -20px;
        width: 35px;
        background: #ffab53;
        margin-left: -17px;
    }
  </style>
<?php if($style==='style-1'){?>
 <div class="blog-st-single">
  	 <div class="tabbable-panel">
	 	<div class="tabbable-line">
	 		<ul class="nav nav-tabs tab-ajax" role="tablist">
                <li class="active">
                    <a href="#all" data-toggle="tab" role="tab" ><?php echo esc_html__(  'All' ,ST_TEXTDOMAIN)?> </a>
                </li>
                <?php 
                if (is_array($cat_all_list) && !empty($cat_all_list)) {
                    if (is_array($all_category) && !empty($all_category)) {
                        foreach ($all_category as $key => $cat) { ?>
        				<li>
        				    <a href="#st_blog_<?php echo $cat->slug ?>" data-toggle="tab" aria-expanded="true"><?php echo $cat->name ?> </a>
        				</li>
                        <?php }
                    }
                }?>
	 		</ul>
	 		<div class="tab-content">
                <div class="tab-pane active st_all"  id="all">
                        <div class="container">
                            <div class="row grid-st">
                                <?php 
                                if($blog_query->have_posts()) : while($blog_query->have_posts()) : 
                                    $blog_query->the_post();
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="blog-item">
                                        <div class="header-thumb">
                                            <a href="<?php the_permalink();?>">
                                                 <?php
                                                    if(has_post_thumbnail() and get_the_post_thumbnail()){
                                                        echo get_the_post_thumbnail(get_the_ID(), array(370, 370));
                                                    }else{
                                                        echo st_get_default_image();
                                                    }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="caption-post">
                                            <div class="category">
                                                <?php the_category(', '); ?>
                                            </div>
                                            <h3 class="title">
                                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                            </h3>
                                            <div class="date">
                                                <span class="date-post"><?php echo get_the_date('d M Y');?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; endif; wp_reset_postdata();?>
                            </div>
                            <div class="row loadmore loadmore-ccv">
                                <div class="col-md-12 load-ajax-icon">
                                    <div class="loader-wrapper">
                                        <div class="st-loader"></div>
                                    </div>
                                </div>
                                 <div class="text-center st-button-loadmore">
                                    
                                    <div class="control-loadmore text-center">
                                        <a class="load_more_post st-button--main" href="#" data-posts-per-page="<?php echo (int)$number_items;?>" data-paged="1" data-order="<?php echo $order;?>" data-order-by="<?php echo $order_by?>" data-tax-query = "<?php echo $select_category ?>" check-all="true" data-max-num-page = "<?php echo $blog_query->max_num_pages;?>" data-index = "<?php echo $index;?>"><?php echo esc_html__(  'Load more' ,ST_TEXTDOMAIN)  ?></a>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                if (is_array($cat_all_list) && !empty($cat_all_list)) {
                    if (is_array($all_category) && !empty($all_category)) {
                        foreach ($all_category as $key => $cat_content) { ?>
                        <div class="tab-pane st_blog_<?php echo $cat_content->slug ?>" id="st_blog_<?php echo $cat_content->slug ?>">
                            <div class="container">
                                <div class="row grid-st">
                                    <?php
                                    $args_cat = array(
                                        'post_type' => 'post',
                                        'orderby' => $order_by,
                                        'order' => $order,
                                        'posts_per_page' => (int)$number_items,
                                        'paged' => $paged,
                                        'category_name' => $cat_content->slug
                                    );
                                    $blog_cat_query = new WP_Query($args_cat);
                                    if($blog_cat_query->have_posts()) : while($blog_cat_query->have_posts()) : 
                                    $blog_cat_query->the_post();
                                    ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="blog-item">
                                            <div class="header-thumb">
                                                <a href="<?php the_permalink();?>">
                                                     <?php
                                                        if(has_post_thumbnail() and get_the_post_thumbnail()){
                                                            echo get_the_post_thumbnail(get_the_ID(), array(370, 370));
                                                        }else{
                                                            echo st_get_default_image();
                                                        }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="caption-post">
                                                <div class="category">
                                                    <?php the_category(', '); ?>
                                                </div>
                                                <h3 class="title">
                                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                                </h3>
                                                <div class="date">
                                                    <span class="date-post"><?php echo get_the_date('d M Y');?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; endif; wp_reset_postdata();?>

                                </div>
                                <div class="row loadmore loadmore-ccv">
                                    <div class="col-md-12 load-ajax-icon">
                                        <div class="loader-wrapper">
                                            <div class="st-loader"></div>
                                        </div>
                                    </div>
                                    <div class="text-center st-button-loadmore">
                                        <div class="control-loadmore text-center">
                                            <a class="load_more_post st-button--main text-center" href="#" data-posts-per-page="<?php echo (int)$number_items;?>" data-paged="1" data-order="<?php echo $order;?>" data-order-by="<?php echo $order_by?>" data-tax-query = "<?php echo $cat_content->slug ?>" data-max-num-page = "<?php echo $blog_query->max_num_pages;?>" check-all="false" data-index = "<?php echo $index;?>"><?php echo esc_html__(  'Load more' ,ST_TEXTDOMAIN)  ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    }
                }?>
	 		</div>
	 	</div>
	 </div>
 </div>
<?php } else{?>
    <div class="st-posts post-row">
        <?php if($blog_query->have_posts()) : while($blog_query->have_posts()) :  $blog_query->the_post();?>
        <div class="col-4">
            <div class="blog-item">
                <div class="header-thumb">
                    <a href="<?php the_permalink();?>">
                         <?php
                            if(has_post_thumbnail() and get_the_post_thumbnail()){
                                echo get_the_post_thumbnail(get_the_ID(), array(370, 370));
                            }else{
                                echo st_get_default_image();
                            }
                        ?>
                    </a>
                </div>
                <div class="caption-post">
                    <div class="category">
                        <?php the_category(', '); ?>
                    </div>
                    <h3 class="title">
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </h3>
                    <div class="date">
                        <span class="date-post"><?php echo get_the_date('d M Y');?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; endif; wp_reset_postdata();?>
    </div>
<?php }?>
