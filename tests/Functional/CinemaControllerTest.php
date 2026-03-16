<?php

namespace App\Test\Functionnal;

// On importe la classe WebTestCase qui permet de tester une application Symfony
// comme si un navigateur faisait des requêtes HTTP
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CinemaControllerTest extends WebTestCase {

    public function testPageProgrammationisAccessible() {

        // On crée un "client HTTP".
        // Ce client agit comme un faux navigateur (Chrome, Firefox, etc.)
        // Il va envoyer des requêtes à l'application Symfony.
        $client = static::createClient();

        // Le client fait une requête HTTP GET vers l'URL /programmation
        // C'est exactement comme si un utilisateur tapait :
        // http://localhost:8000/programmation dans son navigateur
        $client->request('GET', '/programmation');

        // On vérifie que la réponse HTTP est correcte (code 200)
        // Si la page renvoie une erreur (404, 500...), le test échoue
        $this->assertResponseIsSuccessful();

        // On vérifie que la page HTML contient un <h1> avec le texte "Programmation"
        // Symfony analyse le HTML retourné et cherche ce titre
        $this->assertSelectorTextContains('h1', 'Programmation');
    }
}