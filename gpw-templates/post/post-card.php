<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Post - Post card
 */
$showExcerpt = $args['show_excerpt'] ?? true;
$orientation = $args['orientation']  ?? '';

$id          = get_the_ID();
$title       = get_the_title();
$excerpt     = get_the_excerpt();
$link        = get_the_permalink();
$thumbnailID = get_post_thumbnail_id() ?: PLACEHOLDER_IMAGE_ID;

$classes = ['post-card', 'jins-card', 'jins-card--padded'];
if( $orientation === 'horizontal' ) {
  $classes[] = 'jins-card--horizontal';
}
?>
<article class="<?= esc_attr( implode( ' ', $classes ) ) ?>">
  <a href="<?= esc_html( $link ) ?>" class="jins-card__thumbnail">
    <?= wp_get_attachment_image( $thumbnailID, 'medium_large', false, [ 'alt' => $title ] ) ?>
  </a>
  <div class="jins-card__content">
    <h4 class="jins-card__title line-clamp">
      <a href="<?= esc_html( $link ) ?>"><?= esc_html( $title ) ?></a>
    </h4>
    <?php if( $showExcerpt && !empty( $excerpt ) ) : ?>
      <div class="jins-card__excerpt line-clamp"><?= esc_html( $excerpt ) ?></div>
    <?php endif ?>
  </div>
</article>