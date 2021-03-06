<?php

namespace App\Controller;

use App\Repository\TrajetRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PetitTestController extends AbstractController
{
    /**
     * @Route("/petit/test", name="petit_test")
     */
    public function index(TrajetRepository $repo, Request $request)
    {
        dump($request->getLocale());

        $trajets = $repo->findAll();

        return $this->render('petit_test/index.html.twig', [
            'controller_name' => 'PetitTestController',
            'trajets' => $trajets
        ]);
    }
}
