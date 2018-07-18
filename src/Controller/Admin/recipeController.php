<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 18/07/2018
 * Time: 15:24
 */

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recettes")
 */
class recipeController extends Controller {

    /**
     * @Route("/", name="recipe.index")
     */
    public function indexAction(){
        return $this->render("admin/recipe.html.twig");
    }
}