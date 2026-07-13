<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Clubs category page - Content
 */
?>
<section class="clubs-content">
  <div class="section__inner">
    <div class="clubs-content__list">
    </div>
    <?php get_template_part( 'gpw-templates/clubs/club-card', null, [ 'is_template' => true ] ); ?>
    <nav class="navigation pagination" aria-label="Clubs pagination" aria-hidden="true">
      <h2 class="screen-reader-text"><?= __('Clubs pagination', 'gpw') ?></h2>
      <div class="nav-links"></div>
    </nav>
  </div>
</section>