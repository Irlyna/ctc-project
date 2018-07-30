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
use App\Form\IngredientFormType;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render("pages/ingredient/ingredient.html.twig");
    }

    /**
     * @Route("/ajouter-un-ingredient", name="ingredient.addIngredient")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addIngredient(Request $request){
        $ingredient = new Ingredient();

        $form = $this->createForm(IngredientFormType::class, $ingredient);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
        }
        return $this->render("pages/ingredient/addIngredient.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @Route("/modifier", name="ingredient.edit")
     * @param $ingredient
     */
    public function editIngredient($ingredient){

    }

    public function deleteIngredient($ingredient){

    }
}