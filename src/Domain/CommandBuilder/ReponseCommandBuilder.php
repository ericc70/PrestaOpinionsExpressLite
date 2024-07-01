<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\CommandBuilder;

use Ericc70\Expressopinionlite\Domain\Command\UpdateReponseCommand;

class ReponseCommandBuilder implements CommandBuilderInterface
{
    public function buildEditCommand($id, array $data)
    {
       // $id = 1;
        return new UpdateReponseCommand ($id, $data['content'], $data['questionId']); 
    }
    
}