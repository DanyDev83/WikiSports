<?php

namespace App\Controller\Admin;

use DateTimeImmutable;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();;
        yield TextField::new('name', "Nom");
        yield TextEditorField::new('description');
        yield AssociationField::new('articles', "Nb d'articles");

        $edit = Crud::PAGE_EDIT === $pageName;
        
        $createdAt = DateTimeField::new('createdAt', 'Créé le')->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ])->hideWhenCreating();
        $edit ? yield $createdAt->setFormTypeOption('disabled', true) : yield $createdAt;

        $updatedAt = DateTimeField::new('updatedAt', 'Modifié le')->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ])->hideWhenCreating();
        $edit ? yield $updatedAt->setFormTypeOption('disabled', true) : yield $updatedAt;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
            ->setSearchFields(['name', 'description'])
            ->setDefaultSort(['created_at' => 'DESC'])
        ;
    }

    public function createEntity(string $entityFqcn)
    {
        $category = new Category();
        $category->setCreatedAt(new DateTimeImmutable('now'));
        $category->setUpdatedAt(new DateTimeImmutable('now'));

        return $category;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new DateTimeImmutable('now'));
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
