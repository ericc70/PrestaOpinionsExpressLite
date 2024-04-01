<?php

namespace Ericc70\Expressopinionlite\Domain\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use EcExpressopinionsVoteHistory;
use Ericc70\Expressopinionlite\Domain\Command\AddVotetHistoryeCommand;
use Ericc70\Expressopinionlite\Repository\VoteHistoryRepository;


class AddVoteHistoryCommandHandler 
{

    private $entityManager;
    public $repository;

    public function __construct(EntityManagerInterface $entityManager, VoteHistoryRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function handle(EcExpressopinionsVoteHistory $entity, AddVotetHistoryeCommand $command)
    {
        try {
            $currentDateTime = new \DateTime();

            $entity->setUserId($command->getUserId());
            $entity->setQuestionId($command->getQuestionId());
            $entity->setCreatedAt($currentDateTime);
            
            
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

        } catch (\Throwable $th) {
            
            throw $th;
        }

    }

}