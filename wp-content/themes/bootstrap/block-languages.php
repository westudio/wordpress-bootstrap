<?php 

if (!function_exists('icl_get_languages')):
    return;
endif;

?>
<div class="languages">
    <ul>
<?php
foreach (icl_get_languages() as $lang):
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
</div><!-- /.languages -->
