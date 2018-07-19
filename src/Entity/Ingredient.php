<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 * @ORM\Table(name="Ingredient")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\IngredientCategory", inversedBy="ingredients")
     * @ORM\JoinTable(name="ingredients_categories")
     */
    private $ingredientCategories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="ingredients")
     */
    private $recipes;

    //*****************************
    //      Constructeur
    //*****************************

    public function __construct() {
        $this->ingredientCategories = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    //*****************************
    //      GETTER - SETTER
    //*****************************

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIngredientCategories() {
        return $this->ingredientCategories;
    }

    /**
     * @param mixed $ingredientCategories
     */
    public function setIngredientCategories($ingredientCategories): void {
        $this->ingredientCategories = $ingredientCategories;
    }

    /**
     * Get recipes
     * @return Collection
     */
    public function getRecipes() {
        return $this->recipes;
    }


}
