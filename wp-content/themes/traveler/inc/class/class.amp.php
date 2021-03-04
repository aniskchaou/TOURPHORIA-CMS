<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/14/2018
 * Time: 11:19 AM
 */

class ST_AMP_Integration
{

    protected static $inst;

    public function __construct()
    {
        add_action('init',[$this,'__register']);
        add_filter('st_is_amp_enable',[$this,'isEnable']);
    }

    public function __register()
    {
        if($this->isEnable())
        {
            add_action('wp_head',[$this,'__addAmpScripts']);
            add_action('wp_head',[$this,'__addAmpBoilerPlate']);
            add_filter('language_attributes',[$this,'__addHtmlTagAttributes']);
            //wp_get_attachment_image()
        }
    }

    public function __addHtmlTagAttributes($output)
    {
        $output.=' amp ';
        return $output;
    }

    public function __addAmpBoilerPlate()
    {
        $jsons=[
            '@context'=>'http://schema.org',
            '@type'=>'NewsArticle',
            'headline'=>get_the_title(),
            'datePublished'=>get_the_time(date('D M d Y H:i:s O')),
        ];
        ?>
        <script type="application/ld+json">
            <?php echo json_encode($jsons);?>
            </script>
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        <?php

    }
    public function __addAmpScripts()
    {
        echo '<script async src="https://cdn.ampproject.org/v0.js"></script>';

    }

    public function isEnable()
    {
        return false;// Disable for now
        return (bool) st()->get_option('enable_amp_support',false);
    }

    public static function inst()
    {
        if(!self::$inst) self::$inst=new self();
        return self::$inst;
    }
}

ST_AMP_Integration::inst();