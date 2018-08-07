<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User implements UserInterface, \Serializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     *
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recipe", mappedBy="user")
     *
     */
    private $recipes;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    //*****************************
    //      CONSTRUCTEUR
    //*****************************

    public function __construct() {
        $this->recipes = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
    }

    //*****************************
    //      METHODS
    //*****************************

    /**
     * Add recipe
     * @param Recipe $recipe
     * @return User
     */
    public function addRecipe(Recipe $recipe) : User{
        $this->recipes[] = $recipe;
        return $this;
    }

    /**
     * Remove recipe
     * @param Recipe $recipe
     */
    public function removeRecipe(Recipe $recipe){
        $this->recipes->removeElement($recipe);
    }
    //*****************************
    //      GETTER - SETTER
    //*****************************

    public function getId(){
        return $this->id;
    }

    /**
     * Get username
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set username
     * @param string $username
     * @return User
     */
    public function setUsername($username): User {
        $this->username = $username;
        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     * @return User
     */
    public function setName($name): User {
        $this->name = $name;
        return $this;
    }

    /**
     * Get firstname
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set firstname
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname): User {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     * @return User
     */
    public function setEmail($email): User {
        $this->email = $email;
        return $this;
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * Set password
     * @param string $password
     * @return User
     */
    public function setPassword($password): User {
        $this->password = $password;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRecipes() {
        return $this->recipes;
    }

    /**
     * Set role
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): User {
        if(!in_array('ROLE_USER', $roles)){
            $roles[] = 'ROLE_USER';
        }

        foreach ($roles as $role) {
            if(substr($role, 0, 5) !== 'ROLE_'){
                throw new \InvalidArgumentException("Chaque rôle doit commencer par 'ROLE_'");
            }
        }

        $this->roles = $roles;
        return $this;
    }

    /**
     * Get roles
     * @return array
     */
    public function getRoles(){
        return $this->roles ;
    }


    public function getSalt() {

    }


    public function eraseCredentials() {
    }

    public function serialize() {
        return serialize([$this->id, $this->username, $this->password]);
    }

    public function unserialize($serialized) {
        list($this->id, $this->username, $this->password)= unserialize($serialized);
    }
}
