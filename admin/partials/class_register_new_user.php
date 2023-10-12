<?php 


class WPN_Register_New_User{

    public function regiser_user($data){

        // check if suplied param is an array
        if( !is_array($data) ){
            return;
        }

        $user_data = [];
        $user_data['first_name'] = $data['name'];
        $user_data['user_login'] = $data['username'];
        $user_data['user_email'] = $data['email'];
        $user_data['user_pass']  = $data['password'];
        
        if($data['account_Type'] == 'business'){
            $user_data['role'] = 'business';
            $status = 'Pending';
        }else{
            $user_data['role'] = 'customer';
            $status = 'Approved';
        }

        if( !username_exists($user_data['user_login']) || !email_exists($user_data['email'])){
            // Insert the user into the database
            $user_id = wp_insert_user($user_data);

            if (is_wp_error($user_id)) {
                // There was an error in user creation
                echo "Error: " . $user_id->get_error_message();
            } else {
                // update the status to pending
                update_user_meta($user_id, 'wpn_user_status', $status);
                if($user_data['role'] == 'business'){
                    echo 'Thank you for registration, Your account is pending now, We will review and approve!';

                    // update the meta
                    update_user_meta($user_id, 'company_Name', $data['company_name']);
                    update_user_meta($user_id, 'piva_name', $data['piva_']);
                    update_user_meta($user_id, 'user_address', $data['address']);

                }else{
                    echo 'You have successfully registerd!';
                }
            }
        }
    }

    public function login_user($data){

        $creds = array(
            'user_login' => $data['username'],
            'user_password' => $data['password'],
            'remember' => true,
        );

        $user = wp_signon($creds, false );

    }

}