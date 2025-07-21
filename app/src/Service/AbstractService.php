<?php

namespace App\Service;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractService
{
    public function __construct(private ServiceEntityRepository $repository){}

    /**
     * @param int|null $id
     */
    public function find(?int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param array $criteria
     */
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     * @return array|null
     */
    public function findBy(array $criteria): ?array
    {
        return $this->repository->findBy($criteria);
    }

    /**
     * @return void
     */
    public function persist($entity)
    {
        if(!$entity)  return;
        $this->repository->add($entity, true);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param $entity
     * @return void
     */
    public function delete($entity): void
    {
        $this->repository->remove($entity, true);
    }


}