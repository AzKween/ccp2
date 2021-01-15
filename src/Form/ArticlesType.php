<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Kinds;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Choice;


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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
