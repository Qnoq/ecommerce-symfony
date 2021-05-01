<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Order;
use App\Entity\Carrier;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Header;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(OrderCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SF E-commerce');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Commandes', 'fa fa-shopping-cart', Order::class);
        yield MenuItem::linkToCrud('Catégories', 'fa fa-list', Category::class);
        yield MenuItem::linkToCrud('Produits', 'fa fa-tag', Product::class);
        yield MenuItem::linkToCrud('Transporteurs', 'fa fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('Headers', 'fa fa-desktop', Header::class);
    }
}
