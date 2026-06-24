<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Shortcode - Jins socials
 */
namespace gpweb\shortcodes;
use gpweb\inc\controller\CompanyInfo;
class PhoneNumbers extends BaseShortcode {
  public function shortcodeCallback(array $atts, $content = null) {
    $phoneNumber = $this->getPhoneNumbers();
    if( empty( $phoneNumber )) {
      return '';
    }
    ob_start(); ?>
    <div class="phone-numbers">
      <i class="fa-solid fa-square-phone"></i>
      <a href="tel:<?= esc_attr($phoneNumber) ?>"><?= esc_html( $phoneNumber ) ?></a>
    </div>
    <?php return ob_get_clean();
  }
  protected function getPhoneNumbers() {
    return CompanyInfo::getInstance()->getPhoneNumber();
  }
}