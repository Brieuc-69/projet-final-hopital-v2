<?php

namespace App\Controller\Admin;

use App\Entity\Medecin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class MedecinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Medecin::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
       
            TextField::new('firstName'),
            TextField::new('lastName'),    
            DateField::new('disponible'),
            NumberField::new('tarif'),
            TelephoneField::new('tel'),
            AssociationField::new('experience'),
            AssociationField::new('url'),
        ];
    }
    
}
