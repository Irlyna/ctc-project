<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findByUser($userId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('r')
            ->from('App:Recipe', 'r')
            ->where('r.user = :user_id')->setParameter('user_id', $userId);

        return $qb->getQuery()->getResult();

    }

    public function deleteRecipe($recipeId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->delete('App:Recipe', 'r')
            ->where('r.id = :recipeId')
            ->setParameter('recipeId', $recipeId);

        return $qb->getQuery()->getResult();
    }

    public function getRecipeByLetter($letter){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('r')
            ->from('App:Recipe', 'r')
            ->where('r.name LIKE :letter')
            ->setParameter('letter', $letter.'%');

        return $qb->getQuery()->getResult();
    }
}
