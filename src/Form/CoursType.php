<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Classe;
use App\Entity\Semestre;
use App\Entity\CoursTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\DataTransformerInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /*'input' => 'string',
                'widget' => 'choice',
                'input_format' => 'H', */

            ->add('nombreHeureEffAt', DateTimeType::class, [
                'required'=>false,
                'widget' => 'choice',
                
                'input' => 'datetime_immutable',
              
                'data_class'=>null,
                'format' => 'dd-MM-yyyy HH:mm',
                'html5'=>false,
                'attr' => [
                    'autocomplete' => 'off',
                ],
                
            ])
            
            
            ->add('nombreHeureGlobalAt',  DateTimeType::class, [
                'required'=>false,
                'widget' => 'choice',
                'input' => 'datetime_immutable',
              
                'data_class'=>null,
                'format' => 'dd-MM-yyyy HH:mm',
                'html5'=>false,
                'attr' => [
                    'autocomplete' => 'off',
                ],
              
            ])
            ->add('nombreHeurePlannifierAt', DateTimeType::class, [
                'required'=>false,
                'widget' => 'choice',
                'input' => 'datetime_immutable',
              
                'data_class'=>null,
                'format' => 'dd-MM-yyyy HH:mm',
                'html5'=>false,
                'attr' => [
                    'autocomplete' => 'off',
                ],
                
            ])


            ->add('classe',EntityType::class,[
                'class' => Classe::class,
                'expanded' => false,
                'placeholder' => 'Sélectionnez la classe',
                'multiple' => true, 
                'expanded' => true,
            ])
            //->add('anneScolaire')
            ->add('professeur')
            //->add('semestre')
            ->add('module')
            ->add('semestre',EntityType::class,[
                'class' => Semestre::class,
                'choice_label' => 'libelle', 
                "label"=>"Semestre",
                'placeholder' => 'Sélectionnez une session',
                'multiple' => false,
                'expanded' => false,
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
            'data_class' => CoursTrue::class,
        ]);
    }
}
