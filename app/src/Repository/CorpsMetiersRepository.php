<?php

namespace App\Repository;

use App\Entity\CorpsMetiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CorpsMetiers>
 *
 * @method CorpsMetiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method CorpsMetiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method CorpsMetiers[]    findAll()
 * @method CorpsMetiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorpsMetiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CorpsMetiers::class);
    }

    public function add(CorpsMetiers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CorpsMetiers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CorpsMetiers[] Returns an array of CorpsMetiers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CorpsMetiers
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
