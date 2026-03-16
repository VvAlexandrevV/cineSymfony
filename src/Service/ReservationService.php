<?php

namespace App\Service;

use App\Entity\Seance;
use App\Entity\Reservation;

class ReservationService {

    //creation d un fonction qui va calculer le nombre de place restant et renvoyer un entier qui correspond aux places restantes
    public function placesRestantes(Seance $seance): int
    {
       //recup de la seance, de la salle et de la capacité moins(-) le nombre de places qui à été reservés
       $nbPlacesReservees = 0;

       foreach($seance->getReservations() as $reservation) { //Le foreach parcourt toutes les réservations liées à la séance, une par une

            if($reservation->getStatut() === Reservation::STATUT_CONFIRME) { //parmi toutes les réservations de la séance, on ne garde que celles dont le statut est CONFIRME

                $nbPlacesReservees += $reservation->getNombrePlace(); //additionner toutes les places déjà réservées. à la fin, on calcule les places restantes.

            }
       }

       return $seance->getSalle()->getCapacite() - $nbPlacesReservees;
    }   //le return renvoie la capacité totale de la salle moins le nombre de places déjà réservées sur cette séance, ce qui donne le nombre de places restantes.

    //creation d une fonction pour savoir si on peut reserver ou non
    public function peutReserver(Seance $seance): bool {

        return $this->placesRestantes($seance) > 0;

        //La méthode peutReserver() réutilise la méthode placesRestantes() pour vérifier si le nombre de places disponibles est supérieur à zéro. Si oui, elle renvoie true, sinon false.

    }
}