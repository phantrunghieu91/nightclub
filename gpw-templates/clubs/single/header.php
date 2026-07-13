<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single clubs - header
 */
$headerBgID = get_field( 'cat_header_bg_img_id', 'gpw_settings' ) ?: 147;
$currentObj = get_queried_object();
$postTypeObj = get_post_type_object( $currentObj->post_type );
?>
<header class="post-header hero hero--with-content" 
  style="background: var(--primary-color-500) url(<?= wp_get_attachment_image_url( $headerBgID, 'full' ) ?>) center / cover no-repeat;">
  <div class="section__inner">
    <div class="hero__content">
      <strong class="hero__title"><?= $postTypeObj->label ?></strong>
      <?php if( function_exists( 'rank_math_the_breadcrumbs' ) ) rank_math_the_breadcrumbs(); ?>
    </div>
  </div>
</header>