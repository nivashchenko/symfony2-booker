<?php

namespace Booker\BookerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Booker\BookerBundle\Entity\Repository\OrderRepository;
use Booker\BookerBundle\Entity\Order;
use Booker\BookerBundle\Entity\User;
use Booker\BookerBundle\Entity\Room;
use \DateTime as NewDT;

class CalendarController extends Controller
{

    public function bookerAction($date = null)
    {
        if ( null === $date )
        {
            $date = date("Y-m-d");
        }
        $data = $this->getOrders($date);
        $rooms = $this->getRooms();
              
        return $this->render('BookerBookerBundle:Default:index.html.twig', array('data' => $data,
                                                                                'date' => $date,
                                                                                'rooms' => $rooms));
    }
    
    private function getRooms($id = null)
    {
        $em = $this->getDoctrine()
                   ->getManager();
        if (is_null($id) )
        {
            return $rooms = $em->getRepository('BookerBookerBundle:Room')
                            ->getRooms();
        }
        else
        {
            return $rooms = $em->getRepository('BookerBookerBundle:Room')
                            ->find($id);
        }
    }
    
    private function getOrders($date)
    {
        $date = new NewDT($date);
        $em = $this->getDoctrine()
                   ->getManager();
        
        $orders = $em->getRepository('BookerBookerBundle:Order')
                ->getOrders($date);
        $result = array();
        foreach ( $orders as $order )
        {
            if (is_object($order) )
            {
                $result[$order->getRoom()->getId()][] = array('time' => $order->getTime()->format('H:i:s'),
                                                            'number' => $order->getRoom()->getNumber(),
                                                            'orderId' => $order->getId(),
                                                            'username' => $order->getUser()->getUsername(),
                                                            'userId' => $order->getUser()->getId());
            }
        }
        
        return $result;
    }
    
    public function deleteAction($orderId, $date)
    {
        $em = $this->getDoctrine()
                   ->getManager();
        $orders = $em->getRepository('BookerBookerBundle:Order');
        $orders->getOrder($orderId);
        $order = $orders->getOrder($orderId);
        if ( $order->getUser()->getId() == $this->getUser()->getId())
        {
            $em->remove($order);
            $em->flush();
            $date = new NewDT($date);
            return $this->redirect($this->generateUrl('booker_booker_date', array('date' => $date->format('Y-m-d'))));
        }
        return new JsonResponse(array('response' => 'False'));
    }
    
    
    public function createAction($date ,$time, $roomId)
    {
        $em = $this->getDoctrine()
                   ->getManager();
        $orders = $em->getRepository('BookerBookerBundle:Order');
        
        if ( date('U') >= strtotime($date . ' ' . $time) )
        {
            return new JsonResponse(array('response' => 'You can not book room for past date'));
        }
        
        if ( $em->getRepository('BookerBookerBundle:Order')
                ->getOrderByTime($time, $roomId) )
        {
            return new JsonResponse(array('response' => 'This room is booked already'));
        }
        
        if ( $em->getRepository('BookerBookerBundle:Order')
                ->getOrderByUser($date, $time, $this->getUser()->getId()) )
        {
            return new JsonResponse(array('response' => 'You can book only one room for this time period'));
        }
        
        $order = new Order();
        $user = $this->getUser();
        $room = $this->getRooms($roomId);
        $time = new NewDT($date . ' ' . $time);
        $date = new NewDT($date);
        
        $order->setTime($time);
        $order->setDate($date);
        $order->setUser($user);
        $order->setRoom($room);
        
        $em->persist($order);
        $em->flush();
        
        return $this->redirect($this->generateUrl('booker_booker_date', array('date' => $date->format('Y-m-d'))));
    }
}
