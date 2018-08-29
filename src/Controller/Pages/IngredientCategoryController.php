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

        $formIngCat = $this->createForm(IngredientCategoryFormType::class, $ingCat);

        $formIngCat->handleRequest($request);

        if($formIngCat->isSubmitted() && $formIngCat->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingCat);
            $em->flush();
        }
        return $this->render('pages/category/ingredientCategory.html.twig', ['form' => $formIngCat->createView()]);
    }

    /**
     * @param $ingredientCategoryId
     * @Route("/editer-categorie-ingredient/{ingredientCategoryId}", name="ing.cat.edit")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editIngredientCategory($ingredientCategoryId){
        $em = $this->getDoctrine()->getManager();
        $em->find(IngredientCategory::class, $ingredientCategoryId);

        if(isset($_POST['modify']) && !empty($_POST)){
            $IngredientCategoryUpdate = $_POST['name'];

            $em->getRepository(IngredientCategory::class)->editIngredientCategory($ingredientCategoryId, $IngredientCategoryUpdate);

            $em->flush();
        }elseif (isset($_POST['delete'])){
            $em->getRepository(IngredientCategory::class)->deleteIngredientCategory($ingredientCategoryId);
        }
        $em->flush();
        return $this->redirectToRoute('admin.index');
    }
}