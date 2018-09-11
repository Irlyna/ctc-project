<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="Recipe_Category")
 */
class RecipeCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="recipeCategories")
     */
    private $recipes;

    //*****************************
    //      CONSTRUCTEUR
    //*****************************

    public function __construct() {
        $this->recipes = new ArrayCollection();
    }

    public function removeRecipe(Recipe $recipe){
        $this->recipes->removeElement($recipe);
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
     * @return RecipeCategory
     */
    public function setName($name): RecipeCategory {
        $this->name = $name;
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
