<?php

/**
 * Last posts
 */

?>
<section class="section secondary post">
    <div class="page-header">
        <h1><?php _e('Posts', 'bootstrap') ?></h1>
    </div>
    <div class="page-content">
<?php
query_posts(array(
    'post_type' => 'post',
    'posts_per_page' => 4
));

while (have_posts()):
    the_post();
?>
        <?php get_template_part('loop', 'post'); ?>
<?php
endwhile;
?>
    </div>
</section>
