<?php

class Westudio_Bootstrap_Menu_Walker extends Walker_Nav_Menu
{
    /**
     * @see Walker_Nav_Menu
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat('  ', $depth);
        $attributes = $this->get_list_attributes($depth, $args);
        $output .= PHP_EOL . $indent . '<ul' . $this->attributes_to_string($attributes) . '>';
    }

    /**
     * @see Walker_Nav_Menu
     */
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat('  ', $depth);
        $output .= $indent . '</ul>' . PHP_EOL;
    }

    /**
     * @see Walker_Nav_Menu
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_attributes = $this->get_item_attributes($item, $depth, $args, $id);
        $link_attributes = $this->get_link_attributes($item, $depth, $args, $id);

        $output .= PHP_EOL;
        $output .= str_repeat('  ', $depth);
        $output .= '<li' . $this->attributes_to_string($item_attributes) . '>';
        $output .=   $this->get_item_before($item, $depth, $args, $id);
        $output .=     '<a' . $this->attributes_to_string($link_attributes) . '>';
        $output .=       $this->get_link_before($item, $depth, $args, $id);
        $output .=       $this->get_link_label($item, $depth, $args, $id);
        $output .=       $this->get_link_after($item, $depth, $args, $id);
        $output .=     '</a>';
        $output .=   $this->get_item_after($item, $depth, $args, $id);

        return apply_filters('walker_nav_menu_start_el', $output, $item, $depth, $args);
    }

    /**
     * @see Walker_Nav_Menu
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= '</li>';
    }

    /**
     * Attributes to string
     *
     * @param  array  $attributes
     * @return string
     */
    protected function attributes_to_string($attributes)
    {
        if (!$attributes) {
            return '';
        }

        $pairs = array();

        foreach ($attributes as $key => $value) {
            $value = esc_attr($value);
            $pairs[] = "$key=\"$value\"";
        }

        return ' ' . join(' ', $pairs);
    }

    /**
     * Classes to attributes
     *
     * @param  array $attributes
     * @param  array $classes
     * @return array
     */
    protected function classes_to_attributes($attributes, $classes)
    {
        if (!empty($attributes['class'])) {
            $classes = array_merge($classes, explode(' ', $attributes['class']));
        }

        if ($classes) {
            $attributes['class'] = join(' ', $classes);
        }

        return $attributes;
    }

    /**
     * Get list attributes
     *
     * @param  integer $depth
     * @param  object  $args
     * @return array
     */
    protected function get_list_attributes($depth, $args)
    {
        $attributes = array();

        $classes = $this->get_list_classes($depth, $args);
        $attributes = $this->classes_to_attributes($attributes, $classes);

        return $attributes;
    }

    protected function get_list_classes($depth, $args)
    {
        return array('nav');
    }

    /**
     * Get item attributes
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_item_attributes($item, $depth, $args, $id)
    {
        $attributes = array();

        $classes    = $this->get_item_classes($item, $depth, $args, $id);
        $attributes = $this->classes_to_attributes($attributes, $classes);

        return $attributes;
    }

    /**
     * Get item id
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_item_id($item, $depth, $args, $id)
    {
        return apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
    }

    /**
     * Get item classes
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_item_classes($item, $depth, $args, $id)
    {
        $classes = array();

        if ($item->current || $item->current_item_ancestor) {
            $classes[] = $this->get_current_class();
        }

        return $classes;
    }

    /**
     * Get current class
     *
     * @return string
     */
    protected function get_current_class()
    {
        return 'active';
    }

    /**
     * Get item before
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_item_before($item, $depth, $args, $id)
    {
        return $args->before;
    }

    /**
     * Get item after
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_item_after($item, $depth, $args, $id)
    {
        return $args->after;
    }

    /**
     * Get link attributes
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
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

        $classes = $this->get_link_classes($item, $depth, $args, $id);
        $attributes = $this->classes_to_attributes($attributes, $classes);

        return $attributes;
    }

    /**
     * Get link classes
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_link_classes($item, $depth, $args, $id)
    {
        $classes = array();

        return $classes;
    }

    /**
     * Get link label
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_link_label($item, $depth, $args, $id)
    {
        return apply_filters('the_title', $item->title, $item->ID);
    }

    /**
     * Get link before
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_link_before($item, $depth, $args, $id)
    {
        return $args->link_before;
    }

    /**
     * Get link after
     *
     * @param  object  $item
     * @param  integer $depth
     * @param  object  $args
     * @param  integer $id
     * @return array
     */
    protected function get_link_after($item, $depth, $args, $id)
    {
        return $args->link_after;
    }

    /**
     * Cleaned the mess and added `start_depth` support
     *
     * @see Walker_Nav_Menu
     */
    public function display_element($element, &$children, $max_depth, $depth, $args, &$output)
    {
        if (!$element) {
            return;
        }

        if (is_array($args)) {
            $args = (object) reset($args);
        }

        $id_field           = $this->db_fields['id'];
        $id                 = $element->$id_field;
        $this->has_children = !empty($children[$id]);
        $args->has_children = $this->has_children; // BC
        $visible            = !isset($args->start_depth) || $args->start_depth <= $depth;

        if ($visible) {
            $this->start_el($output, $element, $depth, $args, $id);
        }

        if (($max_depth === 0 || $max_depth > $depth + 1) && $this->has_children) {

            if ($visible) {
                $this->start_lvl($output, $depth, $args);
            }

            if (!isset($args->start_depth) || $element->current || $element->current_item_ancestor) {
                foreach ($children[$id] as $child) {
                    $this->display_element($child, $children, $max_depth, $depth + 1, $args, $output);
                }
            }

            if ($visible) {
                $this->end_lvl($output, $depth, $args);
            }

            unset($children[$id]);
        }

        if ($visible) {
            $this->end_el($output, $element, $depth, $args);
        }
    }
}
