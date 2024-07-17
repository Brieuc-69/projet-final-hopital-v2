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
        $user = $this->getUser();
        if(!$user) {
            return $this->redirectToRoute('app_login');
        }
        /**
         * @var User $user
         */
        $patient = $patientRepository->findOneBy(['user' => $user->getId()]);
        $appointements = $appointementRepository->findBy(['patient' => $patient->getId()]);

        return $this->render('profil/index.html.twig', [
            'patient' => $patient,
            'appointements' => $appointements
        ]);
    }
}
