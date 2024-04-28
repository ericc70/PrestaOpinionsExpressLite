<?php

namespace Ericc70\Expressopinionlite\Domain\QueryBuilder;

use Ericc70\Expressopinionlite\Domain\Query\SearchVoteQuery;

class SearchVoteQueryBuilder
{

    public function BuildSearchVoteQuery(array $data)
    {


        if ($data['buttonName'] == 'submitDateDay') {
            $d = date('Y-m-d');
            return new SearchVoteQuery('ByDay', $d);
        }
        if ($data['buttonName'] == 'submitDateMonth') {
            $d = date('Y-m');

            return new SearchVoteQuery("ByMonth", $d);
        }
        if ($data['buttonName'] == 'submitDateYear') {
            $d = date('Y');
            return new SearchVoteQuery('ByYear', $d);
        }
        if ($data['buttonName'] == 'submitDateDayPrev') {
            $d = date('Y-m-d', strtotime("-1 days"));
            return new SearchVoteQuery('ByDay', $d);
        }
        if ($data['buttonName'] == 'submitDateMonthPrev') {
            $d = date('Y-m-d', strtotime("-1 months"));
            return new SearchVoteQuery('ByMonth', $d);
        }
        if ($data['buttonName'] == 'submitDateYearPrev') {
            $d = date('Y-m', strtotime("-1 year"));
            return new SearchVoteQuery('ByYear', $d);
        }
        if ($data['buttonName'] == 'submitDatePicker') {
            $d1 = $data['dateFrom'];
            $d2 = $data['dateTo'];
            return new SearchVoteQuery('ByDateRange', $d1, $d2);
        }
    }
}
