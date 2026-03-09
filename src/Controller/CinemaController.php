<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\FilmRepository;

final class CinemaController extends AbstractController
{
    #[Route('/programmation', name: 'app_programmation')]//correspond au nom du fichier en dur programation
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        return $this->render('cinema/programmation.html.twig', ['films' => $films]);
    }
}
