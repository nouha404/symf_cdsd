<?php

namespace App\Form;

use App\Entity\Niveau;
use App\Entity\Filiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeachFormClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filiere', EntityType::class,[
                "class"=> Filiere::class,
                "required"=>false,
                "placeholder"=> "All"
            ])

            ->add('niveau', EntityType::class,[
                "class"=> Niveau::class,
                "placeholder"=> "All",
                "required"=>false
            ])

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
