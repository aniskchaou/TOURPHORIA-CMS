<?php
    $form_title       = st()->get_option( 'st_hotel_alone_topbar_title_search_form' );
    $form_search_data = st()->get_option( 'st_hotel_alone_topbar_search_form' );
    $page_search = st()->get_option('st_hotel_alone_room_search_page');
    $page_search = get_permalink($page_search);
    $picker_style     = ( isset( $picker_style ) ) ? $picker_style : '';
?>
<div class="form-search-room">
    <form action="<?php echo esc_url( $page_search ) ?>" method="get" class="wpbooking-search-form-wrap">
        <div class="title">
            <?php echo esc_html( $form_title ) ?>
        </div>
        <div class="field">
            <div class="row">
                <?php
                    if ( !empty( $form_search_data ) ) {
                        foreach ( $form_search_data as $k => $v ) {
                            $v = [
                                'label'           => $v[ 'title' ],
                                'field_attribute' => $v[ 'name' ],
                                'layout_size'     => $v[ 'layout_size' ],
                                'placeholder'     => $v[ 'placeholder' ],
                                'picker_style'    => $picker_style
                            ];
                            echo st_hotel_alone_load_view( 'elements/st-form-search-room/fields/' . $v[ 'field_attribute' ], false, $v );
                        }
                    }
                ?>
            </div>
        </div>
        <div class="control">
            <button class="btn btn-primary">
                <?php esc_html_e( "CHECK AVAILABILITY", ST_TEXTDOMAIN ) ?>
            </button>
        </div>
    </form>
</div>