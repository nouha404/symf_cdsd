<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Niveau;
use App\Entity\Module;
use Doctrine\ORM\Mapping\Entity;
use PhpParser\Node\Expr\AssignOp\Mod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomClasse', TextType::class, [
                "required"=> false,
                "constraints"=>[
                    new NotBlank(
                       [
                            "message"=> "ce champ ne peut pas etre null ",
                       ]
                    )
                ]
            ])
            ->add('filiere')

            ->add('niveau', EntityType::class,[
                "class"=> Niveau::class
            ])

            ->add('module', EntityType::class,[
                "class"=>Module::class,
                "expanded"=>true,
                "multiple"=>true,
                "attr"=> [
                    "class"=> "d-flex"
                ]
            ])
            ->add('isArchived')
            ->add('btnSave', submitType::class,[
                "label"=> "Enregistrer",
                "attr"=> [
                    "class"=> "btn btn-danger btn-sm float-center"
                ]
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
            'constraints'=> [
                new UniqueEntity(
                    [
                        'fields'=> ['nomClasse'],
                        'message'=> 'le nom doit la classe doit doit etre unique',
                    ]
                )
            ]
        ]); 
    }
}
