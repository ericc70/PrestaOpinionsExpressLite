<?php

namespace Ericc70\Expressopinionlite\Domain\CommandHandler;


use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Expressopinionlite\Domain\Command\UpdateQuestionCommand;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsQuestion;
use Ericc70\Expressopinionlite\Repository\QuestionRepository;

class UpdateQuestionCommandHandler
{
    private $entityManager;
    public $repository;

    public function __construct(EntityManagerInterface $entityManager, QuestionRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function handle(UpdateQuestionCommand $command)
    {
        $question = $this->entityManager->getRepository(EcExpressopinionsQuestion::class)->find($command->getId());

        if (!$question) {
            throw new \Exception('No question found for id '.$command->getId());
        }

        $question->setContent($command->getContent());

        $this->entityManager->flush();
    }
}
