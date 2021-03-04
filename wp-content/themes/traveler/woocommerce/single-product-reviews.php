<?php
    /**
     * Display single product reviews (comments)
     *
     * @author        WooThemes
     * @package    WooCommerce/Templates
     * @version     3.6.0
     */
    global $product;

    if (!defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    if (!comments_open()) {
        return;
    }

?>
<div id="reviews" class="row">
    <div class="col-sm-7">
        <div id="comments">
            <h2 class="tab-content-title"><?php
                    if (get_option('woocommerce_enable_review_rating') === 'yes' && ($count = $product->get_review_count()))
                        printf(_n('%s review for %s', '%s reviews for %s', $count, ST_TEXTDOMAIN), $count, get_the_title());
                    else
                        _e('Reviews', ST_TEXTDOMAIN);
                ?></h2>

            <?php if (have_comments()) : ?>

                <ol class="commentlist">
                    <?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
                </ol>

                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                    echo '<nav class="woocommerce-pagination">';
                    paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', array(
                        'prev_text' => '&larr;',
                        'next_text' => '&rarr;',
                        'type'      => 'list',
                    )));
                    echo '</nav>';
                endif; ?>

            <?php else : ?>

                <p class="woocommerce-noreviews"><?php _e('There are no reviews yet.', ST_TEXTDOMAIN); ?></p>

            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-5">
        <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>

            <div id="review_form_wrapper">
                <div id="review_form">
                    <?php
                        $commenter = wp_get_current_commenter();

                        $comment_form = array(
                            'title_reply'          => have_comments() ? __('Add a review', ST_TEXTDOMAIN) : __('Be the first to review', ST_TEXTDOMAIN) . ' &ldquo;' . get_the_title() . '&rdquo;',
                            'title_reply_to'       => __('Leave a Reply to %s', ST_TEXTDOMAIN),
                            'comment_notes_before' => '',
                            'comment_notes_after'  => '',
                            'fields'               => array(
                                'author' => '<p class="comment-form-author">' . '<label for="author">' . __('Name', ST_TEXTDOMAIN) . ' <span class="required">*</span></label> ' .
                                    '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true" /></p>',
                                'email'  => '<p class="comment-form-email"><label for="email">' . __('Email', ST_TEXTDOMAIN) . ' <span class="required">*</span></label> ' .
                                    '<input id="email" name="email" type="text" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-required="true" /></p>',
                            ),
                            'label_submit'         => __('Submit', ST_TEXTDOMAIN),
                            'logged_in_as'         => '',
                            'comment_field'        => ''
                        );

                        if (get_option('woocommerce_enable_review_rating') === 'yes') {
                            $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __('Your Rating', ST_TEXTDOMAIN) . '</label><select name="rating" id="rating">
							<option value="">' . __('Rate&hellip;', ST_TEXTDOMAIN) . '</option>
							<option value="5">' . __('Perfect', ST_TEXTDOMAIN) . '</option>
							<option value="4">' . __('Good', ST_TEXTDOMAIN) . '</option>
							<option value="3">' . __('Average', ST_TEXTDOMAIN) . '</option>
							<option value="2">' . __('Not that bad', ST_TEXTDOMAIN) . '</option>
							<option value="1">' . __('Very Poor', ST_TEXTDOMAIN) . '</option>
						</select></p>';
                        }

                        $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __('Your Review', ST_TEXTDOMAIN) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea></p>';

                        comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                    ?>
                </div>
            </div>

        <?php else : ?>

            <p class="woocommerce-verification-required"><?php _e('Only logged in customers who have purchased this product may leave a review.', ST_TEXTDOMAIN); ?></p>

        <?php endif; ?>
    </div>

    <div class="clear"></div>
</div>
