<?php 


function form_user_login_view(){ 
    ob_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = [];
        $data['username']       = sanitize_text_field($_REQUEST['username']);
        // $data['email']          = sanitize_email($_REQUEST['clientEmail']);
        $data['password']       = $_REQUEST['password'];

        if(count($data) > 0)
            WPN_Register_New_User::login_user($data);
        
    }
    ?>

    <form method="post" action="<?php echo get_the_permalink(); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>

        <input type="submit" value="Login">
    </form>

<?php return ob_get_clean();
}