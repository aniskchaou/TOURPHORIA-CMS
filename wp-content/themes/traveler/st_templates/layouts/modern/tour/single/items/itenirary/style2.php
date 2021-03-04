<?php
    $tour_programs = get_post_meta( get_the_ID(), 'tours_program_bgr', true );
    if ( !empty( $tour_programs ) ) {
        ?>
        <div class="owl-carousel-wrapper">
            <div class="owl-carousel owl-tour-program">
                <?php
                    foreach ( $tour_programs as $k => $v ) {
                        ?>
                        <div class="item" style="background-image: url('<?php echo esc_url( $v[ 'image' ] ) ?>')">
                            <div class="header">
                                <h5><?php echo esc_html( $v[ 'time' ] ); ?></h5>
                                <h2><?php echo esc_html( $v[ 'title' ] ); ?></h2>
                            </div>
                            <div class="body ovscroll">
                                <h5><?php echo esc_html( $v[ 'time' ] ); ?></h5>
                                <h2><?php echo esc_html( $v[ 'title' ] ); ?></h2>
                                <div class="desc">
                                    <?php echo balanceTags( $v[ 'desc' ] ); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <a href="#"
               class="prev"><?php echo TravelHelper::getNewIcon( 'arrow-left', '#FFFFFF', '24px', '24px', false ) ?></a>
            <a href="#"
               class="next"><?php echo TravelHelper::getNewIcon( 'arrow-right', '#FFFFFF', '24px', '24px', false ) ?></a>
        </div>
        <?php
    }