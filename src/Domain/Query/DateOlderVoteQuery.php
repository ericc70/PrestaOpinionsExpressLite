<?php

namespace Ericc70\Expressopinionlite\Domain\Query;

class DateOlderVoteQuery
{
    // protected $questionId;
    protected $userId;
    protected $dateactu;

    
    public function __construct(
        // int $questionId,
     int $userId, 
     \Datetime $dateactu)
    {
        // $this->questionId = $questionId;
        $this->userId = $userId;
        $this->dateactu = $dateactu;
    }

    // public function getQuestionId() :int{
    //     return $this->questionId;
    // }

    public function getUserId() :int{
        return $this->userId;
    }
    public function getDateActu() {
        return $this->dateactu;
    }


}