<?php

namespace Ericc70\Expressopinionlite\Domain\Command;

class AddVoteCommand
{
    private $id;
    private int $questionId;
    private int $responseId;
    private \Datetime $createdAt;


    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of questionId
     */ 
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set the value of questionId
     *
     * @return  self
     */ 
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get the value of responseId
     */ 
    public function getResponseId()
    {
        return $this->responseId;
    }

    /**
     * Set the value of responseId
     *
     * @return  self
     */ 
    public function setResponseId($responseId)
    {
        $this->responseId = $responseId;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}