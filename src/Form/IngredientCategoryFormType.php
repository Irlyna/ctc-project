<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 30/07/2018
 * Time: 17:37
 */

namespace App\Form;


use App\Entity\IngredientCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientCategoryFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Entrer une catégorie d\'ingrédients',
                'attr' => ['palceholder' => 'ex: Fruit']]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            ['data_class' => IngredientCategory::class]
        );
    }

}