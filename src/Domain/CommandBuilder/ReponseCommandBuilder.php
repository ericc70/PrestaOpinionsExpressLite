<?php

namespace Ericc70\Expressopinionlite\Domain\CommandBuilder;

use Ericc70\Expressopinionlite\Domain\Command\UpdateReponseCommand;

class ReponseCommandBuilder implements CommandBuilderInterface
{

    public function buildEditCommand($id, array $data)
    {
        $id = 1;
        // Construire la commande de mise à jour en utilisant les données fournies
        return new UpdateReponseCommand ($id, $data['content'], $data['idQuestion']); 
    }
    
}