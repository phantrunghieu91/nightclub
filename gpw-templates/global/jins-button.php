<?php
/**
 * @author Hieu "JIN" Phan Trung
 * Template: Jin's Button
 *
 * @param array $args {
 *   @type string       $tag            HTML tag. 'a' | 'button'. Default 'a'.
 *   @type string       $type           Button type (only for tag=button). 'button' | 'submit' | 'reset'. Default 'button'.
 *   @type string       $label          Button text. Required.
 *   @type string       $href           URL for <a> tag. Default 'javascript:void(0)'.
 *   @type string       $target         Link target. Default '_self'.
 *   @type string       $position       Button alignment. 'center' | 'right'.
 *   @type string       $size           Button size. 'small' | 'medium' | 'large' ( Default: extra small, Different padding )
 *   @type string       $width          Button width. 'full' | 'full-width'.
 *   @type string       $variant        Variant. 'outline' | 'slide-bg'.
 *   @type string       $rounded        Rounded. 'small' | 'medium' | 'large' ( Border radius, default: none )
 *   @type string       $theme          Color theme. 'primary' | 'secondary' | 'tertiary'
 *   @type string       $icon_code      Material Symbols icon name.
 *   @type string       $icon_position  Icon placement. 'left' | 'right'. Default 'right'.
 *   @type string       $class          Additional CSS classes.
 *   @type array        $attributes     Additional HTML attributes.
 * }
 */

if ( empty( $args ) || !is_array( $args ) ) {
  return;
}

// -- Tag & type
$validTags  = ['a', 'button'];
$buttonTag  = isset( $args['tag'] )   && in_array( $args['tag'], $validTags ) ? $args['tag'] : 'a';
$buttonType = $buttonTag === 'button' && isset( $args['type'] ) ? $args['type'] : 'button';

// -- Label (required)
$buttonLabel = $args['label'] ?? '';
if ( !$buttonLabel ) {
  return;
}

// -- Link props
$buttonUrl    = isset( $args['href'] ) && $args['href'] !== '' ?  esc_url( $args['href'] ) : 'javascript:void(0)';
$buttonTarget = $args['target'] ?? '_self';

// -- Icon
$buttonIconCode     = $args['icon_code']     ?? '';
$buttonIconPosition = $args['icon_position'] ?? 'right';

// -- Build classes
$buttonClasses   = isset( $args['class'] ) && !empty( $args['class'] ) ? explode( ' ', ltrim( $args['class'] ) ) : [];
$buttonClasses[] = 'jins-button';

// -- Attributes
$buttonAttrs = [];

// -- Layout
// Width
if ( isset( $args['width'] ) && ( $args['width'] === 'full' || $args['width'] === 'full-width' ) ) {
  $buttonAttrs[] = 'data-width="full"';
}
// Position
if( isset( $args['position'] ) && !empty( $args['position'] ) ) {
  $buttonAttrs[] = sprintf( 'data-position="%s"', esc_attr( $args['position'] ) );
}
// Size
if( isset( $args['size'] ) && !empty( $args['size'] ) ) {
  $buttonAttrs[] = sprintf( 'data-size="%s"', esc_attr( $args['size'] ) );
}

// -- Variant / Theme
// Variant (shape)
if( isset( $args['variant'] ) && !empty( $args['variant'] ) ) {
  $buttonAttrs[] = sprintf( 'data-variant="%s"', esc_attr( $args['variant'] ) );
}
// Theme
if( isset( $args['theme'] ) && !empty( $args['theme'] ) ) {
  $buttonAttrs[] = sprintf( 'data-theme="%s"', esc_attr( $args['theme'] ) );
}

// -- Corner rounded
if( isset( $args['rounded'] ) && !empty( $args['rounded'] ) ) {
  $buttonAttrs[] = sprintf( 'data-rounded="%s"', esc_attr( $args['rounded'] ) );
}
if( isset( $args['attributes'] ) && is_array( $args['attributes'] ) && !empty( $args['attributes'] ) ) {
  foreach( $args['attributes'] as $name => $value ) {
    $buttonAttrs = sprintf( '%s="%s"',
      sanitize_key( $name ),
      esc_attr( $value )
    );
  }
}
?>

<<?= esc_html( $buttonTag ) ?>
  class="<?= esc_attr( implode( ' ', array_filter( $buttonClasses ) ) ) ?>"
  <?= implode( ' ', $buttonAttrs ) ?>
  <?= $buttonTag === 'a' ? "href='{$buttonUrl}' target='{$buttonTarget}'" : "type='{$buttonType}'" ?>
>
  <?php if ( $buttonIconCode && $buttonIconPosition === 'left' ) : ?>
    <span class="jins-button__icon jins-button__icon--left material-symbols-outlined"><?= esc_html( $buttonIconCode ) ?></span>
  <?php endif; ?>

  <span class="jins-button__text"><?= esc_html( $buttonLabel ) ?></span>

  <?php if ( $buttonIconCode && $buttonIconPosition === 'right' ) : ?>
    <span class="jins-button__icon jins-button__icon--right material-symbols-outlined"><?= esc_html( $buttonIconCode ) ?></span>
  <?php endif; ?>
</<?= esc_html( $buttonTag ) ?>>