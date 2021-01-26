<?php

namespace App\Form;

use App\Entity\EventSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SearchType;

class SearchAdminEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('search', SearchType::class, [
               'required' => false,
                'attr' => [
                    'placeholder' => 'Ecrivez votre recherche ..'],
                'label' => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'      => EventSearch::class,
            'csrf_protection' => false,
        ]);
    }
    public function getBlockPrefix(): string
    {
        return '';
    }
}
