<?php

namespace App\Form;

use App\Entity\Ordered;
use App\Entity\User;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Articles')
            ->add('Total')
            ->add('Date')
            ->add('Num_Ordered')
            ->add('Delivery_Address',EntityType::class, array(
                'class'=>User::class,
                'required'=>true,
                'label'=>'Delivery address',
                'choice_label'=>'address',
                'multiple'=>false,
            ))
            ->add('Billing_Address',EntityType::class, array(
                'class'=>User::class,
                'required'=>true,
                'label'=>'Billing address',
                'choice_label'=>'address',
                'multiple'=>false,
            ))
            ->add('user', EntityType::class, array(
                'class'=>User::class,
                'required'=>true,
                'label'=>'E-mail',
                'choice_label'=>'email',
                'multiple'=>false,
            ))
            ->add('Relation_Cart')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ordered::class,
        ]);
    }
}
