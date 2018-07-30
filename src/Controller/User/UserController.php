<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 23/07/2018
 * Time: 13:21
 */

namespace App\Controller\User;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 */
class UserController extends Controller {
    /**
     * @Route("/", name="user.index")
     */
    public function indexAction(){
        return $this->render("user/profil.html.twig");
    }

    /**
     * @Route("/mes-recettes", name="user.getRecipe")
     */
    public function getRecipeUser(){
        $em = $this->getDoctrine()->getManager();
        $recipe = $em->getRepository(Recipe::class)->findByUser();

        return $this->render('user/recipes.html.twig');
    }
}