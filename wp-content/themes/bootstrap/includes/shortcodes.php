<?php

function bootstrap_shortcode_flash_news ($attributes)
{
    get_template_part('templates/flash-news');
}

add_shortcode('flash_news', 'bootstrap_shortcode_flash_news');
