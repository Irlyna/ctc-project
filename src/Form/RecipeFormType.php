<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 24/07/2018
 * Time: 16:19
 */

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de votre recette",
                'attr' => ['placeholder' => 'ex: Boeuf bourguignon ']])
            ->add('ingredients', TextType::class, [
                //'class' => Ingredient::class,
                'label' => 'Ingrédient(s)',
                'attr' => ['placeholder' => 'Séparer les ingrédients par des virgules'],
                /*'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                }, 'choice_label' => 'name'*/])
            ->add('content', TextareaType::class, ['label' => 'Instructions'])
            ->add('recipeCategories', TextType::class, [
                //'class' => RecipeCategory::class,
                'label' => 'Catégorie(s) de la recette',
                'attr' => ['placeholder' => 'ex: Plat familliale, Hiver, etc ...']
                /*
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('rc')
                        ->orderBy('rc.name', 'ASC');
                }, 'choice_label' => 'name'*/])
            ->add('submit', SubmitType::class, ['label'=> 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Recipe::class,
        ));
    }
}