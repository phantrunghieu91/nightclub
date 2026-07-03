<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Clubs category page - Header
 */
$headerBgID  = get_field( 'cat_header_bg_img_id', 'gpw_settings' ) ?: 147;
$currentObj  = get_queried_object();
$title       = is_a( $currentObj, 'WP_Post_Type' ) ? $currentObj->label : $currentObj->name;
$description = is_a( $currentObj, 'WP_Post_Type' ) ? get_field( 'clubs_archive_page_description', 'gpw_settings' ) : term_description();
?>
<header class="clubs-header hero hero--with-content"
  style="background: var(--primary-color-500) url(<?= wp_get_attachment_image_url( $headerBgID, 'full' ) ?>) center / cover no-repeat;">
  <div class="section__inner">
    <div class="hero__content">
      <h1 class="clubs-header__title hero__title"><?= esc_html( $title ) ?></h1>
      <?php if( !empty( $description ) ) : ?>
        <div class="clubs-header__description" id="clubs-category-description">
          <div class="clubs-header__description-content"><?= wp_kses_post( $description ) ?></div>
          <button class="jins-button clubs-header__description-toggle"
            data-position="right" onclick="this.setAttribute( 'aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true' )"
            aria-expanded="false" aria-controls="clubs-category-description"
            data-expanded-text="<?= __( 'Show less', 'gpw' ) ?>" data-collapsed-text="<?= __( 'Show more', 'gpw' ) ?>"
          ></button>
        </div>
      <?php endif ?>
    </div>
  </div>
</header>