<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


class LecteurController extends AbstractController
{
    /**
     * @Route("/lecteur", name="lecteur")
     */
    public function index(): Response
    {
        /*
            La page "Lecteur" va afficher toutes les informations du l'utilisateur connecté,
            s'il a le ROLE_LECTEUR. On pourrait envoyer une variable contenant ces informations à 
            la vue avec la méthode 'getUser' du contrôleur (qui retourne un objet Abonne, l'abonné actuellement connecté)
                $abonneConnecte = $this->getUser();
            Mais on peut avoir cet objet contenant l'abonné connecté directement dans le fichier Twig en utilisant 
                app.user
        */
        return $this->render('lecteur/index.html.twig');
    }

    /**
     * @Route("/lecteur/emprunter/{id}", name="lecteur_emprunter")
     */
    public function emprunter(LivreRepository $lr, EntityManagerInterface $em, $id)
    {
        $livre = $lr->find($id);
        if( in_array($livre, $lr->findByNonRendu()) ){
            $this->addFlash("danger", "Le livre <strong>" . $livre->getTitre() . "</strong> n'est pas disponible");
            return $this->redirectToRoute("accueil");
        }

        $abonne = $this->getUser(); // Pour récupérer l'utilisateur connecté dans un controleur on utlise $this->get_current_user
                                    // cette méthode retourne un objet de la classe Entity/Abonne
        $dateEmprunt = new DateTime();       
        /* EXO : ajouter les lignes de codes pour créer et enregistrer un nouvel emprunt dans la bdd */
        $emprunt = new Emprunt;
        $emprunt->setLivre($livre);
        $emprunt->setAbonne($abonne);
        $emprunt->setDateEmprunt($dateEmprunt);
        $em->persist($emprunt);
        $em->flush();
        $this->addFlash("info", "Votre emprunt du livre " . $livre->getTitre() . " à la date du " . $dateEmprunt->format("d/m/y") . " a bien été enregistré");
        return $this->redirectToRoute("lecteur");
        /*       2. Ajouter un lien sur chaque vignette de livre pour pouvoir emprunter ce livre.
                    Attention ce lien ne doit être visible que si on est connecté avec le ROLE_USER

            Les routes qui commencent par "/lecteur" ne sont accessibles qu'aux utilisateurs qui ont le ROLE_LECTEUR
            quelque soit le controleur où est défini cette route
          */
    }
}
