<?php 

class WP_User_DataTable{
    

    public function new_modify_user_table( $column ) {
        $column['wpn_us_status'] = 'Status';
        return $column;
    }

    public function new_modify_user_table_row( $val, $column_name, $user_id ) {
        switch ($column_name) {
            case 'wpn_us_status' :
                return get_user_meta($user_id, 'wpn_user_status', true);
            default:
        }
        return $val;
    }

    public function custom_user_status_field($user) {
        if (current_user_can('manage_options')) {
            $status = get_user_meta($user->ID, 'wpn_user_status', true);
            $com_name = get_user_meta($user->ID, 'company_Name', true) ?? '';
            $piva_name = get_user_meta($user->ID, 'piva_name', true) ?? '';
            $user_address = get_user_meta($user->ID, 'user_address', true) ?? '';
            ?>
            <h3>Custom User Status</h3>
            <table class="form-table">
                <tr>
                    <th><label for="wpn_user_status">Status</label></th>
                    <td>
                        <select name="wpn_user_status" id="wpn_user_status">
                            <option value="Pending" <?php selected($status, 'Pending'); ?>>Pending</option>
                            <option value="Approved" <?php selected($status, 'Approved'); ?>>Approved</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th><label for="company_Name">Nome Azienda</label></th>
                    <td>
                        <input type="text" name="company_Name" id="company_Name" class="regular-text" value="<?php echo $com_name; ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="piva_name">P. Iva</label></th>
                    <td>
                        <input type="text" name="piva_name" id="piva_name" class="regular-text" value="<?php echo $piva_name; ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="user_address">Indirizzo</label></th>
                    <td>
                        <input type="text" name="user_address" id="user_address" class="regular-text" value="<?php echo $user_address; ?>">
                    </td>
                </tr>
            </table>
            <?php
        }
        
    }

    function custom_save_user_status($user_id) {
        if (current_user_can('manage_options')) {
            if (isset($_POST['wpn_user_status'])) {
                update_user_meta($user_id, 'wpn_user_status', $_POST['wpn_user_status']);
            }
            if (isset($_POST['company_Name'])) {
                update_user_meta($user_id, 'company_Name', $_POST['company_Name']);
            }
            if (isset($_POST['piva_name'])) {
                update_user_meta($user_id, 'piva_name', $_POST['piva_name']);
            }
            if (isset($_POST['user_address'])) {
                update_user_meta($user_id, 'user_address', $_POST['user_address']);
            }
        }
    }

}
