<?php
namespace Automattic\JetpackCRM;

if ( ! defined( 'ZEROBSCRM_PATH' ) ) exit;

class Details_Endpoint extends Client_Portal_Endpoint {

	public static function register_endpoint( $endpoints, $client_portal ) {
		$new_endpoint = new Details_Endpoint( $client_portal );

		$new_endpoint->portal                       = $client_portal;
		$new_endpoint->slug                         = 'details';
		$new_endpoint->name                         = __('Your Details', 'zero-bs-crm');
		$new_endpoint->hide_from_menu               = false;
		$new_endpoint->menu_order                   = 1;
		$new_endpoint->icon                         = 'fa-user';
		$new_endpoint->template_name                = 'details.php';
		$new_endpoint->add_rewrite_endpoint         = true;
		$new_endpoint->should_check_user_permission = true;

		$endpoints[] = $new_endpoint;
		return $endpoints;
	}

	function render_admin_notice() {
		global $zbs;

		$admin_message = '<b>' . __( 'Admin notice:', 'zero-bs-crm' ) . '</b><br>';
		$admin_message .= __( 'This is the Client Portal contact details page. This will show the contact their details and allow them change information in the fields below. You can hide fields from this page in <i>Settings → Client Portal → Fields to hide on Portal</i>.', 'zero-bs-crm' );
		##WLREMOVE
		$admin_message .= '<br><br><a href="' . $zbs->urls['kbclientportal'] . '" target="_blank">' . __( 'Learn more', 'zero-bs-crm' ) . '</a>';
		##/WLREMOVE

		?>
		<div class='alert alert-info' style="font-size: 0.8em;text-align: left;margin-top:0px;">
		<?php echo $admin_message ?>
		</div><?php
	}

