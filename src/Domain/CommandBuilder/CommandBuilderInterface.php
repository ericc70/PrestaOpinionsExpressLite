<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\CommandBuilder;


interface CommandBuilderInterface
{
    public function buildEditCommand($id, array $data);
    


}
