<?php

/**
 * One post inside the loop
 */

?>
<article <?php post_class(); ?>>
    <div class="post-inner">
        <p class="meta"><?php bootstrap_posted_on(); ?></p>
        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h3>
        <p class="categories"><?php the_category(', '); ?></p>
        <?php the_excerpt(); ?>
    </div><!-- post inner -->
</article><!-- /.post_class -->
