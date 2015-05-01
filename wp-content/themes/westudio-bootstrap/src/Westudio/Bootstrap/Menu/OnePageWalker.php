<?php

class Westudio_Bootstrap_Menu_OnePageWalker extends Westudio_Bootstrap_Menu_Walker
{
    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_link_attributes($item, $depth, $args, $id)
    {
        $attributes                = parent::get_link_attributes($item, $depth, $args, $id);
        $attributes['href']        = home_url() . '#' . wb_url_to_slug($attributes['href']);
        $attributes['data-target'] = '#' . wb_url_to_slug($attributes['href']);

        return $attributes;
    }
}
