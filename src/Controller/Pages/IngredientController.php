<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 18/07/2018
 * Time: 15:21
 */

namespace App\Controller\Pages;

use App\Entity\Ingredient;
use App\Entity\IngredientCategory;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/ingredients")
 */
class IngredientController extends Controller {

    /**
     * @Route("/", name="ingredient.index")
     */
    public function indexAction(){
        $getIngredients = $this->getDoctrine()->getRepository(Ingredient::class)->findAll();

        $ingredients = [];
        foreach ($getIngredients as $ingredient => $name){
            $ingredients[] = $name->getName();
        }
        return $this->render("pages/ingredient/ingredient.html.twig", ['ingredients' => $ingredients]);
    }

    /**
     * @Route("/ajouter-un-ingredient", name="ingredient.addIngredient")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addIngredient(){
        if(isset($_POST['submit']) && !empty($_POST)){

            $ingredient = new Ingredient();

            $name = $_POST['ingredient'];
            $ingCat[] = $_POST['ingredientCategory'];

            $em = $this->getDoctrine()->getManager();
            $getIngredient = $em->getRepository(Ingredient::class)->findOneBy(['name' => $name]);

            if(empty($getIngredient)){
                $getCategory = $em->getRepository(IngredientCategory::class)->findOneBy(['name' => $ingCat]);
                if(empty($getCategory)){
                    foreach ($ingCat as $key){
                        $category = new IngredientCategory();
                        $category->setName($key);
                        $em->persist($category);
                    }
                }else{
                    $category = $getCategory;
                }
                $ingredient->setName($name);
                $ingredient->setIngredientCategories($category);

                $em->persist($ingredient);
                $em->flush();

                return $this->redirectToRoute('ingredient.index');

            } else{
                return $this->redirectToRoute('ingredient.index');
            }
        }
        return $this->render("pages/ingredient/ingredient.html.twig");
    }

    /**
     * @Route("/modifier-ingredient/{ingredientId}", name="ingredient.edit")
     * @param $ingredientId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editIngredient($ingredientId){
        $em = $this->getDoctrine()->getManager();
        $ingredient = $em->find(Ingredient::class, $ingredientId);
        //MODIFY INGREDIENT OR INGREDIENT CATEGORIES
        if(isset($_POST['modify'])){
            if(isset($_POST['category'])){
                $ingredientCategoryUpdate = $_POST['category'];

                $getIngredientCategory = $em->getRepository(IngredientCategory::class)->findBy([
                    'name' => $ingredientCategoryUpdate]);

                if(empty($getIngredientCategory) ){
                    $category = new IngredientCategory();

                    $category->setName($ingredientCategoryUpdate);
                    $ingredient->addIngredientCategories($category);

                    $em->persist($category);
                }else{
                    foreach ($getIngredientCategory as $key) {
                        $category = $key;
                    }

                    $catIng = $ingredient->getIngredientCategories();

                    foreach ($catIng as $key) {
                        $categoryOfIngredient = $key;
                    }

                    if($category !== $categoryOfIngredient){
                        $ingredient->addIngredientCategories($category);
                    }else{
                        $ingredient->removeIngredientCategory($category);
                    }
                }
            }

            if(isset($_POST['name'])){
                $ingredientUpdate = $_POST['name'];
                $em->getRepository(Ingredient::class)->editIngredient($ingredientId, $ingredientUpdate);
            }
        //DELETE AN INGREDIENT AND ITS CATEGORY
        }elseif (isset($_POST['delete'])){
            $ingredient->getIngredientCategories();

            foreach ($ingredient as $categories){
                $ingredient->removeIngredientCategory($categories);
            }
            $em->getRepository(Ingredient::class)->deleteIngredient($ingredientId);
        }
        $em->flush();
        return $this->redirectToRoute('admin.index');
    }

}