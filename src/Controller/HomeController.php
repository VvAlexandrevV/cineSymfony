<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]//quand url est en /home
    public function index(): Response//on appel la fonction index
    {
        return $this->render('home/index.html.twig' ); //qui affiche le fichier home/index.html.twig   
    }
}
