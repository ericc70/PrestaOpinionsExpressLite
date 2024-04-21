<?php

namespace Ericc70\Expressopinionlite\Domain\Command;

class AddVoteHistoryCommand
{
    
    // private int $questionId;
    private int $userId;
    
    public function __construct(array $data)
    {
       
        // $this->questionId = $data['questionId'];
        $this->userId = $data['userId'];
     
    }

  
    /**
     * Get the value of questionId
     */ 
    // public function getQuestionId()
    // {
    //     return $this->questionId;
    // }


    /**
     * Get the value of responseId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }


}