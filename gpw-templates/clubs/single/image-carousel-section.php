<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club page - Image carousel section
 */
$imageIds = $args['image_ids'] ?? [];
$title    = $args['title']     ?? '';
$note     = $args['note']      ?? '';
if( empty( $imageIds ) ) {
  return;
}
$fancySlug  = sanitize_title( $title );
$slideItems = [];
foreach( $imageIds as $imageID ) {
  $imageFullUrl = wp_get_attachment_image_url( $imageID, 'full' );
  $slideItems[] = sprintf( '<a href="%s" data-fancybox="gallery-%s">%s</a>',
    esc_url( $imageFullUrl ),
    esc_attr( $fancySlug ),
    wp_get_attachment_image( $imageID, 'medium_large' ),
  );
}
?>
<section class="image-carousel">
  <div class="section__inner">
    <?php if( !empty( $title ) ) : ?>
      <h2 class="section__title"><?= esc_html( $title ) ?></h2>
    <?php endif ?>
    <?php get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true ] ) ?>
    <?php if( !empty( $note )) : ?>
      <p class="image-carousel__note"><?= esc_html( $note ) ?></p>
    <?php endif ?>
  </div>
</section>