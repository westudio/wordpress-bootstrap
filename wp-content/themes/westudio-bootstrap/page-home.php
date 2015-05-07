<?php

/**
 * Template Name: Home Page
 */

?>
<?php get_template_part('blocks/header'); ?>

    <div class="main">

<?php
while (have_posts()):
    the_post();
?>

        <div <?php post_class('page'); ?>>

          <?php get_template_part('blocks/carousel') ?>

<?php if (!wb_get('is_block')): ?>
      <div class="container">
<?php endif ?>

          <div class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
          </div>

          <div class="page-body">
            <?php get_template_part('blocks/edit-buttons') ?>
            <div class="content">
              <?php the_content(); ?>
            </div>
          </div>

        <?php get_template_part('blocks/blocks', 'after') ?>

<?php if (!wb_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

        </div><!-- /.page -->

<?php
endwhile;
?>

    </div><!-- /.main -->

<?php get_template_part('blocks/footer'); ?>
