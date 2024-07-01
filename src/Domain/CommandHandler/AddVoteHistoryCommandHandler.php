<?php

namespace Ericc70\Expressopinionlite\Domain\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;

use Ericc70\Expressopinionlite\Domain\Command\AddVoteHistoryCommand;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsliteVoteHistory as EntityEcExpressopinionsVoteHistory;
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

    public function handle(AddVoteHistoryCommand $command)
    {
        try {

            $entity = new EntityEcExpressopinionsVoteHistory;
         
            //verification de user [to-do] celui de get identique a user current


            $entity->setUserId($command->getUserId());
            // $entity->setQuestionId($command->getQuestionId());
            $entity->setCreatedAt( \DateTime::createFromFormat('Y-m-d', date('Y-m-d')) );
            
            
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

        } catch (\Throwable $th) {
            
            throw $th;
        }

    }

}