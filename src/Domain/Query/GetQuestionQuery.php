<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\Query;

class GetQuestionQuery
{

    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId() :int{
        return $this->id;
    }
}