<?php

namespace App\Repository;

use App\Entity\Nationalities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nationalities>
 *
 * @method Nationalities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nationalities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nationalities[]    findAll()
 * @method Nationalities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationalitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nationalities::class);
    }

    public function add(Villes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Villes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * @return Nationalities[] Returns an array of Communes objects
     */
    public function findAllNames(): array
    {
        $result =  $this->createQueryBuilder('v')
            ->select('v.name')
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getArrayResult();

        $d = array_column($result, "name");
        return array_combine($d, $d);
    }

//    /**
//     * @return Villes[] Returns an array of Villes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Villes
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
