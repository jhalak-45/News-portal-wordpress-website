<?php
/*!
 * Jetpack CRM
 * https://jetpackcrm.com
 *
 * WooSync: Admin: Connection edit page
 *
 */
namespace Automattic\JetpackCRM;

// block direct access
defined( 'ZEROBSCRM_PATH' ) || exit;

/**
 * Page: Connection edit page
 */
function jpcrm_settings_page_html_woosync_connection_edit() {

	global $zbs;

	$settings = $zbs->modules->woosync->settings->getAll();

	if ( isset( $_GET['site_key'] ) ){

		$site_key = sanitize_text_field( $_GET['site_key'] );

		// retrieve connected store
		$sync_site = $zbs->modules->woosync->get_active_sync_site( $site_key );

	}

	if ( !isset( $sync_site ) || !is_array( $sync_site ) ){

		// fail
		echo zeroBSCRM_UI2_messageHTML( 'warning', '', __( 'No such connection exists.', 'zero-bs-crm' ), 'info' );

	} else {

		// process any updates
		if ( isset( $_POST['edit_connection'] ) ){


		    // check nonce
		    check_admin_referer( 'woosync-connection-edit' );


		    // process data
		    $sync_site['key'] = ( isset( $_POST['woosync_key'] ) ? sanitize_text_field( $_POST['woosync_key'] ) : '' );
		    $sync_site['secret'] = ( isset( $_POST['woosync_secret'] ) ? sanitize_text_field( $_POST['woosync_secret'] ) : '' );
		    $sync_site['prefix'] = ( isset( $_POST['woosync_prefix'] ) ? sanitize_text_field( $_POST['woosync_prefix'] ) : '' );		    

		    // verify (ideally we'd say 'these connection settings don't work, are you sure', but for now let's keep it simple)
		    $verified_change = $zbs->modules->woosync->verify_api_connection( '', $sync_site['domain'],$sync_site['key'], $sync_site['secret'] );

		    // update
		    $sync_site['site_key'] = $site_key;
			$zbs->modules->woosync->update_sync_site( $sync_site );
			$connection_updated = true;

			// reload connected store
			$sync_site = $zbs->modules->woosync->get_active_sync_site( $site_key );

		}


		// normal page 
		switch ( $sync_site['mode'] ){

			case JPCRM_WOO_SYNC_MODE_LOCAL:

				$site_title = __( 'Local', 'zero-bs-crm' );

				break;

			case JPCRM_WOO_SYNC_MODE_API:

				$site_title = __( 'External', 'zero-bs-crm' );

				break;

		}


		?>

		<p><?php echo sprintf( __( 'From this page you can edit connection details for a connection between Jetpack CRM and one or more WooCommerce stores. <a href="%s" target="_blank">Read more about connecting Jetpack CRM to WooCommerce</a>.', 'zero-bs-crm' ), $zbs->urls['connect-multi-woo'] ); ?></p>

		<h3 style="text-align: center;" class="ui blue header"><?php echo sprintf( __( 'Edit %s WooCommerce Connection', 'zero-bs-crm' ), $site_title ); ?></h3>
		
		<?php if ( isset( $connection_updated ) ){

			$connection_message = __( 'Your connection settings have been updated. Your new connection settings have been verified.', 'zero-bs-crm' );

			if ( !$verified_change ){

				$connection_message = __( 'Your connection settings have been updated with one Warning: Your new connection settings could not be verified.', 'zero-bs-crm' );

			}

			echo zeroBSCRM_UI2_messageHTML( 'info', __( 'Connection Updated', 'zero-bs-crm' ), $connection_message );

		} ?>

		<form method="post">
		    <input type="hidden" name="edit_connection" id="edit_connection" value="1" />
		    <?php
		    // add nonce
		    wp_nonce_field( 'woosync-connection-edit');
		    ?>
			<table class="table table-striped wtab">
				<tbody>
			        <tr>
			            <td class="wfieldname"><label for="woosync_mode"><?php _e( 'Mode','zero-bs-crm' ); ?>:</label></td>
			            <td style="width:540px"><?php 

							switch ( $sync_site['mode'] ){

								case JPCRM_WOO_SYNC_MODE_LOCAL:

									echo '<span class="ui label teal"><i class="home icon"></i> ' . __( 'Local', 'zero-bs-crm' ) . '</span>';

									break;

								case JPCRM_WOO_SYNC_MODE_API:

									echo '<span class="ui label blue"><i class="plug icon"></i> ' . __( 'External', 'zero-bs-crm' ) . '</span>';

									break;

							}

			            ?></td>
			        </tr>
			        <tr>
			            <td class="wfieldname"><label for="woosync_domain"><?php _e( 'Store domain', 'zero-bs-crm' ); ?>:</label></td>
			            <td style="width:540px"><?php echo $sync_site['domain']; ?></td>
			        </tr><?php 

							switch ( $sync_site['mode'] ){

								case JPCRM_WOO_SYNC_MODE_LOCAL:

								// Local sites, no editing of the key/secret

									?>
					<tr style="display:none">
			            <td colspan="2">
			            	<input type="hidden" name="woosync_key" id="woosync_key" value="<?php if (isset($sync_site['key']) && !empty($sync_site['key'])) echo $sync_site['key']; ?>" />
			            	<input type="hidden" name="woosync_secret" id="woosync_secret" value="<?php if (isset($sync_site['secret']) && !empty($sync_site['secret'])) echo $sync_site['secret']; ?>" />
			            </td>
			        </tr>

		        				<?php
									break;

								case JPCRM_WOO_SYNC_MODE_API:

								// External sites can edit the key and secret

									?>
					<tr>
			            <td class="wfieldname"><label for="woosync_key"><?php _e( 'API Key', 'zero-bs-crm' ); ?>:</label></td>
			            <td style="width:540px"><input type="text" class="winput form-control" name="woosync_key" id="woosync_key" value="<?php if (isset($sync_site['key']) && !empty($sync_site['key'])) echo $sync_site['key']; ?>" placeholder="e.g. ck_99966f77a8e9ace9efb689a6fa7f5334ac9ea645" /></td>
			        </tr>
			       	<tr>
			            <td class="wfieldname"><label for="woosync_secret"><?php _e( 'API Secret', 'zero-bs-crm' ); ?>:</label></td>
			            <td style="width:540px"><input type="text" class="winput form-control" name="woosync_secret" id="woosync_secret" value="<?php if (isset($sync_site['secret']) && !empty($sync_site['secret'])) echo $sync_site['secret']; ?>" placeholder="e.g. cs_9994bcfb20e188073b609650487736196d841015" /></td>
			        </tr>

		        				<?php
									break;

							}

			            ?>
			       	<tr>
			            <td class="wfieldname"><label for="woosync_prefix"><?php _e('Order Prefix','zero-bs-crm'); ?>:</label></td>
			            <td style="width:540px"><input type="text" class="winput form-control" name="woosync_prefix" id="woosync_prefix" value="<?php if (isset($sync_site['prefix']) && !empty($sync_site['prefix'])) echo $sync_site['prefix']; ?>" placeholder="e.g. example_" /></td>
			        </tr>
				</tbody>
				<tfoot>

					<tr>
						<td colspan="2" class="wmid" style="padding-top:1.5em">
							<button class="ui blue button" id="jpcrm-woosync-save-connection-details" type="submit"><?php _e( 'Update Connection', 'zero-bs-crm' ); ?></button>
							<?php

								echo sprintf(
									'<a href="%s&tab=%s&subtab=%s" class="ui basic button" style="margin-top:1em">%s</a>',
									zbsLink($zbs->slugs['settings']),
									$zbs->modules->woosync->slugs['settings'],
									$zbs->modules->woosync->slugs['settings_connections'],
									__( 'Back to Store Connections', 'zero-bs-crm' )
								);

							?>
						</td>
					</tr>

				</tfoot>
			</table>
		</form>

		<script type="text/javascript">

			jQuery(document).ready(function(){

			});


		</script>

		<?php

	} // / normal page load

}