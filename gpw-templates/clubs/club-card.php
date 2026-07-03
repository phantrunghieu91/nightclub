<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Club card
 */
$title = get_the_title();
$excerpt = get_the_excerpt();
$link = get_permalink();
$thumbnailID = get_post_thumbnail_id() ?? PLACEHOLDER_IMAGE_ID;
?>
<article class="jins-card jins-card--horizontal jins-card--padded">
  <a href="<?= esc_url( $link ) ?>" class="jins-card__thumbnail">
    <?= wp_get_attachment_image( $thumbnailID, 'medium_large', false, [ 'alt' => $title ]) ?>
  </a>
  <div class="jins-card__content">
    <h2 class="jins-card__title">
      <a href="<?= esc_url( $link ) ?>"><?= esc_html( $title ) ?></a>
    </h2>
    <div class="jins-card__excerpt"><?= wp_kses_post( $excerpt ) ?></div>
  </div>
</article>