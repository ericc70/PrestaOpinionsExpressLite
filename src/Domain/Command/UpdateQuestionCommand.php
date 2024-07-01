<?php
declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\Command;

// src/Command/UpdateQuestionCommand.php


use Symfony\Component\Validator\Constraints as Assert;

class UpdateQuestionCommand
{
    /**
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $content;

    public function __construct(int $id, string $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
