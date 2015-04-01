<?php

namespace Mesd\LunchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Style
 */
class Style
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $restaurant;


    public function __toString()
    {
        return $this->name;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->restaurant = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Style
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add restaurant
     *
     * @param \Mesd\LunchBundle\Entity\Restaurant $restaurant
     * @return Style
     */
    public function addRestaurant(\Mesd\LunchBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurant[] = $restaurant;

        return $this;
    }

    /**
     * Remove restaurant
     *
     * @param \Mesd\LunchBundle\Entity\Restaurant $restaurant
     */
    public function removeRestaurant(\Mesd\LunchBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurant->removeElement($restaurant);
    }

    /**
     * Get restaurant
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
