<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\QueryHandler;

use Ericc70\Expressopinionlite\Domain\Exeption\AnswerNotFoundException;
use Ericc70\Expressopinionlite\Domain\Exeption\AnswerNotLinkedToQuestionException;
use Ericc70\Expressopinionlite\Domain\Exeption\QuestionNotFoundException;
use Ericc70\Expressopinionlite\Domain\Query\ResponseLinkedToQuestionQuery;
use Ericc70\Expressopinionlite\Repository\QuestionRepository;
use Ericc70\Expressopinionlite\Repository\ResponseRepository;

class ResponseLinkedToQuestionQueryHandler
{

    private $questionRepository;
    private $reponseRepository;

    public function __construct(QuestionRepository $questionRepository, ResponseRepository  $reponseRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->reponseRepository = $reponseRepository;
    }

    public function handle(ResponseLinkedToQuestionQuery $query)
    {
       
        $idQuestion = $query->getQuestionId();
        $idReponse = $query->getReponseId();
        // Check if the question exists
        $question = $this->questionRepository->findById($idQuestion);
        if ($question === null) {
            throw new QuestionNotFoundException("Question with ID {$idQuestion} not found.");
        }
        // Check if the answer exists
        $answer = $this->reponseRepository->findById($idReponse);
        if ($answer === null) {
            throw new AnswerNotFoundException("Answer with ID {$idReponse} not found.");
        }

        // Check if the answer exists and is linked to the question
        $answer = $this->reponseRepository->findOneBy(['id' => $idReponse, 'questionId' => $idQuestion]);
        if ($answer === null) {
            throw new AnswerNotLinkedToQuestionException("Answer with ID {$idReponse} is not linked to question with ID {$idQuestion}.");
        }

        return true;
    }
}
