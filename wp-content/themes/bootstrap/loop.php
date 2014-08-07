<?php

/**
 * One post inside the loop
 */

?>

<article <?php post_class('media'); ?>>
<?php if (has_post_thumbnail()): ?>
  <a href="<?php the_permalink(); ?>" class="pull-left">
    <?php the_post_thumbnail('bootstrap-1-1', array('class' => 'media-object')) ?>
  </a>
<?php endif ?>
  <div class="post-body media-body">
    <h3 class="post-heading media-heading">
      <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
        <?php the_title(); ?>
      </a>
    </h3>
    <p class="date"><?php bootstrap_posted_on(); ?></p>
    <p class="categories"><?php the_category(', '); ?></p>
    <?php the_excerpt(); ?>
  </div><!-- post inner -->
</article><!-- /.post -->
