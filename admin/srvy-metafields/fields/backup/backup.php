<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SRVY_Field_backup' ) ) {
  class SRVY_Field_backup extends SRVY_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'srvy_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'srvy-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="srvy_import_data" class="srvy-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary srvy-confirm srvy-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'srvy' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="srvy-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary srvy-export" target="_blank">'. esc_html__( 'Export & Download', 'srvy' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="srvy_transient[reset]" value="reset" class="button srvy-warning-primary srvy-confirm srvy-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'srvy' ) .'</button>';

      echo $this->field_after();

    }

  }
}
