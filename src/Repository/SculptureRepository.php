<?php

namespace App\Repository;

use App\Entity\Sculpture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

//    /**
//     * @return Sculpture[] Returns an array of Sculpture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sculpture
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
