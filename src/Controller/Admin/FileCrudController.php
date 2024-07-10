<?php

namespace App\Controller\Admin;

use App\Entity\File;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return File::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('url')->setBasePath('uploads/medecins')->setUploadDir('public/uploads/medecins')->setUploadedFileNamePattern('[uuid]-[content.hash].[extension]'),
        ];
    }
    
}
