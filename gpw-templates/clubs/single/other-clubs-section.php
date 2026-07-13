<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single club - Other clubs
 */
$clubs = get_posts( [
  'post_type'   => 'clubs',
  'numberposts' => 3,
  'exclude'     => [get_the_ID()],
] );
if( empty( $clubs ) ) {
  return;
}
$slideItems = [];
foreach( $clubs as $post ) {
  setup_postdata( $post );
  ob_start();
  get_template_part( 'gpw-templates/clubs/club-card', null, [ 'show_excerpt' => false, 'orientation' => 'vertical' ] );
  $slideItems[] = ob_get_clean();
}
wp_reset_postdata();

?>
<section class="other-clubs">
  <div class="section__inner">
    <h2 class="section__title"><?= esc_html( __( 'You may also like', 'gpw' ) ) ?></h2>
    <?php get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true ] ) ?>
  </div>
</section>