<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Peinture;
use App\Entity\Sculpture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function save(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findImgPeinturePortfolio(Peinture $peintures): array 
    {
        return $this->createQueryBuilder('p')
            ->where(':peintures MEMBER OF p.peintures')
            ->andWhere('p.portfolio = TRUE')
            ->setParameter('peintures', $peintures)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findImgSculpturePortfolio(Sculpture $sculptures): array 
    {
        return $this->createQueryBuilder('s')
            ->where(':sculptures MEMBER OF s.sculptures')
            ->andWhere('s.portfolio = TRUE')
            ->setParameter('sculptures', $sculptures)
            ->getQuery()
            ->getResult()
        ;
    }
}
