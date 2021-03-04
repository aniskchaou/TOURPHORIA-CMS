/**
 * Created by NASANJI on 12/20/2016.
 */
jQuery(document).ready(function($){
    //Upload Image
    $(document).on('click', '.wb-upload-fields .wb-upload-image', function(e){
        e.preventDefault();
        var media;
        var p = $(this).closest('.wb-upload-fields');
        media = wp.media.frames.file_frame = wp.media({
            title: 'Upload Image',
            button: {
                text: 'Select',
            },
            multiple: false
        });
        media.on('select', function(){
            var attachment = media.state().get('selection').first().toJSON();
            if( typeof attachment.url == 'string' && attachment.url != ''){
                p.find('.wb-load-image').empty();
                var html = '';
                if(attachment.type == 'image') {
                    p.find('.wb-load-image').removeClass('st-upload-media-type');
                    html = '<img src="' + attachment.url + '" alt="" class="frontend-image img-responsive">' +
                        '<a class="delete" href="javascript:void(0);">&times;</a>';
                }else if(attachment.type == 'application'){
                    html = '<div class="st-media-upload">';
                    html += '<span class="st-media-name">'+ attachment.filename +' (<small>'+ attachment.filesizeHumanReadable +'</small>)</span>';
                    html += '</div>';
                    html += '<a class="delete" href="javascript:void(0);">&times;</a>';
                    p.find('.wb-load-image').addClass('st-upload-media-type');
                }
                p.find('.wb-load-image').append(html);
            }
            p.find('.wb-upload-image-save').val(attachment.id);
        });
        media.open();
    });

    $(document).on('click', '.wb-load-image .delete', function (e) {
        e.preventDefault();
        $(this).closest('.wb-upload-fields').find('.wb-load-image').empty();
        $('.wb-upload-fields .wb-upload-image-save').val('');
    })

});