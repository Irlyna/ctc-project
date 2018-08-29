<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 18/07/2018
 * Time: 15:24
 */

namespace App\Controller\Pages;


use App\Entity\Ingredient;
use App\Entity\IngredientCategory;
use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recettes")
 */
class RecipeController extends Controller {

    /**
     * @Route("/", name="recipe.index")
     */
    public function indexAction(){
        return $this->render("pages/recipe/recipe.html.twig");
    }

    /**
     * @Route("/ajouter-une-recette", name="recipe.add")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addRecipe(){

        if(isset($_POST['submit']) && !empty($_POST) && !empty($user= $this->getUser())){

            $recipe = new Recipe();
            $name = $_POST['name'];
            $ingredients = explode(',',$_POST['ingredient']);
            $step = $_POST['step'];
            $recipeCategories = explode(',',strtolower($_POST['recipeCategory']));


            $em = $this->getDoctrine()->getManager();
            $getRecipe = $em->getRepository(Recipe::class)->findOneBy(['name' => $name]);

            if(empty($getRecipe)){
                foreach($ingredients as $ingredient){
                    $getIngredients = $em->getRepository(Ingredient::class)->findOneBy(['name' => $ingredient]);
                    if(!empty($getIngredients)){
                        $nameIngredient= strtolower($getIngredients->getName());

                        if(strtolower($ingredient) != $nameIngredient){
                            $newIngredient = new Ingredient();
                            $newIngredient->setName($ingredient);
                            $recipe->addIngredients($newIngredient);
                            $em->persist($newIngredient);
                        }else{
                            $recipe->addIngredients($getIngredients);
                        }
                    }elseif(empty($getIngredients)){
                        $newIngredient = new Ingredient();
                        $newIngredient->setName($ingredient);
                        $recipe->addIngredients($newIngredient);
                        $em->persist($newIngredient);
                    }

                }

                foreach ($recipeCategories as $category){
                    $getRecipeCat = $em->getRepository(RecipeCategory::class)->findOneBy(['name' => $category]);
                    if(!empty($getRecipeCat)){
                        $nameRecipe= strtolower($getRecipeCat->getName());
                        if(strtolower($category) != $nameRecipe){
                            $recipeCategory = new RecipeCategory();
                            $recipeCategory->setName($category);
                            $recipe->addRecipeCategory($recipeCategory);
                            $em->persist($recipeCategory);
                        }else{
                            $recipe->addRecipeCategory($getRecipeCat);
                        }
                    }elseif(empty($getRecipeCat)){
                        $recipeCategory = new RecipeCategory();
                        $recipeCategory->setName($category);
                        $recipe->addRecipeCategory($recipeCategory);
                        $em->persist($recipeCategory);
                    }

                }

                $recipe->setName($name);
                $recipe->setContent($step);
                $recipe->setUser($user= $this->getUser());
                $em->persist($recipe);
                $em->flush();

                return $this->redirectToRoute('homepage');

            } else{
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render("default/home.html.twig");
    }

    public function editRecipe($id){

    }

    public function deleteRecipe($RecipeId){

    }
}