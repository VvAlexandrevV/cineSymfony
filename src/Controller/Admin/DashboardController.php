<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

use App\Controller\Admin\FilmCrudController;
use App\Controller\Admin\SalleCrudController;
use App\Controller\Admin\SeanceCrudController;
use App\Controller\Admin\ReservationCrudController;
use App\Controller\Admin\UtilisateurCrudController;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->redirectToRoute('admin_film_index');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CineSymfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkTo(FilmCrudController::class, 'Films', 'fa fa-film');
        yield MenuItem::linkTo(SalleCrudController::class, 'Salles', 'fa fa-door-open');
        yield MenuItem::linkTo(SeanceCrudController::class, 'Séances', 'fa fa-calendar');
        yield MenuItem::linkTo(ReservationCrudController::class, 'Réservations', 'fa fa-ticket');
        yield MenuItem::linkTo(UtilisateurCrudController::class, 'Utilisateurs', 'fa fa-users');
    }
}