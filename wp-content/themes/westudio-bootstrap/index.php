<?php

/**
 * Index
 */

?>
<?php get_template_part('blocks/header'); ?>

    <div class="main">

<?php if (!wb_get('is_block')): ?>
      <div class="container">
<?php endif ?>

        <div class="page archive">

          <div class="page-header">
              <h1><?php wb_title(); ?></h1>
          </div><!-- /.page-header -->

          <div class="row">
            <div class="col-sm-9">

              <div class="page-body">

<?php
if (have_posts()):
  while (have_posts()):
    the_post();
?>

                <?php get_template_part('blocks/loop', get_post_type()); ?>

<?php
  endwhile;
else:
?>
                <div class="alert alert-info">
                  <p><?php _e('No result', 'wb'); ?></p>
                </div>
<?php
endif;
?>

              </div><!-- /.page-body -->

              <div class="page-footer">
                <?php wb_pagination(); ?>
              </div><!-- /.page-footer -->

            </div>
            <div class="col-sm-3">
              <?php get_template_part('blocks/sidebar', 'archive') ?>
            </div>
          </div>

        </div><!-- /.page -->

<?php if (!wb_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>
    </div><!-- /.main -->

<?php get_template_part('blocks/footer'); ?>
