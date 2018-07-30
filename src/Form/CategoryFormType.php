<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 30/07/2018
 * Time: 17:42
 */

namespace App\Form;


use App\Entity\RecipeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Entrer une catégorie',
                'attr' => ['palceholder' => 'ex: Entrée']])
            ->add('submit', SubmitType::class, ['label'=> 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            ['data_class' => RecipeCategory::class]
        );
    }
}