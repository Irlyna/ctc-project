<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 18/07/2018
 * Time: 15:24
 */

namespace App\Controller\Pages;


use App\Entity\Recipe;
use App\Form\RecipeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addRecipe(Request $request){
        $recipe = new Recipe();

        $form = $this->createForm(RecipeFormType::class, $recipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dump('Ca marche!!!');
        }
        return $this->render("pages/recipe/AddRecipe.html.twig", ['form' => $form->createView()]);
    }

    public function editRecipe($id){

    }

    public function deleteRecipe($id){

    }
}