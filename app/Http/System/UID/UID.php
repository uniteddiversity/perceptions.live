<?php

namespace System\UID;


class UID
{
    public function __construct()
    {
        $this->crypt = new Crypt("sda", 32);
    }


    private function mask()
    {
        return '/\"?([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})\"?/';
    }


    private static function translateText($occurrence)
    {
        $instance = new static;
        return preg_replace_callback($instance->mask(), function ($uid) use ($instance) {
            return $instance->resolve($uid[1]);
        }, $occurrence);
    }

    /**
     * @param $occurrence
     * @return mixed
     */
    private static function translateArray($occurrence)
    {
        $instance = new static;
        array_walk_recursive($occurrence, function (&$item) use ($instance) {
            return preg_replace_callback($instance->mask(), function ($uid) use ($instance, &$item) {
                $item = $instance->resolve($uid[1]);
            }, $item);
        });
        return $occurrence;
    }

    public static function generate($id)
    {
        $instance = new static;

        $hash = $instance->crypt->encode($id);

        $segments = $instance->splitSegments($hash);

        return implode('-', $segments);
    }

    public function resolve($uid)
    {
        $hash = str_replace('-', '', $uid);
        $id = current($this->crypt->decode($hash));
        return $id;
    }

    public static function translator($occurrence)
    {

        if (is_array($occurrence)) {
            return self::translateArray($occurrence);
        }
        return self::translateText($occurrence);
    }


    private function splitSegments($hash)
    {
        $segments[] = substr($hash, 0, 8);
        $segments[] = substr($hash, 8, 4);
        $segments[] = substr($hash, 12, 4);
        $segments[] = substr($hash, 16, 4);
        $segments[] = substr($hash, 20, 12);
        return $segments;
    }
}