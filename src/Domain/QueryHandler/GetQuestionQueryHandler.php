<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\QueryHandler;

use Ericc70\Expressopinionlite\Domain\Query\GetQuestionQuery;
use Ericc70\Expressopinionlite\Repository\QuestionRepository;

class GetQuestionQueryHandler
{

    private $repository;

    public function __construct(QuestionRepository $repository)
    {

        $this->repository = $repository;
    }

    public function handle(GetQuestionQuery $query)
    {
        try {
            $questionId = $query->getId();
            $responses = $this->repository->findById($questionId);
            return $responses;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
