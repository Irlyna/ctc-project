<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 17/07/2018
 * Time: 18:27
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(){
        $content = $this->renderView("default/home.html.twig");

        return new Response($content);
    }
}