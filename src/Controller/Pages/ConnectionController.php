<?php
/**
 * Created by PhpStorm.
 * User: Christelle
 * Date: 25/07/2018
 * Time: 10:20
 */

namespace App\Controller\Pages;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/connexion")
 */
class ConnectionController extends Controller {
    /**
     * @Route("/", name="connection.index")
     */
    public function indexAction(){

        return $this->render("pages/register/connection.html.twig");
    }

    /**
     * @Route("/inscription", name="connection.register")
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(UserPasswordEncoderInterface $passwordEncoder){

        if(isset($_POST['submit']) && !empty($_POST)){
            $user = new User();

            $username = $_POST['username'];
            $name = $_POST['name'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $passwordFirst = $_POST['password-first'];
            $passwordSecond = $_POST['password-second'];

            $em = $this->getDoctrine()->getManager();
            $findEmailUser = $em->getRepository(User::class)->findBy(['email' => $email]);

            if(empty($findEmailUser)){
                if($passwordFirst !== $passwordSecond){
                    return $this->render("pages/register/register.html.twig", ["message" => "Erreur dans le formulaire"]);
                }else{
                    $user->setPassword($passwordFirst);
                    $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($password);
                }

                $user->setUsername($username);
                $user->setName($name);
                $user->setFirstname($firstname);
                $user->setEmail($email);
                $user->setRoles(['ROLE_USER']);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('connection.login', ["message" => "Inscription réussis"]);
            }
        }

        return $this->render("pages/register/register.html.twig");
    }

    /**
     * @Route("/connexion", name="connection.login")
     * @param AuthenticationUtils $helper
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $helper){
        return $this->render("pages/register/connection.html.twig",
            ['last_username' => $helper->getLastUsername(),
             'error' => $helper->getLastAuthenticationError()]);
    }

    /**
     * @Route("/deconnexion", name="connection.logout")
     */
    public function logoutAction(){}
}