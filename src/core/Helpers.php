<?php

namespace ContactForm\Core;

class Helpers
{
    /**
     * @param array $array
     *
     * @return array
    */
    public static function arrayFlatten(array $array)
    {
        $flat = [];
        $stack = array_values($array);

        while ($stack) {
            $value = array_shift($stack);
            if (is_array($value)) {
                $stack = array_merge(
                    array_values($value),
                    $stack
                );
            } else {
                $flat[] = $value;
            }
        }

        return $flat;
    }

    /**
     * @param $string
     *
     * @return mixed
    */
    public static function toCamelCase($string)
    {
        return preg_replace_callback('/(?!^)_([a-z])/', function ($string) {
            return strtoupper($string[1]);
        }, $string);
    }

    /**
     * @param $field
     *
     * @return string
    */
    public static function old($field)
    {
        if (isset($_SESSION['user_input'][$field])) {
            return htmlspecialchars($_SESSION['user_input'][$field]);
        }

        return '';
    }
}
