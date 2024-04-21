<?php

use Ericc70\Expressopinionlite\Domain\Command\AddVoteCommand;
use Ericc70\Expressopinionlite\Domain\Command\AddVoteHistoryCommand;
use Ericc70\Expressopinionlite\Domain\Exeption\AnswerNotLinkedToQuestionException;
use Ericc70\Expressopinionlite\Domain\Query\DateOlderVoteQuery;
use Ericc70\Expressopinionlite\Domain\Query\ResponseLinkedToQuestionQuery;
use PhpParser\Node\Stmt\TryCatch;

class expressopinionlitevoteModuleFrontController extends ModuleFrontController
{

    public function initContent()
    {
        parent::initContent();

        $customerId = (int) $this->context->customer->id;

        $requestData = $this->getRequestData();

        if (!empty($requestData['errors'])) {
            return $this->jsonResponse(['message' => 'Erreur dans les données de la requête', 'errors' => $requestData['errors']], 400);
        }

        $validQuestion = $this->isValidQuestion($requestData['idQuestion'], $requestData['idReponse']);


        $this->isValidVoteConstumer();

        $this->insertVote($requestData['idQuestion'], $requestData['idReponse']);
        // $this->isValidVoteConstumer();
        $this->insertVoteHistory($customerId);


        // Retourner une réponse JSON
        $response = array(
            'message' => 'Erreur inconnue',
        );
        return $this->jsonResponse($response, 400);
    }

    private function getRequestData()
    {
        $errors = [];

        $csrfToken = Tools::getValue('token');
        $idQuestion = (int) Tools::getValue('idQuestion');
        $idReponse = (int) Tools::getValue('idReponse');
        $customerId = (int) $this->context->customer->id;

        if (!$csrfToken) {
            $errors['token'] = 'Token CSRF manquant';
        }

        if (!$idQuestion || $idQuestion <= 0) {
            $errors['idQuestion'] = 'ID de question invalide';
        }

        if (!$idReponse || $idReponse <= 0) {
            $errors['idReponse'] = 'ID de réponse invalide';
        }

        if (!$customerId) {
            $errors['customerId'] = 'Pas d\'utilisateur connecté';
        }

        if (!empty($errors)) {
            return array('errors' => $errors);
        }

        return array(
            'csrfToken' => $csrfToken,
            'idQuestion' => $idQuestion,
            'idReponse' => $idReponse,
            'customerId' => $customerId
        );
    }

    private function isValidQuestion(int $question, int $reponse)
    {
        try {
            $exist =  $this->get('expressionlite.query.response_linked_to_question_query_handler');
            $exist->handle(new ResponseLinkedToQuestionQuery($question, $reponse));
        } catch (\Throwable $th) {
            return $this->jsonResponse(['message' => $th->getMessage()], 400);
        }
        return true;
    }

    private function isValidVoteConstumer()

    {

        if (!$this->context->customer->id) {
            return false;
        }

        $dateToCompare = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));


        try {

            $historyVote = $this->get('expressionlite.query.date_older_vote_query_handler');
            $historyVote->handle(new DateOlderVoteQuery($this->context->customer->id, $dateToCompare));
        } catch (\Throwable $th) {
            return $this->jsonResponse(['message' => $th->getMessage()], 400);
        }

        // verifier si user est connecter
        // verifier si user a deja voter a la question y a moins de x jours
        // 
        return true;
    }

    private function insertVote($idQuestion, $idReponse)
    {

        try {
            $addVote = $this->get('expressopinionlite.command.handler.add_vote');
            $addVote->handle(new AddVoteCommand(['questionId' => $idQuestion, 'responseId' => $idReponse]));
        } catch (\Throwable $th) {
            return $this->jsonResponse(['message' => $th->getMessage()], 400);
        }
        return true;
    }

    private function insertVoteHistory($customerId)
    {
      
        try {
            $addVote = $this->get('expressopinionlite.command.handler.add_vote_history');
            $addVote->handle(new AddVoteHistoryCommand(['userId' => $customerId ]));
        } catch (\Throwable $th) {
            return $this->jsonResponse(['message' => $th->getMessage()], 400);
        }
        return true;
    }

    private function jsonResponse($data, $statusCode)
    {
        http_response_code($statusCode);
        die(json_encode($data));
    }
}
