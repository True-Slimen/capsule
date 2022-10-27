<?php

namespace App\Form;

use App\Entity\Cap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CapType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom",
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('picture_path', TextType::class, [
                'label' => "Image",
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('num_lambert', TextType::class, [
                'label' => "N° Lambert",
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('cotation', TextType::class, [
                'label' => "Cotation",
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            //->add('created_at')
            //->add('brewery')
            ->add('save', SubmitType::class, [
                'label' => "Ajouter",
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cap::class,
        ]);
    }
}
