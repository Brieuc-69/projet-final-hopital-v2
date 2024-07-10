<?php
namespace App\Controller;  

use App\Entity\Appointement;
use App\Form\AppointementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;  
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointementRepository extends AbstractController
{
    /**
     * @Route("/appointement", name="appointement")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appointement = new Appointement();
        $form = $this->createForm(AppointementType::class, $appointement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appointement);
            $entityManager->flush();

            $this->addFlash('success', 'Votre rendez-vous a été pris avec succès.');

            return $this->redirectToRoute('appointment');
        }

        return $this->render('appointement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
