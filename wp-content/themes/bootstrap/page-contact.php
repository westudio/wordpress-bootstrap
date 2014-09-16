<?php

/**
 * Template Name: Contact Map Page
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

<?php
while (have_posts()):
    the_post();
?>

        <div <?php post_class(); ?>>

          <div class="page-header">
<?php if (bootstrap_get('is_block')): ?>
            <h2 class="page-title"><?php the_title(); ?></h2>
<?php else: ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
<?php endif ?>
          </div>

          <?php get_template_part('block', 'map') ?>

          <div class="page-body">
            <div class="content">
              <?php the_content(); ?>
            </div>
          </div>

        </div><!-- /.page -->

<?php
endwhile;
?>

<?php if (!bootstrap_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

    </div><!-- /.layout-main -->

<?php
if (bootstrap_has_layout()):
  get_footer();
endif;
?>