<?php

namespace App\Form;

use App\Entity\Categorie;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,[
                'label'=>'Titre',
                'required' => 'false',
                // 'constraints' => [new length(['min' => 3], ['max' => 60])]
            ])

            ->add('resume', TextareaType::class,[
                'label' => 'Contenu',
                'required' => 'true'
            ])
            ->add('article', TextType::class,[
                'label' => 'Article'
            ])
            ->add('Envoyer', SubmitType::class,[
                'label'=>'Valider'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
    }
