<?php
CFSSMARTSMS::createSection( $prefix, array(
    'title'  => '<div class="nirweb_codestar_icon">'.esc_html__('Tera Wallet', 'nss').'<span><i class="fas fa-lock"></i>PRO</span></div>',
    'fields' => array(
        array(
            'type'    => 'content',
            'content' => '<div class="nirweb_activate_pro_notice">'.esc_html__('activate pro version for the settings.','nss').'</div>',
        ),
        array(
            'type'    => 'notice',
            'style'   => 'info',
            'content' => esc_html__('Make sure you have Tera wallet installed and activated.','nss'),
        ),
        array(
            'id'    => 'woowallet_activate',
            'type'  => 'switcher',
            'title' => esc_html__('Activate to send a notification to the user.','nss'),
            'text_width' => 100
        ),
        array(
            'id'     => 'woowallet_options',
            'type'   => 'fieldset',
            'title'  => esc_html__('Activate the variables used in your pattern','nss'),
            'subtitle' => esc_html__('for mellipayamak use 0 for amount , 1 for type , 2 for date , 3 for balance','nss'),
            'dependency' => array( 'woowallet_activate', '==', 'true' ),
            'fields' => array(
                array(
                    'id'    => 'amount',
                    'type'  => 'switcher',
                    'title' => esc_html__('amount','nss'),
                    'text_width' => 100,
                    'subtitle' => esc_html__('use variable amount for transaction\'s amount in your pattern','nss'),
                ),
                array(
                    'id'    => 'type',
                    'type'  => 'switcher',
                    'title' => esc_html__('type','nss'),
                    'text_width' => 100,
                    'subtitle' => esc_html__('use variable type for transaction\'s type in your pattern','nss'),
                ),
                array(
                    'id'    => 'date',
                    'type'  => 'switcher',
                    'title' => esc_html__('date','nss'),
                    'text_width' => 100,
                    'subtitle' => esc_html__('use variable date for the transaction\'s date in your pattern','nss'),
                ),
                array(
                    'id'    => 'balance',
                    'type'  => 'switcher',
                    'title' => esc_html__('balance','nss'),
                    'text_width' => 100,
                    'subtitle' => esc_html__('use variable balance for the transaction\'s balance in your pattern','nss'),
                ),
            ),
        )
    )
));