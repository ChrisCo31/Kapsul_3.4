<?php

namespace CTS\KapsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('selectorTitle', textType::class, array(
                'label' => 'selecteur du titre : ',
                'required' => true
            ))
            ->add('selectorExcerpt', textType::class, array(
                'label' => 'selecteur du résumé : ',
                'required' => true
            ))
            ->add('selectorTag', textType::class, array(
                'label' => 'selecteur du tag : ',
                'required' => true
            ))
            ->add('selectorDate', textType::class, array(
                'label' => 'selecteur date publication : ',
                'required' => true
            ))
            ->add('selectorLink', textType::class, array(
                'label' => 'selecteur du lien : ',
                'required' => true
            ))
            ->add('selectorImg', textType::class, array(
                'label' => 'selecteur de l\'image : ',
                'required' => true
            ))
            ->add('Enregister', SubmitType::class,[
                    'label' => 'Enregister',
                ]
            );;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CTS\KapsBundle\Entity\Selector'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cts_kapsbundle_selector';
    }


}
