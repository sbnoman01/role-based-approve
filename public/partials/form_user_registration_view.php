<?php 


function form_user_registration_view(){ 
    ob_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = [];
        $data['name']           = sanitize_text_field($_REQUEST['clientName']);
        $data['username']       = sanitize_text_field($_REQUEST['clientUserName']);
        $data['email']          = sanitize_email($_REQUEST['clientEmail']);
        $data['account_Type']   = sanitize_text_field($_REQUEST['account_Type']);
        $data['company_name']   = sanitize_text_field($_REQUEST['company_name']);
        $data['piva_']          = sanitize_text_field($_REQUEST['piva_']);
        $data['address']        = sanitize_text_field($_REQUEST['address']);
        $data['password']       = $_REQUEST['password'];

        $nonce_verify = wp_verify_nonce( sanitize_text_field($_POST['register_new_user']), 'register_new_user' );

        if(count($data) > 0 && $nonce_verify == true):
            WPN_Register_New_User::regiser_user($data);
        else:
            echo _('Please Try again, Something is wrong.');
        endif;
    }
	
    ?>

    <form method="post" action="<?php echo get_the_permalink(); ?>" class="wpn_reg_form">

        <!-- Name -->
        <div class="input_group">
            <label for="username">Nome</label>
            <input type="text" name="clientName" id="clientName" >
        </div>

        <!-- Username -->
        <div class="input_group">
            <label for="username">Cognome:</label>
            <input type="text" name="clientUserName" id="clientUserName" required>
        </div>


        <div class="input_group">
            <label for="email">Email:</label>
            <input type="email" name="clientEmail" id="clientEmail" required>
        </div>
 
        <div class="input_group">
            <label for="wpn_account_Type">Account Type:</label>
            <select name="account_Type" id="wpn_account_Type" onchange="accountType()">
                <option value="customer">Customer</option>
                <option value="business">Business</option>
            </select>
        </div>
        <script>
            function accountType(){
                var x = document.getElementById("wpn_account_Type").value;
                if(x == 'business'){
                    jQuery('.for_business').show();
                }else{
                    jQuery('.for_business').hide();
                }
            }
        </script>
        
        <div class="input_group for_business">
            <label for="company_name">Nome Azienda:</label>
            <input type="text" name="company_name" id="company_name">
        </div>
        <div class="input_group for_business">
            <label for="piva_">P. Iva:</label>
            <input type="text" name="piva_" id="piva_">
        </div>
        <div class="input_group for_business">
            <label for="piva_">Indirizzo:</label>
            <input type="text" name="address" id="address">
        </div>

    
		<div class="input_group">
			<label for="password">Password:</label>
        	<input type="password" name="password" required>
		</div>
        <br>

        <input type="hidden" name="register_new_user" value="<?php echo wp_create_nonce('register_new_user') ?>">
        <input type="submit" value="Register">
    </form>

<?php return ob_get_clean();
}