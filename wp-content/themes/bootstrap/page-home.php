<?php

/**
 * Template Name: Home Page
 */

?>
<?php
if (bootstrap_has_layout()):
  get_header();
endif;
?>

<?php if (!bootstrap_get('is_block')): ?>
    <div class="container">
<?php endif ?>

      <div class="layout-main">

<?php
while (have_posts()):
    the_post();
?>

        <div <?php post_class('page-home'); ?>>

          <div class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
          </div>

          <div class="page-body">
            <div class="content">
              <?php the_content(); ?>
            </div>

            <button class="btn-next-page"><?php _e('Next', 'bootstrap') ?></button>

          </div>

        </div><!-- /.page -->

<?php
endwhile;
?>

      </div><!-- /.layout-main -->
<?php if (!bootstrap_get('is_block')): ?>
    </div><!-- /.container -->
<?php endif ?>

    <?php get_template_part('block', 'background') ?>

<?php
if (bootstrap_has_layout()):
  get_footer();
endif;
?>