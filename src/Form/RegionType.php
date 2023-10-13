<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('departements',CollectionType::class,[
                'allow_delete' => true,
                'allow_add' => true,
                'entry_type' => DepartementType::class,
                'by_reference' => false,
                'entry_options' => [
                    'label' => 'Départements en liason'
                ]
            ])
            ->add('file',FileType::class,[
                'multiple' => true,

            ])
            ->add('submit',SubmitType::class,[
                'label' => 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}
