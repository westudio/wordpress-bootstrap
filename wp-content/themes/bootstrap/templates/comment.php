<?php

/**
 * @param object  $comment
 * @param integer $depth
 * @param array   $args
 */

$GLOBALS['comment'] = $comment;
    switch ($comment->comment_type):
        case 'pingback':
        case 'trackback':
    ?>
    <li class="post pingback">
      <p><?php _e( 'Pingback:', 'bootstrap' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'bootstrap' ), ' ' ); ?></p>
      <?php
      break;
      default :
      ?>
      <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
          <footer>
            <div class="comment-author vcard">
              <?php echo get_avatar( $comment, 40 ); ?>
              <?php printf( __( '%s says:', 'bootstrap' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            </div><!-- .comment-author .vcard -->
            <?php if ( $comment->comment_approved == '0' ) : ?>
            <em><?php _e( 'Your comment is awaiting moderation.', 'bootstrap' ); ?></em>
            <br />
          <?php endif; ?>

          <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
              <?php
              /* translators: 1: date, 2: time */
              printf( __( '%1$s at %2$s', 'bootstrap' ), get_comment_date(), get_comment_time() ); ?>
            </time></a>
            <?php edit_comment_link( __( 'Edit', 'bootstrap' ), ' ' );
            ?>
          </div><!-- .comment-meta .commentmetadata -->
        </footer>

        <div class="comment-content"><?php comment_text(); ?></div>

        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
      </article>


    <?php
    break;
    endswitch;

?>