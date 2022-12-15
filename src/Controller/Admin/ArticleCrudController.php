<?php

namespace App\Controller\Admin;

use DateTimeImmutable;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Article')
            ->setEntityLabelInPlural('Articles')
            ->setSearchFields(['username', 'content', 'title'])
            ->setDefaultSort(['created_at' => 'DESC'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('category'))
            ->add(EntityFilter::new('user'))
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('title', "Titre");
        yield TextEditorField::new('content', "Contenu");
        yield AssociationField::new('category', "Categorie");
        yield AssociationField::new('user', "Utilisateur");
        yield UrlField::new('urlPicture', "Url de l'image")->hideOnIndex();

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

    public function createEntity(string $entityFqcn)
    {
        $article = new Article();
        $article->setCreatedAt(new DateTimeImmutable('now'));
        $article->setUpdatedAt(new DateTimeImmutable('now'));

        return $article;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new DateTimeImmutable('now'));
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
