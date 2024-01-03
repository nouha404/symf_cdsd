<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Professeur;
use App\Entity\Semestre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FiltreClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        /*
        ->add('classe', EntityType::class,[
            "class"=> Classe::class,
            "placeholder"=> "All",
            "required"=>false
        ])*/
        ->add('classe', EntityType::class,[
            "class"=> Classe::class,
            "placeholder"=> "All",
            "required"=>false
        ])
        /*
        ->add('professeur', EntityType::class,[
            "class"=> Professeur::class,
            "placeholder"=> "All",
            "required"=>false
        ])

        */

        ->add('btnSave', submitType::class,[
            "label"=> "Filtrer",
            "attr"=> [
                "class"=> "btn btn-warning btn-sm float-center"
            ]
        
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
