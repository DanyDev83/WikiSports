<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre email',
                    ]),
                ],
            ])
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un nom d\'utilisateur',
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 24,
                        'minMessage' => 'Votre nom d\'utilisateur doit comporter au minimum {{ limit }} caractères',
                        'maxMessage' => 'Votre nom d\'utilisateur doit comporter au maximum {{ limit }} caractères'
                    ]),
                    new Regex([
                        "pattern" => "/^[a-z0-9]+$/i", 
                        "htmlPattern" => "^[a-zA-Z0-9]+$",
                        "message" => "Votre nom doit contenir seulement des caractères alphanumériques"
                    ])
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Confirmer votre mot de passe *'],
                'invalid_message' => 'Le mot de passe ne correspond pas',
                'options' => ['attr' => ['class' => 'password-field', 'autocomplete' => 'new-password']],
                'required' => true,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Conditions Générales d\'Utilisations *',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez être d\'accord avec nos CGU',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => ['class' => 'bg-success text-white'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
