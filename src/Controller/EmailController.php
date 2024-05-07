<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Crypto\SMimeEncrypter;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class EmailController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com') // Définit le destinataire de l'e-mail
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Votre demande de prise de rendez-vous!') // Définit le sujet de l'e-mail
            ->text('Votre rendez-vous a bien été pris en compte.A bientot !')  
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        $encrypter = new SMimeEncrypter('/path/to/certificate.crt');
        $encryptedEmail = $encrypter->encrypt($email);

        return new Response('Email envoyé avec succès !');
    }
}

