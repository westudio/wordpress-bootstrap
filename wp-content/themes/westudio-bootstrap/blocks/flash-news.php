<?php

query_posts(array(
  'post_type'      => 'post',
  'posts_per_page' => 3,
  'tag'            => 'flash',
));

$i = 0;

if (have_posts()):
?>
<div class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
<?php
while (have_posts()):
  the_post();
  $active = $i === 0;
?>
    <div class="item<?php echo ($active ? ' active' : '') ?>">
      <?php get_template_part('blocks/loop', 'small') ?>
    </div>
<?php
  $i++;
endwhile;
?>
  </div>
</div>
<?php
endif;

wp_reset_query();

?>
