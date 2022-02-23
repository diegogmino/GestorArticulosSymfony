<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
                    'Opinión' => 'opi',
                    'Divulgación' => 'div',
                    'Informativo' => 'inf',
                    'Reportaje' => 'repor',
                    'Editorial' => 'edit',
                    'Columna' => 'col',
                    'Entrevista' => 'entr',
                    'Crítica' => 'crit',
                    'Otros' => 'otros',
                ]
            ])
            ->add('url')
            ->add('medio', ChoiceType::class, [
                'choices' => [
                    'Papel' => 'papel',
                    'Digital' => 'dig',
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
