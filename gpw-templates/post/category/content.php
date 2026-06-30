<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Post category - Content
 */
?>
<section class="post-content">
  <div class="section__inner">
    <div class="post-content__sidebar jins-sidebars">
      <div class="jins-sidebars__inner">
        <?php get_template_part( 'gpw-templates/post/sidebar/recent-post-widget' ) ?>
      </div>
    </div>
    <main class="post-content__body grid-repeated-cols">
      <?php if( have_posts() ): ?>

        <?php while( have_posts() ) {
          the_post();
          get_template_part( 'gpw-templates/post/post-card' );
        } ?>
        <?php wp_reset_postdata() ?>

        <?php the_posts_pagination( [
          'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
          'next_text' => '<i class="fa-solid fa-angle-right"></i>'
        ] ) ?>

      <?php else: ?>
        <p class="no-post-found"><?= __( 'No post found!', 'gpw' ) ?></p>
      <?php endif ?>
    </main>
  </div>
</section>