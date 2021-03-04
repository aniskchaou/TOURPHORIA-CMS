<?php
/**
 * Created by wpbooking
 * Developer: nasanji
 * Date: 12/20/2016
 * Version: 1.0
 */

/**
 * Load view path
 *
 * @since 1.0
 */
if(!function_exists('wb_form_builder_view_path')) {
    function wb_form_builder_view_path($view)
    {
        // Try to find overided file in theme_name/wpbooking/file-name.php
        $file=locate_template(array(
            'wpbooking/wpbooking-form-builder/'.$view.'.php'
        ),FALSE);

        if(!file_exists($file)){

            $file=WB_Form_Builder::inst()->get_dir('shinetheme/views/'.$view.'.php');
        }

        $file=apply_filters('wb_form_builder_load_view_'.$view,$file,$view);

        if(file_exists($file)){

            return $file;
        }

        return false;
    }
}

/**
 * Get content by file name
 *
 * @since 1.0
 */
if(!function_exists('wb_form_builder_load_view')) {
    function wb_form_builder_load_view($view, $data = array())
    {
        $file=locate_template(array(
            'wpbooking/frontend/wpbooking-form-builder/'.$view.'.php'
        ),FALSE);

        if(!file_exists($file)){

            $file = WB_Form_Builder::inst()->get_dir('shinetheme/views/'.$view.'.php');
        }

        $file=apply_filters('wb_form_builder_load_view_'.$view,$file,$view,$data);

        if(file_exists($file)){

            if(is_array($data))
                extract($data);

            ob_start();
            include($file);
            return @ob_get_clean();
        }
    }
}

/**
 * Get field setting by field type
 *
 * @since 1.0
 */
