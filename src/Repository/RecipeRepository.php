<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects filtered by direction and category (all categ if 'all' is passed as category)
     */
    public function findByDirectionAndCategory($direction, $category): array
    {
        $qb = $this->createQueryBuilder('r');

        if ($category !== 'all') {
            $qb->andWhere('r.categ= :category')
                ->setParameter('category', $category);
        }

        $qb->orderBy('r.estimated_time', $direction === 'desc' ? 'DESC' : 'ASC');

        return $qb->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?Recipe
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
