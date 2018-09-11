<?php

namespace App\Repository;

use App\Entity\RecipeCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RecipeCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeCategory[]    findAll()
 * @method RecipeCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RecipeCategory::class);
    }

    /*
     * UPDATE recipe_category
     * SET recipe_category.name = 'nouvelle valeur'
     * WHERE recipe_category.id = 1
     */
    public function editRecipeCategory($recipeCategoryId, $recipeCategoryUpdate){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->update('App:RecipeCategory', 'rc')
            ->set('rc.name', $qb->expr()->literal($recipeCategoryUpdate))
            ->where('rc.id = :recipeCategoryId')
            ->setParameter('recipeCategoryId', $recipeCategoryId);

        return $qb->getQuery()->getResult();
    }

    public function deleteRecipeCategory($recipeCategoryId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->delete('App:RecipeCategory', 'rc')
            ->where('rc.id = :recipeCategoryId')
            ->setParameter('recipeCategoryId', $recipeCategoryId);

        return $qb->getQuery()->getResult();
    }

    /*
     * DELETE FROM recipe_category
     * WHERE recipe_categorie.id = 1
     */
    public function getCategoriesByLetter($letter){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('rc')
            ->from('App:RecipeCategory', 'rc')
            ->where('rc.name LIKE :letter')
            ->setParameter('letter', $letter.'%');

        return $qb->getQuery()->getResult();
    }
}
