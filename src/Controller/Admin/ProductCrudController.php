<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),
            // ImageField::new('illustration')
            // ->setBasePath('uploads/products')
            // ->setUploadDir('public/uploads')
            // ->setFormType(FileUploadType::class, [
            //     'multiple' => true,
            // ])
            // ->setUploadedFileNamePattern('[randomhash].[extension]')
            // ->setRequired(false),
            CollectionField::new('images'),
            CollectionField::new('images')
                ->setEntryType(ImagesType::class)
                ->onlyOnForms(),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            BooleanField::new('isBest'),
            MoneyField::new('price')->setCurrency('EUR'),
            AssociationField::new('category')
        ];
    }
    
}
