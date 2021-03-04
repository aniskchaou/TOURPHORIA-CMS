jQuery(document).ready(function($){
    var stTextData = $('#user-verify-detail').find('.st-text');
    var text_verfied = stTextData.data('text_verfied');
    var text_apart = stTextData.data('text_apart');
    var text_notverify = stTextData.data('text_notverify');
    var text_sendnotice = stTextData.data('text_sendnotice');
    var text_noticerequired = stTextData.data('text_noticerequired');

    $('.verify-view').click(function(e){
        e.preventDefault();
        var me = $(this);
        var user_id = me.data('user_id');
        var nonce = me.data('nonce');
        var loader = $('#user-verify-detail .loader');
        var appendDiv = $('#user-verify-detail').find('.content-append');

        loader.show();

        appendDiv.html('');

        if(user_id != ''){
            $('#user-verify-detail').fadeIn();
            $.ajax({
                url       : ajaxurl,
                type      : "POST",
                data      : {
                    'action'       : 'get_user_verifications_info',
                    'user_id'   : user_id,
                    'security': nonce
                },
                dataType  : "json",
                complete  : function (res) {
                    loader.hide();

                    var dataRes = res.responseJSON;
                    console.log(dataRes);
                    if(dataRes.status){
                        appendDiv.html(dataRes.htmlData);
                    }else{
                        alert('Get verificate info error.');
                    }
                },
                error     : function (msg) {
                    loader.hide();
                }
            });
        }else{
            alert('User id is invalid.');
        }
    });

    $('#user-verify-detail .close').click(function () {
        $('#user-verify-detail').fadeOut();
    });

    var c_email  = 0;
    var c_phone  = 0;
    var c_card  = 0;
    var c_certificate  = 0;
    var c_social  = 0;

    function returnVal(criteria){
        if(criteria == 'email'){
            return c_email;
        }
        if(criteria == 'phone'){
            return c_phone;
        }
        if(criteria == 'passport'){
            return c_card;
        }
        if(criteria == 'travel_certificate'){
            return c_certificate;
        }
        if(criteria == 'social'){
            return c_social;
        }
    }

    function ascCheck(criteria){
        if(criteria == 'email'){
            c_email++;
        }else{
            c_email = 0;
        }
        if(criteria == 'phone'){
            c_phone++;
        }else{
            c_phone = 0;
        }
        if(criteria == 'passport'){
            c_card++;
        }else{
            c_card = 0;
        }
        if(criteria == 'travel_certificate'){
            c_certificate++;
        }else{
            c_certificate = 0;
        }
        if(criteria == 'social'){
            c_social++;
        }else{
            c_social = 0;
        }
    }
    function reCheck(criteria){
        if(criteria == 'email'){
            c_email = 0;
        }
        if(criteria == 'phone'){
            c_phone = 0;
        }
        if(criteria == 'passport'){
            c_card = 0;
        }
        if(criteria == 'travel_certificate'){
            c_certificate = 0;
        }
        if(criteria == 'social'){
            c_social = 0;
        }
    }

    $(document).on('click', '.verify-box .btn-verify-all', function (e){
        e.preventDefault();
        var me = $(this);
        var user_id = me.data('user_id');
        var nonce = me.data('nonce');
        $('.invalid-reason').hide();

        me.find('.dashicons').remove();

        reCheck('email');
        reCheck('phone');
        reCheck('passport');
        reCheck('travel_certificate');
        reCheck('social');

        me.append('<span class="dashicons dashicons-update loadicon"></span>');

        if(user_id != ''){
            $('#user-verify-detail').fadeIn();
            $.ajax({
                url       : ajaxurl,
                type      : "POST",
                data      : {
                    'action'       : 'user_verify_all_info',
                    'user_id'   : user_id,
                    'security' : nonce,
                },
                dataType  : "json",
                complete  : function (res) {
                    var dataRes = res.responseJSON;
                    if(dataRes.status){
                        console.log(dataRes.type_verify);
                        removeIconButton();
                        me.append('<span class="dashicons dashicons-yes"></span>');
                        $('#user-' + user_id).find('.verify-status').removeClass('all').removeClass('apart').removeClass('none').addClass('all').text(text_verfied);
                        $('.verify-box .verify-status').removeClass('all').removeClass('apart').removeClass('none').addClass('all').text(text_verfied);
                        $('.verify-box .verify-item .verify-status-item').removeClass('all').removeClass('apart').removeClass('none').addClass('all');
                    }else{

                    }
                },
                error     : function (msg) {
                    removeIconButton();
                }
            });
        }else{
            alert('User id is invalid.');
        }
    });

    $(document).on('click', '.verify-box .btn-verify-single', function (e){
        e.preventDefault();
        var me = $(this);
        var user_id = me.data('user_id');
        var criteria = me.data('criteria');
        $('.invalid-reason').hide();

        reCheck('email');
        reCheck('phone');
        reCheck('passport');
        reCheck('travel_certificate');
        reCheck('social');
        me.find('.dashicons').remove();

        me.append('<span class="dashicons dashicons-update loadicon"></span>');

        if(user_id != ''){
            $('#user-verify-detail').fadeIn();
            $.ajax({
                url       : ajaxurl,
                type      : "POST",
                data      : {
                    'action'       : 'user_verify_each_info',
                    'user_id'   : user_id,
                    'criteria' : criteria,
                },
                dataType  : "json",
                complete  : function (res) {
                    var dataRes = res.responseJSON;
                    if(dataRes.status){
                        removeIconButton();
                        me.append('<span class="dashicons dashicons-yes"></span>');

                        var vClass = 'all';
                        var vText = text_verfied;
                        if(dataRes.verify_info == 'apart'){
                            vClass = 'apart';
                            vText = text_apart;
                        }
                        if(dataRes.verify_info == 'none'){
                            vClass = 'none';
                            vText = text_notverify;
                        }
                        $('#user-' + user_id).find('.verify-status').removeClass('all').removeClass('apart').removeClass('none').addClass(vClass).text(vText);
                        $('.verify-box .verify-status').removeClass('all').removeClass('apart').removeClass('none').addClass(vClass).text(vText);
                        me.parent().find('.verify-status-item').removeClass('all').removeClass('none').addClass('all');
                    }else{

                    }
                },
                error     : function (msg) {
                    removeIconButton();
                }
            });
        }else{
            alert('User id is invalid.');
        }
    });

    $(document).on('click', '.verify-box .btn-verify-invalid', function (e){
        e.preventDefault();
        var me = $(this);
        var user_id = me.data('user_id');
        var criteria = me.data('criteria');

        if(returnVal(criteria) == 0){
            $('.invalid-reason').hide();
            me.parent().find('.invalid-reason').show();
            me.parent().find('.invalid-reason').focus();
            me.text(text_sendnotice);
            ascCheck(criteria);
        }else{
            me.find('.dashicons').remove();

            if(user_id != ''){
                $('#user-verify-detail').fadeIn();
                if(me.parent().find('.invalid-reason').val() == ''){
                    alert(text_noticerequired);
                }else{
                    me.append('<span class="dashicons dashicons-update loadicon"></span>');
                    $.ajax({
                        url       : ajaxurl,
                        type      : "POST",
                        data      : {
                            'action'       : 'user_deny_each_info',
                            'user_id'   : user_id,
                            'criteria' : criteria,
                            'notice': me.parent().find('.invalid-reason').val()
                        },
                        dataType  : "json",
                        complete  : function (res) {
                            var dataRes = res.responseJSON;
                            if(dataRes.status){
                                removeIconButton();
                                me.append('<span class="dashicons dashicons-yes"></span>');

                                var vClass = 'all';
                                var vText = text_verfied;
                                if(dataRes.verify_info == 'apart'){
                                    vClass = 'apart';
                                    vText = text_apart;
                                }
                                if(dataRes.verify_info == 'none'){
                                    vClass = 'none';
                                    vText = text_notverify;
                                }
                                $('#user-' + user_id).find('.verify-status').removeClass('all').removeClass('apart').removeClass('none').addClass(vClass).text(vText);
                                $('.verify-box .verify-status').removeClass('all').removeClass('apart').removeClass('none').addClass(vClass).text(vText);
                                me.parent().find('.verify-status-item').removeClass('all').removeClass('none').addClass('none');
                            }else{

                            }
                            reCheck(criteria);
                            me.parent().find('.invalid-reason').hide();
                            me.text(text_sendnotice);
                            me.append('<span class="dashicons dashicons-yes"></span>');
                        },
                        error     : function (msg) {
                            removeIconButton();
                            reCheck(criteria);
                            me.parent().find('.invalid-reason').hide();
                            me.text(text_sendnotice);
                            me.append('<span class="dashicons dashicons-yes"></span>');
                        }
                    });
                }
            }else{
                alert('User id is invalid.');
            }
        }
    });
    $('#user-verify-detail').click(function (e) {
        if (e.target !== this)
            return;
        $('#user-verify-detail').fadeOut();
    })

    function removeIconButton(){
        $('.verify-box .btn-verify-single').find('.dashicons').remove();
        $('.verify-box .btn-verify-invalid').find('.dashicons').remove();
        $('.verify-box .btn-verify-all').find('.dashicons').remove();
    }
});