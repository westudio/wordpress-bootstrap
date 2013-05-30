<?php

$autoplay = get_field('autoplay');

if ($vimeo = trim(get_field('vimeo'))):
?>
    <iframe class="video" src="http://player.vimeo.com/video/<?php echo $vimeo ?>?title=0&amp;byline=0&amp;portrait=0<?php echo ($autoplay ? '&amp;autoplay=1' : ''); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

<?php
elseif ($youtube = trim(get_field('youtube'))):
?>
    <iframe class="video" src="http://www.youtube.com/embed/<?php echo $youtube ?>?rel=0<?php echo ($autoplay ? '&amp;autoplay=1' : ''); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
<?php
endif;
?>