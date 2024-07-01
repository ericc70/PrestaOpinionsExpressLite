<?php
declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\QueryHandler;

use Ericc70\Expressopinionlite\Domain\Exeption\DateOlderThanForConsumerExeption;
use Ericc70\Expressopinionlite\Domain\Query\DateOlderVoteQuery;
use Ericc70\Expressopinionlite\Repository\VoteHistoryRepository;

class DateOlderVoteQueryHandler
{
    protected $voteHistoryRepository;

    public function __construct(VoteHistoryRepository $voteHistoryRepository)
    {
        $this->voteHistoryRepository = $voteHistoryRepository;
    } 

    public function handle(DateOlderVoteQuery $query)
    {
        $userId = $query->getUserId();
        $dateActu = $query->getDateActu();
     
       $answer =  $this->voteHistoryRepository->isDateOlderThanForConsumer($userId, $dateActu);

        if (!$answer) {
            throw new DateOlderThanForConsumerExeption("le dernier vote n'est pas assez ancien.");
        }

        return true;
    }
}