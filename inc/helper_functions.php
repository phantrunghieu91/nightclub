<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Helper functions
 */
if( !function_exists( 'jins_render_image' ) ) {
  function jins_render_image( $img_id, $size = 'medium', $options = [] ) {
    $default_class = 'depend-on-parent';
    if( isset( $options['class'] ) ) {
      $options['class'] .= " $default_class";
    } else {
      $options['class'] = $default_class;
    }
    return wp_get_attachment_image( $img_id, $size, false, $options );
  }
}