<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 17/07/2018
 * Time: 20:23
 */

namespace App\Controller\Pages;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/Connexion");
 */
class ConnectionController extends Controller {

    /**
     * @Route("/", name="connection.index")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
   public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            dump('ok');die();
            /*$password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $user->setRoles(['ROLE_USER']);

            $em = $this->getDoctrine()->getManager();
            $em ->persist($user);
            $em -> flush();*/

           // return $this->redirectToRoute('user.index');
        }
        return $this->render('pages/connection.html.twig', ['form' => $form->createView()]);
    }

   /* /**
     * @Route("/", name="connection.register")
     * @return Response
     */
    /*public function loginAction(AuthenticationUtils $helper) : Response{
        return $this->render('pages/connection.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error'=> $helper->getLastAuthenticationError()
        ]);
    }*/

    /**
     * @Route("/Deconnection", name="connection.logout")
     */
    public function logout(){
        return $this->render('default/home.html.twig');
    }

}