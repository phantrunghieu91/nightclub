<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club - Booking form section
 */
$thumbnailID   = get_post_thumbnail_id() ?: PLACEHOLDER_IMAGE_ID;
$bookingFormSC = '[contact-form-7 id="f0cf609" title="SINGLE CLUBS: Booking form"]';
?>
<section class="booking" id="club-booking">
  <div class="section__inner section__inner--full">
    <?= wp_get_attachment_image( $thumbnailID, 'full', false, [ 'class' => 'booking__thumbnail', 'alt' => get_the_title() ] ) ?>
    <div class="booking__form">
      <?= do_shortcode( $bookingFormSC ) ?>
    </div>
  </div>
</section>