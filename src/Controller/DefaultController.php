<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(){
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();

        return $this->render("default/home.html.twig", ['recipes' => $recipes]);
    }
}