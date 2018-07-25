<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 18/07/2018
 * Time: 15:21
 */

namespace App\Controller\Pages;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/ingredients")
 */
class IngredientController extends Controller {

    /**
     * @Route("/", name="ingredient.index")
     */
    public function indexAction(){
        return $this->render("pages/ingredient.html.twig");
    }

    public function editIngredient($ingredient){
        if(!isset($ingredient)){

        }
    }

    public function deleteIngredient($ingredient){

    }
}