if(!function_exists('wb_form_builder_field_setting')){
    function wb_form_builder_field_setting($field_data, $action = 'new', $key = false, $old_data = false){
        if(!empty($field_data)){
            $html = '';
            switch($field_data['type']){
                case 'text':
                    if($action == 'edit'){
                        $value = $old_data[$field_data['id']];
                        $input_name = 'item_data['.$key.']['.$field_data['id'].']';
                    }else{
                        $value = '';
                        $input_name = 'item_data[{{data.index}}]['.$field_data['id'].']';
                    }

                    $html .= '<p class="description description-wide '.((!empty($field_data['adv_field']))?'wb-advance-field':'').'"><label>
                                    '.$field_data['label'].(isset($field_data['require'])?'<span class="required"> *</span>':'').'<br><input type="text" class="widefat edit-form-item-'.$field_data['id'].'" name="'.$input_name.'" value="'.esc_attr($value).'">
                                    <span class="field-admin-desc">'.(isset($field_data['desc'])?$field_data['desc']:'').'</span>
                                    </label>
                                    </p>';
                    break;
                case 'checkbox':
                    if($action == 'edit'){
                        $value = isset($old_data[$field_data['id']])?$old_data[$field_data['id']]:'';
                        $input_name = 'item_data['.$key.']['.$field_data['id'].']';
                    }else{
                        $value = '';
                        $input_name = 'item_data[{{data.index}}]['.$field_data['id'].']';
                    }
                    $html .= '<p class="description wb-option-checkbox">
					        <label>
						        <input type="checkbox" '.checked('1',$value,false).' value="1" name="'.$input_name.'">'.$field_data['label'].'</label>
                        </p>';
                    break;
                case 'link':
                    $html .= '<p class="description">
					        <a href="#" class="wb-field-'.$field_data['id'].'">'.$field_data['label'].'</a>
                        </p>';
                    break;
                case 'hidden':
                    if($action == 'edit'){
                        $input_name = 'item_data['.$key.']['.$field_data['id'].']';
                    }else{
                        $input_name = 'item_data[{{data.index}}]['.$field_data['id'].']';
                    }
                    $html .= '<p class="description description-wide '.((!empty($field_data['adv_field']))?'wb-advance-field':'').'"><label>
                    '.$field_data['label'].(isset($field_data['require'])?'<span class="required"> *</span>':'').'<br>
                    <input type="text" readonly class="widefat edit-form-item-'.$field_data['id'].' wb-field-'.$field_data['id'].'" name="'.$input_name.'" value="'.$field_data['value'].'"></label></p>';
                    break;
                case 'select_option':
                    if($action == 'edit'){
                        $index = $key;
                        $input_name_value = 'item_data['.$key.']['.$field_data['id'].'][op_value][]';
                        $input_name_key = 'item_data['.$key.']['.$field_data['id'].'][op_key][]';
                    }else{
                        $index = '{{data.index}}';
                        $input_name_key = 'item_data[{{data.index}}]['.$field_data['id'].'][op_key][]';
                        $input_name_value = 'item_data[{{data.index}}]['.$field_data['id'].'][op_value][]';
                    }
                    $html .= '<p class="description">
                            <label>'.$field_data['label'].'</label>
                            <span class="wb-value-table">
                                <span class="value-row-header">
                                    <span class="value-label">'.esc_html__('Value',ST_TEXTDOMAIN).'</span>
                                    <span class="value-label">'.esc_html__('Option',ST_TEXTDOMAIN).'</span>
                                    <span class="value-label"></span>
                                </span>';
                    $chck = false;
                    if($action == 'edit'){
                        if(!empty($old_data[$field_data['id']]) && is_array($old_data[$field_data['id']])){
                            $chck = true;
                            $i = 0;
                            foreach($old_data[$field_data['id']] as $key => $val){
                                $html .= '<span class="value-row-content">
                                    <span class="value-label key"><input type="text" name="' . $input_name_key . '" value="'.$key.'"></span>
                                    <span class="value-label"><input type="text" name="' . $input_name_value . '" value="'.esc_attr($val).'"></span>
                                    <span class="value-label">';
                                if($i != 0)
                                    $html .= '<i class="dashicons dashicons-no-alt"></i>';
                                $i++;
                                $html .= '</span>
                                </span>';
                            }
                        }
                    }
                    if(!$chck) {
                        $html .= '    <span class="value-row-content">
                                    <span class="value-label key"><input type="text" name="' . $input_name_key . '" value=""></span>
                                    <span class="value-label"><input type="text" name="' . $input_name_value . '" value=""></span>
                                    <span class="value-label"></span>
                                </span>';
                    }
                    $html .= '        </span>
                            <span class="add_new_row"><a class="wb-add-new-value" href="#" data-id="'.$field_data['id'].'" data-index="'.$index.'">'.esc_html__('Add new',ST_TEXTDOMAIN).'</a></span>
                        </p>';
                    break;
                case 'post_types':
                    $post_types = get_post_types();
                     if($action == 'edit'){
                        $value = $old_data[$field_data['id']];
                        $input_name = 'item_data['.$key.']['.$field_data['id'].']';
                    }else{
                        $value = '';
                        $input_name = 'item_data[{{data.index}}]['.$field_data['id'].']';
                    }
                    $html .= '<p class="description description-wide '.((!empty($field_data['adv_field']))?'wb-advance-field':'').'"><label>
                                    '.$field_data['label'].'<br>';
                    $html .= '<select class="widefat" name="'.$input_name.'">';
                    foreach($post_types as $key => $val){
                        $pt_opject = get_post_type_object($val);
                        if($val != 'attachment' && $val != 'revision' && $val != 'nav_menu_item' && $val != 'custom_css' && $val != 'customize_changeset' && $val != 'wpcf7_contact_form' && $val != 'option-tree' && $val != 'wb_form_builder' && $val != 'location'&& $val != 'st_layouts'&& $val != 'mc4wp-form'&& $val != 'st_flight'&& $val != 'st_order' && $val != 'st_coupon_code' && $val != 'vc4_templates' && $val != 'vc_grid_item'){
                            $html .= '<option '.selected($value, $val, false).' value="'.$val.'">'.$pt_opject->label.'</option>';
                        }
                    }
                    $html .= '</select></label></p>';
                    break;
                // case 'taxonomy':
                //     $taxonomy = get_object_taxonomies('wpbooking_service', 'array');
                //     if(!empty($taxonomy) && !is_wp_error($taxonomy )){
                //         if($action == 'edit'){
                //             $value = $old_data[$field_data['id']];
                //             $input_name = 'item_data['.$key.']['.$field_data['id'].']';
                //         }else{
                //             $value = '';
                //             $input_name = 'item_data[{{data.index}}]['.$field_data['id'].']';
                //         }
                //         $html .= '<p class="description description-wide '.((!empty($field_data['adv_field']))?'wb-advance-field':'').'"><label>
                //                         '.$field_data['label'].'<br>';

                //         $html .= '<select class="widefat" name="'.$input_name.'">';
                //         foreach ($taxonomy as $key => $val) {
                //             if ($key == 'wpbooking_location') continue;
                //             if ($key == 'wpbooking_extra_service') continue;
                //             if ($key == 'wb_review_stats') continue;
                //             if ($key == 'wb_tour_type') continue;
                //             $html .= '<option '.selected($value, $key, false).' value="'.$key.'">'.$val->label.'</option>';
                //         }
                //         $html .= '</select></label></p>';
                //     }
                //     break;
            }
            return $html;
        }
        return '';
    }
}

