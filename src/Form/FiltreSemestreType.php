<?php

namespace App\Form;

use App\Entity\Semestre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FiltreSemestreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('semestre', EntityType::class,[
                "class"=> Semestre::class,
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
