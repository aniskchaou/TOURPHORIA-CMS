<?php 
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.3.1
 *
 * Class STAttribute
 *
 * Created by ShineTheme
 *
 */
global $wpdb;
$table = $wpdb->prefix.'st_member_packages';
$package_id = (int)STInput::get('edit_package', '');
$sql = "SELECT * FROM {$table} WHERE id = {$package_id} LIMIT 1";
$package = $wpdb->get_row($sql);
if( empty($package)){
    STTemplate::set_message(__('Can not get data for this package.'), 'error');
}
 ?>
 <div class="wrap woocommerce">
    <div class="icon32 icon32-attributes" id="icon-woocommerce"><br/></div>
    <h2><?php _e( 'Member Packages', ST_TEXTDOMAIN ) ?></h2>
    <br class="clear" />
    <div id="col-container">
        <div id="col-left">
        	<?php echo STTemplate::message(); ?>
            <div class="col-wrap">
                <?php if( !empty($package)): ?>
                <div class="form-wrap">
                    <h3><?php _e( 'Edit Package', ST_TEXTDOMAIN ) ?></h3>
                    <form action="" method="post">
                        <input type="hidden" name="package_id" value="<?php echo (int)$package->id; ?>">

                        <div class="form-field">
                            <label for="package_label"><?php _e( 'Name', ST_TEXTDOMAIN ); ?></label>
                            <input name="package_label" id="package_label" type="text" value="<?php echo STInput::post('package_label', $package->package_name); ?>" />
                            <p class="description"><?php _e( 'Name of package.', ST_TEXTDOMAIN ); ?></p>
                        </div>
                        <div class="form-field">
                            <label for="package_subname"><?php _e( 'Sub-name', ST_TEXTDOMAIN ); ?></label>
                            <input name="package_subname" id="package_subname" type="text" value="<?php echo STInput::post('package_subname', $package->package_subname); ?>" />
                            <p class="description"><?php _e( 'Sub-name of package.', ST_TEXTDOMAIN ); ?></p>
                        </div>

                        <div class="form-field">
                            <label for="package_price"><?php _e( 'Price', ST_TEXTDOMAIN ); ?></label>
                            <input type="number" name="package_price" id="package_price" value="<?php echo STInput::post('package_price', $package->package_price); ?>" min="0" step="1">
                            <p class="description"><?php _e( 'Price of package. Unit: United State Dollar (USD).', ST_TEXTDOMAIN ); ?></p>
                        </div>

                        <div class="form-field package-list-service">
                            <label for="package_service"><?php _e( 'Services', ST_TEXTDOMAIN ); ?></label>
                            <?php
                            $list_services = STUser_f::_get_service_available();
                            if(!empty($list_services)){
                                $package_services = $package->package_services;
                                $arr_package_services = explode(',', $package_services);
                                if($package_services == ''){
                                    $selected_all = 'checked';
                                }else{
                                    $selected_all = '';
                                    if(in_array('all', $arr_package_services))
                                        $selected_all = 'checked';
                                }

                                echo '<label><input type="checkbox" name="package_services[]" value="all" '. $selected_all .'/> '. __('All', ST_TEXTDOMAIN) .'</label>';
                                foreach ($list_services as $k => $v){
                                    $obj = get_post_type_object( $v );
                                    $selected = '';
                                    if(in_array($v, $arr_package_services))
                                        $selected = 'checked';
                                    echo '<label><input type="checkbox" name="package_services[]" value="'. $v .'" '. $selected .'/> '. $obj->labels->singular_name .'</label>';
                                }
                            }
                            ?>
                            <p class="description"><?php _e( 'Assign service for membership package.', ST_TEXTDOMAIN ); ?></p>
                        </div>
						
						<div class="form-field">
                            <label for="package_available"><?php _e( 'Time available (days)', ST_TEXTDOMAIN ); ?></label>
                            <input type="number" name="package_available" id="package_available" value="<?php echo STInput::post('package_available',$package->package_time); ?>" min="0" step="1">
                            <p class="description"><?php _e( 'Time available of package. Leave emty for unlimited.', ST_TEXTDOMAIN ); ?></p>
                        </div>

                        <div class="form-field">
                        	<?php 
                        		$default_commission = (float)st()->get_option('partner_commission','0');
                        	?>
                            <label for="package_commision"><?php _e( 'Commission (%)', ST_TEXTDOMAIN ); ?></label>
                            <input type="number" name="package_commision" id="package_commision" value="<?php echo STInput::post('package_commision', $package->package_commission); ?>" min="0" step="1">
                            <p class="description"><?php _e( 'The commission between admin and partner. Default from Theme Settings -> Partner Options -> Commissions', ST_TEXTDOMAIN ); ?></p>
                        </div>
                        <div class="form-field">
                            <label for="package_item_upload"><?php _e( 'Number of item can upload.', ST_TEXTDOMAIN ); ?></label>
                            <input type="number" name="package_item_upload" id="package_item_upload" value="<?php echo STInput::post('package_item_upload', $package->package_item_upload); ?>" min="0" step="1">
                            <p class="description"><?php _e( 'Number of item can upload. Leave emty for unlimited.', ST_TEXTDOMAIN ); ?></p>
                        </div>
						<div class="form-field">
                            <label for="package_item_featured"><?php _e( 'Number of item can set the featured', ST_TEXTDOMAIN ); ?></label>
                            <input type="number" name="package_item_featured" id="package_item_featured" value="<?php echo STInput::post('package_item_featured',$package->package_item_featured); ?>" min="0" step="1">
                            <p class="description"><?php _e( 'Number of item can set featured. Leave emty for unlimited.', ST_TEXTDOMAIN ); ?></p>
                        </div>
						<div class="form-field">
                            <label for="package_description"><?php _e( 'Description', ST_TEXTDOMAIN ); ?></label>
                            <textarea name="package_description" id="package_description" cols="30" rows="10"><?php echo STInput::post('package_description', $package->package_description); ?></textarea>
                            <p class="description"><?php _e( 'Description.', ST_TEXTDOMAIN ); ?></p>
                        </div>

                        <input type="hidden" name="action" value="st_add_member_package">

                        <p class="submit"><input type="submit" name="st_add_member_package" id="submit" class="button" value="<?php _e( 'Update Package', ST_TEXTDOMAIN ); ?>"></p>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div id="col-right">
            <div class="col-wrap">
                <table class="widefat attributes-table wp-list-table ui-sortable" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">
                        	<?php _e( 'Package Name', ST_TEXTDOMAIN ) ?>
                        </th>
                        <th scope="col"><?php _e( 'Price', ST_TEXTDOMAIN ) ?></th>
                        <th scope="col"><?php _e( 'Time Available', ST_TEXTDOMAIN ) ?></th>
                        <th scope="col"><?php _e( 'Commission', ST_TEXTDOMAIN ) ?></th>
                        <th scope="col"><?php _e( 'Items can upload', ST_TEXTDOMAIN ) ?></th>
                        <th scope="col"><?php _e( 'Items can set featured', ST_TEXTDOMAIN ) ?></th>
                        <th scope="col"><?php _e( 'Services', ST_TEXTDOMAIN ) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    	$cls_packages = STAdminPackages::get_inst();
                        $packages = $cls_packages->get_packages();
						if( !empty( $packages ) ):
							foreach( $packages as $key => $package ):
                    ?>
                	<tr>
                		<td>
                			<a href="<?php echo esc_url( add_query_arg('edit_package', (int) $package->id) ); ?>">
                                <strong><?php echo esc_attr( $package->package_name ); ?></strong>
                            </a> 
                			<div class="row-actions">
                        		<span class="edit">
                        			<a href="<?php echo esc_url( add_query_arg('edit_package', (int) $package->id) ); ?>">
                        				<?php _e( 'Edit', ST_TEXTDOMAIN ); ?>
                        			</a> 
                        			| 
                        		</span>
                        		<span class="delete">
                        			<a class="delete" href="<?php echo esc_url( wp_nonce_url( add_query_arg('delete_package', (int) $package->id), 'st_delete_package' ) ); ?>">
                        				<?php _e( 'Delete', ST_TEXTDOMAIN ); ?>
                        			</a>
                        		</span>
                        	</div>
                		</td>
						<td><?php echo TravelHelper::format_money((float)$package->package_price); ?></td>
                        <td>
                            <?php echo $cls_packages->convert_item($package->package_time, true); ?>
                        </td>
                        <td><?php echo (int) $package->package_commission. '%'; ?></td>
                        <td><?php echo $cls_packages->convert_item($package->package_item_upload); ?></td>
                        <td><?php echo $cls_packages->convert_item($package->package_item_featured); ?></td>
                        <td><?php echo $cls_packages->paser_list_services($package->package_services); ?></td>
                	</tr>

					<?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>