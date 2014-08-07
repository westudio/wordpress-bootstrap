<?php

/**
 * Bootstrap_Walker_Nav_Menu
 */
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu
{
    /**
     * {@inheritDoc}
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat('  ', $depth);
        $output .= $indent . '<ul class="dropdown-menu">' . PHP_EOL;
    }

    /**
     * {@inheritDoc}
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_attributes = $this->get_item_attributes($item, $depth, $args, $id);
        $link_attributes = $this->get_link_attributes($item, $depth, $args, $id);

        $output .= str_repeat('  ', $depth);
        $output .= '<li' . $this->attributes_to_string($item_attributes) . '>';
        $output .= $this->get_item_before($ite, $depth, $args, $id);
        $output .= '<a' . $this->attributes_to_string($link_attributes) . '>';
        $output .= $this->get_link_before($ite, $depth, $args, $id);
        $output .= $this->get_link_label($item, $depth, $args, $id);
        $output .= $this->get_link_after($ite, $depth, $args, $id);
        $output .= '</a>';
        $output .= $this->get_item_after($ite, $depth, $args, $id);

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    protected function attributes_to_string($attributes)
    {
        if (!$attributes) {
            return '';
        }

        $pairs = array();

        foreach ($attributes as $key => $value) {
            $pairs[] = $key.'="'.esc_attr($value).'"';
        }

        return ' ' . join(' ', $pairs);
    }

    protected function get_item_attributes($item, $depth, $args, $id)
    {
        $attributes = array();

        if ($id = $this->get_item_id($item, $depth, $args, $id)) {
            $attributes['id'] = $id;
        }

        $attributes['class'] = join(' ', $this->get_item_classes($item, $depth, $args, $id));

        return $attributes;
    }

    protected function get_item_id($item, $depth, $args, $id)
    {
        return apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
    }

    protected function get_item_classes($item, $depth, $args, $id)
    {
        $classes = array();

        $classes[] = 'menu-item-' . $item->ID;

        if ($item->current || $item->current_item_ancestor) {
            $classes[] = 'active';
        }

        if ($args->depth != 1 && $args->has_children) {
            $classes[] = 'dropdown';
        }

        if ($depth && $args->depth != 1 && $args->has_children) {
            $classes[] = 'dropdown-submenu';
        }

        return $classes;
    }

    protected function get_item_before($item, $depth, $args, $id)
    {
        return $args->before;
    }

    protected function get_item_after($item, $depth, $args, $id)
    {
        return $args->after;
    }

    protected function get_link_attributes($item, $depth, $args, $id)
    {
        $attributes = array();

        if (!empty($item->attr_title)) {
            $attributes['title'] = $item->attr_title;
        }

        if (!empty($item->target)) {
            $attributes['target'] = $item->target;
        }

        if (!empty($item->xfn)) {
            $attributes['rel'] = $item->xfn;
        }

        if (!empty($item->url)) {
            $attributes['href'] = $item->url;
        }

        if ($args->depth != 1 && $args->has_children) {
            $attributes['data-toggle'] = 'dropdown';
        }

        $attributes['class'] = join(' ', $this->get_link_classes($item, $depth, $args, $id));

        return $attributes;
    }

    protected function get_link_classes($item, $depth, $args, $id)
    {
        $classes = array();

        if ($args->depth != 1 && $args->has_children) {
            $classes[] = 'dropdown-toggle';
        }

        return $classes;
    }

    protected function get_link_label($item, $depth, $args, $id)
    {
        return apply_filters('the_title', $item->title, $item->ID);
    }

    protected function get_link_before($item, $depth, $args, $id)
    {
        return $args->link_before;
    }

    protected function get_link_after($item, $depth, $args, $id)
    {
        $output = '';

        if ($depth == 0 && $args->depth != 1 && $args->has_children) {
            $output .= '&nbsp;<b class="caret"></b>';
        }

        $output .= $args->link_after;

        return $output;
    }

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output)
    {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        //display this element
        if (is_array($args[0]))
            $args[0]['has_children'] = ! empty($children_elements[$element->$id_field]);
        else if (is_object($args[0]))
            $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])) {

            foreach ($children_elements[ $id ] as $child) {

                if (!isset($newlevel)) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[ $id ]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);

    }

}