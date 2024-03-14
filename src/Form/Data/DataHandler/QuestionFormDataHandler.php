<?php
namespace Ericc70\Expressopinionlite\Form\Data\DataHandler;

use Ericc70\Expressopinionlite\Domain\CommandBuilder\CommandBuilderInterface;
use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler\FormDataHandlerInterface;


class QuestionFormDataHandler implements FormDataHandlerInterface
{
    private $commandBus;
    private $builder;

    public function __construct(CommandBusInterface $commandBus, CommandBuilderInterface $builder)
    {
        $this->commandBus = $commandBus;
        $this->builder = $builder;
    }

    public function update($id, array $data)
    {
       
        // Construire la commande de mise à jour
        $command = $this->builder->buildEditCommand(1, $data);

        $obj = $this->commandBus->handle($command);
        return $obj;
    }

    public function create(array $data)
    {   
    return $data;
    }
}
