<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NEWCLASSEType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $niveau = $options['niveau'] ?? null;

        $builder
         
         
            
            /*->add('btnSave', SubmitType::class, [
                'label' => 'REINSCRIRE',
                'attr' => [
                    'class' => 'btn btn-danger btn-sm float-center',
                ],
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
