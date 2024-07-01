<?php
declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Domain\Query;

class SearchVoteQuery

{
    protected $paramBy;
    protected $searchDate;
    protected $endPeriod;

    public function __construct($paramBy, $searchDate, $endPeriod = null)
    {

        $this->paramBy = $paramBy;
        $this->searchDate = $searchDate;
        $this->endPeriod = $endPeriod;
    }

    /**
     * Get the value of paramBy
     */
    public function getParamBy()
    {
        return $this->paramBy;
    }

    /**
     * Get the value of endPeriod
     */
    public function getEndPeriod()
    {
        return $this->endPeriod;
    }

    /**
     * Get the value of searchDate
     */
    public function getSearchDate()
    {
        return $this->searchDate;
    }
}
