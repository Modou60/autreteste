<?php
namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Utilisateurs;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\StringType;
use PhpParser\Node\Stmt\Label;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;

class CommentairesTypes extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('auteur', TextType::class, [
            'label' => 'Auteur :',
            'required' => 'true',
            'placeholder' => 'Auteur',
            

            // cases à cocher ou bouton radio
            // 'multiple' => true
             'expanded' => true,
        ])
        ->add('mail', EmailType::class, [
            'label' => 'Entrez votre email :',
            'placeholder' => 'Entrez votre email :'
        ])
        ->add('date', DateType::class, [
            'label' => 'Date',
            'placeholder' => 'Date'
        ])
        ->add('commentaire', TextareaType::class, [
            'label' => 'Votre commentaire :'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
}
}
