<?php

declare(strict_types=1);

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
     * Get the value of responseId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }


}