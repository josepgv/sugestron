<?php

namespace Suggestotron;


class Config {
    static public $directory;
    static public $config = [];

    static public function setDirectory($path) {
        self::$directory = $path;
    }

    static public function get($whichConfig) {
        $whichConfig = strtolower($whichConfig);

        self::$config[$whichConfig] = require self::$directory . '/' . $whichConfig . '.php';

        return self::$config[$whichConfig];
    }
} 