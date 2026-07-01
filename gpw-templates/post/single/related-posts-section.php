<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Single post - Related posts
 */
$queryArgs = [
  'numberposts' => 5,
  'exclude'     => [get_the_ID()],
  'orderby'     => 'rand',
  'tax_query'   => [
    'relation' => 'OR',
    [
      'taxonomy' => 'category',
      'field'    => 'term_id',
      'terms'    => wp_get_post_categories( get_the_ID(), [ 'fields' => 'ids' ] )
    ],
    [
      'taxonomy' => 'post_tag',
      'field'    => 'term_id',
      'terms'    => wp_get_post_tags( get_the_ID(), [ 'fields' => 'ids'] )
    ],
  ],
];
$posts = get_posts( $queryArgs );
?>
<section class="related-posts">
  <div class="section__inner">
    <h2 class="section__title"><?= esc_html( __('Related posts', 'gpw') ) ?></h2>
    <ul class="related-posts__list">
      <?php foreach( $posts as $post ) : ?>
      <li class="related-posts__item">
        <a href="<?= get_permalink( $post ) ?>"><?= get_the_title( $post ) ?></a>
      </li>
      <?php endforeach ?>
      <?php wp_reset_postdata() ?>
    </ul>
  </div>
</section>