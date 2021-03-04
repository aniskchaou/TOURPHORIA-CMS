<?php
	/**
	 * @subpackage Traveler
	 * @since      1.0.9
	 **/

	if ( !class_exists( 'STAdminUploadIcon' ) ) {

		class STAdminUploadIcon extends STAdmin
		{

			private $upload_font_folder = "st_uploadfont"; // Upload folder name
			private $path               = "/fonts/packages"; // Path to upload sub folder name
			private $path_folder        = ''; // Path to package folder
			private $path_file_css      = ''; // Path to css file in package folder
			private $foldername_font    = ''; // Name of package folder
			private $message            = ''; // Messages

			public function __construct()
			{
				//ob_start();
				$this->add_enqueue_script();
				$this->createUploadFolder();
				$this->create_submenu();

				add_action( 'admin_init', [ $this, '_upload_font_handler' ] );
			}

			/**
			 * @since 1.0.9
			 **/
			public function setFolderUpload()
			{
				add_filter( 'upload_dir', [ $this, '_awesome_fonticon_dir' ] );
			}


			/**
			 * @since 1.0.9
			 **/
			public function removeFolderUpload()
			{
				remove_filter( 'upload_dir', [ $this, '_awesome_fonticon_dir' ] );
			}


			/**
			 * @since 1.0.9
			 * @return custom upload folder
			 **/
			public function _awesome_fonticon_dir( $param )
			{
				$param[ 'path' ] = $param[ 'basedir' ] . '/' . $this->upload_font_folder;
				$param[ 'url' ]  = $param[ 'baseurl' ] . '/' . $this->upload_font_folder;

				return $param;
			}

			/**
			 * @since 1.0.9
			 * Create upload folder
			 **/
			public function createUploadFolder()
			{

				$upload_dir    = wp_upload_dir();
				$upload_folder = $upload_dir[ 'basedir' ];

				$path = $upload_folder . '/' . $this->upload_font_folder;

				if ( !is_dir( $path ) )
					mkdir( $path, 0755, true );
			}

			/**
			 * @since 1.0.9
			 **/
			public function create_submenu()
			{
				add_action( 'admin_menu', [ $this, '_register_uploadfont_submenu_page' ], 50 );

			}

			/**
			 * @since 1.0.9
			 **/
			public function _register_uploadfont_submenu_page()
			{
				add_submenu_page( 'st_traveler_option', __( 'Importer Fonticon', ST_TEXTDOMAIN ), __( 'Importer Fonticon', ST_TEXTDOMAIN ), 'manage_options', 'st-upload-custom-fonticon', [ $this, '_st_upload_icon_content' ] );
			}

			/**
			 * @since 1.1.9
			 */
			public function _upload_font_handler()
			{
				/* Upload font */
				if ( isset( $_POST[ 'upload-font' ] ) ) {

					$font_file = $_FILES[ 'font-file' ];

					if ( strchr( $font_file[ 'name' ], '.zip' ) ) {

						$movefile = $this->saveFontfile( $font_file );

						if ( $movefile && !isset( $movefile[ 'error' ] ) ) {

							$unzipfile = $this->unzipFontfile( $movefile[ 'file' ], $font_file[ 'name' ] );

							if ( $unzipfile ) {

								unlink( $movefile[ 'file' ] );

								/* save fonticon data */

								$new_item = $this->_getContentFont();

								$newMetaFont = $this->newMetaFont( $new_item );

								if ( $this->updateFont( $newMetaFont ) ) {

									$this->message = __( 'Successful', ST_TEXTDOMAIN );
									$this->show_uploadfont_messsage( 'updated' );
								} else {

									$this->message = __( 'Error upload new fonts', ST_TEXTDOMAIN );

									$this->show_uploadfont_messsage( 'error' );
								}
							} else {
								$this->message = __( 'Error', ST_TEXTDOMAIN );

								$this->show_uploadfont_messsage( 'error' );
							}
						} else {
							$this->message = $movefile[ 'error' ];

							$this->show_uploadfont_messsage( 'error' );
						}
					} else {

						$this->message = __( 'Not a zip file', ST_TEXTDOMAIN );
						$this->show_uploadfont_messsage( 'error' );
					}
				}

				/* Delete font */
				if ( isset( $_GET[ 'deletefont' ] ) ) {

					$fontname = $_GET[ 'deletefont' ];

					$listfont = get_option( 'st_list_fonticon_', [] );

					if ( is_array( $listfont ) and isset( $listfont[ $fontname ] ) && count( $listfont[ $fontname ] ) ) {

						$path_folder = $listfont[ $fontname ][ 'path_folder' ];

						//array_map('unlink', glob($path_folder.'/*'));
						$rmdir = $this->recursiveRemoveDirectory( $path_folder );

						unset( $listfont[ $fontname ] );

						update_option( 'st_list_fonticon_', $listfont );

						if ( $rmdir ) {

							wp_redirect( admin_url( '/admin.php?page=st-upload-custom-fonticon' ) );

						} else {

							$this->message = __( 'Remove error', ST_TEXTDOMAIN );

							$this->show_uploadfont_messsage( 'error' );
						}
					} else {
						$this->message = sprintf( __( 'Icon Package [%s] does not exits.', ST_TEXTDOMAIN ), $fontname );

						$this->show_uploadfont_messsage( 'error' );
					}
				}
			}

			/**
			 * @since 1.0.9
			 * Callback
			 **/
			public function _st_upload_icon_content()
			{

				?>

				<!-- List fonts -->
				<?php if ( isset( $_GET[ 'listfont' ] ) ) :

				$data = [
					'fontname' => $_GET[ 'listfont' ],
					'listfont' => get_option( 'st_list_fonticon_', [] )
				];

				echo balanceTags( $this->load_view( 'upload_fonticon/view_font', false, $data ) );

				?>
			<?php else:

				$data = [
					'list_fonts' => get_option( 'st_list_fonticon_', [] ),
				];

				echo balanceTags( $this->load_view( 'upload_fonticon/index', false, $data ) );

			endif;

			}

			function recursiveRemoveDirectory( $directory )
			{
				foreach ( glob( "{$directory}/*" ) as $file ) {
					if ( is_dir( $file ) ) {
						$this->recursiveRemoveDirectory( $file );
					} else {
						unlink( $file );
					}
				}

				return rmdir( $directory );
			}

			/**
			 * @since 1.0.9
			 **/
			public function saveFontfile( $font_file = '' )
			{


				add_filter( 'upload_dir', [ $this, '_awesome_fonticon_dir' ] );
				$upload_overrides = [ 'test_form' => false ];

				$movefile = wp_handle_upload( $font_file, $upload_overrides );

				remove_filter( 'upload_dir', [ $this, '_awesome_fonticon_dir' ] );

				return $movefile;
			}

			/**
			 * @since 1.0.9
			 **/
			public function unzipFontfile( $file = '', $fontname = '' )
			{

				$this->foldername_font = $this->create_folder( $fontname );

				$unzipfile = unzip_file( $file, $this->path_folder );

				return $unzipfile;
			}

			/**
			 * @since 1.0.9
			 **/
			public function create_folder( $fontname )
			{
				add_filter( 'upload_dir', [ $this, '_awesome_fonticon_dir' ] );
				WP_Filesystem();

				$destination = wp_upload_dir();

				$destination_path = $destination[ 'path' ];

				$name = sanitize_title( str_replace( '.zip', '', $fontname ) );

				$last_number = '';

				preg_match_all( '/[\d]+/', $name, $last_number );

				$end_item = end( $last_number[ 0 ] );
				if ( !empty( $end_item ) ) {

					$name = substr( $name, 0, strrpos( $name, end( $last_number[ 0 ] ) ) );

					$last_number = intval( end( $last_number[ 0 ] ) );

				} else {
					$last_number = '';
				}

				$i = 1;

				$new_name = '';

				do {

					$new_name = $name . $last_number;

					$last_number = $i;

					$i++;
				} while ( is_dir( $destination_path . '/' . $new_name ) );

				$name = empty( $new_name ) ? $name : $new_name;

				mkdir( $destination_path . '/' . $name, 0755 );

				$this->path_folder = $destination_path . '/' . $name;

				$this->path_file_css = $destination[ 'url' ] . '/' . $name;

				remove_filter( 'upload_dir', [ $this, '_awesome_fonticon_dir' ] );

				return $name;
			}

			/**
			 * @since 1.0.9
			 * update 1.2.4
			 **/
			public function _getContentFont()
			{

				$files = fopen( $this->path_folder . '/flaticon.css', 'r' ) or die( "Unable to open file!" );

				$contents = fread( $files, filesize( $this->path_folder . '/flaticon.css' ) );

				$content_rewite = str_replace( 'flaticon-', 'flaticon-' . $this->foldername_font . '-', $contents );
				//$content_rewite = str_replace('Flaticon', 'Flaticon-'.$this->foldername_font, $content_rewite);
				$content_rewite = preg_replace( "/font-family(.*)Flaticon(.*);/", "font-family: Flaticon-" . $this->foldername_font . ";", $content_rewite );
				$content_rewite = str_replace( 'font-size: 20px', 'font-size: 18px', $content_rewite );
				$content_rewite = str_replace( 'margin-left: 20px;', 'margin-left: 0px;', $content_rewite );
				/* Read and rewite file css */
				$handle = fopen( $this->path_folder . '/flaticon.css', 'w' ) or die( 'Cannot open file:  ' . $this->path_folder . '/flaticon.css' );
				fwrite( $handle, $content_rewite );
				$items = [];
				preg_match_all( "/flaticon-" . $this->foldername_font . "-.[0-9 A-Z a-z -]*:/", $content_rewite, $items );
				foreach ( $items[ 0 ] as $key => $val ) {
					$items[ 0 ][ $key ] = str_replace( ':', '', $val );
				}
				$item = [
					$this->foldername_font => [
						'icon_list'     => $items[ 0 ],
						'path_folder'   => $this->path_folder,
						'link_file_css' => $this->path_file_css . '/flaticon.css'
					]
				];

				return $item;
			}

			public function get_remote_data( $url, $post_paramtrs = false )
			{
				$c = curl_init();
				curl_setopt( $c, CURLOPT_URL, $url );
				curl_setopt( $c, CURLOPT_RETURNTRANSFER, 1 );
				if ( $post_paramtrs ) {
					curl_setopt( $c, CURLOPT_POST, TRUE );
					curl_setopt( $c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs );
				}
				curl_setopt( $c, CURLOPT_SSL_VERIFYHOST, false );
				curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0" );
				curl_setopt( $c, CURLOPT_COOKIE, 'CookieName1=Value;' );
				curl_setopt( $c, CURLOPT_MAXREDIRS, 10 );
				$follow_allowed = ( ini_get( 'open_basedir' ) || ini_get( 'safe_mode' ) ) ? false : true;
				if ( $follow_allowed ) {
					curl_setopt( $c, CURLOPT_FOLLOWLOCATION, 1 );
				}
				curl_setopt( $c, CURLOPT_CONNECTTIMEOUT, 9 );
				curl_setopt( $c, CURLOPT_REFERER, $url );
				curl_setopt( $c, CURLOPT_TIMEOUT, 60 );
				curl_setopt( $c, CURLOPT_AUTOREFERER, true );
				curl_setopt( $c, CURLOPT_ENCODING, 'gzip,deflate' );
				$data   = curl_exec( $c );
				$status = curl_getinfo( $c );
				curl_close( $c );
				preg_match( '/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status[ 'url' ], $link );
				$data = preg_replace( '/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[ 0 ] . '$3$4$5', $data );
				$data = preg_replace( '/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[ 1 ] . '://' . $link[ 3 ] . '$3$4$5', $data );
				if ( $status[ 'http_code' ] == 200 ) {
					return $data;
				} elseif ( $status[ 'http_code' ] == 301 || $status[ 'http_code' ] == 302 ) {
					if ( !$follow_allowed ) {
						if ( !empty( $status[ 'redirect_url' ] ) ) {
							$redirURL = $status[ 'redirect_url' ];
						} else {
							preg_match( '/href\=\"(.*?)\"/si', $data, $m );
							if ( !empty( $m[ 1 ] ) ) {
								$redirURL = $m[ 1 ];
							}
						}
						if ( !empty( $redirURL ) ) {
							return call_user_func( __FUNCTION__, $redirURL, $post_paramtrs );
						}
					}
				}

				return 0;
			}

			/**
			 * @since 1.0.9
			 **/
			public function newMetaFont( $new_item )
			{
				$old_item = get_option( 'st_list_fonticon_', [] );
				if ( !is_array( $old_item ) )
					$old_item = [];
				$old_item = array_merge( $new_item, $old_item );

				return $old_item;
			}

			/**
			 * @since 1.0.9
			 **/
			public function updateFont( $arr )
			{
				return update_option( 'st_list_fonticon_', $arr );
			}

			/**
			 * @since 1.0.9
			 **/
			public function add_enqueue_script()
			{
				add_action( 'admin_enqueue_scripts', [ & $this, 'add_script' ] );
			}

			/**
			 * @since 1.0.9
			 **/
			public function add_script()
			{

				$listfont = get_option( 'st_list_fonticon_', [] );

				if ( is_array( $listfont ) && count( $listfont ) ){
					foreach ( $listfont as $key => $val ) {

						wp_enqueue_style( $key, $val[ 'link_file_css' ] );
					}
				}

				wp_register_script( 'update-fonticon', get_template_directory_uri() . '/js/admin/upload-fonticon.js', [ 'jquery' ], null, true );
			}

			/**
			 * @since 1.0.9
			 **/
			public function show_uploadfont_messsage( $type = 'updated ' )
			{
				echo '
				<div class="' . $type . '">
					<p>' . $this->message . '</p>
				</div>
			';
			}

		}

		$st_upload_font = new STAdminUploadIcon();
	}
?>