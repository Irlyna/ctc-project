<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientCategoryRepository")
 * @ORM\Table(name="Ingredient_Category")
 */
class IngredientCategory{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", mappedBy="ingredientCategories")
     */
    private $ingredients = [];

    //*****************************
    //      CONSTRUCTEUR
    //*****************************

    public function __construct() {
        $this->ingredients = new ArrayCollection();
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
     * @return IngredientCategory
     */
    public function setName($name): IngredientCategory {
        $this->name = $name;
        return $this;
    }

    /**
     * Set ingredient
     * @param Ingredient $ingredients
     * @return IngredientCategory
     */
    public function setIngredients(Ingredient $ingredients): IngredientCategory {
        $this->ingredients[] = $ingredients;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getIngredients() {
        return $this->ingredients;
    }


}
