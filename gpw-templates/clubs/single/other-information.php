<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club page - other information
 */
$info     = get_field( 'other_information' );
$music    = get_the_terms( get_the_ID(), 'music' );
$clubType = get_the_terms( get_the_ID(), 'clubs-type' );
$music    = wp_list_pluck( $music, 'name' );
$clubType = wp_list_pluck( $clubType, 'name' );
?>
<section class="other-info">
  <div class="section__inner">
    <?php if( !empty( $info['title'] ) ) : ?>
      <h2 class="section__title"><?=  esc_html( $info['title'] ) ?></h2>
    <?php endif ?>
    <ul class="other-info__list">
      <?php if( !empty( $info['open_time'] ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Open time', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( $info['open_time'] ) ?></span>
      </li>
      <?php endif ?>
      <?php if( !empty( $info['dress_code'] ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Dress code', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( $info['dress_code'] ) ?></span>
      </li>
      <?php endif ?>
      <?php if( !empty( $info['busy_nights'] ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Busy nights', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( $info['busy_nights'] ) ?></span>
      </li>
      <?php endif ?>
      <?php if( !empty( $info['capacity'] ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Capacity', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( $info['capacity'] ) ?></span>
      </li>
      <?php endif ?>
      <?php if( !empty( $clubType ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Place type', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( implode( ', ', $clubType ) ) ?></span>
      </li>
      <?php endif ?>
      <?php if( !empty( $music ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Music', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( implode( ', ', $music ) ) ?></span>
      </li>
      <?php endif ?>
      <?php if( !empty( $info['crowd'] ) ) : ?>
      <li class="other-info__item">
        <strong class="other-info__item-label"><?= __( 'Crowd', 'gpw' ) ?>:</strong>
        <span class="other-info__item-content"><?= esc_html( $info['crowd'] ) ?></span>
      </li>
      <?php endif ?>
    </ul>
    <?php get_template_part( 'gpw-templates/global/jins-button', null, [
      'label'    => __( 'Book a table now', 'gpw' ),
      'href'     => '#club-booking',
      'variant'  => 'outline',
      'theme'    => 'primary',
      'size'     => 'medium',
      'position' => 'center',
      'class'    => 'other-info__to-booking-form'
    ] ) ?>
  </div>
</section>