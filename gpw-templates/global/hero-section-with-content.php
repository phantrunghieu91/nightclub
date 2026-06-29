<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Global - Hero section with content
 */
$sectionData = get_field( 'hero' );
if( empty( $sectionData['bg_image'] ) && empty( $sectionData['title'] ) ) {
  return;
} ?>
<section class="hero hero--with-content" 
  <?php if( !empty( $sectionData['bg_image'])) echo sprintf(' style="background-image:url(%s);"', wp_get_attachment_image_url( $sectionData['bg_image'], 'full' )); ?>
>
  <div class="section__inner">
    <div class="hero__content">
      <h1 class="hero__title"><?= esc_html( $sectionData['title']) ?></h1>
      <?php if( !empty( $sectionData['content'])) : ?>
        <div class="hero__description"><?= wp_kses_post( $sectionData['content']) ?></div>
      <?php endif ?>
    </div>
  </div>
</section>