<?php

namespace Mesd\LunchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 */
class Restaurant
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
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $hours;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $voteTotal;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $vote;

    /**
     * @var \Mesd\LunchBundle\Entity\Style
     */
    private $style;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vote = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Restaurant
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
     * Set location
     *
     * @param string $location
     * @return Restaurant
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set hours
     *
     * @param string $hours
     * @return Restaurant
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return string 
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Restaurant
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Restaurant
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }




    /**
     * Set voteTotal
     *
     * @param integer $voteTotal
     * @return Restaurant
     */
    public function setVoteTotal($voteTotal)
    {
        $this->voteTotal = $voteTotal;

        return $this;
    }

    /**
     * Get voteTotal
     *
     * @return integer
     */
    public function getVoteTotal()
    {
        return $this->voteTotal;
    }

    /**
     * Set style
     *
     * @param \Mesd\LunchBundle\Entity\Style $style
     * @return Restaurant
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return \Mesd\LunchBundle\Entity\Style 
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Get vote
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Add vote
     *
     * @param \Mesd\LunchBundle\Entity\Vote $vote
     * @return Restaurant
     */
    public function addVote(\Mesd\LunchBundle\Entity\Vote $vote)
    {
        $this->vote[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \Mesd\LunchBundle\Entity\Vote $vote
     */
    public function removeVote(\Mesd\LunchBundle\Entity\Vote $vote)
    {
        $this->vote->removeElement($vote);
    }
}
