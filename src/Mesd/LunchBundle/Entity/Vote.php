<?php

namespace Mesd\LunchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 */
class Vote
{
    /**
     * @var integer
     */
    private $id;

   /**** 
    * @var string
    */
    private $name;

    /**
     * @var integer
     */
    private $voter_id;

    /**
     * @var \DateTime
     */
    private $vote_date;

    /**
     * @var \Mesd\LunchBundle\Entity\Restaurant
     */
    private $restaurant;

    public function __toString()
    {
        return $this->voter_id."";
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
     * Set voter_id
     *
     * @param integer $voterId
     * @return Vote
     */
    public function setVoterId($voterId)
    {
        $this->voter_id = $voterId;

        return $this;
    }

    /**
     * Get voter_id
     *
     * @return integer 
     */
    public function getVoterId()
    {
        return $this->voter_id;
    }

    /**
     * Set vote_date
     *
     * @param \DateTime $voteDate
     * @return Vote
     */
    public function setVoteDate($voteDate)
    {
        $this->vote_date = $voteDate;

        return $this;
    }

    /**
     * Get vote_date
     *
     * @return \DateTime 
     */
    public function getVoteDate()
    {
        return $this->vote_date;
    }

    /**
     * Set restaurant
     *
     * @param \Mesd\LunchBundle\Entity\Restaurant $restaurant
     * @return Vote
     */
    public function setRestaurant(\Mesd\LunchBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \Mesd\LunchBundle\Entity\Restaurant 
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
