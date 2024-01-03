<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReinscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('createAt')
            //->add('isArchived')
            ->add('matricule',TextType::class, [
                'label' => 'Matricule',
                'required' => true,
                'mapped' => false, 
            ])
            ->add('btnSave', SubmitType::class, [
                'label' => 'ok',
                'attr' => [
                    'class' => 'btn btn-danger btn-sm mr-15',
                    'name'=>'rr'
                ],
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
