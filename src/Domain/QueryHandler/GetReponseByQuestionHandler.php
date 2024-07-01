<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\QueryHandler;

use Ericc70\Expressopinionlite\Domain\Query\GetReponse;
use Ericc70\Expressopinionlite\Repository\ResponseRepository;

class GetReponseByQuestionHandler 
{

    private $repository;

    public function __construct( ResponseRepository $repository)
    {
       
        $this->repository = $repository;
    }


    public function handle(GetReponse $query)
    {
        $questionId = $query->getQuestionId();

        // Example: Fetch responses from the repository
        $responses = $this->repository->findByQuestionIdLimitedOrdered($questionId);
        return $responses;
    }
}