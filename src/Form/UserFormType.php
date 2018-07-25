<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 23/07/2018
 * Time: 14:37
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
;use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType{

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', TextType::class,['label' => 'Votre pseudo'])
            ->add('name', TextType::class, ['label' => 'Votre prénom'])
            ->add('firstname', TextType::class, ['label' => 'Votre nom'])
            ->add('email', EmailType::class, ['label' => 'Votre e-mail'])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Choisissez un mot de passe'],
                'second_options' => ['label' => 'Confirmer votre mot de passe']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

    public function getBlockPrefix() {
        return 'app_user';
    }
}