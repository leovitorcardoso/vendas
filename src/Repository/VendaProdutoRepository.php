<?php

namespace App\Repository;

use App\Entity\VendaProduto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VendaProduto|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendaProduto|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendaProduto[]    findAll()
 * @method VendaProduto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendaProdutoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VendaProduto::class);
    }

    // /**
    //  * @return VendaProduto[] Returns an array of VendaProduto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VendaProduto
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
