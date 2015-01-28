<?php

/**
 * Template Name: Home Page
 */

?>
<?php get_template_part('templates/header'); ?>

    <div class="main">

<?php
while (have_posts()):
    the_post();
?>

        <div <?php post_class('page'); ?>>

          <?php get_template_part('templates/carousel') ?>

<?php if (!bootstrap_get('is_block')): ?>
      <div class="container">
<?php endif ?>

          <div class="page-header">

            <?php get_template_part('templates/edit-buttons') ?>

            <h1 class="page-title"><?php the_title(); ?></h1>
          </div>

          <div class="page-body">
            <div class="content">
              <?php the_content(); ?>
            </div>
          </div>

        <?php get_template_part('templates/blocks', 'after') ?>

<?php if (!bootstrap_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

        </div><!-- /.page -->

<?php
endwhile;
?>

    </div><!-- /.main -->

<?php get_template_part('templates/footer'); ?>
