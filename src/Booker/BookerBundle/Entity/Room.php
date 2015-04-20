<?php

namespace Booker\BookerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Booker\BookerBundle\Entity\Repository\RoomRepository")
 * @ORM\Table(name="Rooms")
 */
class Room {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number;
    
    /**
    * @ORM\OneToMany(targetEntity="Order", mappedBy="Users")
    */
    protected $order;
    
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
     * Set number
     *
     * @param integer $number
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set availableFrom
     *
     * @param \DateTime $availableFrom
     * @return Room
     */
    public function setAvailableFrom($availableFrom)
    {
        $this->availableFrom = $availableFrom;

        return $this;
    }

    /**
     * Get availableFrom
     *
     * @return \DateTime 
     */
    public function getAvailableFrom()
    {
        return $this->availableFrom;
    }

    /**
     * Set availableTo
     *
     * @param \DateTime $availableTo
     * @return Room
     */
    public function setAvailableTo($availableTo)
    {
        $this->availableTo = $availableTo;

        return $this;
    }

    /**
     * Get availableTo
     *
     * @return \DateTime 
     */
    public function getAvailableTo()
    {
        return $this->availableTo;
    }

    /**
     * Set order
     *
     * @param \Booker\BookerBundle\Entity\Order $order
     * @return Room
     */
    public function setOrder(\Booker\BookerBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Booker\BookerBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->order = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add order
     *
     * @param \Booker\BookerBundle\Entity\Order $order
     * @return Room
     */
    public function addOrder(\Booker\BookerBundle\Entity\Order $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Booker\BookerBundle\Entity\Order $order
     */
    public function removeOrder(\Booker\BookerBundle\Entity\Order $order)
    {
        $this->order->removeElement($order);
    }
}
