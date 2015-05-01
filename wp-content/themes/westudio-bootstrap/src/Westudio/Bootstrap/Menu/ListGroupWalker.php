<?php

class Westudio_Bootstrap_Menu_ListGroupWalker extends Westudio_Bootstrap_Menu_Walker
{
    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_item_classes($item, $depth, $args, $id)
    {
        $classes   = parent::get_item_classes($item, $depth, $args, $id);
        $classes[] = 'list-group-item';

        return $classes;
    }
}
