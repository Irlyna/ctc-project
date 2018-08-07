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
}