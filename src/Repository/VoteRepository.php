<?php

namespace Ericc70\Expressopinionlite\Repository;


use Doctrine\ORM\EntityRepository;
use DateTimeInterface;

class VoteRepository extends EntityRepository
{


    public function searchByDay($date)
    {

        $qb = $this->createQueryBuilder('v');
        $qb->select('r.id AS responseId', 'r.content AS responseContent', 'COUNT(v.id) AS voteCount')
            ->leftJoin('v.responseId', 'r')
            ->where($qb->expr()->eq('v.createdAt', ':specificDate'))
            ->setParameter('specificDate', $date)
            ->groupBy('r.id');

        $query = $qb->getQuery();
        $results = $query->getResult();
        $formattedResults = [
            'data' => $results,
            'extra' => [
                'date'=> $date
        ]
            ];
            
        return $formattedResults;
    }

    public function searchByMonth($date)
    {
        // Extraction de l'année et du mois
        list($year, $month) = explode('-', $date);
        $qb = $this->createQueryBuilder('v');
        $qb->select('r.id AS responseId', 'r.content AS responseContent', 'COUNT(v.id) AS voteCount')
            ->leftJoin('v.responseId', 'r')
            ->where('SUBSTRING(v.createdAt, 1, 7) = :date')
            ->setParameter('date', $date)
            ->groupBy('r.id');
        $query = $qb->getQuery();
        $results = $query->getResult();

        $formattedResults = [
            'data' => $results,
            'extra' => [
                'date'=> $date
        ]
            ];

        return $formattedResults;
    }

    public function searchByYear($date)
    {
        $qb = $this->createQueryBuilder('v');
        $qb->select('r.id AS responseId', 'r.content AS responseContent', 'COUNT(v.id) AS voteCount')
            ->leftJoin('v.responseId', 'r')
            ->where($qb->expr()->like('v.createdAt', ':yearPattern'))
            ->setParameter('yearPattern', $date . '-%')
            ->groupBy('r.id');
        $query = $qb->getQuery();
        $results = $query->getResult();
        $formattedResults = [
            'data' => $results,
            'extra' => [
                'date'=> $date
        ]
            ];
  
        return $formattedResults;
    }
    public function searchByDateRange($startDate,  $endDate)
    {
        $qb = $this->createQueryBuilder('v');
        $qb->select('r.id AS responseId', 'r.content AS responseContent', 'COUNT(v.id) AS voteCount')
            ->leftJoin('v.responseId', 'r')
            ->where($qb->expr()->between('v.createdAt', ':startDate', ':endDate'))
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->groupBy('r.id');

        $query = $qb->getQuery();
        $results = $query->getResult();
        $formattedResults = [
            'data' => $results,
            'extra' => [
              'date'=> [$startDate, $endDate]
        ]
            ];
            
        return $formattedResults;
    }
}
