<?php

namespace App\Form;

use App\Entity\Plannification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PlannificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateAt',DateType::class,[
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'html5' => false,
                'disabled' => false,
            ])
            ->add('heureDebutAt',TimeType::class,[
                'widget' => 'choice',
                
                'html5' => false,
            ])
            ->add('heureFinAt',TimeType::class,[
                'widget' => 'choice',
                'html5' => false,
            ])
            ->add('btnSave', submitType::class,[
                "label"=> "Enregistrer",
                "attr"=> [
                    "class"=> "btn btn-danger btn-sm ",
                ]
            
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plannification::class,
        ]);
    }
}
