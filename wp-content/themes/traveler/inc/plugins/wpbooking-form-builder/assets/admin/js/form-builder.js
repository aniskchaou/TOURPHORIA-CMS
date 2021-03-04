/**
 * Created by PA25072016 on 12/20/2016.
 */
jQuery(document).ready(function($){

    $('.form.ui-sortable').sortable({
        placeholder: "sortable-placeholder",
        handle: ".form-item-handle",
    });

    //dropdown
    $(document).on('click','.wb-form-item .item-edit', function(e){
        e.preventDefault();
        t = $(this);
        t.closest('.wb-form-item').find('.menu-item-settings').slideToggle(300, function(){
            if(t.closest('.wb-form-item').hasClass('menu-item-edit-inactive')){
                t.closest('.wb-form-item').removeClass('menu-item-edit-inactive');
                t.closest('.wb-form-item').addClass('menu-item-edit-active');
            }else{
                t.closest('.wb-form-item').addClass('menu-item-edit-inactive');
                t.closest('.wb-form-item').removeClass('menu-item-edit-active');
            }
        });
    });

    var index = $('#form-to-edit .wb-form-item').length;
    //Add to form
    $('.submit-add-to-form').each(function(){
        $(this).click(function (e) {
            e.preventDefault();
            var t = $(this);
            var p = t.closest('.accordion-section-content');
            var ids = p.find('.field_select');
            if(ids.val() != ''){
                var field_ids = ids.val().split(',');
                for (var i = 0; i < field_ids.length ; i++){
                    var template = wp.template('wb-form-item-'+field_ids[i]);
                    $('#form-to-edit').append(template({index:index}));
                    index += 1;
                }
                p.find('input[type=checkbox]').prop('checked', false);
                ids.val('');
            }
            $('#form-instructions').addClass('fb_hidden');
            $('.drag-instructions').removeClass('fb_hidden');
        });
    });

    //Delete item
    $(document).on('click', '.wb-form-item .item-delete', function(e){
        e.preventDefault();
        $(this).closest('.wb-form-item').slideUp(100, function() {
            $(this).remove();
        });
        var lg = $('#form-to-edit .wb-form-item').length;
        if(lg == 0 || lg == 1){
            $('#form-instructions').removeClass('fb_hidden');
            $('.drag-instructions').addClass('fb_hidden');
        }
    });

    //Cancel item
    $(document).on('click', '.menu-item-settings .item-cancel', function(e){
        e.preventDefault();
        $(this).closest('.menu-item-settings').slideUp(300);
    });

    //Change title
    $(document).on('keyup keydown', '.menu-item-settings .edit-form-item-title', function(){
        t = $(this);
        t.closest('.wb-form-item').find('.form-item-title').text(t.val());
    });

    //Select all
    var c = 0;
    $('.select-all-builder').each(function(){
        $(this).click(function (e){
            e.preventDefault();
            var p = $(this).closest('.accordion-section-content');
            if(c==0) {
                p.find('input[type=checkbox]').prop('checked', true);
                var old = [];
                p.find('.form-list-field li').each(function(){
                    old.push($(this).find('input[type=checkbox]').val());
                });
                p.find('.field_select').val(old);
                c = 1;
            }else{
                p.find('input[type=checkbox]').prop('checked', false);
                p.find('.field_select').val('');
                c = 0;
            }
        });
    });


    //Select field
    $('.form-list-field input[type=checkbox]').each(function(){
        var p = $(this).closest('.accordion-section-content');
        $(this).change(function () {
            var old = p.find('.field_select').val();
            if(old == ''){
                old_arr = [];
            }else{
                var old_arr = old.split(',');
            }
            if($(this).is(':checked')){
                old_arr.push($(this).val());
            }else{
                var index = old_arr.indexOf($(this).val());
                if(index != -1)
                    old_arr.splice( index, 1 );
            }
            p.find('.field_select').val(old_arr);
        });
    });

    //Open/close form field
    $('.accordion-section-title').click(function(){
        var t = $(this);
        var p = t.closest('.add-form-fields');
        var c = p.find('.accordion-section-content');
        c.slideToggle(300, function(){

        });
        if(p.hasClass('open')){
            p.removeClass('open');
        }else{
            $('#side-sortables').find('.add-form-fields').each(function(){
                if($(this).hasClass('open')){
                    $(this).removeClass('open');
                    $(this).find('.accordion-section-content').slideUp(300);
                }
            });
            p.addClass('open');
        }
    });

    //Check new form
    $('.wb-form-builder-content').submit(function(){
        if($(this).find('#form-name').val() == ''){
            $(this).find('#form-name').css({'border':'1px solid red'});
            return false;
        }
    });

    //alert delete form
    $('.wb-edit-footer-action .form-delete').click(function(){
        var del = confirm('You are about to permanently delete this form');
        if(!del){
            return false;
        }
    });

    //advance field
    $(document).on('click', '.wb-form-item .wb-field-advance', function (e) {
        e.preventDefault();
        var p = $(this).closest('.wb-form-item');
        p.find('.wb-advance-field').slideToggle(200);
    });

    //type = select add new
    $(document).on('click', '.add_new_row a', function (e) {
        e.preventDefault();
        var p = $(this).closest('.description');
        var id = $(this).attr('data-id');
        var index = $(this).attr('data-index');
        var row = '<span class="value-row-content">'
            +'<span class="value-label key"><input type="text" name="item_data['+index+']['+id+'][op_key][]" value=""></span>'
            +'<span class="value-label"><input type="text" name="item_data['+index+']['+id+'][op_value][]" value=""></span>'
            +'<span class="value-label"><i class="dashicons dashicons-no-alt"></i></span>'
            +'</span>';
        p.find('.wb-value-table').append(row);
    });
    //type = select delete row
    $(document).on('click', '.value-label i.dashicons', function () {
        $(this).closest('.value-row-content').remove();
    });

    $(document).on('keyup keydown', '.value-label.key input', function(){
        if(!/^[a-zA-Z0-9._]*$/g.test($(this).val())){
            var old = $(this).val().slice(0,(parseInt($(this).val().length) - 1));
            $(this).val(old)
        }
    });

    var check_name = false;
    $(document).on('keyup keydown', '.wb-form-item .edit-form-item-name', function () {
        var t = $(this);
        var check = false;
        $('.wb-form-item .edit-form-item-name').not($(this)).each(function(){
            if(t.val() == $(this).val()){
                check = true;
            }
        });
        if(!/^[a-zA-Z0-9._]*$/g.test(t.val()) || t.val() == ''){
            check = true;
        }
        if(check){
            check_name = true;
            t.css({'border':'1px solid red', 'box-shadow':'inset 0 1px 2px rgba(255, 0, 0,.07)'});
        }else{
            check_name = false;
            t.css({'border':'1px solid rgb(11, 148, 68)','box-shadow':'inset 0 1px 2px rgba(11, 148, 68,.07)'});
        }

        $(this).closest('.wb-form-item').find('.ui-sortable-handle').removeClass('error');
        $(this).closest('.wb-form-item').find('.error-message').addClass('fb_hidden');

    });

    $(document).on('keyup keydown', '.wb-form-item .edit-form-item-title', function () {
        $(this).closest('.wb-form-item').find('.ui-sortable-handle').removeClass('error');
        $(this).closest('.wb-form-item').find('.error-message').addClass('fb_hidden');
    });

    $(document).on('click','.wb-form-save', function(){

        if($('.wb-update-form input[name=form-name]').val() == ''){
            $('.error.error-form-validate').text(wb_fb_param.error_form_title_empty);
            $('.error.error-form-validate').show();
            $('.wb-update-form input[name=form-name]').addClass('error');
            return false;
        }else{
            $('.wb-update-form input[name=form-name]').removeClass('error');
        }

        var item = $('#form-to-edit .wb-form-item');
        if(item.length > 0){
            var check = false;
            item.find('.edit-form-item-title').each(function(){
                if($(this).val() == ''){
                    check = true;
                    $(this).addClass('error');
                    $(this).closest('.wb-form-item').find('.ui-sortable-handle').addClass('error');
                    $(this).closest('.wb-form-item').find('.error-message').text(wb_fb_param.error_field_title_empty);
                    $(this).closest('.wb-form-item').find('.error-message').removeClass('fb_hidden');
                }else{
                    $(this).removeClass('error');
                    $(this).closest('.wb-form-item').find('.ui-sortable-handle').removeClass('error');
                    $(this).closest('.wb-form-item').find('.error-message').addClass('fb_hidden');
                }
            });

            if(check) {
                return false;
            }

            //check = false;
            //$('.wb-form-item .edit-form-item-title').each(function(){
            //    $('.wb-form-item .edit-form-item-title').each(function(){
            //        var t = $(this);
            //        if(!/^[a-zA-Z0-9._*\s]*$/g.test(t.val())){
            //            check = true;
            //            $(this).closest('.wb-form-item').find('.ui-sortable-handle').addClass('error');
            //            $(this).closest('.wb-form-item').find('.error-message').text(wb_fb_param.error_field_title_contain_special);
            //            $(this).closest('.wb-form-item').find('.error-message').removeClass('fb_hidden');
            //        }else{
            //            $(this).closest('.wb-form-item').find('.ui-sortable-handle').removeClass('error');
            //            $(this).closest('.wb-form-item').find('.error-message').addClass('fb_hidden');
            //        }
            //    });
            //});
            //
            //if(check){
            //    return false;
            //}

            check = false;

            item.find('.edit-form-item-name').each(function(){
                if($(this).val() == ''){
                    check = true;
                    $(this).closest('.wb-form-item').find('.ui-sortable-handle').addClass('error');
                    $(this).closest('.wb-form-item').find('.error-message').text(wb_fb_param.error_field_name_empty);
                    $(this).closest('.wb-form-item').find('.error-message').removeClass('fb_hidden');
                }else{
                    $(this).closest('.wb-form-item').find('.ui-sortable-handle').removeClass('error');
                    $(this).closest('.wb-form-item').find('.error-message').addClass('fb_hidden');
                }
            });
            if(check){
                return false;
            }

            //Check name
            check = false;
            $('.wb-form-item .edit-form-item-name').each(function(){
                $('.wb-form-item .edit-form-item-name').each(function(){
                    var t = $(this);
                    if(!/^[a-zA-Z0-9._]*$/g.test(t.val())){
                        check = true;
                        $(this).closest('.wb-form-item').find('.ui-sortable-handle').addClass('error');
                        $(this).closest('.wb-form-item').find('.error-message').text(wb_fb_param.error_field_name_contain_special);
                        $(this).closest('.wb-form-item').find('.error-message').removeClass('fb_hidden');
                    }else{
                        $(this).closest('.wb-form-item').find('.ui-sortable-handle').removeClass('error');
                        $(this).closest('.wb-form-item').find('.error-message').addClass('fb_hidden');
                    }
                });
            });

            if(check){
                return false;
            }

            //Check name
            check = false;
            $('.wb-form-item .edit-form-item-name').each(function() {
                var t = $(this);
                $('.wb-form-item .edit-form-item-name').not($(this)).each(function () {
                    if (t.val() == $(this).val()) {
                        check = true;
                        $(this).closest('.wb-form-item').find('.ui-sortable-handle').addClass('error');
                        $(this).closest('.wb-form-item').find('.error-message').text(wb_fb_param.error_field_name_iden);
                        $(this).closest('.wb-form-item').find('.error-message').removeClass('fb_hidden');
                    }
                });
            });

            if(check){
                return false;
            }
        }
    });

});