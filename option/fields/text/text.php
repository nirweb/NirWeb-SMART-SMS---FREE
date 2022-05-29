<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: text
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'CSFSMARTSMS_Field_text' ) ) {
  class CSFSMARTSMS_Field_text extends CSFSMARTSMS_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $type = ( ! empty( $this->field['attributes']['type'] ) ) ? $this->field['attributes']['type'] : 'text';

      echo wp_kses_post($this->field_before());

      echo '<input type="'. wp_kses_post( $type ) .'" name="'. wp_kses_post( $this->field_name() ) .'" value="'. wp_kses_post( $this->value ) .'"'. wp_kses_post($this->field_attributes()) .' />';

      echo wp_kses_post($this->field_after());

    }

  }
}