	// Functions that were in the template file
	function save_details() {
		if($_POST['save'] == 1){
			$uid = get_current_user_id();
			$uinfo = get_userdata( $uid );
			$cID = zeroBS_getCustomerIDWithEmail($uinfo->user_email);

			// added !empty check - because if logged in as admin, saved deets, it made a new contact for them
			if((int)$_POST['customer_id'] == $cID && !empty($cID)){

				// handle the password fields, if set.
				if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password2']) ){

					if($_POST['password'] != $_POST['password2']){
						echo "<div class='zbs_alert danger'>" . __("Passwords do not match","zero-bs-crm") . "</div>";
					} else {
						// update password
						wp_set_password( sanitize_text_field($_POST['password']), $uid);

						// log password change
						zeroBS_addUpdateLog(
							$cID,
							-1,
							-1,
							array(
								'type' => __( 'Password updated via Client Portal', 'zero-bs-crm' ),
								'shortdesc' => __( 'Contact changed their password via the Client Portal', 'zero-bs-crm' ),
								'longdesc' => '',
							),
							'zerobs_customer'
						);

						// display message
						echo "<div class='zbs_alert'>" . __( 'Password updated.', 'zero-bs-crm' ) . "</div>";
						// update any details as well
						$this->portal->jpcrm_portal_update_details_from_post($cID);
					}
				} else {
					// update any details as well
					$this->portal->jpcrm_portal_update_details_from_post($cID);
				}
			}
		}
	}	

	function get_value( $fieldK, $zbsCustomer ) {
		// get a value (this allows field-irrelevant global tweaks, like the addr catch below...)
		$value = '';
		if (isset($zbsCustomer[$fieldK])) $value = $zbsCustomer[$fieldK];

		// #backward-compatibility
		// contacts got stuck in limbo as we upgraded db in 2 phases.
		// following catches old str and modernises to v3.0
		// make addresses their own objs 3.0+ and do away with this.
		// ... hard typed to avoid custom field collisions, hacky at best.
		switch ($fieldK){

			case 'secaddr1':
				if (isset($zbsCustomer['secaddr_addr1'])) $value = $zbsCustomer['secaddr_addr1'];
				break;

			case 'secaddr2':
				if (isset($zbsCustomer['secaddr_addr2'])) $value = $zbsCustomer['secaddr_addr2'];
				break;

			case 'seccity':
				if (isset($zbsCustomer['secaddr_city'])) $value = $zbsCustomer['secaddr_city'];
				break;

			case 'seccounty':
				if (isset($zbsCustomer['secaddr_county'])) $value = $zbsCustomer['secaddr_county'];
				break;

			case 'seccountry':
				if (isset($zbsCustomer['secaddr_country'])) $value = $zbsCustomer['secaddr_country'];
				break;

			case 'secpostcode':
				if (isset($zbsCustomer['secaddr_postcode'])) $value = $zbsCustomer['secaddr_postcode'];
				break;
		}

		return $value;
	}

	function render_text_field($fieldK, $fieldV, $value){
		// added zbs-text-input class 5/1/18 - this allows "linkify" automatic linking
		// ... via js
		//  mike-label
		?>
		<p>
			<label class='label' for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
			<input type="text" name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control widetext" placeholder="<?php if (isset($fieldV[2])) echo $fieldV[2]; ?>" value="<?php if (isset($value)) echo $value; ?>" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>" />
		</p>
		<?php
	}

	function render_price_field($fieldK, $fieldV, $value){
		?><p>
			<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
			<?php echo zeroBSCRM_getCurrencyChr(); ?> <input style="width: 130px;display: inline-block;;" type="text" name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control  numbersOnly" placeholder="<?php if (isset($fieldV[2])) echo $fieldV[2]; ?>" value="<?php if (isset($value)) echo $value; ?>" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>" />
		</p><?php
	}

	function render_date_field($fieldK, $fieldV, $value){
		/* skipping DATE custom fields for v3.0, lets see if they're asked for...
		... if so, then rewrite this whole linkage (as above to match zeroBSCRM_html_editFields() style)
		... because 'date' here is a UTS, and we'll need date picker etc.

		?><tr class="wh-large"><th><label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label></th>
		<td>
			<input type="text" name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control zbs-date" placeholder="<?php if (isset($fieldV[2])) echo $fieldV[2]; ?>" value="<?php if (isset($value)) echo $value; ?>" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>" />
		</td></tr><?php
		*/
	}

	function render_select_field($fieldK, $fieldV, $value){
		?>
		<p>
			<label class='label' for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
			<select name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control zbs-watch-input" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>">
				<?php
				// pre DAL 2 = $fieldV[3], DAL2 = $fieldV[2]
				$options = array();
				if (isset($fieldV[3]) && is_array($fieldV[3])) {
					$options = $fieldV[3];
				} else {
					// DAL2 these don't seem to be auto-decompiled?
					// doing here for quick fix, maybe fix up the chain later.
					if (isset($fieldV[2])) $options = explode(',', $fieldV[2]);
				}

				if (isset($options) && count($options) > 0){

					//catcher
					echo '<option value="" disabled="disabled"';
					if (!isset($value) || (isset($value)) && empty($value)) echo ' selected="selected"';
					echo '>'.__('Select',"zero-bs-crm").'</option>';

					foreach ($options as $opt){

						echo '<option value="'.$opt.'"';
						if (isset($value) && strtolower($value) == strtolower($opt)) echo ' selected="selected"';
						// __ here so that things like country lists can be translated
						echo '>'.__($opt,"zero-bs-crm").'</option>';

					}

				} else echo '<option value="">'.__('No Options',"zero-bs-crm").'!</option>';

				?>
			</select>
			<input type="hidden" name="zbsc_<?php echo $fieldK; ?>_dirtyflag" id="zbsc_<?php echo $fieldK; ?>_dirtyflag" value="0" />
		</p>
		<?php
	}

	function render_telephone_field($fieldK, $fieldV, $value, $zbsCustomer){
		$click2call = 0;
		?><p>
		<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm");?>:</label>
		<input type="text" name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control zbs-tel" placeholder="<?php if (isset($fieldV[2])) echo $fieldV[2]; ?>" value="<?php if (isset($value)) echo $value; ?>" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>" />
		<?php if ($click2call == "1" && isset($zbsCustomer[$fieldK]) && !empty($zbsCustomer[$fieldK])) echo '<a href="'.zeroBSCRM_clickToCallPrefix().$zbsCustomer[$fieldK].'" class="button"><i class="fa fa-phone"></i> '.$zbsCustomer[$fieldK].'</a>'; ?>
		<?php
		if ($fieldK == 'mobtel'){

			$sms_class = 'send-sms-none';
			$sms_class = apply_filters('zbs_twilio_sms', $sms_class);
			do_action('zbs_twilio_nonce');

			$customerMob = ''; if (is_array($zbsCustomer) && isset($zbsCustomer[$fieldK]) && isset($contact['id'])) $customerMob = zeroBS_customerMobile($contact['id'],$zbsCustomer);

			if (!empty($customerMob)) echo '<a class="' . $sms_class . ' button" data-smsnum="' . $customerMob .'"><i class="mobile alternate icon"></i> '.__('SMS','zero-bs-crm').': ' . $customerMob . '</a>';
		}

		?>
		</p>
		<?php
	}

	function render_email_field($fieldK, $fieldV, $value){
		// added zbs-text-input class 5/1/18 - this allows "linkify" automatic linking
		// ... via js <div class="zbs-text-input">
		// removed from email for now zbs-text-input

		?><p>
		<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
		<div class="<?php echo $fieldK; ?>">
			<input type="text" name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control zbs-email" placeholder="<?php if (isset($fieldV[2])) echo $fieldV[2]; ?>" value="<?php if (isset($value)) echo $value; ?>" autocomplete="off" />
		</div>
		</p><?php
	}

	function render_text_area_field($fieldK, $fieldV, $value) {
		?><p>
		<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
		<textarea name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control" placeholder="<?php if (isset($fieldV[2])) echo $fieldV[2]; ?>" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>"><?php if (isset($value)) echo zeroBSCRM_textExpose($value); ?></textarea>
		</p><?php
	}

	function render_country_list_field($fieldK, $fieldV, $value, $showCountryFields) {
		$countries = zeroBSCRM_loadCountryList();

		if ($showCountryFields == "1"){

			?><p>
			<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
			<select name="zbsc_<?php echo $fieldK; ?>" id="<?php echo $fieldK; ?>" class="form-control" autocomplete="zbscontact-<?php echo time(); ?>-<?php echo $fieldK; ?>">
				<?php

				if (isset($countries) && count($countries) > 0){

					//catcher
					echo '<option value="" disabled="disabled"';
					if (!isset($value) || (isset($value)) && empty($value)) echo ' selected="selected"';
					echo '>'.__('Select',"zero-bs-crm").'</option>';

					foreach ($countries as $countryKey => $country){

						// temporary fix for people storing "United States" but also "US"
						// needs a migration to iso country code, for now, catch the latter (only 1 user via api)

						echo '<option value="'.$country.'"';
						if (isset($value) && (
								strtolower($value) == strtolower($country)
								||
								strtolower($value) == strtolower($countryKey)
							)) echo ' selected="selected"';
						echo '>'.$country.'</option>';

					}

				} else echo '<option value="">'.__('No Countries Loaded',"zero-bs-crm").'!</option>';

				?>
			</select>
			</p><?php

		}
	}

	function render_radio_field($fieldK, $fieldV, $value, $postPrefix) {
		?><p>
		<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
		<div class="zbs-field-radio-wrap">
			<?php

			// pre DAL 2 = $fieldV[3], DAL2 = $fieldV[2]
			$options = false;
			if (isset($fieldV[3]) && is_array($fieldV[3])) {
				$options = $fieldV[3];
			} else {
				// DAL2 these don't seem to be auto-decompiled?
				// doing here for quick fix, maybe fix up the chain later.
				if (isset($fieldV[2])) $options = explode(',', $fieldV[2]);
			}

			if (isset($options) && is_array($options) && count($options) > 0 && $options[0] != ''){

				$optIndex = 0;

				foreach ($options as $opt){
					// <label><input type="radio" name="group1" id="x" /> <span>Label text x</span></label>
					echo '<div class="zbs-radio">';
					echo '<label for="'.$fieldK.'-'.$optIndex.'"><input type="radio" name="'.$postPrefix.$fieldK.'" id="'.$fieldK.'-'.$optIndex.'" value="'.$opt.'"';
					if (isset($value) && $value == $opt) echo ' checked="checked"';
					echo ' /> <span>'.$opt.'</span></label></div>';

					$optIndex++;
				}

			} else echo '-';

			?>
		</div>
		</p><?php
	}

	function render_checkbox_field($fieldK, $fieldV, $value, $postPrefix) {
		?><p>
		<label for="<?php echo $fieldK; ?>"><?php _e($fieldV[1],"zero-bs-crm"); ?>:</label>
		<div class="zbs-field-checkbox-wrap">
			<?php

			// pre DAL 2 = $fieldV[3], DAL2 = $fieldV[2]
			$options = false;
			if (isset($fieldV[3]) && is_array($fieldV[3])) {
				$options = $fieldV[3];
			} else {
				// DAL2 these don't seem to be auto-decompiled?
				// doing here for quick fix, maybe fix up the chain later.
				if (isset($fieldV[2])) $options = explode(',', $fieldV[2]);
			}

			// split fields (multi select)
			$dataOpts = array();
			if (isset($value) && !empty($value)){
				$dataOpts = explode(',', $value);
			}

			if (isset($options) && is_array($options) && count($options) > 0 && $options[0] != ''){

				$optIndex = 0;

				foreach ($options as $opt){
					echo '<div class="zbs-cf-checkbox">';
					echo '<label for="'.$fieldK.'-'.$optIndex.'"><input type="checkbox" name="'.$postPrefix.$fieldK.'-'.$optIndex.'" id="'.$fieldK.'-'.$optIndex.'" value="'.$opt.'"';
					if (in_array($opt, $dataOpts)) echo ' checked="checked"';
					echo ' /> <span>'.$opt.'</span></label></div>';

					$optIndex++;

				}

			} else echo '-';

			?>
		</div>
		</p><?php
	}

	function render_field_by_type( $type, $fieldK, $fieldV, $value, $postPrefix, $showCountryFields, $zbsCustomer ) {
		switch ( $type ) {
			case 'text':
				$this->render_text_field( $fieldK, $fieldV, $value );
				break;
			case 'price':
				$this->render_price_field( $fieldK, $fieldV, $value );
				break;
			case 'date':
				$this->render_date_field( $fieldK, $fieldV, $value );
				break;

			case 'select':
				$this->render_select_field( $fieldK, $fieldV, $value );
				break;

			case 'tel':
				$this->render_telephone_field( $fieldK, $fieldV, $value, $zbsCustomer );
				break;

			case 'email':
				$this->render_email_field( $fieldK, $fieldV, $value );
				break;

			case 'textarea':
				$this->render_text_area_field( $fieldK, $fieldV, $value );
				break;

			// Added 1.1.19
			case 'selectcountry':
				$this->render_country_list_field( $fieldK, $fieldV, $value, $showCountryFields  );
				break;

			// 2.98.5 added autonumber, checkbox, radio
			case 'autonumber':
				// NOT SHOWN on portal :)
				break;

			// radio
			case 'radio':
				$this->render_radio_field( $fieldK, $fieldV, $value, $postPrefix );
				break;

			case 'checkbox':
				$this->render_checkbox_field( $fieldK, $fieldV, $value, $postPrefix );
				break;
		}
	}

}
