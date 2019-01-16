<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 10/01/2019
 * Time: 10:11
 */

namespace CTS\KapsBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Name or Pseudo
            ->add('username', TextType::class, [
                'label' => 'Nom ou Pseudo',
                'required' => true
            ])
            // check emails
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'required' => true,
                'first_options' =>array('label' =>'Email de contact'),
                'second_options'=>array('label' =>'Verification de l\'email'),
            ])
            // check password
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Verifier mot de passe'),

            ])
            ->add('save', SubmitType::class, [
                'label' => 'S\'enregistrer'
            ]);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CTS\KapsBundle\Entity\User'
        ]);
    }

}