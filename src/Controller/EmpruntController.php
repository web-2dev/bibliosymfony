<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EmpruntRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Emprunt;
use App\Form\EmpruntType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_BIBLIOTHECAIRE")
 * 
 */
class EmpruntController extends AbstractController
{
    /**
     * @Route("/biblio/emprunt", name="emprunt")
     */
    public function index(EmpruntRepository $empruntRepository): Response
    {
        $listeEmprunts = $empruntRepository->findAll();
        return $this->render('emprunt/index.html.twig', [
            'emprunts' => $listeEmprunts,
        ]);
    }

    /**
     * @Route("/biblio/emprunt/ajouter", name="emprunt_ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $em)
    {
        $emprunt = new Emprunt;
        $formEmprunt = $this->createForm(EmpruntType::class, $emprunt);
        $formEmprunt->handleRequest($request);
        if($formEmprunt->isSubmitted() && $formEmprunt->isValid()){
            $em->persist($emprunt);
            $em->flush();
            $this->addFlash("success", "Nouvel emprunt enregistré");
            return $this->redirectToRoute("emprunt");
        }
        return $this->render("emprunt/ajouter.html.twig", [ "formEmprunt" => $formEmprunt->createView() ]);
    }

    /* EXO : ajouter une route qui permet de définir une date de retour à un emprunt (la date du jour). 
             Dans l'affichage de la liste des emprunts, dans la colonne "Date retour", lorsqu'il n'y a pas de date_retour, il y aura un lien "à rendre" 
             qui lancera cette route (après avoir enregistré la modification de l'emprunt en base de données, on redirige vers la liste des emprunts)
    */

    /**
     * @Route("/biblio/emprunt/retour/{id}", name="emprunt_retour" )
     */
    public function retour(EmpruntRepository $er, EntityManagerInterface $em, $id)
    {
        $empruntAmodifier = $er->find($id);
        $empruntAmodifier->setDateRetour(new \DateTime());
        $em->flush();
        $this->addFlash("info", "Le livre <strong>" . $empruntAmodifier->getLivre()->getTitre() . "</strong> emprunté par <i>" . $empruntAmodifier->getAbonne()->getPseudo() . "</i> a été rendu");
        return $this->redirectToRoute("emprunt");
    }

}
