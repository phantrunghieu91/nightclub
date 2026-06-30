<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Post category - Recent post sidebar
 */
$recentPosts = get_posts( [
  'status'      => 'publish',
  'numberposts' => 5,
  'orderby'     => 'rand'
] );
if( empty( $recentPosts ) ) {
  return;
}
?>
<aside class="jins-sidebar recent-posts">
  <header class="jins-sidebar__header">
    <h3 class="jins-sidebar__title"><?= __( 'Recent posts', 'gpw' ) ?></h3>
  </header>
  <main class="jins-sidebar__body">
    <ul class="jins-sidebar__list">
      <?php foreach( $recentPosts as $post ) : ?>
        <li class="jins-sidebar__item recent-post">
          <?php get_template_part( 'gpw-templates/post/post-card', false, ['orientation' => 'horizontal', 'show_excerpt' => false ] ) ?>
        </li>
      <?php endforeach ?>
    </ul>
  </main>
</aside>