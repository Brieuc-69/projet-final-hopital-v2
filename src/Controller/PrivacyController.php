<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyController extends AbstractController
{
     #[Route('/privacy-policy', name: 'privacy_policy')]
    public function privacyPolicy()
    {
        return $this->render('privacy/index.html.twig');
    }
}
