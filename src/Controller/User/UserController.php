<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 23/07/2018
 * Time: 13:21
 */

namespace App\Controller\User;

use App\Entity\Recipe;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends Controller {
    /**
     * @Route("/", name="user.index")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository(Recipe::class)->findByUser($this->getUser()->getid());

        return $this->render('user/profil.html.twig', ['recipes' => $recipes]);
    }

    /**
     * @param $userId
     * @Route("/edit-user/{userId}", name="user.edit")
     */
    public function editUser($userId){

    }

    /**
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete-user/{userId}", name="user.delete")
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
        return $this->redirectToRoute('homepage');
    }
}