<?php

namespace App\Repository;

use App\Entity\IngredientCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IngredientCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientCategory[]    findAll()
 * @method IngredientCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IngredientCategory::class);
    }

    public function deleteIngredientCategory($ingredientCategoryId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->delete('App:IngredientCategory', 'ic')
            ->where('ic.id = :ingredientCategoryId')
            ->setParameter('ingredientCategoryId', $ingredientCategoryId);

        return $qb->getQuery()->getResult();
    }
}