/**
 * Check form user for checkout
 *
 * @since 1.0
 */
if(!function_exists('wb_use_for_checkout')){
    function wb_use_for_checkout(){
        $form_id = get_option('wb_form_use_for_checkout','');
        return !empty($form_id)?$form_id:0;
    }
}

/**
 * List country
 *
 * @since 1.0
 */
if(!function_exists('wb_list_country')){
    function wb_list_country(){
        $country_array = array(
            ''   => esc_html__('--Select country--',ST_TEXTDOMAIN),
            "AF" => esc_html__("Afghanistan",ST_TEXTDOMAIN),
            "AL" => esc_html__("Albania",ST_TEXTDOMAIN),
            "DZ" => esc_html__("Algeria",ST_TEXTDOMAIN),
            "AS" => esc_html__("American Samoa",ST_TEXTDOMAIN),
            "AD" => esc_html__("Andorra",ST_TEXTDOMAIN),
            "AO" => esc_html__("Angola",ST_TEXTDOMAIN),
            "AI" => esc_html__("Anguilla",ST_TEXTDOMAIN),
            "AQ" => esc_html__("Antarctica",ST_TEXTDOMAIN),
            "AG" => esc_html__("Antigua and Barbuda",ST_TEXTDOMAIN),
            "AR" => esc_html__("Argentina",ST_TEXTDOMAIN),
            "AM" => esc_html__("Armenia",ST_TEXTDOMAIN),
            "AW" => esc_html__("Aruba",ST_TEXTDOMAIN),
            "AU" => esc_html__("Australia",ST_TEXTDOMAIN),
            "AT" => esc_html__("Austria",ST_TEXTDOMAIN),
            "AZ" => esc_html__("Azerbaijan",ST_TEXTDOMAIN),
            "BS" => esc_html__("Bahamas",ST_TEXTDOMAIN),
            "BH" => esc_html__("Bahrain",ST_TEXTDOMAIN),
            "BD" => esc_html__("Bangladesh",ST_TEXTDOMAIN),
            "BB" => esc_html__("Barbados",ST_TEXTDOMAIN),
            "BY" => esc_html__("Belarus",ST_TEXTDOMAIN),
            "BE" => esc_html__("Belgium",ST_TEXTDOMAIN),
            "BZ" => esc_html__("Belize",ST_TEXTDOMAIN),
            "BJ" => esc_html__("Benin",ST_TEXTDOMAIN),
            "BM" => esc_html__("Bermuda",ST_TEXTDOMAIN),
            "BT" => esc_html__("Bhutan",ST_TEXTDOMAIN),
            "BO" => esc_html__("Bolivia",ST_TEXTDOMAIN),
            "BA" => esc_html__("Bosnia and Herzegovina",ST_TEXTDOMAIN),
            "BW" => esc_html__("Botswana",ST_TEXTDOMAIN),
            "BV" => esc_html__("Bouvet Island",ST_TEXTDOMAIN),
            "BR" => esc_html__("Brazil",ST_TEXTDOMAIN),
            "BQ" => esc_html__("British Antarctic Territory",ST_TEXTDOMAIN),
            "IO" => esc_html__("British Indian Ocean Territory",ST_TEXTDOMAIN),
            "VG" => esc_html__("British Virgin Islands",ST_TEXTDOMAIN),
            "BN" => esc_html__("Brunei",ST_TEXTDOMAIN),
            "BG" => esc_html__("Bulgaria",ST_TEXTDOMAIN),
            "BF" => esc_html__("Burkina Faso",ST_TEXTDOMAIN),
            "BI" => esc_html__("Burundi",ST_TEXTDOMAIN),
            "KH" => esc_html__("Cambodia",ST_TEXTDOMAIN),
            "CM" => esc_html__("Cameroon",ST_TEXTDOMAIN),
            "CA" => esc_html__("Canada",ST_TEXTDOMAIN),
            "CT" => esc_html__("Canton and Enderbury Islands",ST_TEXTDOMAIN),
            "CV" => esc_html__("Cape Verde",ST_TEXTDOMAIN),
            "KY" => esc_html__("Cayman Islands",ST_TEXTDOMAIN),
            "CF" => esc_html__("Central African Republic",ST_TEXTDOMAIN),
            "TD" => esc_html__("Chad",ST_TEXTDOMAIN),
            "CL" => esc_html__("Chile",ST_TEXTDOMAIN),
            "CN" => esc_html__("China",ST_TEXTDOMAIN),
            "CX" => esc_html__("Christmas Island",ST_TEXTDOMAIN),
            "CC" => esc_html__("Cocos [Keeling] Islands",ST_TEXTDOMAIN),
            "CO" => esc_html__("Colombia",ST_TEXTDOMAIN),
            "KM" => esc_html__("Comoros",ST_TEXTDOMAIN),
            "CG" => esc_html__("Congo - Brazzaville",ST_TEXTDOMAIN),
            "CD" => esc_html__("Congo - Kinshasa",ST_TEXTDOMAIN),
            "CK" => esc_html__("Cook Islands",ST_TEXTDOMAIN),
            "CR" => esc_html__("Costa Rica",ST_TEXTDOMAIN),
            "HR" => esc_html__("Croatia",ST_TEXTDOMAIN),
            "CU" => esc_html__("Cuba",ST_TEXTDOMAIN),
            "CY" => esc_html__("Cyprus",ST_TEXTDOMAIN),
            "CZ" => esc_html__("Czech Republic",ST_TEXTDOMAIN),
            "CI" => esc_html__("Côte d’Ivoire",ST_TEXTDOMAIN),
            "DK" => esc_html__("Denmark",ST_TEXTDOMAIN),
            "DJ" => esc_html__("Djibouti",ST_TEXTDOMAIN),
            "DM" => esc_html__("Dominica",ST_TEXTDOMAIN),
            "DO" => esc_html__("Dominican Republic",ST_TEXTDOMAIN),
            "NQ" => esc_html__("Dronning Maud Land",ST_TEXTDOMAIN),
            "DD" => esc_html__("East Germany",ST_TEXTDOMAIN),
            "EC" => esc_html__("Ecuador",ST_TEXTDOMAIN),
            "EG" => esc_html__("Egypt",ST_TEXTDOMAIN),
            "SV" => esc_html__("El Salvador",ST_TEXTDOMAIN),
            "GQ" => esc_html__("Equatorial Guinea",ST_TEXTDOMAIN),
            "ER" => esc_html__("Eritrea",ST_TEXTDOMAIN),
            "EE" => esc_html__("Estonia",ST_TEXTDOMAIN),
            "ET" => esc_html__("Ethiopia",ST_TEXTDOMAIN),
            "FK" => esc_html__("Falkland Islands",ST_TEXTDOMAIN),
            "FO" => esc_html__("Faroe Islands",ST_TEXTDOMAIN),
            "FJ" => esc_html__("Fiji",ST_TEXTDOMAIN),
            "FI" => esc_html__("Finland",ST_TEXTDOMAIN),
            "FR" => esc_html__("France",ST_TEXTDOMAIN),
            "GF" => esc_html__("French Guiana",ST_TEXTDOMAIN),
            "PF" => esc_html__("French Polynesia",ST_TEXTDOMAIN),
            "TF" => esc_html__("French Southern Territories",ST_TEXTDOMAIN),
            "FQ" => esc_html__("French Southern and Antarctic Territories",ST_TEXTDOMAIN),
            "GA" => esc_html__("Gabon",ST_TEXTDOMAIN),
            "GM" => esc_html__("Gambia",ST_TEXTDOMAIN),
            "GE" => esc_html__("Georgia",ST_TEXTDOMAIN),
            "DE" => esc_html__("Germany",ST_TEXTDOMAIN),
            "GH" => esc_html__("Ghana",ST_TEXTDOMAIN),
            "GI" => esc_html__("Gibraltar",ST_TEXTDOMAIN),
            "GR" => esc_html__("Greece",ST_TEXTDOMAIN),
            "GL" => esc_html__("Greenland",ST_TEXTDOMAIN),
            "GD" => esc_html__("Grenada",ST_TEXTDOMAIN),
            "GP" => esc_html__("Guadeloupe",ST_TEXTDOMAIN),
            "GU" => esc_html__("Guam",ST_TEXTDOMAIN),
            "GT" => esc_html__("Guatemala",ST_TEXTDOMAIN),
            "GG" => esc_html__("Guernsey",ST_TEXTDOMAIN),
            "GN" => esc_html__("Guinea",ST_TEXTDOMAIN),
            "GW" => esc_html__("Guinea-Bissau",ST_TEXTDOMAIN),
            "GY" => esc_html__("Guyana",ST_TEXTDOMAIN),
            "HT" => esc_html__("Haiti",ST_TEXTDOMAIN),
            "HM" => esc_html__("Heard Island and McDonald Islands",ST_TEXTDOMAIN),
            "HN" => esc_html__("Honduras",ST_TEXTDOMAIN),
            "HK" => esc_html__("Hong Kong SAR China",ST_TEXTDOMAIN),
            "HU" => esc_html__("Hungary",ST_TEXTDOMAIN),
            "IS" => esc_html__("Iceland",ST_TEXTDOMAIN),
            "IN" => esc_html__("India",ST_TEXTDOMAIN),
            "ID" => esc_html__("Indonesia",ST_TEXTDOMAIN),
            "IR" => esc_html__("Iran",ST_TEXTDOMAIN),
            "IQ" => esc_html__("Iraq",ST_TEXTDOMAIN),
            "IE" => esc_html__("Ireland",ST_TEXTDOMAIN),
            "IM" => esc_html__("Isle of Man",ST_TEXTDOMAIN),
            "IL" => esc_html__("Israel",ST_TEXTDOMAIN),
            "IT" => esc_html__("Italy",ST_TEXTDOMAIN),
            "JM" => esc_html__("Jamaica",ST_TEXTDOMAIN),
            "JP" => esc_html__("Japan",ST_TEXTDOMAIN),
            "JE" => esc_html__("Jersey",ST_TEXTDOMAIN),
            "JT" => esc_html__("Johnston Island",ST_TEXTDOMAIN),
            "JO" => esc_html__("Jordan",ST_TEXTDOMAIN),
            "KZ" => esc_html__("Kazakhstan",ST_TEXTDOMAIN),
            "KE" => esc_html__("Kenya",ST_TEXTDOMAIN),
            "KI" => esc_html__("Kiribati",ST_TEXTDOMAIN),
            "KW" => esc_html__("Kuwait",ST_TEXTDOMAIN),
            "KG" => esc_html__("Kyrgyzstan",ST_TEXTDOMAIN),
            "LA" => esc_html__("Laos",ST_TEXTDOMAIN),
            "LV" => esc_html__("Latvia",ST_TEXTDOMAIN),
            "LB" => esc_html__("Lebanon",ST_TEXTDOMAIN),
            "LS" => esc_html__("Lesotho",ST_TEXTDOMAIN),
            "LR" => esc_html__("Liberia",ST_TEXTDOMAIN),
            "LY" => esc_html__("Libya",ST_TEXTDOMAIN),
            "LI" => esc_html__("Liechtenstein",ST_TEXTDOMAIN),
            "LT" => esc_html__("Lithuania",ST_TEXTDOMAIN),
            "LU" => esc_html__("Luxembourg",ST_TEXTDOMAIN),
            "MO" => esc_html__("Macau SAR China",ST_TEXTDOMAIN),
            "MK" => esc_html__("Macedonia",ST_TEXTDOMAIN),
            "MG" => esc_html__("Madagascar",ST_TEXTDOMAIN),
            "MW" => esc_html__("Malawi",ST_TEXTDOMAIN),
            "MY" => esc_html__("Malaysia",ST_TEXTDOMAIN),
            "MV" => esc_html__("Maldives",ST_TEXTDOMAIN),
            "ML" => esc_html__("Mali",ST_TEXTDOMAIN),
            "MT" => esc_html__("Malta",ST_TEXTDOMAIN),
            "MH" => esc_html__("Marshall Islands",ST_TEXTDOMAIN),
            "MQ" => esc_html__("Martinique",ST_TEXTDOMAIN),
            "MR" => esc_html__("Mauritania",ST_TEXTDOMAIN),
            "MU" => esc_html__("Mauritius",ST_TEXTDOMAIN),
            "YT" => esc_html__("Mayotte",ST_TEXTDOMAIN),
            "FX" => esc_html__("Metropolitan France",ST_TEXTDOMAIN),
            "MX" => esc_html__("Mexico",ST_TEXTDOMAIN),
            "FM" => esc_html__("Micronesia",ST_TEXTDOMAIN),
            "MI" => esc_html__("Midway Islands",ST_TEXTDOMAIN),
            "MD" => esc_html__("Moldova",ST_TEXTDOMAIN),
            "MC" => esc_html__("Monaco",ST_TEXTDOMAIN),
            "MN" => esc_html__("Mongolia",ST_TEXTDOMAIN),
            "ME" => esc_html__("Montenegro",ST_TEXTDOMAIN),
            "MS" => esc_html__("Montserrat",ST_TEXTDOMAIN),
            "MA" => esc_html__("Morocco",ST_TEXTDOMAIN),
            "MZ" => esc_html__("Mozambique",ST_TEXTDOMAIN),
            "MM" => esc_html__("Myanmar [Burma]",ST_TEXTDOMAIN),
            "NA" => esc_html__("Namibia",ST_TEXTDOMAIN),
            "NR" => esc_html__("Nauru",ST_TEXTDOMAIN),
            "NP" => esc_html__("Nepal",ST_TEXTDOMAIN),
            "NL" => esc_html__("Netherlands",ST_TEXTDOMAIN),
            "AN" => esc_html__("Netherlands Antilles",ST_TEXTDOMAIN),
            "NT" => esc_html__("Neutral Zone",ST_TEXTDOMAIN),
            "NC" => esc_html__("New Caledonia",ST_TEXTDOMAIN),
            "NZ" => esc_html__("New Zealand",ST_TEXTDOMAIN),
            "NI" => esc_html__("Nicaragua",ST_TEXTDOMAIN),
            "NE" => esc_html__("Niger",ST_TEXTDOMAIN),
            "NG" => esc_html__("Nigeria",ST_TEXTDOMAIN),
            "NU" => esc_html__("Niue",ST_TEXTDOMAIN),
            "NF" => esc_html__("Norfolk Island",ST_TEXTDOMAIN),
            "KP" => esc_html__("North Korea",ST_TEXTDOMAIN),
            "VD" => esc_html__("North Vietnam",ST_TEXTDOMAIN),
            "MP" => esc_html__("Northern Mariana Islands",ST_TEXTDOMAIN),
            "NO" => esc_html__("Norway",ST_TEXTDOMAIN),
            "OM" => esc_html__("Oman",ST_TEXTDOMAIN),
            "PC" => esc_html__("Pacific Islands Trust Territory",ST_TEXTDOMAIN),
            "PK" => esc_html__("Pakistan",ST_TEXTDOMAIN),
            "PW" => esc_html__("Palau",ST_TEXTDOMAIN),
            "PS" => esc_html__("Palestinian Territories",ST_TEXTDOMAIN),
            "PA" => esc_html__("Panama",ST_TEXTDOMAIN),
            "PZ" => esc_html__("Panama Canal Zone",ST_TEXTDOMAIN),
            "PG" => esc_html__("Papua New Guinea",ST_TEXTDOMAIN),
            "PY" => esc_html__("Paraguay",ST_TEXTDOMAIN),
            "YD" => esc_html__("People's Democratic Republic of Yemen",ST_TEXTDOMAIN),
            "PE" => esc_html__("Peru",ST_TEXTDOMAIN),
            "PH" => esc_html__("Philippines",ST_TEXTDOMAIN),
            "PN" => esc_html__("Pitcairn Islands",ST_TEXTDOMAIN),
            "PL" => esc_html__("Poland",ST_TEXTDOMAIN),
            "PT" => esc_html__("Portugal",ST_TEXTDOMAIN),
            "PR" => esc_html__("Puerto Rico",ST_TEXTDOMAIN),
            "QA" => esc_html__("Qatar",ST_TEXTDOMAIN),
            "RO" => esc_html__("Romania",ST_TEXTDOMAIN),
            "RU" => esc_html__("Russia",ST_TEXTDOMAIN),
            "RW" => esc_html__("Rwanda",ST_TEXTDOMAIN),
            "RE" => esc_html__("Réunion",ST_TEXTDOMAIN),
            "BL" => esc_html__("Saint Barthélemy",ST_TEXTDOMAIN),
            "SH" => esc_html__("Saint Helena",ST_TEXTDOMAIN),
            "KN" => esc_html__("Saint Kitts and Nevis",ST_TEXTDOMAIN),
            "LC" => esc_html__("Saint Lucia",ST_TEXTDOMAIN),
            "MF" => esc_html__("Saint Martin",ST_TEXTDOMAIN),
            "PM" => esc_html__("Saint Pierre and Miquelon",ST_TEXTDOMAIN),
            "VC" => esc_html__("Saint Vincent and the Grenadines",ST_TEXTDOMAIN),
            "WS" => esc_html__("Samoa",ST_TEXTDOMAIN),
            "SM" => esc_html__("San Marino",ST_TEXTDOMAIN),
            "SA" => esc_html__("Saudi Arabia",ST_TEXTDOMAIN),
            "SN" => esc_html__("Senegal",ST_TEXTDOMAIN),
            "RS" => esc_html__("Serbia",ST_TEXTDOMAIN),
            "CS" => esc_html__("Serbia and Montenegro",ST_TEXTDOMAIN),
            "SC" => esc_html__("Seychelles",ST_TEXTDOMAIN),
            "SL" => esc_html__("Sierra Leone",ST_TEXTDOMAIN),
            "SG" => esc_html__("Singapore",ST_TEXTDOMAIN),
            "SK" => esc_html__("Slovakia",ST_TEXTDOMAIN),
            "SI" => esc_html__("Slovenia",ST_TEXTDOMAIN),
            "SB" => esc_html__("Solomon Islands",ST_TEXTDOMAIN),
            "SO" => esc_html__("Somalia",ST_TEXTDOMAIN),
            "ZA" => esc_html__("South Africa",ST_TEXTDOMAIN),
            "GS" => esc_html__("South Georgia and the South Sandwich Islands",ST_TEXTDOMAIN),
            "KR" => esc_html__("South Korea",ST_TEXTDOMAIN),
            "ES" => esc_html__("Spain",ST_TEXTDOMAIN),
            "LK" => esc_html__("Sri Lanka",ST_TEXTDOMAIN),
            "SD" => esc_html__("Sudan",ST_TEXTDOMAIN),
            "SR" => esc_html__("Suriname",ST_TEXTDOMAIN),
            "SJ" => esc_html__("Svalbard and Jan Mayen",ST_TEXTDOMAIN),
            "SZ" => esc_html__("Swaziland",ST_TEXTDOMAIN),
            "SE" => esc_html__("Sweden",ST_TEXTDOMAIN),
            "CH" => esc_html__("Switzerland",ST_TEXTDOMAIN),
            "SY" => esc_html__("Syria",ST_TEXTDOMAIN),
            "ST" => esc_html__("São Tomé and Príncipe",ST_TEXTDOMAIN),
            "TW" => esc_html__("Taiwan",ST_TEXTDOMAIN),
            "TJ" => esc_html__("Tajikistan",ST_TEXTDOMAIN),
            "TZ" => esc_html__("Tanzania",ST_TEXTDOMAIN),
            "TH" => esc_html__("Thailand",ST_TEXTDOMAIN),
            "TL" => esc_html__("Timor-Leste",ST_TEXTDOMAIN),
            "TG" => esc_html__("Togo",ST_TEXTDOMAIN),
            "TK" => esc_html__("Tokelau",ST_TEXTDOMAIN),
            "TO" => esc_html__("Tonga",ST_TEXTDOMAIN),
            "TT" => esc_html__("Trinidad and Tobago",ST_TEXTDOMAIN),
            "TN" => esc_html__("Tunisia",ST_TEXTDOMAIN),
            "TR" => esc_html__("Turkey",ST_TEXTDOMAIN),
            "TM" => esc_html__("Turkmenistan",ST_TEXTDOMAIN),
            "TC" => esc_html__("Turks and Caicos Islands",ST_TEXTDOMAIN),
            "TV" => esc_html__("Tuvalu",ST_TEXTDOMAIN),
            "UM" => esc_html__("U.S. Minor Outlying Islands",ST_TEXTDOMAIN),
            "PU" => esc_html__("U.S. Miscellaneous Pacific Islands",ST_TEXTDOMAIN),
            "VI" => esc_html__("U.S. Virgin Islands",ST_TEXTDOMAIN),
            "UG" => esc_html__("Uganda",ST_TEXTDOMAIN),
            "UA" => esc_html__("Ukraine",ST_TEXTDOMAIN),
            "SU" => esc_html__("Union of Soviet Socialist Republics",ST_TEXTDOMAIN),
            "AE" => esc_html__("United Arab Emirates",ST_TEXTDOMAIN),
            "GB" => esc_html__("United Kingdom",ST_TEXTDOMAIN),
            "US" => esc_html__("United States",ST_TEXTDOMAIN),
            "ZZ" => esc_html__("Unknown or Invalid Region",ST_TEXTDOMAIN),
            "UY" => esc_html__("Uruguay",ST_TEXTDOMAIN),
            "UZ" => esc_html__("Uzbekistan",ST_TEXTDOMAIN),
            "VU" => esc_html__("Vanuatu",ST_TEXTDOMAIN),
            "VA" => esc_html__("Vatican City",ST_TEXTDOMAIN),
            "VE" => esc_html__("Venezuela",ST_TEXTDOMAIN),
            "VN" => esc_html__("Vietnam",ST_TEXTDOMAIN),
            "WK" => esc_html__("Wake Island",ST_TEXTDOMAIN),
            "WF" => esc_html__("Wallis and Futuna",ST_TEXTDOMAIN),
            "EH" => esc_html__("Western Sahara",ST_TEXTDOMAIN),
            "YE" => esc_html__("Yemen",ST_TEXTDOMAIN),
            "ZM" => esc_html__("Zambia",ST_TEXTDOMAIN),
            "ZW" => esc_html__("Zimbabwe",ST_TEXTDOMAIN),
            "AX" => esc_html__("Åland Islands",ST_TEXTDOMAIN)
        );

        return apply_filters('st_form_builder_list_country',$country_array);
    }
}

if(!function_exists('wb_get_admin_message'))
{
    function wb_get_admin_message($clear_message=true){
        $message = WB_Form_Builder::inst()->get_admin_message($clear_message);

        if($message){
            $type=$message['type'];
            switch($type){
                case "error":
                    $type='error';
                    break;
                case "success":
                    $type='updated';
                    break;
                default:
                    $type='notice-warning';
                    break;
            }
            return sprintf('<div class="notice %s" >%s</div>',$type,$message['content']);
        }

        return false;
    }
}
if(!function_exists('wb_set_admin_message'))
{
    function wb_set_admin_message($message,$type='information'){
        WB_Form_Builder::inst()->set_admin_message($message,$type);
    }
}