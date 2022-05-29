<?php
/***************************************
#----------Contact 7
 ******************************************************/
if(is_plugin_active('contact-form-7/wp-contact-form-7.php') && nirweb_smart_sms_option['contact_7_activate'] == '1' && !empty(nirweb_smart_sms_option['contact_7_rep'])){

    add_action("wpcf7_before_send_mail",function ($cf7) {
        $cf7 = WPCF7_ContactForm::get_current();
        foreach(nirweb_smart_sms_option['contact_7_rep'] as $item){
            if($item['contact_7_form'] == $cf7->id){
                $output  =  Nirweb_smart_sms_data::nirweb_smart_sms_contact_7_data($cf7->id);
                Nirweb_smart_sms_data::nirweb_smart_send_sms(nirweb_smart_sms_option['pattern_contact_7'],$output,trim($item['phone_contact_7']));
                break;
            }
        }
        return $cf7;
    });
}
/***************************************
#----------LearnDash
 ******************************************************/
if(is_plugin_active('sfwd-lms/sfwd_lms.php')) {
    add_action('learndash_course_completed', function ($data) {
        $course_id = $data['course']->ID;
        $user_id = $data['user']->ID;
        if (nirweb_smart_sms_option['learndash']['course_complete_admin_activate'] == '1' && !empty(nirweb_smart_sms_option['learndash']['course_complete_admin_pattern'])) {
            $output = Nirweb_smart_sms_data::nirweb_smart_sms_learnpress($user_id, $course_id);
            foreach (nirweb_smart_sms_option['to'] as $item){
                Nirweb_smart_sms_data::nirweb_smart_send_sms(nirweb_smart_sms_option['learndash']['course_complete_admin_pattern'], $output, $item['to_phone']);
            }
        }
        if (nirweb_smart_sms_option['learndash']['course_complete_user_activate'] == '1' && !empty(nirweb_smart_sms_option['learndash']['course_complete_user_pattern'])) {
            $output = Nirweb_smart_sms_data::nirweb_smart_sms_learnpress($user_id, $course_id);
            $phone = get_user_meta($user_id, nirweb_smart_sms_option['user_meta'], true);
            Nirweb_smart_sms_data::nirweb_smart_send_sms(nirweb_smart_sms_option['learndash']['course_complete_user_pattern'], $output, $phone);
        }

    }, 10, 1);
}

/***************************************
#---------- Add phone field to Wordpress registration form
 ******************************************************/
if(nirweb_smart_sms_option['add_phone_field'] == '1'){
    add_action( 'register_form',function() {
        ?>
        <p>
            <label for="nirweb_phone">
                <?= esc_html__( 'Phone number', 'nss' ) ?> <br/>
                <input type="text" class="regular_text" name="nirweb_phone" />
            </label>
        </p>
        <?php
    } );

    add_filter( 'registration_errors', function ( $errors, $sanitized_user_login, $user_email ) {

        if ( nirweb_smart_sms_option['phone_field_required'] == '1'&& (empty( $_POST['nirweb_phone'] ) || !is_numeric($_POST['nirweb_phone']) || strlen($_POST['nirweb_phone']) != 11)) {
            $errors->add( 'first_or_last', esc_html__( '<strong>ERROR</strong>: phone number is missing', 'nss' ) );
        }

        return $errors;
    }, 10, 3 );

    add_action( 'user_register', function( $user_id ) {

        if ( ! empty( $_POST['nirweb_phone'] ) ) {
            update_user_meta( $user_id, 'nirweb_phone', sanitize_text_field($_POST['nirweb_phone']) ) ;
        }

    });

}

/***************************************
#---------- Add phone field to woocommerce registration form
 ******************************************************/

if(nirweb_smart_sms_option['add_phone_field_woo'] == '1'){
    add_action( 'woocommerce_register_form_start', function(){
        ?>
        <p class="form-row form-row-wide">
            <label for="nirweb_phone"><?= esc_html__( 'Phone number', 'nss' ) ?></label>
            <input  class="input-text" type="text" name="nirweb_phone" />
        </p>
        <?php
    });

    add_action('woocommerce_register_post',function ($username, $email, $validation_errors){
        if (nirweb_smart_sms_option['add_phone_field_woo'] == '1'&& (empty( $_POST['nirweb_phone'] ) || !is_numeric($_POST['nirweb_phone']) || strlen($_POST['nirweb_phone']) != 11)) {
            $validation_errors->add('phone_number_woo_error',  esc_html__( '<strong>ERROR</strong>: phone number is missing', 'nss' ) );
        }
        return $validation_errors;
    }, 10, 3);

    add_action('woocommerce_created_customer', function ($customer_id){
        if (isset($_POST["nirweb_phone"])) {
            update_user_meta($customer_id, "nirweb_phone", sanitize_text_field($_POST["nirweb_phone"]));
        }
    });
}
