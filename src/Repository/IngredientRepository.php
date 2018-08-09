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

    public function deleteIngredient($ingredientId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->delete('App:Ingredient', 'i')
            ->where('i.id = :ingredientId')
            ->setParameter('ingredientId', $ingredientId);


        return $qb->getQuery()->getResult();
    }
}
