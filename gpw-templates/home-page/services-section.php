<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Home page - Services section
 */
$sectionData = get_field('services');
if( empty( $sectionData['service'])) {
  return;
}
?>
<section class="services">
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
    <div class="services__grid grid-repeated-cols">
      <?php foreach( $sectionData['service'] as $service ) : ?>
      <article class="service">
        <?= wp_get_attachment_image( $service['icon'] ?? PLACEHOLDER_IMAGE_ID, 'thumbnail', false, [ 'class' => 'service__icon', 'alt' => $service['label']]) ?>
        <h4 class="service__label"><?= esc_html( $service['label']) ?></h4>
        <div class="service__content"><?= wp_kses_post( $service['content']) ?></div>
      </article>
      <?php endforeach ?>
    </div>
  </div>
</section>