<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;



class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function index(HttpClientInterface $httpClientInterface): Response
    {
        $films = $httpClientInterface->request(
            'GET',
            'https://swapi.dev/api/films'
        )->toArray()['results'];

        return $this->render('home/index.html.twig', [
            'films' => $films,
        ]);
    }
    #[Route('/people', name: 'app_people')]

    public function people(HttpClientInterface $httpClientInterface): Response
    {
        $people = $httpClientInterface->request(
            'GET',
            'https://swapi.dev/api/people'
        )->toArray()['results'];

        return $this->render('home/people.html.twig', [
            'people' => $people,
        ]);
    }
    #[Route('/planets/{id}', name: 'app_planet')]

    public function planet(HttpClientInterface $httpClientInterface, int $id): Response
    {
        $planet = $httpClientInterface->request(
            'GET',
            "https://swapi.dev/api/planets/{$id}"
        )->toArray();

        return $this->render('home/planet.html.twig', [
            'planet' => $planet,
        ]);
    }
}
