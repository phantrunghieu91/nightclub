<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single post - header
 */
const HEADER_BG_IMG_ID = 147;
$primaryCategoryID     = get_post_meta( get_the_ID(), 'rank_math_primary_category', true );
$category              = null;
if( $primaryCategoryID ) {
  $category = get_category( $primaryCategoryID );
} else {
  $categories = get_the_category();
  $category   = !empty( $categories ) ? $categories[0] : null;
}
?>
<header class="post-header hero hero--with-content" 
  style="background: var(--primary-color-500) url(<?= wp_get_attachment_image_url( HEADER_BG_IMG_ID, 'full' ) ?>) center / cover no-repeat;">
  <div class="section__inner">
    <div class="hero__content">
      <strong class="hero__title">
        <a href="<?= get_term_link( $category ) ?>"><?= esc_html( $category->name ) ?></a>
      </strong>
      <?php if( function_exists( 'rank_math_the_breadcrumbs' ) ) rank_math_the_breadcrumbs(); ?>
    </div>
  </div>
</header>