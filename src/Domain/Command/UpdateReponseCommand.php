<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\Command;


class UpdateReponseCommand {
  /**
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $content;

    private $questionId;

    public function __construct(int $id, string $content, int $questionId)
    {
        $this->id = $id;
        $this->content = $content;
        $this->questionId = $questionId;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Get the value of questionId
     */ 
    public function getQuestionId()
    {
        return $this->questionId;
    }


}