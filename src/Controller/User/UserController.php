<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 23/07/2018
 * Time: 13:21
 */

namespace App\Controller\User;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Profil")
 */
class UserController extends Controller {
    /**
     * @Route("/", name="user.index")
     */
    public function indexAction(){
        return $this->render("user/profil.html.twig");
    }
}