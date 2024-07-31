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

        // Vérifier si l'utilisateur est connecté

        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();

        /**
         * @var User $user
         */


          // Récupérer le patient associé à l'utilisateur connecté

        $patient = $patientRepository->findOneBy(['user' => $user->getId()]);



        // Créer un nouvel objet Appointement

        $appointement = new Appointement();

          // Créer le formulaire pour les appointements
        
        $form = $this->createForm(AppointementType::class, $appointement);
        $form->handleRequest($request);

           // Vérifier si le formulaire est soumis et valide


        if($form->isSubmitted() && $form->isValid()) {
            if(!$patient) {

                 // Si aucun patient n'est trouvé, créer un nouveau patient

                $patient = $form->get('patient')->getData();
                $patient->setUser($this->getUser());
                $entityManager->persist($patient);
            } else {

                // Associer le rendez-vous au patient existant
                $appointement->setPatient($patient);
            }
            
             // Enregistrer l'appointement dans la base de données
      
            $entityManager->persist($appointement);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

         // Rendre la vue pour créer un nouveau rendez-vous

        return $this->render('appointement/new.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);
    }

    #[Route('/appointement/delete/{id}', name: 'app_appointement_delete')]
    public function delete(Appointement $appointement, EntityManagerInterface $entityManager, Request $request): Response
    {
       
           // Supprimer l'appointement de la base de données

            $entityManager->remove($appointement);
            $entityManager->flush();
       
        // Rediriger vers la page de profil
        
        return $this->redirectToRoute('app_profil');
    }

    
}
