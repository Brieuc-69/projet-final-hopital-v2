<?php
namespace App\Controller;

use App\Entity\Appointement;
use App\Entity\Appointment;
use App\Form\AppointementType;
use App\Form\AppointmentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/appointment", name="appointment")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appointment = new Appointement();
        $form = $this->createForm(AppointementType::class, $appointment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appointment);
            $entityManager->flush();

            $this->addFlash('success', 'Votre rendez-vous a été pris avec succès.');

            return $this->redirectToRoute('appointment');
        }

        return $this->render('appointment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
