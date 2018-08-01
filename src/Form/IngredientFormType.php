<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 29/07/2018
 * Time: 17:29
 */

namespace App\Form;


use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'ingrédient',
                'attr' => ['placeholder' => 'ex: Fraise ']])
            ->add('IngredientCategories', TextType::class, [
                'label' => 'Entrer une catégorie d\'ingrédients',
                'attr' => ['placeholder' => 'ex: Fruit']])
            ->add('submit', SubmitType::class, ['label'=> 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            ['data_class' => Ingredient::class]
        );
    }
}