<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(LivreRepository $lr): Response
    {
        $livresNonRendus = $lr->findByNonRendu();
        return $this->render('base.html.twig', [
            'liste_livres' =>  $lr->findAll(),
            'liste_livres_indisponibles' => $livresNonRendus
        ]);
    }
}
