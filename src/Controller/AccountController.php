<?php

namespace App\Controller;

use App\Classe\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="account")
     */
    public function index(Cart $cart): Response
    {
        return $this->render('account/index.html.twig', [
            'cart' => $cart->getFull(),
        ]);
    }
}
