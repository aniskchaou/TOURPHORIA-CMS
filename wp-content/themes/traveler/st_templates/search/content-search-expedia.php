<?php
$iframe_expedia = st()->get_option( 'expedia_iframe_code', '' );
if ( $iframe_expedia == '' ) {
	$iframe_expedia = '<div id="searchWidget" style="width:100%;height:480px;"><iframe id="widgetIframe" src="https://www.expedia.com/marketing/widgets/searchform/widget?wtt=2&tp1=123456&tp2=&tp3=&tp4=&tp5=&lob=H,FH,F,CA,A&des=&wbi=11&olc=000000&whf=4&hfc=C7C7C7&wif=4&ifc=000000&wbc=FFCB00&wbf=4&bfc=3D3100&wws=1&sfs=H480FW100R" width="100%" height="100%" scrolling="no" frameborder="0"></iframe></div>';
}
$browser = '';
if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
	$agent = $_SERVER['HTTP_USER_AGENT'];
}
if ( strlen( strstr( $agent, 'Firefox' ) ) > 0 ) {
	$browser = 'firefox';
}

if ( $browser == 'firefox' ) {
	?>
    <div id="expedia-embed"></div>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                if ($.browser.mozilla) {
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        $('#expedia-embed').html('<?php echo balanceTags($iframe_expedia); ?>');
                    })
                }
            });
        })(jQuery)
    </script>
	<?php
} else {
	echo balanceTags($iframe_expedia);
}
?>

