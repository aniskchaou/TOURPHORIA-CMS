/**
 * Created by me664 on 11/24/14.
 */
jQuery(document).ready(function($){

    if($('select[name="include_products-type"]').length > 0) {
        $('select[name="include_products-type"]').find('option').eq(0).remove();
    }

    function repoFormatResult(state) {
        if (!state.id) return state.name; // optgroup
        return state.name+'<p><em>'+state.description+'</em></p>';
    }
    $('.st_product_select_ajax').each(function(){
        var me=$(this);
        console.log(me.closest('.format-setting-inner').find('select').val());
        $(this).select2({
            multiple:true,
            placeholder: me.data('placeholder'),
            minimumInputLength:2,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: ajaxurl,
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term,
                        action:'st_product_select_ajax',
                        post_type:me.closest('.format-setting-inner').find('select').val()
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter the remote JSON data
                    return { results: data.items };
                },
                cache: true
            },
            initSelection: function(element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected repository's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the repository name is shown preselected
                var id = $(element).val();

                if (id !== "") {
                    old_data=$(element).data('old');

                    callback(old_data);
                }
            },
            formatResult: repoFormatResult,
            formatSelection: repoFormatResult,
            escapeMarkup: function(m) { return m; }
        });
    });
});/**
 * Created by me664 on 12/4/14.
 */
