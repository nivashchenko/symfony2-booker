<?php

// src/Booker/BookerBundle/Entity/User.php

namespace Booker\BookerBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @ORM\Entity(repositoryClass="Booker\BookerBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="Users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
    * @ORM\OneToMany(targetEntity="Order", mappedBy="Users")
    */
    protected $order;

    public function __construct()
    {
        parent::__construct();
        
        $kernel = $GLOBALS['kernel'];
        $em = $kernel->getContainer();
        
        if ( $salt = $em->getParameter('secret') ) 
        {
            $this->salt = $salt;
        }
        $this->roles = array('ROLE_USER');
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
     * Set order
     *
     * @param \Booker\BookerBundle\Entity\Order $order
     * @return User
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
     * Add order
     *
     * @param \Booker\BookerBundle\Entity\Order $order
     * @return User
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
