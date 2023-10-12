<?php 


class WPN_Shortocde{

    static function user_registration_form( $atts ) {

        $path = plugin_dir_path(dirname(__FILE__)) . '/public/partials/form_user_registration_view.php';

        if( file_exists($path) ){
            require $path;
            return form_user_registration_view();
        }
    }
    static function user_login_form( $atts ) {
        $path = plugin_dir_path(dirname(__FILE__)) . '/public/partials/form_user_login_view.php';

        if( file_exists($path) ){
            require $path;
            return form_user_login_view();
        }
    }
}