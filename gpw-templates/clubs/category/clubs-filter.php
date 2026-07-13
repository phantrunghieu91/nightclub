<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Category clubs page - Clubs filter
 */
$musics = get_terms( [
  'taxonomy' => 'music',
] );
$clubTypes = get_terms( [
  'taxonomy' => 'clubs-type'
] );
if( empty( $musics ) && empty( $clubTypes ) ) {
  return;
}
?>
<form method="GET" class="clubs-filter">
  <div class="clubs-filter__message"></div>
  <?php if( !empty( $musics ) ) : ?>
  <select name="music" class="clubs-filter__control">
    <option value=""><?= __( 'Filter by Music', 'gpw' ) ?></option>
    <option value="all"><?= __( 'All', 'gpw' ) ?></option>
    <?php foreach( $musics as $music ) : ?>
      <option value="<?= esc_attr( $music->term_id ) ?>"><?= esc_html( $music->name ) ?></option>
    <?php endforeach ?>
  </select>
  <?php endif ?>
  <?php if( !empty( $clubTypes ) ) : ?>
  <select name="clubs-type" class="clubs-filter__control">
    <option value=""><?= __( 'Filter by Type', 'gpw' ) ?></option>
    <option value="all"><?= __( 'All', 'gpw' ) ?></option>
    <?php foreach( $clubTypes as $clubType ) : ?>
      <option value="<?= esc_attr( $clubType->term_id ) ?>"><?= esc_html( $clubType->name ) ?></option>
    <?php endforeach ?>
  </select>
  <?php endif ?>
  <?php get_template_part( 'gpw-templates/global/jins-button', null, [
    'tag'   => 'button',
    'type'  => 'submit',
    'label' => __( 'Filter clubs', 'gpw' ),
    'theme' => 'primary',
    'width' => 'full',
  ] ) ?>
</form>