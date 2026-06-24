<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template for accordion element
 * @args:
 * - items (array) - Array of accordion items, each item should have 'title' and 'content' keys
 * - has_icon (bool) - Whether to show the expand/collapse icon
 * - icon_code (array) - Array of icon code state expanded and collapsed
 */
$items = $args['items'] ?? [];
$hasIcon = $args['has_icon'] ?? false;
$iconCode = $args['icon_code'] ?? [ 'remove', 'add' ];
if( empty($items) ) {
  return;
}
?>
<div class="jins-accordion">
  <?php foreach( $items as $idx => $item ) : ?>

    <div class="jins-accordion__item">
      <button class="jins-accordion__button" aria-expanded="<?= $idx == 0 ? 'true' : 'false' ?>" aria-controls="panel-<?= $idx ?>">
        <span class="jins-accordion__button-text"><?= esc_html( $item['title'] ) ?></span>
        <?php if( $hasIcon ) : ?>
          <span class="accordion__button-icon material-symbols-outlined" 
            data-expanded-code="<?= esc_attr( $iconCode[0]) ?>" data-collapsed-code="<?= esc_attr( $iconCode[1] ) ?>">
            <?= $idx == 0 ? $iconCode[0] : $iconCode[1] ?>
          </span>
        <?php endif; ?>
      </button>
      <div class="jins-accordion__panel" id="panel-<?= $idx ?>" aria-hidden="<?= $idx == 0 ? 'false' : 'true' ?>">
        <?= wp_kses_post( $item['content'] ) ?>
      </div>
    </div>

  <?php endforeach; ?>
</div>

<?php
// ! Clean up variables
unset( $items, $hasIcon );