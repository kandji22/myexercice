<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Entity\Region;
use App\Form\DepartementType;
use App\Form\MyformType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class RegionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Region::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX == $pageName) {
            return [
                IdField::new('id'),
                TextField::new('name'),
                DateTimeField::new('created'),
            ];
        }
        else {
            return [
                TextField::new('name'),
                CollectionField::new('departements')
                ->setEntryType(DepartementType::class)
                ->setFormTypeOption('by_reference',false)
                ->allowAdd(true)
                ->allowDelete(true)
                ,
                CollectionField::new('files')
                ->setEntryType(MyformType::class)
            ];
        }
    }

}
