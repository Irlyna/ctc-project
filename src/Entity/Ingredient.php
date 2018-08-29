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

//    /**
//     * @ORM\Column(type="decimal", scale=2)
//     * @ORM\JoinColumn()
//     */
//    private $volume;
//
//    /**
//     * @ORM\Column(type="string", length=10)
//     */
//    private $measuringValue = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\IngredientCategory", inversedBy="ingredients")
     * @ORM\JoinTable(name="ingredients_categories")
     */
    private $ingredientCategories = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="ingredients", cascade={"persist"})
     */
    private $recipes;

    //*****************************
    //      CONSTRUCTOR
    //*****************************

    public function __construct() {
        $this->ingredientCategories = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    //*****************************
    //      METHODS
    //*****************************
    /**
     * Set ingredientCategories
     * @param IngredientCategory $ingredientCategories
     * @return Ingredient
     */
    public function addIngredientCategories(IngredientCategory $ingredientCategories): Ingredient {
        $this->ingredientCategories[] = $ingredientCategories;
        return $this;
    }

    /**
     * Remove recipeCategory
     * @param IngredientCategory $ingredientCategory
     */
    public function removeIngredientCategory(IngredientCategory $ingredientCategory){
        $this->ingredientCategories->removeElement($ingredientCategory);
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
     * Get volume
     * @return double
     */
   /* public function getVolume() {
        return $this->volume;
    }*/

    /**Set quantity
     * @param double $volume
     * @return Ingredient
     */
   /* public function setVolume($volume): Ingredient {
        $this->volume = $volume;
        return $this;
    }*/

    /**
     * Get measuringValue
     * @return array
     */
    /*public function getMeasuringValue() {
        return $this->measuringValue;
    }*/

    /**
     * Set measuringValue
     * @param array $measuringValue
     * @return Ingredient
     */
    /*public function setMeasuringValue($measuringValue): Ingredient {
        $this->measuringValue = array_unique($measuringValue);
        return $this;
    }*/

    /**
     * Get ingredientCategories
     * @return Collection
     */
    public function getIngredientCategories() {
        return $this->ingredientCategories;
    }

    /**
     * Get recipes
     * @return Collection
     */
    public function getRecipes() {
        return $this->recipes;
    }


}
