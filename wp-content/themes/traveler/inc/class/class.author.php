<?php
if ( ! class_exists( 'ST_Author' ) ) {
	/**
	 * Class STActivity
	 */
	class ST_Author{
		static $_inst;
		protected $_table_version = "1.0.3";
		protected $_table_name = '';

		function __construct() {
			//$this->_table_name = 'st_review_partner';
			//add_action( 'after_setup_theme', array( $this, '_check_table_activity' ) );

			add_action( 'wp_ajax_st_author_write_review', [ $this, 'st_author_write_review' ] );
			add_action( 'wp_ajax_nopriv_st_author_write_review', [ $this, 'st_author_write_review' ] );
		}

		public function st_get_time_membership($from){

            $date1 = $from;
            $date2 = date('Y-m-d H:i:s');

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            if($diff < 12){
                return sprintf('%s months', $diff);
            }else{
                if($diff == 12){
                    return sprintf('1 year', $diff);
                }else{
                    $year = intval($diff/12);
                    $month = $diff%12;
                        return sprintf('%s year%s %s month%s', $year, ($year > 1 ? 's' : ''), $month, ($month > 1 ? 's' : ''));
                }
            }
        }

		public function st_author_write_review() {
			$title      = STInput::post( 'title', '' );
			$content    = STInput::post( 'content', '' );
			$user_id    = STInput::post( 'user_id', '' );
			$partner_id = STInput::post( 'partner_id', '' );
			$star       = STInput::post( 'star', '' );
			$arr_star = [];
			$i = 0;
			foreach (json_decode(stripcslashes($star)) as $k => $v){
				$sub_arr_star = explode('|', $v);
				$arr_star[$i] = $sub_arr_star;
				$i++;
			}
			$data_ins = array(
				'partner_id' => intval($partner_id),
				'user_id'    => intval($user_id),
				'title'      => $title,
				'content'    => $content,
				'rating'     => json_encode($arr_star),
				'helpful'    => 0,
			);
			$this->insert_data($data_ins);
			echo json_encode([
				'status' => true,
				'message' => __('Add review for partner successful', ST_TEXTDOMAIN)
			]);
			die;
		}

		public function get_author_review_score($partner_id){
			$data = $this->get_data_by_partner_id($partner_id);
			$arr = [];
			$i = 0;
			if(!empty($data)) {
				foreach ( $data as $k => $v ) {
					$rating         = json_decode( $v['rating'] );
					$arr_rating_sub = [];
					foreach ( $rating as $kk => $vv ) {
						$arr_rating_sub[ $vv[0] ] = $vv[1];
					}
					$arr[ $i ] = $arr_rating_sub;
					$i ++;
				}
			}

			if(!empty($arr)){
				$avrage = [];
				foreach ($arr[0] as $kk => $vv){
					$avrage[$kk] = 0;
				}
			}

			$i = count($arr);
			foreach($arr as $value)
			{
				foreach ($arr[0] as $kk => $vv){
					$avrage[$kk] += $value[$kk];
				}
			}

			foreach ($arr[0] as $kk => $vv){
				$avrage[$kk] = ($avrage[$kk]?number_format (round($avrage[$kk]/$i,1), 1):0);
			}

			return [
				'sum' => count($data),
				'data' => $avrage
			];
		}

		function get_average_by_rating($rating){
            $r_rating = json_decode($rating);
            $arr_r_rating = [];
            foreach ($r_rating as $k_rr => $v_rr){
                $arr_r_rating[$v_rr[0]] = $v_rr[1];
            }
            $avg_rating = round(array_sum($arr_r_rating) / count($arr_r_rating), 1);
            return $avg_rating;
        }

		function get_count_review_by_user_id($user_id){
            global $wpdb;
            $table = $wpdb->prefix . $this->_table_name;
            $sql   = "SELECT count(*) FROM {$table} WHERE user_id={$user_id}";

            return $wpdb->get_var( $sql );
        }

		function get_data_by_partner_id( $partner_id ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;

			$sql = "SELECT * FROM {$table} WHERE partner_id={$partner_id}";

			$res = $wpdb->get_results( $sql, ARRAY_A );

			if ( ! empty( $res ) && count( $res ) > 0 ) {
				return $res;
			}

			return false;
		}

		function _check_table_activity() {
			$dbhelper = new DatabaseHelper( $this->_table_version );
			$dbhelper->setTableName( $this->_table_name );
			$column = array(
				'id'         => array(
					'type'           => 'bigint',
					'length'         => 9,
					'AUTO_INCREMENT' => true
				),
				'partner_id' => array(
					'type'   => 'INT',
					'length' => 11
				),
				'user_id'    => array(
					'type'   => 'INT',
					'length' => 11
				),
				'title'      => array(
					'type'   => 'varchar',
					'length' => 255
				),
				'content'    => array(
					'type'   => 'text'
				),
				'rating'     => array(
					'type'   => 'varchar',
					'length' => 255
				),
				'helpful'    => array(
					'type'   => 'bigint',
					'length' => 9
				),
			);

			$column = apply_filters( 'st_change_column_st_review_partner', $column );

			$dbhelper->setDefaultColums( $column );
			$dbhelper->check_meta_table_is_working( 'st_review_partner_table_version' );

			return array_keys( $column );
		}

		function insert_data( $data ) {
			global $wpdb;

			$table = $wpdb->prefix . $this->_table_name;

			$wpdb->insert( $table, $data );
		}

		function update_data( $data, $where ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;

			$wpdb->update( $table, $data, $where );
		}

		function check_data_for_user( $id, $user_id ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;
			$sql   = "SELECT count(*) FROM {$table} WHERE id={$id} AND user_id={$user_id}";

			return $wpdb->get_var( $sql );
		}

		/**
		 * @param $where
		 */
		function delete_data( $where ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;
			$wpdb->delete( $table, $where );
		}

		function get_data( $stas_id ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;

			$sql = "SELECT * FROM {$table} WHERE id=%s";

			$res = $wpdb->get_row( $wpdb->prepare( $sql, $stas_id ) );

			if ( ! empty( $res ) && count( $res ) > 0 ) {
				return $res;
			}

			return false;
		}

		function get_data_by_date( $start, $end ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;

			$sql = "SELECT * FROM {$table} WHERE booking_from >= {$start} AND booking_to <= {$end}";

			$res = $wpdb->get_results( $sql, ARRAY_A );

			if ( ! empty( $res ) && count( $res ) > 0 ) {
				return $res;
			}

			return false;
		}

		function get_data_by_date_and_id( $id, $start, $end ) {
			global $wpdb;
			$table = $wpdb->prefix . $this->_table_name;

			$sql = "SELECT * FROM {$table} WHERE id IN ({$id}) AND booking_from >= {$start} AND booking_to <= {$end}";

			$res = $wpdb->get_results( $sql, ARRAY_A );

			if ( ! empty( $res ) && count( $res ) > 0 ) {
				return $res;
			}

			return false;
		}

		static function inst() {
			if ( ! self::$_inst ) {
				self::$_inst = new self();
			}

			return self::$_inst;
		}
	}

	ST_Author::inst();
}