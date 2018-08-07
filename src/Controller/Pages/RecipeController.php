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
            $ingredients[] = $_POST['ingredient'];
            $ingCat[] = $_POST['ingredientCategory'];
            $step = $_POST['step'];
            $recipeCategories[] = $_POST['recipeCategory'];


            $em = $this->getDoctrine()->getManager();
            $getRecipe = $em->getRepository(Recipe::class)->findOneBy(['name' => $name]);

            if(empty($getRecipe)){
                $getIngredients = $em->getRepository(Ingredient::class)->findOneBy(['name' => $ingredients]);
                $getIngCat = $em->getRepository(IngredientCategory::class)->findOneBy(['name'=>$ingCat]);
                $getRecipeCat = $em->getRepository(RecipeCategory::class)->findOneBy(['name' => $recipeCategories]);

                if(empty($getIngCat)){
                    foreach ($ingCat as $key){
                        $category = new IngredientCategory();
                        $category->setName($key);
                        $em->persist($category);
                    }
                    $em->flush();
                }else{
                    $category = $getIngCat;
                }
                if(empty($getIngredients)){
                    foreach ($ingredients as $key){
                        $ingredient = new Ingredient();
                        $ingredient->setName($key);
                        $ingredient->setIngredientCategories($category);
                        $em->persist($ingredient);
                    }
                    $em->flush();
                }else{
                    $ingredient = $getIngredients;
                }
                if(empty($getRecipeCat)){
                    foreach ($recipeCategories as $key){
                        $recipeCategory = new RecipeCategory();
                        $recipeCategory->setName($key);
                        $em->persist($recipeCategory);
                    }
                    $em->flush();
                }else{
                    $recipeCategory = $getRecipeCat;
                }

                $recipe->setName($name);
                $recipe->addIngredients($ingredient);
                $recipe->setContent($step);
                $recipe->addRecipeCategory($recipeCategory);
                $recipe->setUser($user= $this->getUser());
                $em->persist($recipe);
                $em->flush();

                return $this->redirectToRoute('recipe.index');

            } else{
                return $this->redirectToRoute('recipe.index');
            }
        }

        return $this->render("pages/recipe/recipe.html.twig");
    }

    public function editRecipe($id){

    }

    public function deleteRecipe($id){

    }
}