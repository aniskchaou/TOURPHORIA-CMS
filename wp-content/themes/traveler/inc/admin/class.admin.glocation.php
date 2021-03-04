<?php 
/**
*@since 1.2.0
**/
if(!class_exists('STGLocation')){
	class STGLocation{
		public $table = 'st_glocation';
		public $column = array();
		public $st_upgrade_glocation = 0;
		public $allow_version = false;

		public function __construct(){
			add_action('after_setup_theme',array(&$this,'_check_table_glocation'), 10);
			add_action('admin_enqueue_scripts', array($this, '_add_scripts'));
			add_action('admin_notices', array($this, '_add_notices'));
			add_action('wp_ajax_st_get_data_glocation', array($this,'st_get_data_glocation'), 9999);
		}

		public function _add_scripts(){
			wp_enqueue_style( 'admin-glocation', get_template_directory_uri() .'/css/admin/admin.glocation.css' );
			wp_enqueue_script('admin-glocation.js', get_template_directory_uri() . '/js/admin/glocation.js', array('jquery'), true );
		}

		public function _add_notices(){
			$check = get_option('st_completed_update_glocation', '');
			if(!$check || empty($check) || STInput::request('page', '') == 'st-upgrade-data'){
				$google_key = get_option('st_google_key', '');
				echo '<div class="notice notice-warning" style="padding-bottom: 10px">';
				echo '
					<p>This version 1.2.0 has a few new data updates. Click "Update Now" button to perform it.</p>';

				if($check){
					echo '
						<p><em>(You did it once. If you want to do it again, click "Update Now" button.)</em></p>
					';
				}
				echo '	
					<button id="st-update-glocation" class="button button-primary button-large" type="submit">Update Now</button>
				';
				echo '</div>';
				echo '
					<div class="update-glocation-wrapper">
						<div class="update-glocation-content">
							<div class="update-glocation-title clear">
								<h4 class="title">Update Data Traveler</h4>
								<a href="#" class="update-glocation-close"></a>
							</div>
							<div class="update-glocation-detail">
								<h4>Content will be updated:</h4>
								<p>1. Create a field seacrh by Google Places. <a href="https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete" target="_blank">Demo</a></p>
								<p>2. Create a new table as \'st_glocation\' to save data from Google</p>
								<br/>
								<p class="text-warning"><strong>Guide: </strong> You need enter a Google API. <a href="https://developers.google.com/maps/documentation/elevation/get-api-key" target="_blank">Create a Google API key</a></p>
								<p style=""><a target="_blank" href="https://developers.google.com/maps/documentation/geocoding/usage-limits">Learn more about \'Google Maps Geocoding API Usage Limits\'</a></p>
							</div>
							<div class="update-glocation-button">
								<div class="ball"></div>
								<div class="ball1"></div>
								<div class="text">Start</div>
							</div>
							<div class="update-glocation-progress">
								<div class="progress-bar blue stripes">
								    <span style="width: 0%"></span>
								</div>
							</div>
							<form action="" class="update-glocation-form">
								<label for="reset_table"><input id="reset_table" type="checkbox" name="reset_table" value="reset"><span style="margin-left: 5px">Please select if you perform again</span></label>
								<br/>
								<label style="margin-top: 20px;"><span style="margin-left: 5px">Google API key</span><input type="text" name="google_key" placeholder="Enter your Google API..." value="'.$google_key.'"></label>
							</form>
							<div class="update-glocation-message">
							
							</div>
						</div>
					</div>
				';
			}	
		}

		public function _check_table_glocation(){
			$dbhelper = new DatabaseHelper('1.0.0');
			$dbhelper->setTableName($this->table);
			$column = array(
				'id'=>array(
	                'type' => 'bigint',
	                'length' => 9,
	                'AUTO_INCREMENT' => TRUE
	            ),
	            'post_id'=>array(
	                'type' => 'bigint',
	                'length' => 11
	            ),
	            'post_type' => array(
	            	'type' => 'varchar',
	            	'length' => 255
	            ),
	            'street_number' => array(
					'type' => 'varchar',
					'length' => 255
	            ),
	            'route' => array(
					'type' => 'varchar',
					'length' => 255
	            ),
	            'sublocality_level_1'=> array(
					'type' => 'varchar',
					'length' => 255
	            ),
	            'locality' => array(
					'type' => 'varchar',
					'length' => 255
	            ),
	            'administrative_area_level_2' => array(
	                'type' => 'varchar',
	                'length' => 255
	            ),
	            'administrative_area_level_1' => array(
	                'type' => 'varchar',
	                'length' => 255
	            ),
	            'country' => array(
	                'type' => 'varchar',
	                'length' => 255
	            )
			);
			$this->column = $column;
			$dbhelper->setDefaultColums($column);
			$dbhelper->check_meta_table_is_working('glocation_table_version');
		}

		public function isset_table(){
			global $wpdb;
			$table = $wpdb->prefix.$this->table;
			if($wpdb->get_var("SHOW TABLES LIKE '{$table}'") != $table){
				return false;
			}
			return true;
		}

		public function _deleteTable(){
        	global $wpdb;
        	$table = $wpdb->prefix.$this->table;
        	$wpdb->query("DROP TABLE {$table}");
        }

		public function st_get_data_glocation(){
			global $wpdb;
			$table = $wpdb->prefix.$this->table;

			if(!empty($_REQUEST['post_type'])){
				if(STInput::request('reset_table', '') == 'reset'){
					if($this->isset_table()){
	        			$this->_deleteTable();
	        			$this->_check_table_glocation();
	        			update_option('st_completed_update_glocation', '');
	        		}
				}
				$google_key = STInput::request('google_key', '');
				$post_type = STInput::request('post_type', '');
				$page = intval(STInput::request('page', 1));
				$start = intval(STInput::request('start', ''));

				$post_types = array('st_hotel', 'st_rental', 'st_tours', 'st_activity', 'st_cars', 'location');

				if($start > 5){
					update_option('st_completed_update_glocation', 'completed');
					update_option('st_google_key', $google_key);

					echo json_encode(array('status' => 'completed', 'progress' => 100));
					die();
				}

				$results = $this->get_latlong_posttype($post_type, $page, $start);
				if(!empty($results['lists'])){
					$string_value = '';
					foreach($results['lists'] as $list){
						$lat = floatval(trim($list->map_lat));
						$lng = floatval(trim($list->map_lng));

						usleep(100000);

						$info = $this->get_remote_data("https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$google_key}&language=en");
						
						$info = (array)json_decode($info);
						if($info['status'] == 'OK'){
							$address = $info['results'][0]->address_components;

							$post_id = $list->id;
							$post_type = get_post_type($list->id);
							$street_number = '';
							$route = '';
							$sublocality_level_1 = '';
							$locality = '';
							$administrative_area_level_2 = '';
							$administrative_area_level_1 = '';
							$country = '';

							foreach($address as $item){
								if(in_array('street_number', $item->types)){
									$street_number = sanitize_title($item->long_name);
								}
								if(in_array('route', $item->types)){
									$route = sanitize_title($item->long_name);
								}
								if(in_array('sublocality_level_1', $item->types)){
									$sublocality_level_1 = sanitize_title($item->long_name);
								}
								if(in_array('locality', $item->types)){
									$locality = sanitize_title($item->long_name);
								}
								if(in_array('administrative_area_level_2', $item->types)){
									$administrative_area_level_2 = sanitize_title($item->long_name);
								}
								if(in_array('administrative_area_level_1', $item->types)){
									$administrative_area_level_1 = sanitize_title($item->long_name);
								}
								if(in_array('country', $item->types)){
									$country = sanitize_title($item->long_name);
								}
							}

							$string_value .= "(NULL,'{$post_id}', '{$post_type}', '{$street_number}', '{$route}', '{$sublocality_level_1}', '{$locality}', '{$administrative_area_level_2}', '{$administrative_area_level_1}', '{$country}'),";
						}elseif($info['status'] == 'OVER_QUERY_LIMIT'){
							echo json_encode(array(
								'status' => 'error',
								'progress' => 100,
								'message' => $info['message']
								));
							die();
						}elseif($info['status'] == 'ZERO_RESULTS' || empty($info)){
							continue;
						}else{
							echo json_encode(array(
								'status' => 'error',
								'progress' => 100,
								'message' => $info
								));
							die();
						}
						
					}
					if(!empty($string_value)){
						$string_value = substr($string_value, 0, -1);
						$sql = "INSERT INTO {$table} (id, post_id, post_type, street_number, route, sublocality_level_1, locality, administrative_area_level_2, administrative_area_level_1, country) VALUES {$string_value}";
						
						update_post_meta($post_id, 'st_country', $country);
						update_post_meta($post_id, 'st_street_number', $street_number);
						update_post_meta($post_id, 'st_route', $route);
						update_post_meta($post_id, 'st_sublocality_level_1', $sublocality_level_1);
						update_post_meta($post_id, 'st_locality', $locality);
						update_post_meta($post_id, 'st_administrative_area_level_2', $administrative_area_level_2);
						update_post_meta($post_id, 'st_administrative_area_level_1', $administrative_area_level_1);

						$return = $wpdb->query($sql);
						if(!$return){
							echo json_encode(array('status' => 'error_table', 'progress' => 100, 'message' => 'Have an error when save data.'));
							die();
						}
					}
				}
				$total_posts = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type IN ('st_hotel', 'st_cars', 'st_rental', 'st_activity', 'st_tours', 'location') AND post_status IN ('publish','private')");
				$total_glocation_inserted = $wpdb->get_var("SELECT COUNT(id) FROM {$wpdb->prefix}st_glocation");
				$progress = ($total_glocation_inserted / $total_posts) * 100;
				$results['progress'] = $progress;

				$results['post_type'] = (intval($results['start']) > 5) ? 'st_hotel' : $post_types[$results['start']];
				$results['status'] = 'continue';
				$results['google_key'] = $google_key;
				unset($results['lists']);
				echo json_encode($results);
				die();

			}else{
				echo json_encode(array('status' => 'error', 'message' => 'This request is denied.'));
				die();
			}
		}

		public function get_latlong_posttype($post_type = 'st_hotel', $page = 1, $start = 0){
			global $wpdb;
			$posts_per_page = 10;
			$table = $wpdb->prefix.$post_type;
			$total = intval($wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type = '{$post_type}' AND post_status IN ('publish', 'private')"));

			$number_page = ceil($total / $posts_per_page);

			$offset = ($page - 1) * $posts_per_page;

			$sql = "SELECT
				id,
				mt.meta_value as map_lat,
				mt1.meta_value as map_lng
			FROM
				{$wpdb->prefix}posts
			INNER JOIN {$wpdb->prefix}postmeta AS mt ON {$wpdb->prefix}posts.ID = mt.post_id
			AND mt.meta_key = 'map_lat'
			INNER JOIN {$wpdb->prefix}postmeta AS mt1 ON {$wpdb->prefix}posts.ID = mt1.post_id
			AND mt1.meta_key = 'map_lng'
			WHERE
				post_type = '{$post_type}'
			AND mt.meta_value <> ''
			AND mt1.meta_value <> ''
			AND post_status IN ('publish', 'private')
			GROUP BY
				ID
			LIMIT {$offset}, {$posts_per_page}";

			$list = $wpdb->get_results($sql);

			$next_page = ($page < $number_page) ? $page + 1 : 1;
			$start = ($page < $number_page) ? $start : $start + 1;

			return array(
				'lists' => $list,
				'page' => $next_page,
				'start' => $start
				);

		}

		public function get_remote_data($url, $post_paramtrs = false){
		    $c = curl_init();
		    curl_setopt($c, CURLOPT_URL, $url);
		    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		    if($post_paramtrs)
		    {
		        curl_setopt($c, CURLOPT_POST,TRUE);
		        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&".$post_paramtrs );
		    }
		    curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		    curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
		    curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
		    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
		    $follow_allowed= ( ini_get('open_basedir') || ini_get('safe_mode')) ? false:true;
		    if ($follow_allowed){
		        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
		    }
		    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
		    curl_setopt($c, CURLOPT_REFERER, $url);
		    curl_setopt($c, CURLOPT_TIMEOUT, 60);
		    curl_setopt($c, CURLOPT_AUTOREFERER, true);
		    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
		    $data=curl_exec($c);
		    $status=curl_getinfo($c);
		    curl_close($c);
		    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si',  $status['url'],$link); $data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si','$1=$2'.$link[0].'$3$4$5', $data);   $data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si','$1=$2'.$link[1].'://'.$link[3].'$3$4$5', $data);
		    if($status['http_code'] == 200){
		        return $data;
		    }elseif($status['http_code'] == 301 || $status['http_code'] == 302){
		        if (!$follow_allowed)
		        {
		            if (!empty($status['redirect_url']))
		            {
		                $redirURL=$status['redirect_url'];
		            }
		            else
		            {
		                preg_match('/href\=\"(.*?)\"/si',$data,$m);
		                if (!empty($m[1]))
		                {
		                    $redirURL=$m[1];
		                }
		            }
		            if(!empty($redirURL)){
		                return  call_user_func( __FUNCTION__, $redirURL, $post_paramtrs);
		            }
		        }
		    }
		    return 0;
		}

		public function check_url($domain){
           	$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
	       	curl_setopt ($ch, CURLOPT_URL,$domain );
	       	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	       	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	       	curl_setopt ($ch,CURLOPT_VERBOSE,false);
	       	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	       	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
	       	curl_setopt($ch,CURLOPT_SSLVERSION,3);
	       	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
	       	$page = curl_exec($ch);
	       	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	       	curl_close($ch);
	       	if($httpcode >= 200 && $httpcode < 300) return true;
	       	else return false;
       }
	} new STGLocation;
}