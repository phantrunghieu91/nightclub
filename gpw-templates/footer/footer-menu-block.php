<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Footer - Menu block
 */
$menuTermID = $args['menu_id'] ?? false;
if( !$menuTermID ) {
  return;
}
$menuObj = get_term( $menuTermID, 'nav_menu' );
$menuItems = wp_get_nav_menu_items( $menuTermID );
if( empty( $menuItems ) ) {
  if( is_user_logged_in(  ) || current_user_can( 'manage_options' ) ) {
    echo "<p class='jins-error-message'>No menu items found in menu {$menuObj->name}</p>";
  }
  return;
}
?>
<div class="footer__menu">
  <h2 class="footer__title"><?= $menuObj->name ?></h2>
  <ul class="footer__menu-list">
    <?php foreach( $menuItems as $menuItem ): 
      $isCurrent = $menuItem->object_id == get_the_ID(); 
    ?>
      <li class="footer__menu-item<?= $isCurrent ? ' footer__menu-item--current' : '' ?>">
        <a href="<?= $isCurrent ? 'javascript:void(0);' : $menuItem->url ?>" class="footer__menu-link"
          <?= $isCurrent ? 'onclick="document.getElementById(\'content\').scrollIntoView({ behavior: \'smooth\' });"' : '' ?>
        ><?= esc_html( $menuItem->title ) ?></a>
      </li>
    <?php endforeach ?>
  </ul>
</div>