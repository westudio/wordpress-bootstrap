<?php

if (!$url = get_edit_post_link(get_the_ID())) {
  return;
}

?>
<a
    href="<?php echo $url ?>"
    class="btn btn-sm btn-default pull-right"
    title="<?php _e('Edit', 'bootstrap') ?>">
    <i class="glyphicon glyphicon-pencil"></i>
</a>
