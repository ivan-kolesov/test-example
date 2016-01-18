<?php

namespace Kernel;

class Config
{
    protected static $configs = [];

    /**
     * @param $key
     * @param null $default
     * @return string|null
     */
    public static function get($key, $default = null)
    {
        list($group, $item) = self::parseKey($key);

        if (!empty($group)) {
            self::load($group);

            $content = Arr::get(self::$configs, $group, []);
            return Arr::get($content, $item, $default);
        }

        return $default;
    }

    /**
     * @param $key
     * @return array
     */
    protected static function parseKey($key)
    {
        $segs = explode('.', $key);

        $group = null;
        $item = null;

        if (!empty($segs)) {
            $group = $segs[0];
            $item = join('.', array_slice($segs, 1));
        }

        return [$group, $item];
    }

    /**
     * @param string $group
     */
    protected static function load($group)
    {
        if (!array_key_exists($group, self::$configs)) {
            $filename = APP_DIR . 'config/' . $group . '.php';
            if (file_exists($filename)) {
                $content = require $filename;
                self::$configs[$group] = $content;
            }
        }
    }
}