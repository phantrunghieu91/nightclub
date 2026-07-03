<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Clubs category page - Content
 */
?>
<section class="clubs">
  <div class="section__inner">
    <div class="clubs__list">
      <?php while( have_posts() ) {
        the_post();
        get_template_part( 'gpw-templates/clubs/club-card' );
      } ?>
      <?php wp_reset_postdata() ?>
    </div>
    <?php the_posts_pagination( [
      'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
      'next_text' => '<i class="fa-solid fa-angle-right"></i>'
    ] ) ?>
  </div>
</section>