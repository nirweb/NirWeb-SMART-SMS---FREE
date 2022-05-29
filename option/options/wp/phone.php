<?php
CFSSMARTSMS::createSection( $prefix, array(
    'title'  => '<div class="nirweb_codestar_icon">'.esc_html__('phone', 'nss').'<span><i class="fas fa-lock"></i>PRO</span></div>',
    'fields' => array(
        array(
            'type'    => 'content',
            'content' => '<div class="nirweb_activate_pro_notice">'.esc_html__('activate pro version for the settings.','nss').'</div>',
        ),
        array(
            'id'         => 'phone_shortcode_active',
            'type'       => 'switcher',
            'title'  =>  esc_html__('active phone shortcode.','nss'),
            'subtitle' => esc_html__('user\'s phone numbers will be saved and shown in admin panel.','nss'),
            'text_width' => 100,
            'default'    => false
        ),
        array(
            'type' => 'submessage',
            'style' => 'danger',
            'content' => '<p style="font-size: 16px">' . esc_html__('use shortcode [phone_box_nirweb]', 'nss') . '</p>',
            'dependency' => array(['phone_shortcode_active', '==', true]),
        ),
    )
));