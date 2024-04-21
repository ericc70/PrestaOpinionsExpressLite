<?php

namespace Ericc70\Expressopinionlite\Domain\Query;


class GetStatutLastVote
{

    private $questionId;
    private $userId;

    public function __construct(int $questionId, $userId)
    {
        $this->questionId = $questionId;
        $this->userId = $userId;
    }

    public function getQuestionId() :int{
        return $this->questionId;
    }

    public function getUserId() :int
    {
        return $this->userId;
    }
}