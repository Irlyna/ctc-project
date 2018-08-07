<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 06/08/2018
 * Time: 11:31
 */

namespace App\Controller\Admin;
use App\Entity\Ingredient;
use App\Entity\IngredientCategory;
use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller {

    /**
     * @Route("/", name="admin.index")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findAll();
        $ingredients = $em->getRepository(Ingredient::class)->findAll();
        $ingredientCategories = $em->getRepository(IngredientCategory::class)->findAll();
        $recipeCategories = $em->getRepository(RecipeCategory::class)->findAll();

        return $this->render('admin/adminProfil.html.twig', [
            'users' => $users,
            'ingredients' => $ingredients,
            'ingredientCategories' => $ingredientCategories,
            'recipeCategories' => $recipeCategories]);

    }

    /**
     * @param $userId
     * @Route("/edit-user/{userId}", name="admin.edit.user")
     */
    public function editUser($userId){

    }

    /**
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete-user/{userId}", name="admin.delete.user")
     */
    public function deleteUser($userId){
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class, $userId);

        $recipes = $user->getRecipes();
        foreach ($recipes as $recipe){
            $em->getRepository(Recipe::class)->deleteRecipe($recipe);
        }
        $em->getRepository(User::class)->deleteUser($userId);
        $em->flush();
        return $this->redirectToRoute('admin.index');
    }
}