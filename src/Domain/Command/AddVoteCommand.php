<?php

namespace Ericc70\Expressopinionlite\Domain\Command;

class AddVoteCommand
{
   
    private int $questionId;
    private int $responseId;
    
    public function __construct(array $data)
    {
       
        $this->questionId = $data['questionId'];
        $this->responseId = $data['responseId'];
     
    }

  
    /**
     * Get the value of questionId
     */ 
    public function getQuestionId()
    {
        return $this->questionId;
    }


    /**
     * Get the value of responseId
     */ 
    public function getResponseId()
    {
        return $this->responseId;
    }


}