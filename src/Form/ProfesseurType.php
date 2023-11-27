<?php

namespace App\Form;

use App\Entity\Grade;
use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('email')
            ->add('module', EntityType::class,[
                "class"=>Module::class,
                "expanded"=>true,
                "multiple"=>true,
                "attr"=> [
                    "class"=> "d-flex"
                ]

                ]
            )
            ->add('isArchived')

            ->add('grade', EntityType::class,[
                "class"=>Grade::class,
                "expanded"=>true,
                "multiple"=>true,
                "attr"=> [
                    "class"=> "d-flex"
                ]

                ]
            )
            ->add("classe", EntityType::class, [
                "class"=>Classe::class,
                "expanded"=>true,
                "multiple"=>true,
            ])

            ->add('btnSave', submitType::class,[
                "label"=> "Enregistrer",
                "attr"=> [
                    "class"=> "btn btn-danger btn-sm float-left"
                ]
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
