<?php

namespace App\Repository;

use App\Entity\EntrepriseActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EntrepriseActivite>
 *
 * @method EntrepriseActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrepriseActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrepriseActivite[]    findAll()
 * @method EntrepriseActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntrepriseActivite::class);
    }

    public function add(EntrepriseActivite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EntrepriseActivite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getLastRowId(): ?int
    {
        return $this->createQueryBuilder('ea')
            ->select('MAX(m.id)')
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_SINGLE_SCALAR);
    }


//    /**
//     * @return EntrepriseActivite[] Returns an array of EntrepriseActivite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EntrepriseActivite
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
