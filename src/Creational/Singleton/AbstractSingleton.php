<?php

namespace Creational\Singleton;

abstract class AbstractSingleton
{

    /**
     * @todo Declare in child class
     */
    // protected static $instance;

    protected function __construct()
    {
    }

    /**
     * @throws SingletonException
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * @throws SingletonException
     * @return void
     */
    public function __clone()
    {
        throw new SingletonException('This is a Singleton class. __clone() is forbidden.');
    }

    /**
     * @throws SingletonException
     * @return void
     */
    public function __wakeup()
    {
        throw new SingletonException('This is a Singleton class. __wakeup() is forbidden.');
    }

}
