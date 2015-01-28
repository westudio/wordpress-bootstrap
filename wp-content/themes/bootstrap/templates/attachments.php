<?php
if ($attachments = bootstrap_get_attachments()):
?>
    <div class="attachments">
      <ul>
<?php
  foreach ($attachments as $i => $attachment):
    $title = $attachment->fields->title;
    $url   = wp_get_attachment_url($attachment->id);
?>
        <li><i class="glyphicon glyphicon-download"></i> <a href="<?php echo $url ?>"><?php echo $title ?></a></li>
<?php
  endforeach;
?>
      </ul>
    </div>
<?php
endif;
?>
