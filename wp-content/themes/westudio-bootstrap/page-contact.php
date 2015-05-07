<?php

/**
 * Template Name: Contact Map Page
 */

?>
<?php get_template_part('blocks/header'); ?>

    <div class="main">

<?php if (!wb_get('is_block')): ?>
      <div class="container">
<?php endif ?>

<?php
while (have_posts()):
    the_post();
?>

        <div <?php post_class(); ?>>

          <div class="page-header">
<?php if (wb_get('is_block')): ?>
            <h2 class="page-title"><?php the_title(); ?></h2>
<?php else: ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
<?php endif ?>
          </div>

          <?php get_template_part('blocks/map') ?>

          <div class="page-body">
            <?php get_template_part('blocks/edit-buttons') ?>
            <div class="content">
              <?php the_content(); ?>
            </div>
          </div>

        </div><!-- /.page -->

<?php
endwhile;
?>

<?php if (!wb_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

    </div><!-- /.main -->

<?php get_template_part('blocks/footer'); ?>
