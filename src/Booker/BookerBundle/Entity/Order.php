<?php

namespace Booker\BookerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Booker\BookerBundle\Entity\Repository\OrderRepository")
 * @ORM\Table(name="Orders")
 */
class Order {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @ORM\Column(type="integer")
//     */
//    protected $userId;
//    
//    /**
//     * @ORM\Column(type="integer")
//     */
//    protected $roomId;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date;


    /**
     * @ORM\Column(type="time")
     */
    protected $time;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="Orders")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $user;
    
        /**
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="Orders")
     * @ORM\JoinColumn(name="roomId", referencedColumnName="id")
     */
    protected $room;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set timeFrom
     *
     * @param \DateTime $time
     * @return Order
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get timeFrom
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set user
     *
     * @param \Booker\BookerBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\Booker\BookerBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Booker\BookerBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set room
     *
     * @param \Booker\BookerBundle\Entity\Room $room
     * @return Order
     */
    public function setRoom(\Booker\BookerBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Booker\BookerBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }
}
