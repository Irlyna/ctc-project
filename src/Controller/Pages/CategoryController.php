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
        $categories = $this->getDoctrine()->getRepository(RecipeCategory::class)->findAll();

        return $this->render("pages/category/category.html.twig", ['categories' => $categories]);
    }

    /**
     * @param $letter
     * @Route("/trier-par-lettre/{letter}", name="category.by.letter")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCategoriesByLetter($letter){
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(RecipeCategory::class)->getCategoriesByLetter($letter);

        return $this->render('pages/category/category.html.twig', ['categories' => $categories]);
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/modifier-categorie-recette/{recipeCategoryId}", name="category.edit")
     */
    public function editRecipeCategory($recipeCategoryId){
        $em = $this->getDoctrine()->getManager();
        $category = $em->find(RecipeCategory::class, $recipeCategoryId);

        if(isset($_POST['modify']) && !empty($_POST)){
            $recipeCategoryUpdate = $_POST['name'];

            $em->getRepository(RecipeCategory::class)->editRecipeCategory($recipeCategoryId, $recipeCategoryUpdate);

        }elseif(isset($_POST['delete'])){
            $recipes = $category->getRecipes();
            foreach ($recipes as $recipe){
                $category->removeRecipe($recipe);
            }
            $em->getRepository(RecipeCategory::class)->deleteRecipeCategory($recipeCategoryId);
        }
        $em->flush();
        return $this->redirectToRoute('admin.index');
    }
}