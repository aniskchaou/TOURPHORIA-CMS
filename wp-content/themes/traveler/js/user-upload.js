jQuery(document).ready(function ($) {
    'use strict';
    var media_uploader;
    $('body').on('click', '.upload-button-partner', function (event) {
        event.preventDefault();
        var parent = $(this).closest('.upload-partner-wrapper');
        media_uploader = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {text: $(this).data('uploader_button_text'),},
            multiple: !1
        });
        media_uploader.open();
        select_media(parent)
    });

    function select_media(parent) {
        media_uploader.on("select", function (event) {
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            if (typeof image_url == 'string' && image_url != '') {
                var html = '<div class="upload-item"> ' + '<img src="' + image_url + '" alt="" class="frontend-image img-responsive">' + '<a class="delete" href="javascript:void(0);">&times;</i></a>' + '</div>';
                $('.upload-items', parent).html(html)
            } else {
                $('.upload-items', parent).empty()
            }
            $('.save-image-id', parent).val(json.id)
        })
    }

    $('body').on('click', '.upload-button-partner-link', function (event) {
        event.preventDefault();
        var parent = $(this).closest('.upload-partner-wrapper-link');
        media_uploader = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {text: $(this).data('uploader_button_text'),},
            multiple: !1
        });
        select_media_link(parent)
    });

    function select_media_link(parent) {
        media_uploader.open();
        media_uploader.on("select", function (event) {
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            if (typeof image_url == 'string' && image_url != '') {
                var html = '<div class="upload-item"> ' + '<img src="' + image_url + '" alt="" class="frontend-image img-responsive">' + '<a class="delete" href="javascript:void(0);">&times;</i></a>' + '</div>';
                $('.upload-items', parent).html(html);
                $('.save-image-url', parent).val(image_url)
            } else {
                $('.upload-items', parent).empty()
            }
        })
    }

    $('body').on('click', '.delete', function (event) {
        event.preventDefault();
        $(this).closest('.upload-wrapper').find('input').val('');
        $(this).closest('.upload-item').remove()
    });
    $('body').on('click', '.upload-mul-partner-wrapper .delete-gallery', function (event) {
        event.preventDefault();
        $(this).closest('.upload-mul-partner-wrapper').find('.upload-items').empty()
    });
    $('body').on('click', '.upload-button-partner-multi', function (event) {
        event.preventDefault();
        var parent = $(this).closest('.upload-mul-partner-wrapper');
        select_media_multi(parent)
    });

    function select_media_multi(parent) {
        media_uploader = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {text: $(this).data('uploader_button_text'),},
            multiple: !0
        });
        media_uploader.open();
        media_uploader.on("select", function () {
            var length = media_uploader.state().get("selection").length;
            var images = media_uploader.state().get("selection").models;
            var html = '';
            var id_string = '';
            console.log(length);
            for (var i = 0; i < length; i++) {
                var image_url = images[i].changed.url;
                var image_caption = images[i].changed.caption;
                var image_title = images[i].changed.title;
                console.log(images[i]);
                if (typeof image_url == 'string' && image_url != '') {
                    html += '<div class="upload-item"> ' + '<img src="' + image_url + '" alt="" class="frontend-image img-responsive">' + '</div>';
                    id_string += images[i].id + ','
                }
            }
            if (html != '') {
                $('.upload-items', parent).html(html)
            } else {
                $('.upload-items', parent).empty()
            }
            if (id_string != '') {
                id_string = id_string.substr(0, id_string.length - 1)
            }
            $('.save-image-id', parent).val(id_string)
        })
    }

    $('body').on('click', '.tab-item .tab-title', function () {
        var parent = $(this).next().slideToggle()
    });
    $('body').on('click', '.add-list-item', function () {
        var target = $(this).data('get-html');
        var html = $(target).html();
        var parent = $(this).parent();
        $('.list-properties', parent).append(html);
        return !1
    })
    $('body').on('keyup', '.tab-item .tab-content-title', function () {
        var val = $(this).val();
        $(this).closest('.tab-item').find('.tab-title').html(val)
    });
    $('body').on('click', '.delete-tab-item', function () {
        $(this).closest('.tab-item').remove()
    });
    $('body').on('click', '.st_icon_picker', function () {
        $(this).iconpicker({icons: st_icon_picker.icon_list, iconClassPrefix: ' '})
    })
})