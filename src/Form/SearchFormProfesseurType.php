<?php

namespace App\Form;

use App\Entity\Grade;
use App\Entity\Classe;
use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SearchFormProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('grade', EntityType::class, [
                "class" => Grade::class,
                "expanded"=>true,
                "multiple"=>true,
                "placeholder" => "All",
                "required" => false,
                "attr"=> [
                    "class"=> "d-flex"
                ]
            ])
            

            -> add("classe", EntityType::class, [
                "class"=> Classe::class,
                "expanded"=>true,
                "multiple"=>true,
                "placeholder" => "All",
                "required" => false,
                "attr"=> [
                    "class"=> "d-flex"
                ]
            ])

            ->add('btnSaved', submitType::class,[
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
        ]);
    }
}
