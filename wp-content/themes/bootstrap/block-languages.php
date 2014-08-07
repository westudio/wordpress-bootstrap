<?php

if (!function_exists('icl_get_languages') || !defined('ICL_LANGUAGE_CODE')):
  return;
endif;

$languages = icl_get_languages();

if ($languages):
?>
<ul class="languages">
<?php
  foreach ($languages as $lang):
    $code = $lang['language_code'];
    $url  = $lang['url'];

    if ($code == ICL_LANGUAGE_CODE):
?>
  <li class="active"><a href="<?php echo $url; ?>"><?php echo strtoupper($code); ?></a></li>
<?php
    else:
?>
  <li><a href="<?php echo $url; ?>"><?php echo strtoupper($code); ?></a></li>
<?php
    endif;
  endforeach;
?>
</ul>
<?php
endif;
?>