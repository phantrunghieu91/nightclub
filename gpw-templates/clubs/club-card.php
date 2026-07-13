<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Club card
 */
$isTemplate  = $args['is_template']  ?? false;
$showExcerpt = $args['show_excerpt'] ?? true;
$orientation = $args['orientation']  ?? 'horizontal';
$title       = get_the_title();
$excerpt     = get_the_excerpt();
$link        = get_permalink();
$thumbnailID = get_post_thumbnail_id() ?? PLACEHOLDER_IMAGE_ID;
$classes     = ['club-card', 'jins-card'];
if( $orientation === 'horizontal' ) {
  $classes = array_merge( [ 'jins-card--horizontal', 'jins-card--padded' ], $classes );
}
?>
<?php if( true === $isTemplate ) {
  echo '<template id="club-card-template">';
} ?>
<article 
  <?php if ( $isTemplate ) {
    echo sprintf( 'class="%s"', implode( ' ', $classes ) );
  } else post_class( $classes ); ?> 
>
  <a href="<?= !$isTemplate ? esc_url( $link ) : '' ?>" class="jins-card__thumbnail">
    <?php if( false === $isTemplate ) {
      echo wp_get_attachment_image( $thumbnailID, 'medium_large', false, [ 'alt' => $title ] );
    } else {
      echo '<img src="" srcset="" alt="Image alt" />';
    } ?>
  </a>
  <div class="jins-card__content">
    <h2 class="jins-card__title">
      <a href="<?= !$isTemplate ? esc_url( $link ) : '' ?>"><?= !$isTemplate ? esc_html( $title ) : '' ?></a>
    </h2>
    <?php if( $showExcerpt && !empty( $excerpt ) ) : ?>
      <div class="jins-card__excerpt"><?= !$isTemplate ? wp_kses_post( $excerpt ) : '' ?></div>
    <?php endif ?>
  </div>
</article>
<?php if( true === $isTemplate ) {
  echo '</template>';
}