<?php

if (!$url = get_edit_post_link(get_the_ID())):
  return;
endif;

?>
<a
  href="<?php echo $url ?>"
  class="btn btn-xs btn-default btn-edit pull-right"
  title="<?php _e('Edit', 'wb') ?>">
  <i class="glyphicon glyphicon-pencil"></i>
</a>
