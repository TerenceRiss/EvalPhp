<?php

namespace App\Repository;

use App\Entity\Shoes;
use Doctrine\ORM\Query;
use App\Form\SearchType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Shoes>
 *
 * @method Shoes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shoes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shoes[]    findAll()
 * @method Shoes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shoes::class);
    }

    public function save(Shoes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Shoes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Shoes[] Returns an array of Shoes objects
    */
   public function search(array $search)
   {
      $query= $this->createQueryBuilder('r');

      if (!empty($search['size'])){
        $query 
            // ->join('r.sizes', 's')
            ->andWhere('r.size = :size')
            ->setParameter('size', $search['size'])
        ;
      }

      if(!empty($search['price'])){
        $prices = json_decode($search['price'], true);
        $query
            ->andWhere('r.price >= :min')
            ->setParameter('min', $prices['min'])
            ->andWhere('r.price <= :max')
            ->setParameter('max', $prices['max'])
        ;
      }


      if(!empty($search['search'])) {

        $query
            ->andWhere('r.name like :query')
            ->setParameter('query', '%'.$search['search'].'%')
        ;
    }

    if(!empty($search['gender'])){
        $query
        ->andWhere('r.gender like :gender' )
        ->setParameter('gender', '%'.$search['gender'].'%')
        ;
    }

    

    if(!empty($search['type'])){
        $query
        ->andWhere('r.type LIKE :type')
        ->setParameter('type', '%'.$search['type'].'%')
        ;
    }
        //    ->andWhere('s.exampleField = :val')
        //    ->setParameter('val', $value)
        //    ->orderBy('s.id', 'ASC')
        //    ->setMaxResults(10)
        //    ->getQuery()
        //    ->getResult()
    if(!empty($search['date'])){
        $array = explode(' ', $search['date']);
        $query
        ->orderBy($array[0], $array[1]);

    }
        return $query->getQuery()->getResult();
}

//    public function findOneBySomeField($value): ?Shoes
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
