<?php
if ($thumbnail_id = bootstrap_get_background()):
?>
  <?php echo wp_get_attachment_image($thumbnail_id, 'bootstrap-background', false, array('data-size' => 'cover', 'data-attachment' => 'fixed', 'data-y' => 'middle')); ?>
<?php
endif;
?>
