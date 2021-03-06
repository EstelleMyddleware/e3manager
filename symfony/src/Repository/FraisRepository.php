<?php

namespace App\Repository;

use App\Entity\Frais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Frais|null find($id, $lockMode = null, $lockVersion = null)
 * @method Frais|null findOneBy(array $criteria, array $orderBy = null)
 * @method Frais[]    findAll()
 * @method Frais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Frais::class);
    }

    /**
     * @return int|mixed|string
     */

    public function countFrais()
    {
        $queryBuilder = $this->createQueryBuilder('frais');
        $queryBuilder->select('COUNT(frais.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }



    /**
     * @return Frais[] Returns an array of Frais objects
     */
    public function findByTypeFrais($value)
    {
        return $this->createQueryBuilder('frais')
                ->andWhere('frais.idTypeFrais = :val')
                ->setParameter('val', $value)
                ->orderBy('frais.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
    }





    // /**
    //  * @return Frais[] Returns an array of Frais objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Frais
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
