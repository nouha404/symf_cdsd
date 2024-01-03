<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('createAt')
            //->add('isArchived')
            ->add('etudiant',EtudiantType::class,[
                "label"=>false,
            ])
            
            ->add('classe', EntityType::class,[
                "choice_label"=> "nomClasse",
                "class"=> Classe::class,
                "placeholder"=> "All",
                "required"=>false
            ])
            //->add('anneScolaire')
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
            'data_class' => Inscription::class,
        ]);
    }
}
