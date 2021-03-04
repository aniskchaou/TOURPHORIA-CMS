<?php
$check_email = true;
$check_phone=  true;
$check_passport = true;
$check_cer = true;
$check_social = true;

if(empty($data['user_email'])){
    $check_email = false;
}
if(empty($data['st_phone'])){
	$check_email = false;
}

$data_check_passport = array(
	$data['passport_name'],
	$data['passport_id'],
	$data['passport_birthday'],
	$data['passport_photos']
);

$data_check_cer = array(
	$data['business_c_name'],
	$data['business_c_email'],
	$data['business_c_address'],
	$data['business_c_phone'],
	$data['business_r_name'],
	$data['business_r_position'],
	$data['business_r_passport_id'],
	$data['business_r_issue_date']
);

if(empty($data['social_facebook_uid']) || empty($data['social_facebook_name'])){
	$check_social = false;
}

$check_passport = st_check_user_verify_empty($data_check_passport);
$check_cer = st_check_user_verify_empty($data_check_cer);

$user_verify_all = st_check_user_verify('', $data['user_id']);
?>
<div class="verify-box">
	<h3><?php echo __('Verifications Info', ST_TEXTDOMAIN); ?>
        <?php
            if($check_email && $check_phone && $check_passport && $check_cer && $check_social){
        ?>
			<button class="btn-verify-all" data-nonce="<?php echo wp_create_nonce( 'user_verifications' ); ?>" data-user_id="<?php echo $data['user_id']; ?>" ><?php echo __('Verify all', ST_TEXTDOMAIN);  ?></button>
        <?php } ?>
		<?php echo STUser::verify_status($data['user_id'])['html']; ?><span class="status-text"><?php echo __('Status: ', ST_TEXTDOMAIN); ?></span>
	</h3>

	<div class="verify-item">
		<div class="verify-label">
			<b><?php echo __('Email', ST_TEXTDOMAIN); ?></b>
            <?php if(empty($data['user_email'])){ ?>
			<button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="email"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
            <?php }else{ ?>
                <?php echo STUser::verify_status_by_key($data['user_id'], 'email', true); ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="email"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
			<button class="btn-verify-single" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="email"><?php echo __('Verify', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
            <?php } ?>
		</div>
		<div class="verify-value">
			<?php
				if(!empty($data['user_email'])){
					echo $data['user_email'];
				}else{
					echo '<span class="empty-info">-------- ' . __('Empty', ST_TEXTDOMAIN) . ' --------</span>';
				}
				?>
		</div>
	</div>

	<div class="verify-item">
		<div class="verify-label">
			<b><?php echo __('Phone', ST_TEXTDOMAIN); ?></b>
			<?php if(empty($data['st_phone'])){ ?>
			<button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="phone"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
			<?php }else{ ?>
				<?php echo STUser::verify_status_by_key($data['user_id'], 'phone', true); ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="phone"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
			<button class="btn-verify-single" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="phone"><?php echo __('Verify', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
            <?php } ?>
		</div>
		<div class="verify-value">
			<?php
			if(!empty($data['st_phone'])){
				echo $data['st_phone'];
			}else{
				echo '<span class="empty-info">-------- ' . __('Empty', ST_TEXTDOMAIN) . ' --------</span>';
			}
			?>
		</div>
	</div>

	<div class="verify-item idcard">
		<div class="verify-label">
			<b><?php echo __('Personal identity card or passport', ST_TEXTDOMAIN); ?></b>
            <?php
            if(!$check_passport) {
	            ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>"
                        data-criteria="passport"><?php echo __( 'Send notice', ST_TEXTDOMAIN ); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
	            <?php
            }else{
            ?>
	            <?php echo STUser::verify_status_by_key($data['user_id'], 'passport', true); ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>"
                        data-criteria="passport"><?php echo __( 'Send notice', ST_TEXTDOMAIN ); ?></button>
                <button class="btn-verify-single" data-user_id="<?php echo $data['user_id']; ?>"
                        data-criteria="passport"><?php echo __( 'Verify', ST_TEXTDOMAIN ); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
            <?php } ?>
		</div>
		<div class="verify-value">
			<?php
			if(!empty($data['passport_name']) || !empty($data['passport_id']) || !empty($data['passport_birthday']) || !empty($data['passport_photos'])){
				?>
				<ul>
					<li>
						<span class="card-label"><?php echo __('Name on card', ST_TEXTDOMAIN) ?></span>
						<span class="card-value">
							<?php
								if(!empty($data['passport_name'])){
								    echo $data['passport_name'];
                                }else{
								    echo '---------';
                                }
							?>
						</span>
					</li>
					<li>
						<span class="card-label"><?php echo __('Card ID', ST_TEXTDOMAIN) ?></span>
						<span class="card-value">
							<?php
							if(!empty($data['passport_id'])){
								echo $data['passport_id'];
							}else{
								echo '---------';
							}
							?>
						</span>
					</li>
					<li>
						<span class="card-label"><?php echo __('Birthday', ST_TEXTDOMAIN) ?></span>
						<span class="card-value">
							<?php
							if(!empty($data['passport_birthday'])){
								echo $data['passport_birthday'];
							}else{
								echo '---------';
							}
							?>
						</span>
					</li>
					<li>
						<span class="card-label"><?php echo __('Photo', ST_TEXTDOMAIN) ?></span>
						<span class="card-value">
                            <?php
                            if(!empty($data['passport_photos'])){
                                $arr_passport_photos = explode(',', $data['passport_photos']);
                                if(!empty($arr_passport_photos)){
                                    foreach ($arr_passport_photos as $pk => $pv){
                                        echo '<a href="'.$pv.'" title="" class="thickbox"><img src="'. $pv .'" alt="Single Image" width="60" height="60"/></a>';
                                    }
                                }
                            }else{
	                            echo '---------';
                            }
                            ?>
						</span>
					</li>
				</ul>
				<?php
			}else{
				echo '<span class="empty-info">-------- ' . __('Empty', ST_TEXTDOMAIN) . ' --------</span>';
			}
			?>
		</div>
	</div>

	<div class="verify-item certificate idcard">
		<div class="verify-label">
			<b><?php echo __('Travel Certificate', ST_TEXTDOMAIN); ?></b>
            <?php
            if(!$check_cer){
            ?>
			<button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="travel_certificate"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
            <?php }else{ ?>
	            <?php echo STUser::verify_status_by_key($data['user_id'], 'travel_certificate', true); ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="travel_certificate"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
			<button class="btn-verify-single" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="travel_certificate"><?php echo __('Verify', ST_TEXTDOMAIN); ?></button>
			<textarea rows="3" class="invalid-reason"></textarea>
            <?php } ?>
		</div>
		<div class="verify-value">
			<?php
			if(!empty($data['business_c_name']) || !empty($data['business_c_email']) || !empty($data['business_c_address']) || !empty($data['business_c_phone']) || !empty($data['business_r_name']) || !empty($data['business_r_position']) || !empty($data['business_r_passport_id']) || !empty($data['business_r_issue_date'])){
			    ?>
                <ul>
                    <li>
                        <span class="card-label"><?php echo __('Company name', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_c_name'])){
								echo $data['business_c_name'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Email', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_c_email'])){
								echo $data['business_c_email'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Company address', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_c_address'])){
								echo $data['business_c_address'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Phone Number', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_c_phone'])){
								echo $data['business_c_phone'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li><i><?php echo __('Representative Information', ST_TEXTDOMAIN); ?></i></li>
                    <li>
                        <span class="card-label"><?php echo __('Fullname', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_r_name'])){
								echo $data['business_r_name'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Position', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_r_position'])){
								echo $data['business_r_position'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Personal Indentity/passport', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_r_passport_id'])){
								echo $data['business_r_passport_id'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Issue date', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							if(!empty($data['business_r_issue_date'])){
								echo $data['business_r_issue_date'];
							}else{
								echo '---------';
							}
							?>
						</span>
                    </li>
                    <li>
                        <span class="card-label"><?php echo __('Photo', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
                            <?php
                            if(!empty($data['business_photos'])){
	                            $arr_passport_photos = explode(',', $data['business_photos']);
	                            if(!empty($arr_passport_photos)){
		                            foreach ($arr_passport_photos as $pk => $pv){
			                            echo '<a href="'.$pv.'" title="" class="thickbox"><img src="'. $pv .'" alt="Single Image" width="60" height="60"/></a>';
		                            }
	                            }
                            }else{
	                            echo '---------';
                            }
                            ?>
						</span>
                    </li>
                </ul>
                <?php
			}else{
				echo '<span class="empty-info">-------- ' . __('Empty', ST_TEXTDOMAIN) . ' --------</span>';
			}
			?>
		</div>
	</div>

    <div class="verify-item certificate idcard">
        <div class="verify-label">
            <b><?php echo __('Social', ST_TEXTDOMAIN); ?></b>
			<?php if(empty($data['social_facebook_uid']) && empty('social_facebook_name')){ ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="social"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
			<?php }else{ ?>
				<?php echo STUser::verify_status_by_key($data['user_id'], 'social', true); ?>
                <button class="btn-verify-invalid" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="social"><?php echo __('Send notice', ST_TEXTDOMAIN); ?></button>
                <button class="btn-verify-single" data-user_id="<?php echo $data['user_id']; ?>" data-criteria="social"><?php echo __('Verify', ST_TEXTDOMAIN); ?></button>
                <textarea rows="3" class="invalid-reason"></textarea>
			<?php } ?>
        </div>
        <div class="verify-value">
            <?php if(!empty($data['social_facebook_uid']) && !empty($data['social_facebook_name'])) { ?>
            <ul>
                <?php if ( ! empty( $data['social_facebook_uid'] ) ) { ?>
                <li>
                    <span class="card-label"><?php echo __('ID', ST_TEXTDOMAIN) ?></span>
                    <span class="card-value">
							<?php
								echo $data['social_facebook_uid'];
							?>
						</span>
                </li>
                <?php } ?>
	            <?php if ( ! empty( $data['social_facebook_name'] ) ) { ?>
                    <li>
                        <span class="card-label"><?php echo __('Name', ST_TEXTDOMAIN) ?></span>
                        <span class="card-value">
							<?php
							echo $data['social_facebook_name'];
							?>
						</span>
                    </li>
	            <?php } ?>
            </ul>
            <?php
            }else{
	            echo '<span class="empty-info">-------- ' . __('Empty', ST_TEXTDOMAIN) . ' --------</span>';
            }
            ?>
        </div>
    </div>
</div>
