<?php

namespace SkyParking\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parking place
 *
 * @ORM\Entity
 * @ORM\Table(name="parking_places")
 */
class ParkingPlace
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * Is place reserved?
     *
     * @ORM\Column(type="boolean")
     */
    protected $reserved;

    /**
     * Path to place's map image source
     *
     * @ORM\Column(type="string")
     */
    protected $image;

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}

