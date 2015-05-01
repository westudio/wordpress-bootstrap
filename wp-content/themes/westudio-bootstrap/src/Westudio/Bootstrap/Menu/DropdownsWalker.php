<?php

class Westudio_Bootstrap_Menu_DropdownsWalker extends Westudio_Bootstrap_Menu_Walker
{
    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_list_classes($depth, $args)
    {
        $classes   = array();
        $classes[] = 'dropdown-menu';

        return $classes;
    }

    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_item_classes($item, $depth, $args, $id)
    {
        $classes = parent::get_item_classes($item, $depth, $args, $id);

        if ($args->depth != 1 && $args->has_children) {
            $classes[] = 'dropdown';
        }

        return $classes;
    }

    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_link_attributes($item, $depth, $args, $id)
    {
        $attributes = parent::get_link_attributes($item, $depth, $args, $id);

        if ($args->depth != 1 && $args->has_children) {
            $attributes['data-toggle'] = 'dropdown';
        }

        return $attributes;
    }

    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_link_classes($item, $depth, $args, $id)
    {
        $classes = parent::get_link_classes($item, $depth, $args, $id);

        if ($args->depth != 1 && $args->has_children) {
            $classes[] = 'dropdown-toggle';
        }

        return $classes;
    }

    /**
     * @see Westudio_Bootstrap_Menu_Walker
     */
    protected function get_link_after($item, $depth, $args, $id)
    {
        $output = parent::get_link_after($item, $depth, $args, $id);

        if ($depth == 0 && $args->depth != 1 && $args->has_children) {
            $output .= '&nbsp;<b class="caret"></b>';
        }

        return $output;
    }
}
