<?php
if (!function_exists('get_field')):
  return;
endif;

if (!($blocks = get_field('blocks_after'))):
  return;
endif;
?>
<div class="row">
<?php foreach ($blocks as $block): ?>
  <div class="col-sm-6">
    <section class="block">
      <h3 class="block-title"><?php echo $block->post_title ?></h3>
      <div class="block-body content">
        <?php echo apply_filters('the_content', $block->post_content) ?>
      </div>
    </section>
  </div>
<?php endforeach ?>
</div>
