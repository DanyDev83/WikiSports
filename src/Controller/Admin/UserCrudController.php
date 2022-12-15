<?php

namespace App\Controller\Admin;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ->setSearchFields(['username', 'email'])
            ->setDefaultSort(['created_at' => 'DESC'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('username', "Nom");
        yield EmailField::new('email');
        yield TextField::new('password')->setFormType(PasswordType::class)->onlyWhenCreating();
        yield AssociationField::new('articles', "Articles")->hideWhenCreating();
        yield ArrayField::new('roles', "Rôles");

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
        $user = new User();
        $user->setCreatedAt(new DateTimeImmutable('now'));
        $user->setUpdatedAt(new DateTimeImmutable('now'));

        return $user;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new DateTimeImmutable('now'));
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
