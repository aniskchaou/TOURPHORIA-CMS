<?php
    /**
     * Created by PhpStorm.
     * User: me664
     * Date: 4/9/15
     * Time: 3:12 PM
     */

    if ( !class_exists( 'ST_Abstract_Front_Controller' ) ) {
        abstract class ST_Abstract_Front_Controller extends ST_Abstract_Controller
        {

            function __construct( $arg = [] )
            {
                parent::__construct( $arg );
            }

            /**
             *
             * @since 1.0.9
             *
             *
             * */
            function init()
            {
                //Add Stats display for posted review
                add_action( 'st_review_more_content', [ $this, 'display_posted_review_stats' ] );

                add_action( 'save_post', [ $this, 'update_avg_rate' ] );

                add_filter( 'post_class', [ $this, 'change_post_class' ] );

                add_filter( 'pre_get_posts', [ $this, '_admin_posts_for_current_author' ] );

                /**
                 *
                 * @since 1.0.9
                 * */
                add_action( 'st_search_fields_name', [ $this, 'get_search_fields_name' ], 2 );

            }

            function get_search_fields_name( $array, $post_type = '' )
            {
                return $array;
            }

            /**
             *
             *
             *
             *
             * @since 1.0.9
             * */
            function _admin_posts_for_current_author( $query )
            {
                if ( $query->is_admin ) {
                    $post_type = $query->get( 'post_type' );

                    if ( !current_user_can( 'manage_options' ) and ( !is_string( $post_type ) or $post_type != 'location' ) ) {
                        global $user_ID;
                        $query->set( 'author', $user_ID );
                    }
                }

                return $query;
            }

            /**
             *
             *
             *
             *
             * @since 1.0.9
             * */
            function change_post_class( $class )
            {
                return $class;
            }

            /**
             *
             *
             *
             *
             * @since 1.0.9
             * */
            function update_avg_rate( $post_id )
            {
                $avg = STReview::get_avg_rate( $post_id );
                update_post_meta( $post_id, 'rate_review', $avg );
            }

            /**
             *
             *
             *
             *
             * @since 1.0.9
             * */
            function get_review_stats()
            {
                return [];
            }

            /**
             *
             *
             *
             *
             * @since 1.0.9
             * */
            function display_posted_review_stats( $comment_id )
            {
                if ( get_post_type() == $this->post_type ) {
                    $data = $this->get_review_stats();

                    $output[] = '<ul class="list booking-item-raiting-summary-list mt20">';

                    if ( !empty( $data ) and is_array( $data ) ) {
                        foreach ( $data as $value ) {
                            $key = $value[ 'title' ];

                            $stat_value = get_comment_meta( $comment_id, 'st_stat_' . sanitize_title( $value[ 'title' ] ), true );

                            $output[] = '
                    <li>
                        <div class="booking-item-raiting-list-title">' . $key . '</div>
                        <ul class="icon-group booking-item-rating-stars">';
                            for ( $i = 1; $i <= 5; $i++ ) {
                                $class = '';
                                if ( $i > $stat_value ) $class = 'text-gray';
                                $output[] = '<li><i class="fa fa-smile-o ' . $class . '"></i>';
                            }

                            $output[] = '
                        </ul>
                    </li>';
                        }
                    }

                    $output[] = '</ul>';


                    echo implode( "\n", $output );
                }
            }
        }
    }