<?php

namespace App\Tests\Unit;

// on importe les classes dont on a besoin dans le test
use App\Entity\Salle;
use App\Entity\Seance;
use App\Service\ReservationService;
use PHPUnit\Framework\TestCase;

class ReservationServiceTest extends TestCase 
{
    // on va créer une fonction = un test
    public function testPeutReserverSiPlacesDisponibles() 
    {
        // on crée une salle
        $salle = new Salle();

        // on définit la capacité de la salle (50 places)
        $salle->setCapacite(50);

        // on crée une séance
        $seance = new Seance();

        // on associe la salle à la séance
        $seance->setSalle($salle);

        // on crée le service que l'on veut tester
        $service = new ReservationService();

        // on vérifie que la fonction peutReserver() renvoie TRUE
        // car il reste des places dans la salle
        $this->assertTrue($service->peutReserver($seance));
    }

    public function testNePeutPasReserverSiComplet()
    {
        // on crée une salle
        $salle = new Salle();

        // capacité de la salle = 0 place (donc complet)
        $salle->setCapacite(0);

        // on crée une séance
        $seance = new Seance();

        // on associe la salle à la séance
        $seance->setSalle($salle);

        // on instancie le service à tester
        $service = new ReservationService();

        // on vérifie que peutReserver() renvoie FALSE
        // car il n'y a plus de place disponible
        $this->assertFalse($service->peutReserver($seance));
    }
}