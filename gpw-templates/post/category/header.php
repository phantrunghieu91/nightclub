<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Post category - header
 */
$headerBgID = get_field('cat_header_bg_img_id', 'gpw_settings') ?: 147;
$currentObj = get_queried_object();
$title = is_home() ? get_the_title( get_option( 'page_for_posts' ) ) : $currentObj->name;
$description = is_category() ? term_description() : '';
?>
<header class="post-header hero hero--with-content" style="background: var(--primary-color-500) url(<?= wp_get_attachment_image_url( $headerBgID, 'full' ) ?>) center / cover no-repeat;">
  <div class="section__inner">
    <div class="hero__content">
      <h1 class="post-header__title hero__title"><?= esc_html( $title ) ?></h1>
      <?php if( !empty( $description ) ) : ?>
        <div class="post-header__description" id="post-category-description">
          <div class="post-header__description-content"><?= wp_kses_post( $description ) ?></div>
          <button class="jins-button post-header__description-toggle" 
            data-position="right" onclick="this.setAttribute( 'aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true' )"
            aria-expanded="false" aria-controls="post-category-description"
            data-expanded-text="<?= __('Show less', 'gpw') ?>" data-collapsed-text="<?= __('Show more', 'gpw') ?>"
          ></button>
        </div>
      <?php endif ?>
    </div>
  </div>
</header>