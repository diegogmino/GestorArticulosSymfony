<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('fecha')
            ->add('texto')
            ->add('comentario')
            ->add('resumen')
            ->add('categoria', ChoiceType::class, [
                'choices' => [
                    'Opinión' => 1,
                    'Divulgación' => 2,
                    'Informativo' => 3,
                    'Reportaje' => 4,
                    'Editorial' => 5,
                    'Columna' => 6,
                    'Entrevista' => 7,
                    'Crítica' => 8,
                    'Otros' => 9,
                ]
            ])
            ->add('url')
            ->add('medio', ChoiceType::class, [
                'choices' => [
                    'Papel' => 1,
                    'Digital' => 2,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
