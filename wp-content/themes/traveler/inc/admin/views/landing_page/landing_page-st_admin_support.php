
<?php 
    $check_registered = false ; 
?>
<?php if (!$check_registered){?>
<div class="traveler-important-notice">
        <p class="about-description"><?php echo __("To access our support forum and resources, you first must register your purchase.", ST_TEXTDOMAIN) ; ?><br>
<?php echo __("See the",ST_TEXTDOMAIN ) ; ?> <a href="<?php echo admin_url('/admin.php?page=st_admin_registration');?>"> <?php echo __("Product Registration" , ST_TEXTDOMAIN ); ?></a> <?php echo __("tab for instructions on how to complete registration." , ST_TEXTDOMAIN ); ?></p>
    </div>
<?php }?>
<div class="traveler-registration-steps">
    	<div class="feature-section st_admin_support">
            <?php 
                $submit_a_ticket = "https://shinehelp.shinetheme.com/";
                $document = "http://shinetheme.com/documentation/traveler/";
                $knowledgebase = "http://shinetheme.com/documentation/traveler/";
                $video = "http://shinetheme.com/documentation/traveler/" ;
                $forum  = "https://shinehelp.shinetheme.com/";

            ?>
        	<div class='st_col_4'>
				<h4><span class="dashicons dashicons-sos"></span><?php echo __("Submit A Ticket",ST_TEXTDOMAIN ) ; ?></h4>
				<p><?php echo __("We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.",ST_TEXTDOMAIN ) ; ?></p>
                <a href="<?php echo esc_url($submit_a_ticket) ; ?>" class="button button-large button-primary traveler-large-button" target="_blank"><?php echo __("Submit A Ticket",ST_TEXTDOMAIN ) ; ?></a>            </div>
            <div class='st_col_4'>
				<h4><span class="dashicons dashicons-book"></span><?php echo __("Documentation",ST_TEXTDOMAIN ) ; ?></h4>
				<p><?php echo __("This is the place to go to reference different aspects of the theme. Our online documentation is an incredible resource for learning the ins and outs of using traveler.",ST_TEXTDOMAIN ) ; ?></p>
                <a href="<?php echo esc_url($document);?>" class="button button-large button-primary traveler-large-button" target="_blank"><?php echo __("Documentation",ST_TEXTDOMAIN ) ; ?></a>            </div>
        	<div class="last-feature st_col_4">
				<h4><span class="dashicons dashicons-portfolio"></span><?php echo __("Knowledgebase",ST_TEXTDOMAIN ) ; ?></h4>
				<p><?php echo __("Our knowledgebase contains additional content that is not inside of our documentation. This information is more specific and unique to various versions or aspects of traveler.",ST_TEXTDOMAIN ) ; ?></p>
                <a href="<?php echo esc_url($knowledgebase);?>" class="button button-large button-primary traveler-large-button" target="_blank"><?php echo __("Knowledgebase",ST_TEXTDOMAIN ) ; ?></a>            </div>
            <div class='st_col_4'>
            	<h4><span class="dashicons dashicons-format-video"></span><?php echo __("Video Tutorials",ST_TEXTDOMAIN ) ; ?></h4>
				<p><?php echo __("Nothing is better than watching a video to learn. We have a growing library of high-definition, narrated video tutorials to help teach you the different aspects of using traveler.",ST_TEXTDOMAIN ) ; ?></p>
                <a href="<?php echo esc_url($video);?>" class="button button-large button-primary traveler-large-button" target="_blank"><?php echo __("Watch Videos",ST_TEXTDOMAIN ) ; ?></a>            </div>
            <div class='st_col_4'>
				<h4><span class="dashicons dashicons-groups"></span><?php echo __("Community Forum",ST_TEXTDOMAIN ) ; ?></h4>
				<p><?php echo __("We also have a community forum for user to user interactions. Ask another traveler user! Please note that ThemeFusion does not provide product support here.",ST_TEXTDOMAIN ) ; ?></p>
                <a href="<?php echo esc_url($forum);?>" class="button button-large button-primary traveler-large-button" target="_blank"><?php echo __("Community Forum",ST_TEXTDOMAIN ) ; ?></a>            </div>            
        </div>
    </div>