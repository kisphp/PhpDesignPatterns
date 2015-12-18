<?php

namespace Test\Creational\Singleton;

use Codeception\TestCase\Test;
use Helper\Creational\Singleton\AlfaSingleton;
use Helper\Creational\Singleton\BetaSingleton;

/**
 * @group Creational
 * @group Singleton
 */
class SingletonTest extends Test
{

    public function testSingleInstance()
    {
        $a = AlfaSingleton::getInstance();
        $b = AlfaSingleton::getInstance();

        $this->assertSame($a, $b);
    }

    public function testDifferentSingletonClasses()
    {
        $alfa = AlfaSingleton::getInstance();
        $beta = BetaSingleton::getInstance();

        $this->assertNotSame($alfa, $beta);
    }

    /**
     * @expectedException \Creational\Singleton\SingletonException
     */
    public function testSingletonNoCloneAllowed()
    {
        $alfa = AlfaSingleton::getInstance();
        $beta = clone $alfa;

        $this->assertSame($alfa, $beta);
    }

    /**
     * @expectedException \Creational\Singleton\SingletonException
     */
    public function testSingletonNoCopyBySerialization()
    {
        $alfa = AlfaSingleton::getInstance();
        $serialized = serialize($alfa);
        $beta = unserialize($serialized);

        $this->assertSame($alfa, $beta);
    }
}
