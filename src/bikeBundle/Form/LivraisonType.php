<?php

namespace bikeBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use Doctrine\ORM\EntityRepository;

class LivraisonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('livreur',\Symfony\Bridge\Doctrine\Form\Type\EntityType::class,array(

            'class'=>'bikeBundle:Livreur',
            'placeholder'=>'Selectionnez un livreur',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->where('u.livDispo >= 1');
            },
            'choice_label'=>'livnom',
            'multiple'=>false,'attr'=>array('class'=>'form-control')
        ))
            ->add('livraisonAdresse',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('livraisonProduits',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')))
            ->add('montantTotal',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin:2px')));
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bikeBundle\Entity\Livraison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bikebundle_livraison';
    }


}
