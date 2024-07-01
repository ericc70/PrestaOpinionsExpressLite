<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\Command;

class AddVoteCommand
{

    protected int $questionId;
    protected int $responseId;

    public function __construct(int $questionId, int $responseId)
    {

        $this->questionId = $questionId;
        $this->responseId = $responseId;
    }

    /**
     * Get the value of questionId
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     * Get the value of responseId
     */
    public function getResponseId(): int
    {
        return $this->responseId;
    }
}
