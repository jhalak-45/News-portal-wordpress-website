<?php 
/*!
 * Admin Page: Settings: OAuth Connections: edit 
 */

// stop direct access
if ( ! defined( 'ZEROBSCRM_PATH' ) ) exit; 

global $zbs;

// Load OAuth
$zbs->load_oauth_handler();

// edits?
if ( isset( $_GET['edit-provider'] ) && $zbs->oauth->legitimate_provider( $_GET['edit-provider'] ) ){

    // which provider?
    $editing_provider = sanitize_text_field( $_GET['edit-provider'] );

    // retrieve summary and existing token config
    $provider = $zbs->oauth->get_provider( $editing_provider );
    $provider_config = $zbs->oauth->get_provider_config( $editing_provider );

    // if not set, prepare
    if ( !is_array( $provider_config ) ){
        $provider_config = array();
    }

    // anything to update?
    if ( isset( $_POST['edit_provider'] ) && zeroBSCRM_isZBSAdminOrAdmin() ){

        $provider_config['id'] = ( isset( $_POST['jpcrm_oauth_setting_' . $editing_provider . '_id'] ) ? sanitize_text_field( $_POST['jpcrm_oauth_setting_' . $editing_provider . '_id'] ) : '' );
        $provider_config['secret'] = ( isset( $_POST['jpcrm_oauth_setting_' . $editing_provider . '_secret'] ) ? sanitize_text_field( $_POST['jpcrm_oauth_setting_' . $editing_provider . '_secret'] ) : '' );

        // direct override
        $zbs->oauth->update_provider_config( $editing_provider, $provider_config );

        // display updated message
        echo zeroBSCRM_UI2_messageHTML( 'info', __( 'Connection settings updated', 'zero-bs-crm' ), __( 'Your OAuth connection settings have been updated.', 'zero-bs-crm' ) . '<br><br><a href="' . zbsLink( $zbs->slugs['settings'] . '&tab=oauth' ) . '" class="ui button green">' . __( 'Return to OAuth Connections', 'zero-bs-crm' ) . '</a>' );

        // reload
        $provider_config = $zbs->oauth->get_provider_config( $editing_provider );

    }

    // Draw edit screen
    ?>
    <form method="post">
    <input type="hidden" name="edit_provider" id="edit_provider" value="1" />
    <table class="table table-bordered table-striped wtab">
            <thead>
                <tr><th colspan=2><?php echo sprintf( __( '%s Connection Settings', 'zero-bs-crm' ), $provider['name'] ); ?></th></tr>
            </thead>
            <tbody>

                <tr>
                    <td><label><?php _e( 'Redirect URI', 'zero-bs-crm' ); ?></label></td>                    
                    <td>
                        <code><?php echo esc_url( $zbs->oauth->get_callback_url( $editing_provider ) ); ?></code>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <hr />
                    </td>
                </tr>

                <tr>
                    <td><label for="jpcrm_oauth_setting_<?php echo $editing_provider; ?>_id"><?php _e( 'Client ID', 'zero-bs-crm' ); ?></label></td>
                    <td>
                        <div class="ui fluid input" style="min-width: 150px;">
                            <input type="text" name="jpcrm_oauth_setting_<?php echo $editing_provider; ?>_id" id="jpcrm_oauth_setting_<?php echo $editing_provider; ?>_id" placeholder="<?php echo sprintf( __( 'e.g. %s', 'zero-bs-crm' ), '595387679191-32p8h47uwks4e0kfcct50irbsj8o8rmp.apps.domain.com' ); ?>" value="<?php if ( isset( $provider_config['id'] ) ) { echo $provider_config['id']; } ?>" />
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><label for="jpcrm_oauth_setting_<?php echo $editing_provider; ?>_secret"><?php _e( 'Client Secret', 'zero-bs-crm' ); ?></label></td>
                    <td>
                        <div class="ui fluid input" style="min-width: 150px;">
                            <input type="text" name="jpcrm_oauth_setting_<?php echo $editing_provider; ?>_secret" id="jpcrm_oauth_setting_<?php echo $editing_provider; ?>_secret" placeholder="<?php echo sprintf( __( 'e.g. %s', 'zero-bs-crm' ), 'KEOCPW-uRiDf-CZsGlXDrtWM2ZJXUqj10aT' ); ?>" value="<?php if ( isset( $provider_config['secret'] ) ) { echo $provider_config['secret']; } ?>" />
                        </div>
                    </td>
                </tr>

                <?php

                // if we have a token for this provider, let's say so here for clarity
                if ( isset( $provider_config['token'] ) && !empty( $provider_config['token'] ) ){ ?>
                <tr>
                    <td><?php _e( 'Connection Status:', 'zero-bs-crm' ); ?></td>
                    <td><?php

                        $status_output = false;
                      
                        if ( isset( $provider_config['expires'] ) ){

                            if ( $provider_config['expires'] < time() ){

                                _e( 'Previously had connection, but has expired.', 'zero-bs-crm' );
                                $status_output = true;

                            } else {

                                echo sprintf( __( 'Connected, expires %s', 'zero-bs-crm' ), date( 'F j, Y, g:i a', $provider_config['expires'] ) );
                                $status_output = true;

                            }

                        }

                        if ( !$status_output ){

                            _e( 'Has connection without expiry specified.', 'zero-bs-crm' );

                        }

                    ?></td>
                </tr><?php

                }

            ?>
                <tr>
                    <td colspan="2">
                        <p style="text-align:center;padding:2em;">
                            <button type="submit" class="ui button primary"><?php _e( 'Save Settings', 'zero-bs-crm' ); ?></button>
                            <?php if ( isset( $provider['docs_url'] ) ){
                                ?><a href="<?php echo esc_url( $provider['docs_url'] ); ?>" target="_blank" class="ui teal button"><?php _e( 'Documentation', 'zero-bs-crm' ); ?></a><?php
                            } ?>
                            <a href="<?php echo zbsLink( $zbs->slugs['settings'] . '&tab=oauth' ); ?>" class="ui button"><?php _e( 'Return to OAuth Connections', 'zero-bs-crm' ); ?></a>
                        </p>
                    </td>
                </tr>

                <?php

            ?></tbody></table></form><?php

}