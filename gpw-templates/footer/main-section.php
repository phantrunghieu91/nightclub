<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: FOOTER - Main section
 */

$data          = get_field( 'footer_main', 'gpw_settings' );
$aboutData     = $data['about']     ?? [];
$subscribeData = $data['subscribe'] ?? [];
$companyInfo   = gpweb\inc\controller\CompanyInfo::getInstance();
$socials       = $companyInfo->getSocials();
?>
<section class="footer-main">
  <div class="section__inner">
    <?php if( !empty( $aboutData['content'] ) ): ?>
    <div class="footer-main__about">
      
      <?php if( !empty( $aboutData['content'] ) ): ?>
        <h2 class="footer__title"><?= esc_html( $aboutData['title'] ) ?></h2>
      <?php endif ?>

      <div class="footer-main__about-content">
        <?= wp_kses_post( $aboutData['content'] ) ?>
      </div>

      <?php if( !empty( $socials ) ) : ?>
      <div class="jins-socials">
        <ul class="jins-socials__list">
          <?php foreach( $socials as $social ) : ?>
          <li class="jins-socials__item">
            <a href="<?= esc_url( $social['link'] ) ?>" target="_blank" rel="noopener noreferrer">
              <?= wp_get_attachment_image( $social['icon'], 'thumbnail', false, [ 'alt' => $social['name'] ] ) ?>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>
      
    </div>
    <?php endif ?>

    <?php get_template_part( 'gpw-templates/footer/footer-menu-block', null, [ 'menu_id' => 3 ] ) ?>
    
    <?php get_template_part( 'gpw-templates/footer/footer-menu-block', null, [ 'menu_id' => 5 ] ) ?>
    
    <?php if( !empty( $subscribeData['cf7_sc'] ) ) : ?>
      <div class="footer-main__subscribe">
        
        <?php if( !empty( $subscribeData['title'] ) ) : ?>
          <h2 class="footer__title"><?= esc_html( $subscribeData['title'] ) ?></h2>
        <?php endif ?>
        <?php if( !empty( $subscribeData['description'] ) ) : ?>
          <div class="footer__description"><?= wp_kses_post( $subscribeData['description'] ) ?></div>
        <?php endif ?>
        
        <?= do_shortcode( $subscribeData['cf7_sc'] ) ?>

      </div>
    <?php endif ?>
  </div>
</section>