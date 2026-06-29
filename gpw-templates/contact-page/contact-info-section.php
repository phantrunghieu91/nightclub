<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: CONTACT PAGE - Contact info section
 */
$companyInfo = gpweb\inc\controller\CompanyInfo::getInstance();
$sectionData = get_field( 'contact_info' );
$address     = $companyInfo->getAddress();
$email       = $companyInfo->getEmail();
$phone       = $companyInfo->getPhoneNumber();
$map         = $sectionData['google_map'];
$map         = preg_replace( '/width="\d*" |height="\d*" /', '', $map );
?>
<section class="contact-info">
  <div class="section__inner">
    <div class="contact-info__infos">
      <div class="contact-info__item company-name">
        <i class="fa-solid fa-house"></i>
        <span><?= get_bloginfo( 'name' ) ?></span>
      </div>
      <?php if( !empty( $address ) ): ?>
      <div class="contact-info__item address">
        <i class="fa-solid fa-location-dot"></i>
        <span><?= $companyInfo->getAddress() ?></span>
      </div>
      <?php endif ?>
      <?php if( !empty( $phone ) ): ?>
      <div class="contact-info__item phone-number">
        <i class="fa-solid fa-phone"></i>
        <a href="tel:<?= esc_attr( $phone ) ?>"><?= esc_html( $phone ) ?></a>
      </div>
      <?php endif ?>
      <?php if( !empty( $email ) ): ?>
      <div class="contact-info__item email">
        <i class="fa-solid fa-envelope"></i>
        <a href="mailto:<?= esc_attr( $email ) ?>"><?= esc_html( $email ) ?></a>
      </div>
      <?php endif ?>
      <?php if( !empty( $map ) ) {
        echo '<div class="contact-info__map">';
        echo $map;
        echo '</div>';
      } ?>
    </div>
    <?php if( !empty( $sectionData['cf7_sc'] ) ) : ?>
    <div class="contact-info__form">
      <?= do_shortcode( $sectionData['cf7_sc'] ); ?>
    </div>
    <?php endif ?>
  </div>
</section>