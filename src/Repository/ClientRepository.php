<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository

  {
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }
    public function findClientByTelephone(string $telephone): ?Client
{
    return $this->createQueryBuilder('c')
        ->andWhere('c.telephone = :telephone')
        ->setParameter('telephone', $telephone)
        ->getQuery()
        ->getOneOrNullResult();
}

 //   public function findBySearchCriteria(ClientSearch $search)
//{
  //  $qb = $this->createQueryBuilder('c');

    //if ($search->telephone) {
      //  $qb->andWhere('c.telephone LIKE :telephone')
        //   ->setParameter('telephone', '%' . $search->telephone . '%');
    //}

    //if ($search->surname) {
      //  $qb->andWhere('c.surname LIKE :surname')
        //   ->setParameter('surname', '%' . $search->surname . '%');
    //}

    //if ($search->compte !== null) {
      //  $qb->andWhere('c.compte = :compte')
        //   ->setParameter('compte', $search->compte);
    //}

    //return $qb->getQuery()->getResult();



//    /**
//     * @return Client[] Returns an array of Client objects
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

//    public function findOneBySomeField($value): ?Client
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
