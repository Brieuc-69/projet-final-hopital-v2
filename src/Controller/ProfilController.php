<?php

namespace App\Controller;

use App\Repository\AppointementRepository;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(PatientRepository $patientRepository, AppointementRepository $appointementRepository): Response
    {

        // Récupère l'utilisateur actuellement connecté
        $user = $this->getUser();
        if(!$user) {
            // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
            return $this->redirectToRoute('app_login');
        }
        /**
         * @var User $user
         */
        // Recherche le patient associé à l'utilisateur connecté

        $patient = $patientRepository->findOneBy(['user' => $user->getId()]);

        // Récupère tous les rendez-vous du patient
        $appointements = $appointementRepository->findBy(['patient' => $patient->getId()]);

          // Rend la vue avec les informations du patient et ses rendez-vous
        return $this->render('profil/index.html.twig', [
            'patient' => $patient,
            'appointements' => $appointements
        ]);
    }
}
