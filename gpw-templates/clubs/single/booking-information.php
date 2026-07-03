<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club page - booking information
 */
$info = get_field( 'booking_information' );
if( empty( $info['content'] ) ) {
  return;
}
?>
<section class="booking-information">
  <div class="section__inner">
    <?php if( !empty( $info['title'] ) ) : ?>
      <h2 class="section__title"><?=  esc_html( $info['title'] ) ?></h2>
    <?php endif ?>
    <div class="booking-information__content">
      <?= wp_kses_post( $info['content'] ) ?>
    </div>
  </div>
</section>