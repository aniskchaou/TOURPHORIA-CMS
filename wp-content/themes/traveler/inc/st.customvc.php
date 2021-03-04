<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom VC element
 *
 * Created by ShineTheme
 *
 */

if(function_exists('vc_add_shortcode_param') and class_exists( 'Vc_Manager' )) {
    if(!function_exists( 'st_css_classes_for_vc_row_and_vc_column' )) {
        function st_css_classes_for_vc_row_and_vc_column( $class_string , $tag )
        {
            if($tag == 'vc_row' || $tag == 'vc_row_inner') {
                $class_string = str_replace( 'vc_row-fluid' , '' , $class_string );
            }
            if(defined( 'WPB_VC_VERSION' )) {
                if(version_compare( WPB_VC_VERSION , '4.2.3' , '>' )) {
                    if($tag == 'vc_column' || $tag == 'vc_column_inner') {
                        //$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-lg-$1', $class_string);
                        $class_string = str_replace( 'vc_col' , 'col' , $class_string );
                        $class_string = str_replace( 'col-sm' , 'col-md' , $class_string );
                        $class_string = str_replace( 'col-md2' , 'col-sm' , $class_string );
                    }
                } else {
                    if($tag == 'vc_column' || $tag == 'vc_column_inner') {
                        $class_string = preg_replace( '/vc_span(\d{1,2})/' , 'col-lg-$1' , $class_string );
                        $class_string = str_replace( 'col-sm' , 'col-md' , $class_string );
                        $class_string = str_replace( 'col-md2' , 'col-sm' , $class_string );
                    }
                }
            }
            return $class_string;
        }

    }
// Filter to Replace default css class for vc_row shortcode and vc_column
    add_filter( 'vc_shortcodes_css_class' , 'st_css_classes_for_vc_row_and_vc_column' , 10 , 2 );
// Add new Param in Row
    if(function_exists( 'vc_add_param' )) {
        vc_add_param( 'vc_row' , array(
                "type"       => "dropdown" ,
                "heading"    => __( 'Full Width' , ST_TEXTDOMAIN ) ,
                "param_name" => "row_fullwidth" ,
                "value"      => array(
                    __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                ) ,
            )
        );
        vc_add_param( 'vc_row' , array(
                "type"        => "dropdown" ,
                "heading"     => __( 'Parallax' , ST_TEXTDOMAIN ) ,
                "param_name"  => "parallax_class" ,
                "value"       => array(
                    __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                ) ,
                "description" => __( "You can choose yes to display Parallax Effect" , ST_TEXTDOMAIN ) ,
            )
        );
        vc_add_param( 'vc_row' , array(
                "type"       => "dropdown" ,
                "heading"    => __( 'Background Video' , ST_TEXTDOMAIN ) ,
                "param_name" => "bg_video" ,
                "value"      => array(
                    __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                ) ,
            )
        );
        vc_add_param( 'vc_row' , array(
                "type"       => "st_poster_media" ,
                "heading"    => __( 'Poster Media video' , ST_TEXTDOMAIN ) ,
                "param_name" => "st_poster_media" ,
            )
        );
        vc_add_param( 'vc_row' , array(
                "type"       => "st_media" ,
                "heading"    => __( 'Media video' , ST_TEXTDOMAIN ) ,
                "param_name" => "st_media" ,
            )
        );
        vc_add_param( 'vc_row' , array(
                "type"        => "textfield" ,
                "heading"     => __( 'Input ID element' , ST_TEXTDOMAIN ) ,
                "param_name"  => "row_id" ,
                "value"       => '' ,
                "description" => __( "Row ID" , ST_TEXTDOMAIN ) ,
            )
        );
    }
    if(!function_exists( 'st_media_settings_field' )) {
        function st_media_settings_field( $settings , $value )
        {
            $dependency = '';//vc_generate_dependencies_attributes($settings);
            return '<div class="my_param_block">'
            . '<input id="st_url_media" name="' . $settings[ 'param_name' ]
            . '" class="wpb_vc_param_value wpb-textinput '
            . $settings[ 'param_name' ] . ' ' . $settings[ 'type' ] . '_field" type="text" value="'
            . $value . '" ' . $dependency . '/>'
            . '</div>'
            . '<button id="btn_add_media" class="vc_btn vc_panel-btn-save vc_btn-primary">'.__("Upload",ST_TEXTDOMAIN).'</button>' // New button element
            . "<script>
        jQuery(document).ready(function($){
            var _custom_media = true,
                _orig_send_attachment = wp.media.editor.send.attachment;
            $('#btn_add_media').click(function(e) {
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(this);

                _custom_media = true;
                wp.media.editor.send.attachment = function(props, attachment){
                    if ( _custom_media ) {
                        $('#st_url_media').val(attachment.url);
                    } else {
                        return _orig_send_attachment.apply( this, [props, attachment] );
                    };
                }
                wp.media.editor.open(button);
                return false;
            });
            $('.add_poster_media').on('click', function(){
                _custom_media = false;
            });
        });
    </script>";
        }
    }
    if(!function_exists( 'st_poster_media_settings_field' )) {
        function st_poster_media_settings_field( $settings , $value )
        {
            $dependency = '';//vc_generate_dependencies_attributes($settings);
            return '<div class="my_param_block">'
            . '<input id="st_url_poster_media" name="' . $settings[ 'param_name' ]
            . '" class="wpb_vc_param_value wpb-textinput '
            . $settings[ 'param_name' ] . ' ' . $settings[ 'type' ] . '_field" type="text" value="'
            . $value . '" ' . $dependency . '/>'
            . '</div>'
            . '<button id="btn_add_poster_media" class="vc_btn vc_panel-btn-save vc_btn-primary">'.__("Upload",ST_TEXTDOMAIN).'</button>' // New button element
            . "<script>
        jQuery(document).ready(function($){
            var _custom_media = true,
                _orig_send_attachment = wp.media.editor.send.attachment;
            $('#btn_add_poster_media').click(function(e) {
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(this);

                _custom_media = true;
                wp.media.editor.send.attachment = function(props, attachment){
                    if ( _custom_media ) {
                        $('#st_url_poster_media').val(attachment.url);
                    } else {
                        return _orig_send_attachment.apply( this, [props, attachment] );
                    };
                }
                wp.media.editor.open(button);
                return false;
            });
            $('.add_poster_media').on('click', function(){
                _custom_media = false;
            });
        });
    </script>";
        }
    }
    vc_add_param( 'vc_tab' , array(
            "type"        => "textfield" ,
            "heading"     => __( 'Tab Icon' , ST_TEXTDOMAIN ) ,
            "param_name"  => "tab_icon" ,
            "value"       => '' ,
            "description" => __( "Icon next to the tab title" , ST_TEXTDOMAIN ) ,
        )
    );
    vc_add_param( 'vc_tabs' , array(
            "type"        => "dropdown" ,
            "heading"     => __( 'Tab Style' , ST_TEXTDOMAIN ) ,
            "param_name"  => "tab_style" ,
            "value"       => array(
                __( "--- Select ---" , ST_TEXTDOMAIN ) => "" ,
                __( "Search tab" , ST_TEXTDOMAIN ) => "search_tab" ,
                __( "Single tab" , ST_TEXTDOMAIN ) => "single_tab" ,
            ) ,
            "description" => __( "Select tab style" , ST_TEXTDOMAIN ) ,
        )
    );
    if(!function_exists( 'st_post_type_location_settings_field' )) {
        function st_post_type_location_settings_field( $settings , $value )
        {
            $dependency = '';
            $query      = array(
                'post_type' => 'location' ,
                'post__in'  => explode( ',' , $value ),
                'posts_per_page' => -1 ,
            );
            $txt        = '';
            $list       = query_posts( $query );
            while( have_posts() ) {
                the_post();
                $txt .= '{id: "' . get_the_ID() . '", name: "' . get_the_title() . '" , description:  "ID: ' . get_the_ID() . '" },';
            }
            wp_reset_query();
            if(!is_singular( 'product' ) && !is_singular('shop_order' )){
                wp_enqueue_script( 'select2.js' );
                wp_enqueue_script( 'select2-lang' );
                wp_enqueue_style( 'st-select2' );
            }
            return '<div class="my_param_block">'
            . '<input id="st_location" name="' . $settings[ 'param_name' ]
            . '" class="st_pt_location st_post_select_ajax wpb_vc_param_value wpb-textinput '
            . $settings[ 'param_name' ] . ' ' . $settings[ 'type' ] . '_field" type="text" value="'
            . $value . '" ' . $dependency . ' data-post-type="location" multiple />'
            . '</div>'
            . "<script>
                jQuery(document).ready(function($){
                    $('.st_pt_location').each(function(){
                        var me=$(this);
                        $(this).select2({
                            placeholder: me.data('placeholder'),
                            minimumInputLength:2,
                            allowClear: true,
                            multiple: true,
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
                                var data = [" . $txt . "];
                                callback(data);
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
            </script>
            <style>.select2-drop{z-index:999999;}
                   .select2-container{width:100%;}
                   .select2-search-choice p{line-height:0}
            </style>";
        }

    }
    /**
     *
     *
     * @since 1.1.5
     * */
    if(!function_exists( 'st_post_type_location_2_settings_field' )) {
        function st_post_type_location_2_settings_field( $settings , $value )
        {
            $dependency = '';
            $query      = array(
                'post_type' => 'location' ,
                'post__in'  => explode( ',' , $value ),
                'posts_per_page' => -1 ,
            );
            $txt        = '{}';
            query_posts( $query );
            while( have_posts() ) {
                the_post();
                $txt = '{id: "' . get_the_ID() . '", name: "' . get_the_title() . '" , description:  "ID: ' . get_the_ID() . '" }';
            }
            wp_reset_query(); wp_reset_postdata();
            return '<div class="my_param_block">'
            . '<input id="st_location" name="' . $settings[ 'param_name' ]
            . '" class="st_pt_location_2 wpb_vc_param_value wpb-textinput '
            . $settings[ 'param_name' ] . ' ' . $settings[ 'type' ] . '_field" type="text" value="'
            . $value . '" ' . $dependency . ' data-post-type="location" />'
            . '</div>'
            . "<script>
                jQuery(document).ready(function($){
                    $('.st_pt_location_2').each(function(){
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
                                var data = ".$txt.";
                                console.log(data);
                                callback(data);
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
            </script>
            <style>.select2-drop{z-index:999999;}
                   .select2-container{width:100%;}
                   .select2-search-choice p{line-height:0}
            </style>";
        }

    }
    vc_add_shortcode_param( 'st_media' , 'st_media_settings_field' );
    vc_add_shortcode_param( 'st_poster_media' , 'st_poster_media_settings_field' );
    vc_add_shortcode_param( 'st_post_type_location' , 'st_post_type_location_settings_field' );
    /**
     *
     *
     * @since 1.1.5
     * */
    vc_add_shortcode_param( 'st_post_type_location_2' , 'st_post_type_location_2_settings_field' );
    /*if(function_exists('vc_st_reg_shortcode_param'))
    {
        vc_st_reg_shortcode_param('st_media', 'st_media_settings_field');
        vc_st_reg_shortcode_param('st_post_type_location', 'st_post_type_location_settings_field');
    }*/

    if(!function_exists( 'st_post_type_hotel_settings_field' )) {
        function st_post_type_hotel_settings_field( $settings , $value )
        {
            $dependency = '';
            $query      = array(
                'post_type' => 'st_hotel' ,
                'post__in'  => explode( ',' , $value ),
                'posts_per_page' => -1 ,
            );
            $txt        = '';
            $list       = query_posts( $query );
            while( have_posts() ) {
                the_post();
                $txt .= '{id: "' . get_the_ID() . '", name: "' . get_the_title() . '" , description:  "ID: ' . get_the_ID() . '" },';
            }
            wp_reset_query(); wp_reset_postdata();
            return '<div class="my_param_block">'
            . '<input id="st_location" name="' . $settings[ 'param_name' ]
            . '" class="st_pt_hotel st_post_select_ajax wpb_vc_param_value wpb-textinput '
            . $settings[ 'param_name' ] . ' ' . $settings[ 'type' ] . '_field" type="text" value="'
            . $value . '" ' . $dependency . ' data-post-type="st_hotel" multiple />'
            . '</div>'
            . "<script>
                jQuery(document).ready(function($){
                    $('.st_pt_hotel').each(function(){
                        var me=$(this);
                        $(this).select2({
                            placeholder: me.data('placeholder'),
                            minimumInputLength:2,
                            allowClear: true,
                            multiple: true,
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
                                var data = [" . $txt . "];
                                callback(data);
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
            </script>
            <style>.select2-drop{z-index:999999;}
                   .select2-container{width:100%;}
                   .select2-search-choice p{line-height:0}
            </style>";
        }

    }
    vc_add_shortcode_param( 'st_post_type_hotel' , 'st_post_type_hotel_settings_field' );

    vc_add_shortcode_param( 'st_list_location' , 'st_list_location' );

    if(!function_exists('st_list_location')) {
        function st_list_location($settings, $value)
        {
            $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
            $list_location = TravelHelper::treeLocationHtml();

            $output_html = '<select name="'.$param_name.'" class="wpb_vc_param_value wpb-input wpb-select '.$param_name.'" data-option="">';
            $output_html .= '<option class="" value="">'.esc_html__('-- Select --',ST_TEXTDOMAIN).'</option>';
            if($list_location) {
                foreach ($list_location as $key => $location) {
                    $level_html = '';

                    for($i = 1;$i <= $location['level']/20;$i++){
                        $level_html .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                    }
                    $output_html .= '<option class="level-'.$location['level'].'" '.($value==$location['ID']?'selected':'').' value="'.$location['ID'].'">'.balanceTags($level_html).$location['post_title'].'</option>';
                }
            }
            $output_html .= '<select>';
            return $output_html;

        }
    }

    vc_add_shortcode_param( 'st_tp_locations' , 'st_tp_field_get_locations' );

    if(!function_exists('st_tp_field_get_locations')) {
        function st_tp_field_get_locations($settings, $value)
        {
            $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
            $location_type = isset($settings['location_type']) ? $settings['location_type'] : '';
            $placeholder = isset($settings['heading']) ? $settings['heading'] : '';
            $locale_default = st()->get_option('tp_locale_default', 'en');


            if ($location_type == 'flight') {
                parse_str(urldecode($value),$old_data);
                $location_text = $location_id = '';
                if(!empty($old_data['location_id'])){
                    $location_text = $old_data['location_text'];
                    $location_id = $old_data['location_id'];
                }
                $html = "<div class='form-group st-tp-field-flights'>
                        <div class='st-select-wrapper tp-flight-wrapper' >
                            <input id='location_origin-" . $param_name . "' type='text' data-locale='" . esc_attr($locale_default) . "' class='form-control tp-flight-location st-location-name' autocomplete='off' data-name='location_id' value='".($location_text)."' placeholder='" . esc_html($placeholder) . "'>
                            <input type='hidden' name='location_text' class='st-tp-flight-save' value='".$location_text."'>
                            <input type='hidden' name='location_id' class='st-tp-flight-save' value='".$location_id."'>
                        </div>
                        <input name='" .$param_name . "' class='st-tp-location-flight-value wpb_vc_param_value wpb-textinput " . $param_name . " " . $settings['type'] . "_field' type='hidden' value='".$value."'>
                    </div>
                    <script>
                    jQuery(document).ready(function($) {
                        $('.vc_ui-button-fw').on('click', function() {
                            $('.st-tp-field-flights').each(function(){
                                var value = $(this).find('.st-tp-flight-save').serialize();
                                $(this).find('.st-tp-location-flight-value').val( encodeURIComponent(value) );
                            });
                        });
                        var last_select_clicked = !1;

                            $('.tp-flight-location').each(function() {
                                var t = $(this);
                                var parent = t.closest('.tp-flight-wrapper');
                                $(this).keyup(function(event) {

                                    $('.st-tp-field-flights .st-option-wrapper').remove();
                                    if(!$('.st-tp-field-flights .st-option-wrapper').length > 0){
                                        t.closest('.st-tp-field-flights').append('<div class=\"option-wrapper st-option-wrapper\"></div>');
                                    }
                                    last_select_clicked = t;
                                    parent.find('.st-location-id').remove();
                                    var name = t.attr('data-name');
                                    var locale = t.attr('data-locale');
                                    var val = t.val();
                                    if (val.length >= 2) {
                                        $.getJSON('https://autocomplete.travelpayouts.com/jravia?locale=' + locale + '&with_countries=false&q=' + val, function(data) {
                                            if (typeof data == 'object') {
                                                var html = '';
                                                html += '<select name=\"' + name + '\" class=\"st-location-id st-hidden st-tp-flight-save \" tabindex=\"-1\">';
                                                $.each(data, function(key, value) {
                                                    var f_name = '';
                                                    if (value.name != null) {
                                                        f_name = '(' + value.name + ')'
                                                    }
                                                    html += '<option value=\"' + value.code + '\">' + value.city_fullname + ' ' + f_name + ' - ' + value.code + '</option>'
                                                });
                                                html += '</select>';
                                                parent.find('.st-location-id').remove();
                                                parent.find('input[name=location_id]').remove();
                                                parent.append(html);
                                                html = '';
                                                $('select option', parent).prop('selected', !1);
                                                $('select option', parent).each(function(index, el) {
                                                    var country = $(this).data('country');
                                                    var text = $(this).text();
                                                    var text_split = text.split('||');
                                                    text_split = text_split[0];
                                                    var highlight = get_highlight(text, val);
                                                    if (highlight.indexOf('</span>') >= 0) {
                                                        var current_country = $(this).parent('select').attr('data-current-country');
                                                        if (typeof current_country != 'undefined' && current_country != '') {
                                                            if (country == current_country) {
                                                                html += '<div data-text=\"' + text + '\" data-country=\"' + country + '\" data-value=\"' + $(this).val() + '\" class=\"option\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '</a></div>'
                                                            }
                                                        } else {
                                                            html += '<div data-text=\"' + text + '\" data-country=\"' + country + '\" data-value=\"' + $(this).val() + '\" class=\"option\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '</a></div>'
                                                        }
                                                    }
                                                });
                                                t.closest('.st-tp-field-flights').find('.option-wrapper').html(html).show();
                                                t.caculatePosition(t.closest('.st-tp-field-flights').find('.option-wrapper'), t);
                                                t.clickOption();
                                            }
                                        })
                                    }
                                });
                                t.caculatePosition = function() {
                                    if (!last_select_clicked || !last_select_clicked.length) return;
                                    var wraper = $('.option-wrapper');
                                    var input_tag = last_select_clicked;
                                    var width = input_tag.outerWidth();
                                    var z_index = 99999;
                                    var position = 'absolute';
                                    wraper.css({
                                        position: position,
                                        top: '100%',
                                        left: 0,
                                        width: width,
                                        'z-index': z_index
                                    })
                                };
                                t.clickOption = function(){
                                    $(document).on('click','.st-option-wrapper .option a', function(e){
                                        e.preventDefault();
                                        p = $(this).closest('.option');
                                        var text = p.data('text');
                                        var value = p.data('value');
                                        last_select_clicked.val(text);
                                        $(this).closest('.st-tp-field-flights').find('select option[value='+value+']').attr('selected','selected');
                                        $(this).closest('.st-tp-field-flights').find('input[name=location_text]').val(text);
                                        $(this).closest('.st-option-wrapper').hide();
                                    });
                                };
                                $(window).resize(function() {
                                    t.caculatePosition()
                                })
                            });

                            function get_highlight(text, val) {
                                var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class=\"highlight\">$&</span>');
                                return highlight
                            }
                        });
                    </script>";
                return $html;
            }
            if ($location_type == 'hotel_id') {
                parse_str(urldecode($value),$old_data);
                $h_text = $h_id = '';
                if(!empty($old_data['h_id'])){
                    $h_text = $old_data['h_text'];
                    $h_id = $old_data['h_id'];
                }
                $html = "<div class='form-group st-tp-field-hotel-id'>
                        <div class='st-select-wrapper tp-hotel-wrapper' >
                            <input id='hotel_id" . $param_name . "".time()."' type='text' data-locale='" . esc_attr($locale_default) . "' class='form-control tp-hotel-id st-location-name' autocomplete='off' data-name='h_id' value='".($h_text)."' placeholder='" . esc_html($placeholder) . "'>
                            <input type='hidden' name='h_text' class='st-tp-hotel-id-save' value='".$h_text."'>
                            <input type='hidden' name='h_id' class='st-tp-hotel-id-save' value='".$h_id."'>
                        </div>
                        <input name='" .$param_name . "' class='st-tp-hotel-id-value wpb_vc_param_value wpb-textinput " . $param_name . " " . $settings['type'] . "_field' type='hidden' value='".$value."'>
                    </div>
                    <script>
                    jQuery(document).ready(function($) {
                        $('.vc_ui-button-fw').on('click', function() {
                            $('.st-tp-field-hotel-id').each(function(){
                                var value = $(this).find('.st-tp-hotel-id-save').serialize();
                                $(this).find('.st-tp-hotel-id-value').val( encodeURIComponent(value) );
                            });
                        });
                        var last_select_clicked = !1;

                            $('.tp-hotel-id').each(function() {
                                var t = $(this);
                                var parent = t.closest('.tp-hotel-wrapper');
                                $(this).keyup(function(event) {

                                    $('.st-tp-field-hotel-id .st-option-wrapper').remove();

                                    t.closest('.st-tp-field-hotel-id').append('<div class=\"option-wrapper st-option-wrapper\"></div>');

                                    last_select_clicked = t;
                                    parent.find('.st-hotel-id').remove();
                                    var name = t.attr('data-name');
                                    var locale = t.attr('data-locale');
                                    var val = t.val();
                                    if (val.length >= 2) {
                                        $.getJSON('https://engine.hotellook.com/api/v2/lookup.json?query=' + val + '&lang=' + locale + '&limit=5', function(data) {
                                            if (typeof data == 'object') {
                                                var html = '';
                                                html += '<select name=\"' + name + '\" class=\"st-hotel-id st-hidden st-tp-hotel-id-save \" tabindex=\"-1\">';
                                                $.each(data.results.hotels, function(key, value) {
                                                    console.log(value);
                                                    html += '<option data-type=\"hotel\" value=\"' + value.id + '\">' + value.fullName + '</option>'
                                                });
                                                html += '</select>';
                                                parent.find('.st-hotel-id').remove();
                                                parent.find('input[name=h_id]').remove();
                                                parent.append(html);
                                                html = '';
                                                $('select option', parent).prop('selected', !1);
                                                $('select option', parent).each(function(index, el) {
                                                    var text = $(this).text();
                                                    var text_split = text.split(\"||\");
                                                    text_split = text_split[0];
                                                    var highlight = get_highlight(text, val);
                                                    if (highlight.indexOf('</span>') >= 0) {
                                                        if ($(this).data('type') == 'location') {
                                                            html += '<div data-text=\"' + text + '\" data-value=\"' + $(this).val() + '\" class=\"option1\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '<i class=\"fa fa-map-marker\"></i></a>' + '</div>'
                                                        } else {
                                                            html += '<div data-text=\"' + text + '\" data-value=\"' + $(this).val() + '\" class=\"option1\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '<i class=\"fa fa-building\"></i></a>' + '</div>'
                                                        }
                                                    }
                                                });
                                                t.closest('.st-tp-field-hotel-id').find('.option-wrapper').html(html).show();
                                                t.caculatePosition(t.closest('.st-tp-field-hotel-id').find('.option-wrapper'), t);
                                                t.clickOption();
                                            }
                                        })
                                    }
                                });
                                t.caculatePosition = function() {
                                    if (!last_select_clicked || !last_select_clicked.length) return;
                                    var wraper = $('.option-wrapper');
                                    var input_tag = last_select_clicked;
                                    var width = input_tag.outerWidth();
                                    var z_index = 99999;
                                    var position = 'absolute';
                                    wraper.css({
                                        position: position,
                                        top: '100%',
                                        left: 0,
                                        width: width,
                                        'z-index': z_index
                                    })
                                };
                                t.clickOption = function(){
                                    $(document).on('click','.st-option-wrapper .option1 a', function(e){
                                        e.preventDefault();
                                        p = $(this).closest('.option1');
                                        var text = p.data('text');
                                        var value = p.data('value');
                                        $(this).closest('.st-tp-field-hotel-id').find('.tp-hotel-id').val(text);
                                        $(this).closest('.st-tp-field-hotel-id').find('select option[value='+value+']').attr('selected','selected');
                                        $(this).closest('.st-tp-field-hotel-id').find('input[name=h_text]').val(text);
                                        $(this).closest('.st-option-wrapper').hide();
                                    });
                                };
                                $(window).resize(function() {
                                    t.caculatePosition()
                                })
                            });

                            function get_highlight(text, val) {
                                var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class=\"highlight\">$&</span>');
                                return highlight
                            }
                        });
                    </script>";
                return $html;
            }
            if ($location_type == 'hotel_map') {
                parse_str(urldecode($value),$old_data);
                $h_text = $h_id = '';
                if(!empty($old_data['hotel_map'])){
                    $h_text = $old_data['hotel_map_text'];
                    $h_id = $old_data['hotel_map'];
                }
                $html = "<div class='form-group st-tp-field-hotel-map'>
                        <div class='st-select-wrapper tp-hotel-map-wrapper' >
                            <input id='hotel_map" . $param_name . "' type='text' data-text='".esc_html('hotels', ST_TEXTDOMAIN)."' data-locale='" . esc_attr($locale_default) . "' class='form-control tp-hotel-map st-location-name' autocomplete='off' data-name='hotel_map' value='".($h_text)."' placeholder='" . esc_html($placeholder) . "'>
                            <input type='hidden' name='hotel_map_text' class='st-tp-hotel-map-save' value='".$h_text."'>
                            <input type='hidden' name='hotel_map' class='st-tp-hotel-map-save' value='".$h_id."'>
                        </div>
                        <input name='" .$param_name . "' class='st-tp-hotel-map-value wpb_vc_param_value wpb-textinput " . $param_name . " " . $settings['type'] . "_field' type='hidden' value='".$value."'>
                    </div>
                    <script>
                    jQuery(document).ready(function($) {
                        $('.vc_ui-button-fw').on('click', function() {
                            $('.st-tp-field-hotel-map').each(function(){
                                var value = $(this).find('.st-tp-hotel-map-save').serialize();
                                $(this).find('.st-tp-hotel-map-value').val( encodeURIComponent(value) );
                            });
                        });
                        var last_select_clicked = !1;

                            $('.tp-hotel-map').each(function() {
                                var t = $(this);
                                var parent = t.closest('.tp-hotel-map-wrapper');
                                $(this).keyup(function(event) {

                                    $('.st-tp-field-hotel-map .st-option-wrapper').remove();

                                    t.closest('.st-tp-field-hotel-map').append('<div class=\"option-wrapper st-option-wrapper\"></div>');

                                    last_select_clicked = t;
                                    parent.find('.st-hotel-map').remove();
                                    var name = t.attr('data-name');
                                    var locale = t.attr('data-locale');
                                    var val = t.val();
                                    if (val.length >= 2) {
                                        $.getJSON('https://engine.hotellook.com/api/v2/lookup.json?query=' + val + '&lang=' + locale + '&limit=5', function(data) {
                                            if (typeof data == 'object') {
                                                var html = '';
                                                html += '<select name=\"' + name + '\" class=\"st-hotel-map st-hidden st-tp-hotel-map-save \" tabindex=\"-1\">';

                                                $.each(data.results.locations, function(key, value) {
                                                    html += '<option data-type=\"location\" value=\"lat\=' + value.location.lat + '&lng\='+value.location.lon+'\">' + value.fullName + ' - ' + value.hotelsCount + ' ' + t.attr('data-text') + '</option>'
                                                });
                                                $.each(data.results.hotels, function(key, value) {
                                                    html += '<option data-type=\"hotel\" value=\"lat\=' + value.location.lat + '&lng\='+value.location.lon+'&hotel_id\='+ value.id +'\">' + value.fullName + '</option>'
                                                });
                                                html += '</select>';
                                                parent.find('.st-hotel-map').remove();
                                                parent.find('input[name=hotel_map]').remove();
                                                parent.append(html);
                                                html = '';
                                                $('select option', parent).prop('selected', !1);
                                                $('select option', parent).each(function(index, el) {
                                                    var text = $(this).text();
                                                    var text_split = text.split(\"||\");
                                                    text_split = text_split[0];
                                                    var highlight = get_highlight(text, val);
                                                    if (highlight.indexOf('</span>') >= 0) {
                                                        if ($(this).data('type') == 'location') {
                                                            html += '<div data-text=\"' + text + '\" data-value=\"' + $(this).val() + '\" class=\"option1\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '<i class=\"fa fa-map-marker\"></i></a>' + '</div>'
                                                        } else {
                                                            html += '<div data-text=\"' + text + '\" data-value=\"' + $(this).val() + '\" class=\"option1\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '<i class=\"fa fa-building\"></i></a>' + '</div>'
                                                        }
                                                    }
                                                });
                                                t.closest('.st-tp-field-hotel-map').find('.option-wrapper').html(html).show();
                                                t.caculatePosition(t.closest('.st-tp-field-hotel-map').find('.option-wrapper'), t);
                                                t.clickOption();
                                            }
                                        })
                                    }
                                });
                                t.caculatePosition = function() {
                                    if (!last_select_clicked || !last_select_clicked.length) return;
                                    var wraper = $('.option-wrapper');
                                    var input_tag = last_select_clicked;
                                    var width = input_tag.outerWidth();
                                    var z_index = 99999;
                                    var position = 'absolute';
                                    wraper.css({
                                        position: position,
                                        top: '100%',
                                        left: 0,
                                        width: width,
                                        'z-index': z_index
                                    })
                                };
                                t.clickOption = function(){
                                    $(document).on('click','.st-option-wrapper .option1 a', function(e){
                                        e.preventDefault();
                                        p = $(this).closest('.option1');
                                        var text = p.data('text');
                                        var value = p.data('value');
                                        $(this).closest('.st-tp-field-hotel-map').find('.tp-hotel-map').val(text);
                                        $(this).closest('.st-tp-field-hotel-map').find('select').val(value);
                                        $(this).closest('.st-tp-field-hotel-map').find('input[name=hotel_map_text]').val(text);
                                        $(this).closest('.st-option-wrapper').hide();
                                    });
                                };
                                $(window).resize(function() {
                                    t.caculatePosition()
                                })
                            });

                            function get_highlight(text, val) {
                                var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class=\"highlight\">$&</span>');
                                return highlight
                            }
                        });
                    </script>";
                return $html;
            }
            if ($location_type == 'city') {
                parse_str(urldecode($value),$old_data);
                $city_text = $city_id = '';
                if(!empty($old_data['city_id'])){
                    $city_text = $old_data['city_text'];
                    $city_id = $old_data['city_id'];
                    $city_selection = $old_data['city_avail'];
                }
                $selection_data = array(
                    '1stars' => esc_html__('1 star', ST_TEXTDOMAIN),
                    '2stars' => esc_html__('2 stars', ST_TEXTDOMAIN),
                    '3stars' => esc_html__('3 stars', ST_TEXTDOMAIN),
                    '4stars' => esc_html__('4 stars', ST_TEXTDOMAIN),
                    '5stars' => esc_html__('5 stars', ST_TEXTDOMAIN),
                    'price' => esc_html__('Cheap', ST_TEXTDOMAIN),
                    'center' => esc_html__('Close to city center', ST_TEXTDOMAIN),
                    'distance' => esc_html__('Distance', ST_TEXTDOMAIN),
                    'highprice' => esc_html__('Expensive', ST_TEXTDOMAIN),
                    'gay' => esc_html__('Gay friendly', ST_TEXTDOMAIN),
                    'lake_view' => esc_html__('Lake view', ST_TEXTDOMAIN),
                    'luxury' => esc_html__('Luxury', ST_TEXTDOMAIN),
                    'panoramic_view' => esc_html__('Panoramic view', ST_TEXTDOMAIN),
                    'pets' => esc_html__('Pet friendly', ST_TEXTDOMAIN),
                    'pool' => esc_html__('Pool', ST_TEXTDOMAIN),
                    'popularity' => esc_html__('Popularity', ST_TEXTDOMAIN),
                    'rating' => esc_html__('Rating', ST_TEXTDOMAIN),
                    'restaurant' => esc_html__('Restaurant', ST_TEXTDOMAIN),
                    'river_view' => esc_html__('River view', ST_TEXTDOMAIN),
                    'russians' => esc_html__('Russian guests', ST_TEXTDOMAIN),
                    'sea_view' => esc_html__('Sea view', ST_TEXTDOMAIN),
                    'tophotels' => esc_html__('Top hotels', ST_TEXTDOMAIN),
                );

                $avail_html = '';
                if(!empty($city_id)){
                    $json = file_get_contents('https://yasen.hotellook.com/tp/v1/available_selections.json?id='.$city_id);
                    if(!empty($json)){
                        $obj = json_decode($json);

                        $avail_html = '<div class="selection" ><p>'.esc_html__('Select selection', ST_TEXTDOMAIN).'</p>';
                        foreach($obj as $key => $val){
                            $old = !empty($city_selection[$key])?$city_selection[$key]:'';
                            $avail_html .= '<select name="city_avail[]" class="st-tp-hotel-city-save">';
                            $avail_html .= '<option value=""></option>';
                            foreach($obj as $k => $v){
                                if(!empty($selection_data[$v])) {
                                    $avail_html .= '<option '.selected($v,$old,false).' value="' . $v . '">' . $selection_data[$v] . '</option>';
                                }
                            }
                            $avail_html .= '</select>';
                            if($key == 2){
                                break;
                            }

                        }
                        $avail_html .= '</div>';
                    }

                }

                $html = "<div class='city-field'><div class='form-group st-tp-field-hotel-city'>
                        <div class='st-select-wrapper tp-hotel-city-wrapper' >
                            <input id='city_" . $param_name . "' type='text' data-avail='".(json_encode($selection_data))."' data-text='".esc_html('hotels', ST_TEXTDOMAIN)."' data-locale='" . esc_attr($locale_default) . "' class='form-control tp-hotel-city st-location-name' autocomplete='off' data-name='city_id' value='".($city_text)."' placeholder='" . esc_html($placeholder) . "'>
                            <input type='hidden' name='city_text' class='st-tp-hotel-city-save' value='".$city_text."'>
                            <input type='hidden' name='city_id' class='st-tp-hotel-city-save' value='".$city_id."'>
                        </div>
                        <input name='" .$param_name . "' class='st-tp-hotel-city-value wpb_vc_param_value wpb-textinput " . $param_name . " " . $settings['type'] . "_field' type='hidden' value='".$value."'>
                    </div>
                    ".($avail_html)."
                    </div>
                    <script>
                    jQuery(document).ready(function($) {
                        $('.vc_ui-button-fw').on('click', function() {
                            $('.st-tp-field-hotel-city').each(function(){
                                var value = $(this).closest('.city-field').find('.st-tp-hotel-city-save').serialize();
                                $(this).find('.st-tp-hotel-city-value').val( encodeURIComponent(value) );
                            });
                        });
                        var last_select_clicked = !1;

                            $('.tp-hotel-city').each(function() {
                                var t = $(this);
                                var parent = t.closest('.tp-hotel-city-wrapper');

                                $(this).keyup(function(event) {

                                    $('.st-tp-field-hotel-city .st-option-wrapper').remove();

                                    t.closest('.st-tp-field-hotel-city').append('<div class=\"option-wrapper st-option-wrapper\"></div>');

                                    last_select_clicked = t;
                                    parent.find('.st-hotel-city').remove();
                                    var name = t.attr('data-name');
                                    var locale = t.attr('data-locale');
                                    var val = t.val();
                                    if (val.length >= 2) {
                                        $.getJSON('https://engine.hotellook.com/api/v2/lookup.json?query=' + val + '&lang=' + locale + '&limit=10', function(data) {
                                            if (typeof data == 'object') {
                                                var html = '';
                                                html += '<select name=\"' + name + '\" class=\"st-hotel-city st-hidden st-tp-hotel-city-save \" tabindex=\"-1\">';

                                                $.each(data.results.locations, function(key, value) {
                                                    html += '<option data-type=\"location\" value=\"' + value.id + '\">' + value.fullName + '</option>'
                                                });

                                                html += '</select>';
                                                parent.find('.st-hotel-city').remove();
                                                parent.find('input[name=city_id]').remove();
                                                parent.append(html);
                                                html = '';
                                                $('select option', parent).prop('selected', !1);
                                                $('select option', parent).each(function(index, el) {
                                                    var text = $(this).text();
                                                    var text_split = text.split(\"||\");
                                                    text_split = text_split[0];
                                                    var highlight = get_highlight(text, val);
                                                    if (highlight.indexOf('</span>') >= 0) {
                                                        if ($(this).data('type') == 'location') {
                                                            html += '<div data-text=\"' + text + '\" data-value=\"' + $(this).val() + '\" class=\"option1\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '<i class=\"fa fa-map-marker\"></i></a>' + '</div>'
                                                        } else {
                                                            html += '<div data-text=\"' + text + '\" data-value=\"' + $(this).val() + '\" class=\"option1\">' + '<span class=\"label\"><a href=\"#\">' + text_split + '<i class=\"fa fa-building\"></i></a>' + '</div>'
                                                        }
                                                    }
                                                });
                                                t.closest('.st-tp-field-hotel-city').find('.option-wrapper').html(html).show();
                                                t.caculatePosition(t.closest('.st-tp-field-hotel-city').find('.option-wrapper'), t);

                                            }
                                        })
                                    }
                                });
                                t.caculatePosition = function() {
                                    if (!last_select_clicked || !last_select_clicked.length) return;
                                    var wraper = $('.option-wrapper');
                                    var input_tag = last_select_clicked;
                                    var width = input_tag.outerWidth();
                                    var z_index = 99999;
                                    var position = 'absolute';
                                    wraper.css({
                                        position: position,
                                        top: '100%',
                                        left: 0,
                                        width: width,
                                        'z-index': z_index
                                    })
                                };
                                t.clickOption = function(){
                                    $(document).on('click','.st-option-wrapper .option1 a', function(e){
                                        e.preventDefault();
                                        p = $(this).closest('.option1');
                                        var text = p.data('text');
                                        var value = p.data('value');

                                        $(this).closest('.st-tp-field-hotel-city').find('.tp-hotel-city').val(text);
                                        $(this).closest('.st-tp-field-hotel-city').find('select').val(value);
                                        $(this).closest('.st-tp-field-hotel-city').find('input[name=city_text]').val(text);
                                        $(this).closest('.st-option-wrapper').hide();
                                        var avail = 'https://yasen.hotellook.com/tp/v1/available_selections.json?id='+value;
                                        var el = $(this).closest('.city-field');
                                        var avail_data = $(this).closest('.st-tp-field-hotel-city').find('.tp-hotel-city').data('avail');
                                        var arr = [];
                                        $.each(avail_data, function(key, value) {
                                            arr[key] = value;
                                        });
                                        $.getJSON(avail, function(data) {

                                             if(data[0] != undefined){
                                                el.find('.selection').remove();
                                                el.find('input[name=city_selection]').val('');
                                                var html = '<div class=\"selection\" >';
                                                var select_html = '<select name=\"city_avail[]\" class=\"st-tp-hotel-city-save\">'
                                                select_html += '<option value=\"\"></option>';
                                                $.each(data, function(key,value){
                                                    if(arr[value] != undefined){
                                                        select_html += '<option value=\"'+ value +'\">  '+arr[value]+'</option>';
                                                    }
                                                });
                                                select_html+= '</select>';
                                                for(var i = 0; i < data.length; i++){
                                                    html += select_html;
                                                    if (i === 2) { break; }
                                                }
                                                html += '</div>';
                                                el.append(html);
                                             }
                                        });
                                    });
                                };
                                t.clickOption();
                                $(window).resize(function() {
                                    t.caculatePosition()
                                })
                            });

                            function get_highlight(text, val) {
                                var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class=\"highlight\">$&</span>');
                                return highlight
                            }
                        });
                    </script>";
                return $html;
            }
            return '';
        }
    }
}