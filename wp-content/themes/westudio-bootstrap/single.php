<?php

/**
 * Single post
 */

?>
<?php get_template_part('blocks/header'); ?>

    <div class="main">

<?php
while (have_posts()):
  the_post();
  $is_block = wb_get('is_block');
?>

        <div <?php post_class(); ?>>

          <?php get_template_part('blocks/carousel', 'single') ?>

<?php if (!$is_block): ?>
      <div class="container">
<?php endif ?>

          <div class="page-header">
<?php if ($is_block): ?>
            <h2 class="page-title"><?php the_title(); ?></h2>
<?php else: ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
<?php endif ?>
          </div>

          <div class="page-body">
            <?php get_template_part('blocks/edit-buttons') ?>
            <div class="content">
              <?php the_content(); ?>
            </div>
          </div>

          <div class="page-footer">
            <?php wb_pager() ?>
          </div>

<?php if (!$is_block): ?>
      </div><!-- /.container -->
<?php endif ?>

        </div><!-- /.page -->

<?php
endwhile;
?>

    </div><!-- /.main -->

<?php get_template_part('blocks/footer'); ?>
