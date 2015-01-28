<?php

/**
 * The template for 404 error.
 */

?>
<?php get_template_part('templates/header'); ?>

    <div class="main">

<?php if (!bootstrap_get('is_block')): ?>
      <div class="container">
<?php endif ?>

        <div class="page not-found">

          <div class="page-header">
            <h1><?php _e( 'Page not found', 'bootstrap' ); ?></h1>
          </div>

          <div class="page-body">
            <p><?php _e( 'It seems than what you\'re looking for is no longer here.', 'bootstrap' ); ?></p>
          </div>

        </div><!-- /.page -->

<?php if (!bootstrap_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

    </div><!-- /.main -->

<?php get_template_part('templates/footer'); ?>
