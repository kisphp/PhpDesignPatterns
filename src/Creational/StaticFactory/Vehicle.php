<?php

namespace Creational\StaticFactory;

class Vehicle implements VehicleInterface
{
    const CLASS_NAMESPACE = 'Creational\\StaticFactory\\';

    /**
     * @param string $type
     * @param int    $wheels
     *
     * @throws \Exception
     *
     * @return VehicleInterface
     */
    public static function create($type, $wheels)
    {
        $className = self::CLASS_NAMESPACE . ucfirst(strtolower($type));

        if (class_exists($className)) {
            return new $className($wheels);
        }

        throw new \Exception(sprintf('Class type "%s" not found', $type));
    }

    /**
     * @return string
     */
    public function getType()
    {
        return get_class($this);
    }
}
