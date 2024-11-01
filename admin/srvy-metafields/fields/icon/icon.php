<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SRVY_Field_icon' ) ) {
  class SRVY_Field_icon extends SRVY_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'srvy' ),
        'remove_title' => esc_html__( 'Remove Icon', 'srvy' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'srvy_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="srvy-icon-select">';
      echo '<span class="srvy-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary srvy-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button srvy-warning-primary srvy-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="srvy-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'SRVY_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'SRVY_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="srvy-modal-icon" class="srvy-modal srvy-modal-icon hidden">
        <div class="srvy-modal-table">
          <div class="srvy-modal-table-cell">
            <div class="srvy-modal-overlay"></div>
            <div class="srvy-modal-inner">
              <div class="srvy-modal-title">
                <?php esc_html_e( 'Add Icon', 'srvy' ); ?>
                <div class="srvy-modal-close srvy-icon-close"></div>
              </div>
              <div class="srvy-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'srvy' ); ?>" class="srvy-icon-search" />
              </div>
              <div class="srvy-modal-content">
                <div class="srvy-modal-loading"><div class="srvy-loading"></div></div>
                <div class="srvy-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
