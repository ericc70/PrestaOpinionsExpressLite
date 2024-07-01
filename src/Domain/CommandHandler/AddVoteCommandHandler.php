<?php
namespace Ericc70\Expressopinionlite\Domain\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Ericc70\Expressopinionlite\Domain\Command\AddVoteCommand;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsliteQuestion;
use Ericc70\Expressopinionlite\Entity\EcExpressopinionsliteResponse;

use Ericc70\Expressopinionlite\Entity\EcExpressopinionsliteVote;
use Ericc70\Expressopinionlite\Repository\VoteRepository;
use Ericc70\Expressopinionlite\Repository\QuestionRepository;
use Ericc70\Expressopinionlite\Repository\ResponseRepository;

class AddVoteCommandHandler 
{
    private EntityManagerInterface $entityManager;
    private VoteRepository $voteRepository;

    public function __construct(
        EntityManagerInterface $entityManager, 
        VoteRepository $voteRepository
    ) {
        $this->entityManager = $entityManager;
        $this->voteRepository = $voteRepository;
    }

    public function handle(AddVoteCommand $command)
    {

     
        try {
            $entity = new EcExpressopinionsliteVote();
            $currentDateTime = new \DateTime();

            // Récupérer les objets EcExpressopinionsQuestion et EcExpressopinionsResponse 
            $questionRepository = $this->entityManager->getRepository(EcExpressopinionsliteQuestion::class);
            $question = $questionRepository->find($command->getQuestionId());

            $responseRepository = $this->entityManager->getRepository(EcExpressopinionsliteResponse::class);
            $response = $responseRepository->find($command->getResponseId());

            if (!$question || !$response) {
                throw new \Exception("Invalid question or response id."); 
            }

            $entity->setQuestionId($question);
            $entity->setResponseId($response);
            $entity->setCreatedAt($currentDateTime);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
