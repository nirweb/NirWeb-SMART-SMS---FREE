<?php
CFSSMARTSMS::createSection( $prefix, array(
    'title'  => esc_html__('phone registration', 'nss'),
    'fields' => array(
        array(
            'type'    => 'content',
            'content' => '<div class="nirweb_activate_pro_notice">'.esc_html__('activate pro version for the settings.','nss').'</div>',
        ),
        array(
            'id'         => 'add_phone_field',
            'type'       => 'switcher',
            'title'  =>  esc_html__('Add phone number field to wordpress registration form.','nss'),
            'subtitle' => esc_html__('user\'s phone number will be saved in nirweb_phone user meta.','nss'),
            'text_width' => 100,
            'default'    => false
        ),
        array(
            'id'         => 'phone_field_required',
            'type'       => 'switcher',
            'title'  =>  esc_html__('require phone number field.','nss'),
            'text_width' => 100,
            'dependency' => array('add_phone_field' ,'==' , true),
            'default'    => false
        ),
        array(
            'id'         => 'add_phone_field_woo',
            'type'       => 'switcher',
            'title'  =>  esc_html__('Add phone number field to woocommerce registration form.','nss'),
            'subtitle' => esc_html__('user\'s phone number will be saved in nirweb_phone user meta.','nss'),
            'text_width' => 100,
            'default'    => false
        ),
        array(
            'id'         => 'phone_field_required_woo',
            'type'       => 'switcher',
            'title'  =>  esc_html__('require phone number field.','nss'),
            'text_width' => 100,
            'dependency' => array('add_phone_field_woo' ,'==' , true),
            'default'    => false
        ),
    )
));