<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 17/07/2018
 * Time: 20:16
 */

namespace App\Controller\Pages;


use App\Entity\RecipeCategory;
use App\Form\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 */
class CategoryController extends Controller {

    /**
     * @Route("/", name="category.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(){
        $getCategories = $this->getDoctrine()->getRepository(RecipeCategory::class)->findAll();

        $categories = [];
        foreach ($getCategories as $category => $name){
            $categories[] = $name->getName();
        }
        return $this->render("pages/category/category.html.twig", ['categories' => $categories]);
    }

    /**
     * @Route("/admin/ajouter-categorie-recette", name="category.add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addRecipeCategory(Request $request){
        $category = new RecipeCategory();

        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }
        return $this->render("pages/category/category.html.twig", ['form' => $form->createView()]);
    }

    /**
     * @param $recipeCategoryId
     * @param $recipeCategoryUpdate
     * @Route("/modifier-categorie-recette/{recipeCategoryId}", name="category.edit")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editRecipeCategory($recipeCategoryId){
        if(isset($_POST['submit']) && !empty($_POST)){
            $em = $this->getDoctrine()->getManager();
            $recipeCategoryUpdate = $_POST['name'];

            $em->find(RecipeCategory::class, $recipeCategoryId);

            $em->getRepository(RecipeCategory::class)->editRecipeCategory($recipeCategoryId, $recipeCategoryUpdate);

            $em->flush();
        }
        return $this->redirectToRoute('admin.index');
    }

    /**
     * @param $recipeCategoryId
     * @Route("/supprimer-categorie-recette/{recipeCategoryId}", name="category.delete")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteRecipeCategory($recipeCategoryId){
        $em = $this->getDoctrine()->getManager();
        $em->find(RecipeCategory::class, $recipeCategoryId);
        $em->getRepository(RecipeCategory::class)->deleteRecipeCategory($recipeCategoryId);
        $em->flush();
        return $this->redirectToRoute('admin.index');
    }
}