<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\FilmRepository;
use App\Entity\Reservation;
use App\Entity\Seance;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservationType;

final class CinemaController extends AbstractController
{
    #[Route('/programmation', name: 'app_programmation')]//correspond au nom du fichier en dur programation
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();
        return $this->render('cinema/programmation.html.twig', ['films' => $films]);
    }
    //si authent ok alors acces aux reservation du profil
    #[IsGranted('IS_AUTHENTICATED')]
    #[Route('/profil', name: 'app_profil')]

    public function profil(): Response {
    
        return $this->render('cinema/reservations.html.twig');
    }
    //si authent ok alors acces aux reservation du profil
    #[IsGranted('IS_AUTHENTICATED')]
    #[Route('/annuler-reservation/{id}', name: 'app_annuler_reservation')]

    public function annulerReservation(Reservation $reservation, EntityManagerInterface $entityManager): Response {

        //est ce que l id de l utilisateur de reservation a l id de l utlisateur connecté si c est === on supprime , sinon non
        if($reservation->getUtilisateur()->getId() === $this->getUser()->getId()) {
            $reservation->setStatut(Reservation::STATUT_ANNULE);//on supprime pas , on annule comme ca on garde l historique
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_profil');
    }

    #[IsGranted('IS_AUTHENTICATED')]
    #[Route('/reserver/{id}', name: 'app_reserver')]
    public function reserver(Seance $seance, Request $request, EntityManagerInterface $entityManager): Response {

        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $reservation
                ->setUtilisateur($this->getUser())
                ->setSeance($seance)
                ->setStatut(Reservation::STATUT_CONFIRME);

            $entityManager->persist($reservation);
            $entityManager->flush(); 
            
            return $this->redirectToRoute('app_profil');
        }
        return $this->render('cinema/reserver.html.twig', ['seance' => $seance, 'form' => $form->createView()]);
    }
}
