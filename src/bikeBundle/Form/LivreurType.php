<?php

namespace bikeBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;

class LivreurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('livNom',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('livPrenom',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('email',EmailType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('username',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('password',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('livtel',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('Enter',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary btn-sm','style'=>'position:relative;left:45.2%')));

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bikeBundle\Entity\Livreur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bikebundle_livreur';
    }


}
