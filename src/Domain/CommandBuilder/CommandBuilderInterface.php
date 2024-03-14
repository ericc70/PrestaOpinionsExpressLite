<?php

namespace Ericc70\Expressopinionlite\Domain\CommandBuilder;


interface CommandBuilderInterface
{
    public function buildEditCommand($id, array $data);
}
