<?php

namespace App\Form;

use App\Entity\Song;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SongFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('video_id', TextType::class, [
                'property_path' => 'videoId',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('start', IntegerType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('end', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
            'csrf_protection' => false,

        ]);
    }
}
