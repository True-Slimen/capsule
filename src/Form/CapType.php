<?php

namespace App\Form;

use App\Entity\Cap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
            ->add('picture_path', FileType::class, [
                'label' => "Image",
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '40024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Merci de ne soumettre que des fichiers JPEG, JPG ou PNG',
                    ])
                ],
            ])
            ->add('num_lambert', TextType::class, [
                'label' => "N° Lambert",
                'attr' => [
                    'class' => 'form-control mb-2'
                ]
            ])
            ->add('cotation', NumberType::class, [
                'label' => "Cotation",
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'invalid_message' => 'Seul les chiffres sont acceptés',
            ])
            //->add('created_at')
            //->add('brewery')
            ->add('save', SubmitType::class, [
                'label' => "Ajouter",
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cap::class,
        ]);
    }
}
