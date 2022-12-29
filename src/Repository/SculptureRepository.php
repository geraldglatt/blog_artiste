<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Sculpture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Sculpture>
 *
 * @method Sculpture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sculpture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sculpture[]    findAll()
 * @method Sculpture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SculptureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sculpture::class);
    }

    public function save(Sculpture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sculpture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Sculpture[]
     */
    public function lastThreeSculpture() 
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.id', 'DESC')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Sculpture[] Return an array of Sculpture objects
     */
    public function findAllPortfolio(Category $categorie): array 
    {
        return $this->createQueryBuilder('s')
            ->where(':categorie MEMBER OF s.categorie')
            ->andWhere('s.portfolio = TRUE')
            ->setParameter('categorie', $categorie)
            ->getQuery()
            ->getResult()
        ;
    }
}
