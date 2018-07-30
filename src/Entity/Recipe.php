<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 * @ORM\Table(name="Recipe")
 */
class Recipe{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="recipes")
     * @ORM\JoinTable(name="recipes_ingredients")
     */
    private $ingredients = [];

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RecipeCategory", inversedBy="recipes")
     * @ORM\JoinTable(name="recipes_categories")
     */
    private $recipeCategories;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recipes")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    //*****************************
    //      CONSTRUCTEUR
    //*****************************

    public function __construct() {
        $this->ingredients = new ArrayCollection();
        $this->recipeCategories = new ArrayCollection();

        if($this->id === null){
            $this->setDate(new \DateTime('now'));
        }
    }

    //*****************************
    //      METHODS
    //*****************************

    /**
     * Add ingredients
     * @param Ingredient $ingredients
     * @return Recipe
     */
    public function addIngredients(Ingredient $ingredients): Recipe {
        $this->ingredients[] = $ingredients;
        return $this;
    }

    /**
     * Remove ingredient
     * @param Ingredient $ingredient
     */
    public function removeIngredients(Ingredient $ingredient){
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Add recipeCategories
     * @param RecipeCategory $recipeCategories
     * @return Recipe
     */
    public function addRecipeCategory(RecipeCategory $recipeCategories): Recipe {
        $this->recipeCategories [] = $recipeCategories;
        return $this;
    }

    /**
     * Remove recipeCategory
     * @param RecipeCategory $recipeCategory
     */
    public function removeRecipeCategory(RecipeCategory $recipeCategory){
        $this->recipeCategories->removeElement($recipeCategory);
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
     * @return Recipe
     */
    public function setName($name): Recipe {
        $this->name = $name;
        return $this;
    }

    /**
     * Get ingredients
     * @return Collection
     */
    public function getIngredients() {
        return $this->ingredients;
    }

    /**
     * Get content
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set content
     * @param string $content
     * @return Recipe
     */
    public function setContent($content): Recipe {
        $this->content = $content;
        return $this;
    }

    /**
     * Get recipeCategories
     * @return Collection
     */
    public function getRecipeCategories() {
        return $this->recipeCategories;
    }


    /**
     * Get user
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set user
     * @param mixed $user
     */
    public function setUser($user): void {
        $this->user = $user;
    }

    /**
     * Get date
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set date
     * @param \DateTime $date
     * @return Recipe
     */
    public function setDate($date): Recipe {
        $this->date = $date;
        return $this;
    }




}
