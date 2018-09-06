<?php

namespace App\Repository;

use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ingredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingredient[]    findAll()
 * @method Ingredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }

    public function findAllByLetter($letter){
    }

    /* UPDATE ingredient
       SET name = $ingredientUpdate
       WHERE ingredient.id = $ingredientId
    */
    public function editIngredient($ingredientId, $ingredientUpdate){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->update('App:Ingredient', 'i')
            ->set('i.name', $qb->expr()->literal($ingredientUpdate))
            ->where('i.id = :ingredientId')
            ->setParameter('ingredientId', $ingredientId);

        return $qb->getQuery()->getResult();
    }

    /*DELETE FROM ingredient
      WHERE ingredient.id = $ingredientId */
    public function deleteIngredient($ingredientId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->delete('App:Ingredient', 'i')
            ->where('i.id = :ingredientId')
            ->setParameter('ingredientId', $ingredientId);

        return $qb->getQuery()->getResult();
    }

    /*
     * SELECT *
     * FROM `recipe_category`
     * WHERE recipe_category.name
     * LIKE 'C%'
     * */
    public function getIngredientsByLetter($letter){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('i')
            ->from('App:Ingredient', 'i')
            ->where('i.name LIKE :letter')
            ->setParameter('letter', $letter.'%');

        return $qb->getQuery()->getResult();
    }
}
