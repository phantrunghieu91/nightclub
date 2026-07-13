<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Comments template
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>
<section class="jins-comments">
  <div class="section__inner">
    
    <?php if( have_comments() ) : ?>
      <div class="jins-comments__list-wrapper">
        <h2 class="section__title"><?= _x( 'Comments & Reviews', 'Comments template', 'gpw' ) ?></h2>
        <ol class="jins-comments__list">
          <?php wp_list_comments( [
            'callback'     => 'jins_comment_cb',
            'format'       => 'html5'
          ] ); ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
          <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'flatsome' ); ?></h2>
          <div class="nav-links nex-prev-nav">
            <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'flatsome' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'flatsome' ) ); ?></div>
          </div>
        </nav>
        <?php endif; // Check for comment navigation. ?>
      </div>
    <?php endif ?>

    <div class="jins-comments__form-wrapper">
      <?php comment_form( [
        'title_reply'        => _x( 'Leave your comment here', 'Comments template', 'gpw' ),
        'title_reply_before' => '<h3 class="jins-comments__form-title">',
        'title_reply_after'  => '</h3>',
        'format'             => 'html5',
        'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="jins-button %3$s" value="%4$s" data-theme="primary" data-size="medium" />',
      ] ); ?>
    </div>
  </div>
</section>