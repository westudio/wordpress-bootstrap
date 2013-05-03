<?php

if (!post_type_supports(get_post_type(), 'comments')):
    return;
endif;

$comments = get_approved_comments(get_the_ID());

?>
<div id="comments" class="comments">
<?php
if (post_password_required()):
?>
    <div class="alert alert-warning">
        <p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ocean71' ); ?></p>
    </div>
<?php
else:
    if ($comments):
?>
    <h2><?php
        $count = count($comments);
        printf(
            _n('One comment on "%2$s"', '%1$s comments on "%2$s"', $count, 'ocean71'),
            number_format_i18n($count),
            get_the_title()
        );
    ?></h2>

    <?php
    wp_list_comments(array(
        'callback' => 'bootstrap_comment'
    ));
    ?>

<?php
    endif;

    if (!comments_open()):
?>
    <div class="alert alert-info">
        <p><?php _e('Comments are closed.', 'ocean71'); ?></p>
    </div>
<?php
    else:
        comment_form();
    endif;
?>

<?php
endif;
?>
</div><!-- /.comments -->