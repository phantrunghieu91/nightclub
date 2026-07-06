<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Structure base on wordpress hooks and functions
 */
if( !function_exists( 'jins_comment_cb' )) {
  function jins_comment_cb( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    $avatar_size = 100;
    $comment_link = get_comment_link( $comment->comment_ID );
    switch ( $comment->comment_type ):
      case 'pingback':
      case 'trackback': ?>
        <li class="pingback">
          <?php _e( 'Pingback:', 'flatsome' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link">', '<span>' ); ?>
        </li>
        <?php break; // break pingback, trackback
      default: ?>
        <li <?php comment_class('jins-comments__item') ?> id="li-comment-<?php comment_ID() ?>">
          <article class="jins-comment" id="comment-<?php comment_ID() ?>">
            <?= get_avatar( $comment, $avatar_size, '', get_comment_author() . '\'s comment', [ 'class' => 'jins-comment__customer-avatar' ] ) ?>
            <div class="jins-comment__label">
              <?php printf( __( '%s <span class="says">says:</span>', 'flatsome' ), sprintf( '<cite><strong>%s</strong></cite>', get_comment_author_link() ) ); ?>
            </div>
            <div class="jins-comment__content"><?php comment_text() ?></div>
            <div class="jins-comment__meta">
              <a href="<?= esc_url( $comment_link ) ?>">
                <time datetime="<?php comment_time( 'c' ); ?>" class="jins-comment__meta-time">
                  <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'gpw' ), get_comment_date(), get_comment_time() ); ?>
                </time>
              </a>
            </div>
            <div class="jins-comment__reply-wrapper">
              <?php comment_reply_link( [
                ...$args,
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
              ] ); ?>
            </div>
          </article>
        </li>
        <?php break;
    endswitch;
  }
} // ! end jins_comment_cb check