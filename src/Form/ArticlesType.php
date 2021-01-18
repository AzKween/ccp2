<?php

namespace App\Form;

use App\Entity\Kinds;
use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Price')
            ->add('Description')
            ->add('PictureFile', FileType::class, [
                'required' => true
            ])
            ->add('carts')
            ->add('Relation_Kinds', EntityType::class, array(
                'class' => kinds::class,
                'choice_label' => 'kind',
                'label' => 'kinds',
                'multiple' => false,
                
            ))
            ->add('categories', EntityType::class, array(
                'class' => Categories::class,
                'choice_label' => 'category',
                'label' => 'categories',
                'multiple' => false,
                
            ))
            ->add('DateAdd', DateTimeType::class, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
