<?php

namespace Ericc70\Expressopinionlite\Domain\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Expressopinionlite\Domain\Command\UpdateReponseCommand;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsResponse;
use Ericc70\Expressopinionlite\Repository\ResponseRepository;

class UpdateReponseCommandHandler {

    private $entityManager;
    public $repository;

    public function __construct(EntityManagerInterface $entityManager, ResponseRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function handle(UpdateReponseCommand $command)
    {
        $reponse = $this->entityManager->getRepository(EcExpressopinionsResponse::class)->find($command->getId());

        if (!$reponse) {
            throw new \Exception('No reponse found for id '.$command->getId());
        }

        $reponse->setContent($command->getContent());
       // $reponse->setQuestionId($command->getQuestionId());

        $this->entityManager->flush();
    }
}