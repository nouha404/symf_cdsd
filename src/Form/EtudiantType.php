<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('matricule')
            ->add('email')
            ->add('tuteur')
            ->add('dateNaissanceAt', DateType::class, [
                "widget"=> "single_text",
                "input"=>"datetime_immutable",
            ])
            ->add('password',PasswordType::class,[
                
            ])
            
           
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
