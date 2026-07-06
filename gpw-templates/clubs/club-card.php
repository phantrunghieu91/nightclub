<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Club card
 */
$showExcerpt = $args['show_excerpt'] ?? true;
$orientation = $args['orientation'] ?? 'horizontal';
$title       = get_the_title();
$excerpt     = get_the_excerpt();
$link        = get_permalink();
$thumbnailID = get_post_thumbnail_id() ?? PLACEHOLDER_IMAGE_ID;
$classes = ['club-card', 'jins-card'];
if( $orientation === 'horizontal' ) {
  $classes = array_merge([ 'jins-card--horizontal', 'jins-card--padded' ], $classes);
}
?>
<article class="<?= esc_attr( implode( ' ', $classes )) ?>">
  <a href="<?= esc_url( $link ) ?>" class="jins-card__thumbnail">
    <?= wp_get_attachment_image( $thumbnailID, 'medium_large', false, [ 'alt' => $title ] ) ?>
  </a>
  <div class="jins-card__content">
    <h2 class="jins-card__title">
      <a href="<?= esc_url( $link ) ?>"><?= esc_html( $title ) ?></a>
    </h2>
    <?php if( $showExcerpt && !empty( $excerpt ) ) : ?>
      <div class="jins-card__excerpt"><?= wp_kses_post( $excerpt ) ?></div>
    <?php endif ?>
  </div>
</article>