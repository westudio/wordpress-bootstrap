<?php
if ($thumbnail_id = get_post_thumbnail_id()):
?>
  <?php
    echo wp_get_attachment_image(
      $thumbnail_id,
      'wb-background',
      false,
      array(
        'data-size'       => 'cover',
        'data-attachment' => 'fixed',
        'data-y'          => 'middle'
      )
    );
  ?>
<?php
endif;
?>
