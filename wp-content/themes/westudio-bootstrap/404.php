<?php

/**
 * The template for 404 error.
 */

?>
<?php get_template_part('blocks/header'); ?>

    <div class="main">

<?php if (!wb_get('is_block')): ?>
      <div class="container">
<?php endif ?>

        <div class="page not-found">

          <div class="page-header">
            <h1><?php _e( 'Page not found', 'wb' ); ?></h1>
          </div>

          <div class="page-body">
            <p><?php _e( 'It seems than what you\'re looking for is no longer here.', 'wb' ); ?></p>
          </div>

        </div><!-- /.page -->

<?php if (!wb_get('is_block')): ?>
      </div><!-- /.container -->
<?php endif ?>

    </div><!-- /.main -->

<?php get_template_part('blocks/footer'); ?>
