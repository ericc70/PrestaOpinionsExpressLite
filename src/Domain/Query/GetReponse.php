<?php

namespace Ericc70\Expressopinionlite\Domain\Query;


class GetReponse
{

    private $questionId;

    public function __construct(int $questionId)
    {
        $this->questionId = $questionId;
    }

    public function getQuestionId() :int{
        return $this->questionId;
    }
}