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
        $patient = new Patient();
        $form = $this->createForm(AppointementType::class, $appointement);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // patient 
            $patient->setLastName($form->get('name')->getData());
            $patient->setFirstName($form->get('firstname')->getData());
            $patient->setEmail($form->get('email')->getData());
            $patient->setTel($form->get('phone')->getData());
            $patient->setAdress($form->get('address')->getData());
            dd($patient);
            $entityManager->persist($patient);
            $entityManager->flush();
            // appointement
            $appointement->setPatient($patient);
            $appointement->setCreatedAt(new \DateTimeImmutable());
            $appointement->setUptdateAt(new \DateTimeImmutable());
            $entityManager->persist($appointement);
            $entityManager->flush();
            return $this->redirectToRoute('app_appointement');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
