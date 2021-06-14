<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*  select* 
        from event
        where type = "adulte"
        order by date_evenement ASC*/
    public function recuEventByType($type) : ?Array // si je ne sais pas ce quil retourne: enlever ":..."  et ? permet un retour nul
    {
        
      //  $type = $event->getdate_evenement();
        
        return $this->createQueryBuilder('e') //=from event
        //
            ->andWhere('e.type = :type') //  where type = "adulte"
            ->setParameter('type', $type)
            ->orderBy('e.DateEvenement', 'ASC') //  order by date_evenement ASC*/
            ->getQuery()
            ->getResult()
        ;
    }
    
}
