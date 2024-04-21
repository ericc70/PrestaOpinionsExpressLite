<?php

namespace Ericc70\Expressopinionlite\Domain\Query;

class ResponseLinkedToQuestionQuery 
{
    protected $questionId;
    protected $reponseId;

    
    public function __construct(int $questionId, int $reponseId)
    {
        $this->questionId = $questionId;
        $this->reponseId = $reponseId;
    }

    public function getQuestionId() :int{
        return $this->questionId;
    }

    public function getReponseId() :int{
        return $this->reponseId;
    }
}