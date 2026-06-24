<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Shortcode - Jins socials
 */
namespace gpweb\shortcodes;
use gpweb\inc\controller\CompanyInfo;
class JinsSocials extends BaseShortcode {
  public function shortcodeCallback(array $atts, $content = null) {
    $socials = $this->getSocials();
    if( empty( $socials )) {
      return '';
    }
    ob_start();
    ?>
    <div class="jins-socials">
      <ul class="jins-socials__list">
        <?php foreach( $socials as $social ) : ?>
        <li class="jins-socials__item">
          <a href="<?= esc_url( $social['link'] ) ?>" target="_blank" rel="noopener noreferrer">
            <?= wp_get_attachment_image( $social['icon'], 'thumbnail', false, [ 'alt' => $social['name'] ]) ?>
          </a>
        </li>
        <?php endforeach ?>
      </ul>
    </div>
    <?php 
    return ob_get_clean();
  }
  protected function getSocials() {
    return CompanyInfo::getInstance()->getSocials();
  }
}