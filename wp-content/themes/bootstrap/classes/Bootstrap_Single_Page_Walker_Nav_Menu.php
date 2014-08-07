<?php

require_once dirname(__FILE__) .'/Bootstrap_Walker_Nav_Menu.php';

class Bootstrap_Single_Page_Walker_Nav_Menu extends Bootstrap_Walker_Nav_Menu
{
    /**
     * {@inheritDoc}
     */
    protected function get_link_attributes($item, $depth, $args, $id)
    {
        $attributes                = parent::get_link_attributes($item, $depth, $args, $id);
        $attributes['href']        = home_url() . '#' . bootstrap_url_to_slug($attributes['href']);
        $attributes['data-target'] = '#' . bootstrap_url_to_slug($attributes['href']);

        return $attributes;
    }
}