<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club - customer review form
 */
if( !post_type_supports( 'clubs', 'comments' ) ) {
  return;
}
comments_template();