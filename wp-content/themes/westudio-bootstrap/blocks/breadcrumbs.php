<?php
if ($breadcrumbs = wb_get_breadcrumbs()):
  $last = count($breadcrumbs) - 1;
?>
<ul class="breadcrumb">
<?php
  foreach ($breadcrumbs as $i => $item):
    if ($i != $last):
?>
  <li><?php echo $item; ?></li>
<?php
    else:
?>
  <li class="active"><?php echo $item; ?></li>
<?php
    endif;
  endforeach
?>
</ul>
<?php
endif;
?>
