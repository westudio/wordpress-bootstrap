<?php

function wb_shortcode_flash_news ($attributes)
{
    get_template_part('blocks/flash-news');
}

add_shortcode('wb_flash_news', 'wb_shortcode_flash_news');
