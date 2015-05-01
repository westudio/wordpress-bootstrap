<?php

class Westudio_Bootstrap_Loader
{
    public static function load($class)
    {
        if (null === ($path = self::find($class))) {
            return;
        }

        foreach ((array) $path as $directory) {
            $file = $directory . '/' . str_replace('_', '/', $class) . '.php';
            if (file_exists($file)) {
                include $file;
                return;
            }
        }
    }

    public static function find($class)
    {
        foreach (self::namespaces() as $namespace => $path) {
            if (0 === strpos($class, $namespace)) {
                return $path;
            }
        }

        return null;
    }

    public static function namespaces()
    {
        $src = dirname(dirname(dirname(__FILE__)));

        return array(
            'Westudio_Bootstrap_' => $src,
        );
    }
}
