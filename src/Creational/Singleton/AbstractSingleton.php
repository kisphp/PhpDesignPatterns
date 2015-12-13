<?php

namespace Creational\Singleton;

abstract class AbstractSingleton
{
    protected static $instance;

    /**
     */
    protected function __construct()
    {
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

}
