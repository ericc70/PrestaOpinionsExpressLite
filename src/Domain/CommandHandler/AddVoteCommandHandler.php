<?php

namespace Ericc70\Expressopinionlite\Domain\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;

use Ericc70\Expressopinionlite\Domain\Command\AddVoteCommand;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsVote as EntityEcExpressopinionsVote;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsVoteHistory;
use Ericc70\Expressopinionlite\Repository\VoteRepository;

class AddVoteCommandHandler 
{

    private $entityManager;
    public $repository;

    public function __construct(EntityManagerInterface $entityManager, VoteRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function handle(EcExpressopinionsVoteHistory $entity, AddVoteCommand $command)
    {
        try {
            $currentDateTime = new \DateTime();

            $entity->setQuestionId($command->getQuestionId());
            $entity->setResponseId($command->getResponseId());
            $entity->setCreatedAt($currentDateTime);
            
            
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

        } catch (\Throwable $th) {
            
            throw $th;
        }

    }

}