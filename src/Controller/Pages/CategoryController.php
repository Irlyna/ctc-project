<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 17/07/2018
 * Time: 20:16
 */

namespace App\Controller\Pages;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 */
class CategoryController extends Controller {

    /**
     * @Route("/", name="category.index")
     */
    public function indexAction(){
        return $this->render("pages/category.html.twig");
    }
}