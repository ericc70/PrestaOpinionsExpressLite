<?php

declare(strict_types=1);
namespace Ericc70\Expressopinionlite\Repository;

use Doctrine\ORM\EntityRepository;

class ResponseRepository extends EntityRepository
{

    public function findByQuestionIdLimitedOrdered($questionId = 1)
    {
        
        return $this->createQueryBuilder('e')
            ->andWhere('e.questionId = :questionId')
            ->setParameter('questionId', $questionId)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
}