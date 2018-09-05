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
     * @param $letter
     * @Route("/trier-par-lettre/{letter}", name="recipe.by.letter")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRecipesByLetter($letter){
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository(Recipe::class)->getRecipeByLetter($letter);

        return $this->render('default/home.html.twig', ['recipes' => $recipes]);
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
            $recipeCategories = explode(',',$_POST['recipeCategory']);


            $em = $this->getDoctrine()->getManager();
            $getRecipe = $em->getRepository(Recipe::class)->findOneBy(['name' => $name]);

            if(empty($getRecipe)){
                //ADD INGREDIENT
                foreach($ingredients as $ingredient){
                    $getIngredients = $this->getIngredient($em, $ingredient);
                    if(!empty($getIngredients)){
                        foreach($getIngredients as $ing){
                            $nameIngredient= strtolower($ing->getName());
                        }

                        if(strtolower($ingredient) != $nameIngredient){
                            $newIngredient = new Ingredient();
                            $newIngredient->setName($ingredient);
                            $recipe->addIngredients($newIngredient);
                            $em->persist($newIngredient);
                        }else{
                            foreach ($getIngredients as $ing)
                            $recipe->addIngredients($ing);
                        }
                    }elseif(empty($getIngredients)){
                        $newIngredient = new Ingredient();
                        $newIngredient->setName($ingredient);
                        $recipe->addIngredients($newIngredient);
                        $em->persist($newIngredient);
                    }

                }
                //ADD RECIPE CATEGORY
                foreach ($recipeCategories as $category){
                    $getRecipeCat = $this->getRecipeCategory($em, $category);
                    if(!empty($getRecipeCat)){
                        foreach ($getRecipeCat as $cat){
                            $nameRecipe= strtolower($cat->getName());
                        }
                        if(strtolower($category) != $nameRecipe){
                            $recipeCategory = new RecipeCategory();
                            $recipeCategory->setName($category);
                            $recipe->addRecipeCategory($recipeCategory);
                            $em->persist($recipeCategory);
                        }else{
                            foreach($getRecipeCat as $cat){
                                $recipe->addRecipeCategory($cat);
                            }

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


    /**
     * @param $recipeId
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/modifier-recette/{recipeId}", name="recipe.edit")
     */
    public function editRecipe($recipeId){
        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository(Recipe::class)->find($recipeId);

        if(isset($_POST['submit'])){
            $recipeName = $_POST['name'];
            $recipeIngredients = $_POST['ingredient'];
            $addRecipeIngredient = explode(',',$_POST['addIngredient']);
            $recipeContent = $_POST['step'];
            $recipeCategories = $_POST['recipeCategory'];
            $addRecipeCategory = explode(',',strtolower($_POST['addRecipeCategory']));

            $recipe->setName($recipeName);
            $recipe->setContent($recipeContent);

            /*foreach ($recipeIngredients as $ingredient){
                $getIngredient = $this->getIngredient($em, $ingredient);
                foreach ($getIngredient as $item) {
                    if($ingredient != $item->getName()){
                        $recipe->addIngredients($item);
                    }
                }
            }*/

            foreach($addRecipeIngredient as $ingredient){
                if(!empty($ingredient)){
                    $getIngredient = $this->getIngredient($em, $ingredient);
                    if(empty($getIngredient)){
                        $newIngredient = new Ingredient();
                        $newIngredient->setName($ingredient);
                        $recipe->addIngredients($newIngredient);
                        $em->persist($newIngredient);
                    }else{
                        $recipe->addIngredients($ingredient);
                    }
                }
            }

            /*foreach ($recipeCategories as $category){
                $getCategory = $this->getRecipeCategory($em, $category);
                foreach ($getCategory as $item){
                    if($category != $item->getName()){
                        $recipe->addRecipeCategory($item);
                    }
                }
            }*/

            foreach($addRecipeCategory as $category){
                if(!empty($category)){
                    $getCategory = $this->getRecipeCategory($em, $category);
                    if(empty($getCategory)){
                        $newCategory = new RecipeCategory();
                        $newCategory->setName($category);
                        $recipe->addRecipeCategory($newCategory);
                        $em->persist($newCategory);
                    }else{
                        $recipe->addRecipeCategory($category);
                    }
                }
            }


            $em->flush();
        }else{
            return $this->render('pages/recipe/editRecipe.html.twig', ['recipe' => $recipe]);
        }
        return $this->redirectToRoute('user.index');
    }

    /**
     * @param $recipeId
     * @Route("/supprimer-recette/{recipeId}", name="recipe.delete")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteRecipe($recipeId){
        $em = $this->getDoctrine()->getManager();
        $recipe = $em->find(Recipe::class, $recipeId);

        $ingredients = $recipe->getIngredients();
        $categories = $recipe->getRecipeCategories();

        foreach ($ingredients as $ingredient){
            $recipe->removeIngredients($ingredient);
        }
        foreach ($categories as $category){
            $recipe->removeRecipeCategory($category);
        }

        $em->getRepository(Recipe::class)->deleteRecipe($recipeId);

        return $this->redirectToRoute('user.index');
    }

    private function getIngredient($em, $ingredient){
        return $em->getRepository(Ingredient::class)->findBy(['name' => $ingredient]);
    }

    private function getRecipeCategory($em, $recipeCategory){
        return $em->getRepository(RecipeCategory::class)->findBy(['name'=> $recipeCategory]);
    }
}

