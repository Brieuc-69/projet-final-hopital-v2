<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Appointement;
use App\Form\AppointementType;
use App\Repository\MedecinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager, MedecinRepository $medecinRepository): Response
    {
        
        $medecins = $medecinRepository->findAll();
  
        // Affichez votre page d'accueil avec le formulaire
        return $this->render('home/index.html.twig', [
            'medecins' => $medecins
        ]);
    }
}
