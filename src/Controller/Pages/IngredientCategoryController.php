<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 30/07/2018
 * Time: 11:30
 */

namespace App\Controller\Pages;


use App\Entity\IngredientCategory;
use App\Form\IngredientCategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories-d-ingredient")
 */
class IngredientCategoryController extends Controller {

    /**
     * @Route("/ajouter-une-categorie", name="ing.cat.add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addCategory(Request $request){
        $ingCat = new IngredientCategory();

        $form = $this->createForm(IngredientCategoryFormType::class, $ingCat);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingCat);
            $em->flush();
        }
        return $this->render('pages/category/ingredientCategory.html.twig');
    }
}