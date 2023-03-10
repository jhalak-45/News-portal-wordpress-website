<?php
/**
 * Payment Thank You
 *
 * This is used as a 'Payment Confirmation' when payment success
 *
 * @author 		ZeroBSCRM
 * @package 	Templates/Portal/Thanks
 * @see			https://jetpackcrm.com/kb/
 * @version     3.0
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Don't allow direct access

global $zbs;
$portal = $zbs->modules->portal;

do_action( 'zbs_enqueue_scripts_and_styles' );

	$uid = get_current_user_id();
	$uinfo = get_userdata( $uid );
	$cID = zeroBS_getCustomerIDWithEmail($uinfo->user_email);
	
?>
<div class="alignwide zbs-site-main zbs-portal-grid">
	<nav class="zbs-portal-nav">
		<?php
			$portal->render->portal_nav('dashboard');
		?>
	</nav>

	<div class="zbs-portal-content">
		<?php
			// preview msg
			$portal->render->admin_preview_message( $cID, 'margin-bottom:1em' );

			// admin msg (upsell cpp) (checks perms itself, safe to run)
			$portal->render->admin_message();

		?>
		<h2><?php _e("Thank You", "zero-bs-crm"); ?></h2>
		<div class='zbs-entry-content' style="position:relative;">
			<p>
			<?php _e("Thank you for your payment.", "zero-bs-crm"); ?>
			</p>
		</div>
	</div>
	<div class="zbs-portal-grid-footer"><?php $portal->render->portal_footer(); ?></div>
</div>