<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 25/10/2018
 * Time: 12:43
 */

namespace CTS\KapsBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', textType::class, array(
                'label' => 'Nom : ',
                'required' => true
            ))

            ->add('url', UrlType::class, array(
                'label' => 'Url : ',
                'required' => true
            ))

            ->add('presentation', textType::class, array(
                'label' => 'Apercu : ',
                'required' => true
            ))

            ->add('createdAt', DateType::class,[
                'label' => 'Date : ',
                'format' => 'dd/MM/yyyy',

            ])
            ->add('picture', PictureType::class, [
                'label' => 'Image : ',
                'required' => false
            ])
            ->add('universe', ChoiceType::class, [
                'label' => 'Univers',
                'choices' => [
                    'Arts' => true,
                    'Culture' => false,
                    'Histoire'=> false,
                    'Sciences'=> false,
                    'Politique'=> false,
                    'Societe'=> false,
                ]
                ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder'
            ]);

    }

    /**s
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CTS\KapsBundle\Entity\Media'
        ]);
    }

}