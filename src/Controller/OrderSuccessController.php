<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_validate")
     */
    public function index(Cart $cart, $stripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if(!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }
        
        if(!$order->getState() == 0) {
            $cart->remove();
            $order->setState(1);
            $this->entityManager->flush();

            $mail = new Mail();
            $content = "Bonjour ".$order->getUser()->getFirstname()."<br/> Merci pour votre commande, Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione cumque ea natus nobis sequi saepe aliquam fugiat consectetur eos dignissimos.";
            $mail->send($order->getUser()->getEmail(), $order->getUser()->getFirstname(), 'Votre commande La Boutique Française est validée', $content);
        }


        return $this->render('order_success/index.html.twig', [
            'order' => $order
        ]);
    }
}
