<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 17/07/2018
 * Time: 20:23
 */

namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Connexion");
 */
class ConnectionController extends Controller {

    /**
     * @Route("/", name="connection.index")
     */
    public function indexAction(){
        return $this->render("admin/connection.html.twig");
    }
}