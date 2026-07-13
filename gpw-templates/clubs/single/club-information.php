<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club page - Club information
 */
$price   = get_field( 'price' );
$address = get_field( 'address' );
$excerpt = get_the_excerpt();
?>
<section class="club-info">
  <div class="section__inner">
    <h1 class="club-info__title"><?= esc_html( get_the_title() ) ?></h1>
    <?php if( !empty( $address['text'] ) ) : ?>
    <p class="club-info__address">
      <i class="fa-solid fa-location-dot"></i>
      <a href="<?= esc_url( $address['google_map'] ) ?? 'javascript:void(0);' ?>" target="_blank" rel="noopener noreferrer">
        <?= esc_html( $address['text'] ) ?>
      </a>
    </p>
    <?php endif ?>
    <p class="club-info__price"><?= !empty( $price ) ? esc_html( $price ) : __('Contact us', 'gpw') ?></p>
    <?php if( !empty( $excerpt )) : ?>
      <div class="club-info__excerpt"><?= esc_html( $excerpt ) ?></div>
    <?php endif ?>
  </div>
</section>