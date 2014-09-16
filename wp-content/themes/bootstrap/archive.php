<?php

/**
 * Template Name: Archive
 */

?>
<?php
if (bootstrap_has_layout()):
    get_header();
endif;
?>

    <div class="layout-main">

<?php if (!bootstrap_get('is_block')): ?>
      <div class="container">
<?php endif ?>

        <div class="page archive">

          <div class="page-header">
              <h1><?php bootstrap_title(); ?></h1>
          </div><!-- /.page-header -->

          <div class="page-body">

<?php
if (have_posts()):
  while (have_posts()):
    the_post();
?>

            <?php get_template_part('loop', get_post_type()); ?>

<?php
  endwhile;
else:
?>
            <div class="alert alert-info">
              <p><?php _e('No result', 'bootstrap'); ?></p>
            </div>
<?php
endif;
?>

          </div><!-- /.page-body -->

          <div class="page-footer">
            <?php bootstrap_pagination(); ?>
          </div><!-- /.page-footer -->

        </div><!-- /.page -->

<?php if (!bootstrap_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

    </div><!-- /.layout-main -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>