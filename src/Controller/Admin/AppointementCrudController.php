<?php

namespace App\Controller\Admin;

use App\Entity\Appointement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AppointementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Appointement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('content'),
            DateField::new('createdAt'),
            DateField::new('uptdateAt'),
            DateField::new('dateAppointment'),
            AssociationField::new('medecin'),
            AssociationField::new('patient'),
             
        ];
    }

}
