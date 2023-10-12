<?php 


class WPN_User_Role{
    public function create_pending_user_role() {
        add_role(
            'business_role',
            'Business',
            array(
                'read' => true,
                'level_0' => true,
            )
        );
    }

    public function myplugin_auth_login ($user, $password) {
        
        //do any extra validation stuff here
        $user_status = get_user_meta($user->ID, 'wpn_user_status', true);

        if ($user_status === 'Pending') {
            $message = 'Your account is Pending. Please wait for approval or contact the administrator for assistance.';
            return new WP_Error('custom_status_blocked', $message);
        }else{
            return $user;
        }
    }
}