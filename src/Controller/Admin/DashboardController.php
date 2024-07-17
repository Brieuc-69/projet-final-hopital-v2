<?php

namespace App\Controller\Admin;

use App\Entity\Appointement;
use App\Entity\Experience;
use App\Entity\File;
use App\Entity\Gender;
use App\Entity\Medecin;
use App\Entity\Patient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard-admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration Hopital');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Medecin', 'fa-solid fa-user-doctor', Medecin::class);
        yield MenuItem::linkToCrud('Appointment', 'fa-solid fa-calendar-check', Appointement::class);
        yield MenuItem::linkToCrud('Patient', 'fa-solid fa-person', Patient::class);
        yield MenuItem::linkToCrud('Expérience', 'fa-solid fa-person', Experience::class);
        yield MenuItem::linkToCrud('File', 'fa-solid fa-file', File::class);
        yield MenuItem::linkToCrud('Genre', 'fa-solid fa-file', Gender::class);
    }
}
