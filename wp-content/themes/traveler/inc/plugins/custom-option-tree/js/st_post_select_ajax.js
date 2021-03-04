/**
 * Created by me664 on 11/24/14.
 */
jQuery(document).ready(function($){

    $('.st_post_select_ajax').each(function(){
        var me=$(this);
        $(this).select2({
            placeholder: me.data('placeholder'),
            minimumInputLength:2,
            allowClear: true,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: ajaxurl,
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term,
                        action:'st_post_select_ajax',
                        post_type:me.data('post-type')
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
                    var data={
                        id:id,
                        name:$(element).data('pl-name'),
                        description:$(element).data('pl-desc')
                    };
                    callback(data);
                }
            },
            formatResult: function(state){
                if (!state.id) return state.name; // optgroup
                return state.name+'<p><em>'+state.description+'</em></p>';
            },
            formatSelection: function(state){
                if (!state.id) return state.name; // optgroup
                return state.name+'<p><em>'+state.description+'</em></p>';
            },
            escapeMarkup: function(m) { return m; }
        });
    });
});