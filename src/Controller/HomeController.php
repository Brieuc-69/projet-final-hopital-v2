<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Appointement;
use App\Form\AppointementType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        
            $user = $this->getUser();

       
            $appointement = new Appointement();

            $form = $this->createForm(AppointementType::class, $appointement);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($appointement);
                $entityManager->flush();
                $this->addFlash('success', 'Votre rendez-vous a été pris en compte avec succès.');
            }
        

        // Affichez votre page d'accueil avec le formulaire
        return $this->render('home/index.html.twig');
    }
}
