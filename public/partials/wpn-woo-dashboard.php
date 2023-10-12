<?php 


class WPN_Woo_dashboard{
    
    public function wpn_add_woo_business_fields() {
        
        $user = wp_get_current_user();

        // only show for business and admin user
        if( $user->roles[0] == 'administrator' || $user->roles[0] == 'business_role'){

            $com_name = get_user_meta($user->ID, 'company_Name', true) ?? '';
            $piva_name = get_user_meta($user->ID, 'piva_name', true) ?? '';
            $user_address = get_user_meta($user->ID, 'user_address', true) ?? '';
            ?>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="company_name"><?php _e( 'Nome Azienda', 'woocommerce' ); ?></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="company_Name" id="company_Name" value="<?php echo esc_attr( $com_name ); ?>" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="piva_name"><?php _e( 'P. Iva', 'woocommerce' ); ?></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="piva_name" id="v" value="<?php echo esc_attr( $piva_name ); ?>" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="user_address"><?php _e( 'Indirizzo', 'woocommerce' ); ?></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="user_address" id="user_address" value="<?php echo esc_attr( $user_address ); ?>" />
                </p>
            <?php

        }
    }

    public function save_woo_business_field_account_details( $user_id ) {
        // For Favorite color
        if( isset( $_POST['company_Name'] ) )
            update_user_meta( $user_id, 'company_Name', sanitize_text_field( $_POST['company_Name'] ) );
        if( isset( $_POST['piva_name'] ) )
            update_user_meta( $user_id, 'piva_name', sanitize_text_field( $_POST['piva_name'] ) );
        if( isset( $_POST['user_address'] ) )
            update_user_meta( $user_id, 'user_address', sanitize_text_field( $_POST['user_address'] ) );
    }
}