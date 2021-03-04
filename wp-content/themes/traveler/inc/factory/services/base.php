<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 1:44 PM
 */

abstract class ST_Base_Service
{
    protected $post;
    protected $post_id;

    public function __construct($post)
    {
        if($post instanceof WP_Post)
        {
            $this->post_id = $post->ID;
            $this->post = $post;
        }else{
            $this->post_id = $post;
            $this->post = new WP_Post($this->post_id);
        }
    }

    public function getFeatureImage($size='')
    {
        return wp_get_attachment_image(get_post_thumbnail_id($this->post_id),$size);
    }

    public function getPermalink()
    {
        return get_permalink($this->post_id);
    }

    public function getTitle()
    {
        return get_the_title($this->post_id);
    }


    public function getAddress()
    {
        return $this->getMeta('address');
    }

    public function getExcerpt($length=50)
    {
        return TravelHelper::cutnchar(strip_tags(get_the_excerpt($this->post_id)),$length);
    }

    public function getMeta($key)
    {
        return get_post_meta($this->post_id,$key,true);
    }

}