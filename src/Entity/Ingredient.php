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
     * @ORM\ManyToMany(targetEntity="App\Entity\IngredientCategory", inversedBy="ingredients", cascade={"persist"})
     * @ORM\JoinTable(name="ingredients_categories")
     */
    private $ingredientCategories = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="ingredients", cascade={"persist"})
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
     * Get name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     * @return Ingredient
     */
    public function setName($name): Ingredient {
        $this->name = $name;
        return $this;
    }

    /**
     * Get ingredientCategories
     * @return Collection
     */
    public function getIngredientCategories() {
        return $this->ingredientCategories;
    }

    /**
     * Set ingredientCategories
     * @param IngredientCategory $ingredientCategories
     * @return Ingredient
     */
    public function setIngredientCategories(IngredientCategory $ingredientCategories): Ingredient {
        $this->ingredientCategories[] = $ingredientCategories;
        return $this;
    }

    /**
     * Get recipes
     * @return Collection
     */
    public function getRecipes() {
        return $this->recipes;
    }


}
