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

            ->add('support', ChoiceType::class, array(
                'choices' => array(
                    'ecrit' => true,
                    'audio' => false,
                    'video' => false,
                )
            ))

            ->add('frequency', ChoiceType::class, array(
                'choices' => array(
                    'quotidien' => true,
                    'hebdomadaire' => false,
                    'mensuel' => false,
                    'trimestriel'=> false,
                    'indefini' => false,
                )
            ))

            ->add('lang', ChoiceType::class, array(
                'label' => 'Langue : ',
                'choices' => array(
                    'fr' => true,
                    'en' => false,
                )
            ))

            ->add('price', ChoiceType::class, array(
                'label' => 'Price : ',
                'choices' => array(
                    'gratuit' => true,
                    'payant' => false,
                )
            ))

            ->add('createdAt', DateType::class,[
                'label' => 'Date : ',
                'format' => 'dd/MM/yyyy',

            ])
            ->add('picture', PictureType::class, [
                'label' => 'Image : ',
                'required' => false])

            ->add('themes', CollectionType::class, [
                'entry_type' => ThemeType::class,
                'allow_add'  => true,
                'allow_delete' => true,
                'label' => 'Test : ',
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