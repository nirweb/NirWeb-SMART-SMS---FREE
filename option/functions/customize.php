<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * WP Customize custom panel
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WP_Customize_Panel_CSF' ) && class_exists( 'WP_Customize_Panel' ) ) {
  class WP_Customize_Panel_CSF extends WP_Customize_Panel {
    public $type = 'CFSSMARTSMS';
  }
}

/**
 *
 * WP Customize custom section
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WP_Customize_Section_CSF' ) && class_exists( 'WP_Customize_Section' ) ) {
  class WP_Customize_Section_CSF extends WP_Customize_Section {
    public $type = 'CFSSMARTSMS';
  }
}

/**
 *
 * WP Customize custom control
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WP_Customize_Control_CSF' ) && class_exists( 'WP_Customize_Control' ) ) {
  class WP_Customize_Control_CSF extends WP_Customize_Control {

    public $type   = 'CFSSMARTSMS';
    public $field  = '';
    public $unique = '';

    public function render() {

      $depend  = '';
      $visible = '';

      if ( ! empty( $this->field['dependency'] ) ) {

        $dependency      = $this->field['dependency'];
        $depend_visible  = '';
        $data_controller = '';
        $data_condition  = '';
        $data_value      = '';
        $data_global     = '';

        if ( is_array( $dependency[0] ) ) {
          $data_controller = implode( '|', array_column( $dependency, 0 ) );
          $data_condition  = implode( '|', array_column( $dependency, 1 ) );
          $data_value      = implode( '|', array_column( $dependency, 2 ) );
          $data_global     = implode( '|', array_column( $dependency, 3 ) );
          $depend_visible  = implode( '|', array_column( $dependency, 4 ) );
        } else {
          $data_controller = ( ! empty( $dependency[0] ) ) ? $dependency[0] : '';
          $data_condition  = ( ! empty( $dependency[1] ) ) ? $dependency[1] : '';
          $data_value      = ( ! empty( $dependency[2] ) ) ? $dependency[2] : '';
          $data_global     = ( ! empty( $dependency[3] ) ) ? $dependency[3] : '';
          $depend_visible  = ( ! empty( $dependency[4] ) ) ? $dependency[4] : '';
        }

        $depend .= ' data-controller="'. wp_kses_post( $data_controller ) .'"';
        $depend .= ' data-condition="'. wp_kses_post( $data_condition ) .'"';
        $depend .= ' data-value="'. wp_kses_post( $data_value ) .'"';
        $depend .= ( ! empty( $data_global ) ) ? ' data-depend-global="true"' : '';

        $visible  = ' CFSSMARTSMS-dependency-control';
        $visible .= ( ! empty( $depend_visible ) ) ? ' CFSSMARTSMS-depend-visible' : ' CFSSMARTSMS-depend-hidden';

      }

      $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
      $class = 'customize-control customize-control-'. $this->type . $visible;

      echo '<li id="'. wp_kses_post( $id ) .'" class="'. wp_kses_post( $class ) .'"'. wp_kses_post($depend) .'>';
      $this->render_field_content();
      echo '</li>';

    }

    public function render_field_content() {

      $complex = apply_filters( 'csf_customize_complex_fields', array(
        'accordion',
        'background',
        'border',
        'button_set',
        'checkbox',
        'color_group',
        'date',
        'dimensions',
        'fieldset',
        'group',
        'image_select',
        'link',
        'link_color',
        'media',
        'palette',
        'repeater',
        'sortable',
        'sorter',
        'spacing',
        'switcher',
        'tabbed',
        'typography'
      ) );

      $field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
      $custom     = ( ! empty( $this->field['customizer'] ) ) ? true : false;
      $is_complex = ( in_array( $this->field['type'], $complex ) ) ? true : false;
      $class      = ( $is_complex || $custom ) ? ' CFSSMARTSMS-customize-complex' : '';
      $atts       = ( $is_complex || $custom ) ? ' data-unique-id="'. wp_kses_post( $this->unique ) .'" data-option-id="'. wp_kses_post( $field_id ) .'"' : '';

      if ( ! $is_complex && ! $custom ) {
        $this->field['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
      }

      $this->field['name'] = $this->settings['default']->id;

      $this->field['dependency'] = array();

      echo '<div class="CFSSMARTSMS-customize-field'. wp_kses_post( $class ) .'"'. wp_kses_post($atts) .'>';

      CFSSMARTSMS::field( $this->field, $this->value(), $this->unique, 'customize' );

      echo '</div>';

    }

  }
}
