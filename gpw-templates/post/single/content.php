<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single post - content
 */
?>
<section class="post-content">
  <div class="section__inner">
    <h1 class="post-content__title"><?= esc_html( get_the_title() ) ?></h1>
    <div class="post-content__body">
      <?php the_content() ?>
    </div>
  </div>
</section>