<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Repository;

use Doctrine\ORM\EntityRepository;

class VoteHistoryRepository extends EntityRepository
{

    public function getLastVote($userId, $questionId)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.questionId = :questionId')
            ->setParameter('questionId', $questionId)
            ->andWhere('e.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // public function isDateOlderThanForConsumer(
    //     int $userId, 
    //     // int $questionId, 
    //     \DateTimeInterface $dateToCompare): bool
    // {
    //    return $this->createQueryBuilder('h')

    //     ->select('DATEDIFF(:dateToCompare, h.createdAt)')
    //        ->andWhere('h.userId = :userId')
    //     //    ->andWhere('h.questionId = :questionId')
    //        ->setParameter('userId', $userId)
    //     //    ->setParameter('questionId', $questionId)
    //        ->setParameter('dateToCompare', $dateToCompare)
    //        ->orderBy('h.createdAt', 'DESC')
    //        ->setMaxResults(1)
    //        ->getQuery()
    //        ->getSingleScalarResult() > 7;
      

    
    // }

    public function isDateOlderThanForConsumer(int $userId, \DateTimeInterface $dateToCompare): bool
    {
        $entityManager = $this->getEntityManager();
    
        $latestVote = $this->createQueryBuilder('h')
            ->select('h.createdAt')
            ->andWhere('h.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('h.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    
        if (!$latestVote) {
            return true; // No previous vote found, so it's not older than the given date
        }
    
        $diff = $latestVote['createdAt']->diff($dateToCompare);
    
        // Return true if the difference is more than 7 days
     
        return $diff->days > 7;
    }
    
}
