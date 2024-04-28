<?php

namespace Ericc70\Expressopinionlite\Domain\QueryHandler;

use Ericc70\Expressopinionlite\Domain\Query\SearchVoteQuery;
use Ericc70\Expressopinionlite\Repository\VoteRepository;

class SearchVoteQueryHandler
{

    protected $voteRepository;

    public function __construct(VoteRepository $voteRepository)
    {
        $this->voteRepository = $voteRepository;
    }



    public function handle(SearchVoteQuery $command)
    {
    
        $votes=[];
        
        if ($command->getEndPeriod() == null) {
            $method = 'search' . $command->getParamBy();
            $periode = $command->getSearchDate();

            $votes =    $this->voteRepository->$method($periode);
        }

        if ($command->getEndPeriod() != null) {
            $method = 'search' . $command->getParamBy();

            $date1 = $command->getSearchDate();
            $date2 = $command->getEndPeriod();

            $votes =    $this->voteRepository->$method($date1, $date2);
        }

        // Return the votes as a JSON string
        return json_encode($votes);
    }
}
