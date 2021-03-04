<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                while (have_posts()) : the_post();
                    if ($layout && !empty($layout)) {
                        echo STTemplate::get_vc_pagecontent($layout);
                    }
                endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php wp_reset_query(); ?>