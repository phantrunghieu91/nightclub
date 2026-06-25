<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Global - Customer reviews section
 */
$sectionData = get_field( 'customer_reviews', 'gpw_settings' );
if( empty( $sectionData['customer'] ) ) {
  return;
}
?>
<section class="customer-reviews">
  <div class="section__inner">
    <?php if( !empty( $sectionData['title'] ) || !empty( $sectionData['description'] ) ) : ?>
    <header class="section__header">
      <?php if( !empty( $sectionData['title'] ) ): ?>
        <h2 class="section__title"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ): ?>
        <h2 class="section__description"><?= esc_html( $sectionData['description'] ) ?></h2>
      <?php endif ?>
    </header>
    <?php endif ?>
    <div class="customer-reviews__grid grid-repeated-cols">
      <?php foreach( $sectionData['customer'] as $customer ): if( empty( $customer['review'] ) ) continue; ?>
        <article class="customer-review">
          <?php if( !empty( $customer['label'] ) ) : ?>
            <strong class="customer-review__label"><?= esc_html( $customer['label'] ) ?></strong>
          <?php endif ?>
          <div class="customer-review__review"><?= wp_kses_post( $customer['review'] ) ?></div>
          <?php if( $customer['name'] ): ?>
            <div class="customer-review__customer">
              <?= wp_get_attachment_image( $customer['avatar'] ?? PLACEHOLDER_IMAGE_ID, 'thumbnail', false, [ 'class' => 'customer-review__customer-avatar', 'alt' => $customer['name']] ) ?>
              <span class="customer-review__customer-name"><?= esc_html( $customer['name'] ) ?></span>
              <?php if( !empty( $customer['from'] ) ): ?>
                <span class="customer-review__customer-from"><?= esc_html( $customer['from'] ) ?></span>
              <?php endif ?>
            </div>
          <?php endif ?>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>