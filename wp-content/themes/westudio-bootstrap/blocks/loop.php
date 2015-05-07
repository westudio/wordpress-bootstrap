<?php

/**
 * One post inside the loop
 */

?>
<article <?php post_class(); ?>>
  <p class="post-date"><?php wb_posted_on(); ?></p>
  <h2 class="post-title">
    <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
      <?php the_title(); ?>
    </a>
  </h2>
  <?php if (has_post_thumbnail()): ?>
    <a href="<?php the_permalink(); ?>" class="pull-left">
      <?php the_post_thumbnail('wb-12', array('class' => 'post-image')) ?>
    </a>
  <?php endif; ?>
  <div class="post-body">
    <?php get_template_part('blocks/edit-buttons') ?>
    <?php the_excerpt() ?>
  </div><!-- /.post-body -->
</article><!-- /.post -->
