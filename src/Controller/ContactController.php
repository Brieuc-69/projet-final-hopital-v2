<?php

namespace App\Controller;

use App\Entity\Appointement;
use App\Entity\Patient;
use App\Form\AppointementType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appointement = new Appointement();
        $form = $this->createForm(AppointementType::class, $appointement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appointement);
            $entityManager->flush();

        // Redirection vers un itinéraire affichant une confirmation ou une liste de rendez-vous
            return $this->redirectToRoute('app_appointement');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
