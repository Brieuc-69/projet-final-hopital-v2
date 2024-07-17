<?php

namespace App\Controller;

use App\Entity\Appointement;
use App\Entity\Patient;
use App\Form\AppointementType;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppointementController extends AbstractController
{
    #[Route('/appointement', name: 'app_appointement')]
    public function index(Request $request, EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();

        /**
         * @var User $user
         */

        $patient = $patientRepository->findOneBy(['user' => $user->getId()]);

        $appointement = new Appointement();
        
        $form = $this->createForm(AppointementType::class, $appointement);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if(!$patient) {
                $patient = $form->get('patient')->getData();
                $patient->setUser($this->getUser());
                $entityManager->persist($patient);
            } else {
                $appointement->setPatient($patient);
            }
            
            
            $entityManager->persist($appointement);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }
        return $this->render('appointement/new.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);
    }

    #[Route('/appointement/delete/{id}', name: 'app_appointement_delete')]
    public function delete(Appointement $appointement, EntityManagerInterface $entityManager, Request $request): Response
    {
       
            $entityManager->remove($appointement);
            $entityManager->flush();
       
        return $this->redirectToRoute('app_profil');
    }

    
}
