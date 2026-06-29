<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Global - Hero section
 */
$sectionData = get_field( 'hero' );
if( empty( $sectionData['banner'] ) ) {
  return;
} ?>
<section class="hero">
  <div class="section__inner section__inner--full">
    <?= wp_get_attachment_image( $sectionData['banner'], 'full', false, ['class' => 'hero__banner', 'alt' => 'Hero banner'] ) ?>
  </div>
</section>