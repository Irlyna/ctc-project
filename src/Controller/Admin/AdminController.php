<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 06/08/2018
 * Time: 11:31
 */

namespace App\Controller\Admin;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller {

    /**
     * @Route("/", name="admin.index")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('admin/adminProfil.html.twig', ['users' => $users]);

    }

    /**
     * @param $id
     * @Route("/delete-user", name="admin.delete.user")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser(){
        dump('ca marche ta mere');
        return $this->render('admin/adminProfil.html.twig');
    }
}