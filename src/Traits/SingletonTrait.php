<?php

namespace App\Traits;

trait SingletonTrait
{

    private static $_instance;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (isset(self::$_instance) === false) {
            self::$_instance = new static();
        }

        return self::$_instance;
    }
}
