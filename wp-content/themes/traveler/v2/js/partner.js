jQuery(function($) {
    $(".sidebar-dropdown").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if ($(this).hasClass("active")) {
            $(".sidebar-dropdown").removeClass("active");
            $(this).removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this).find(".sidebar-submenu").slideDown(200);
            $(this).addClass("active");
        }
    });
    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
        $('body').removeClass('with-panel-right-reveal');
        $(".with-panel-right-reveal .sidenav-overlay").hide();
    });
    $(".sidenav-overlay").click(function() {
        $(".page-wrapper").removeClass("toggled");
        $('body').removeClass('with-panel-right-reveal');
        $(".with-panel-right-reveal .sidenav-overlay").hide();
    });
    $("#show-sidebar").click(function() {
        $('body').addClass('with-panel-right-reveal');
        $(".page-wrapper").addClass("toggled");
        $(".with-panel-right-reveal .sidenav-overlay").show();
    });
    /*Data chart*/
});