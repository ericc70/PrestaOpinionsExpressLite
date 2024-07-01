<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use Ericc70\Expressopinionlite\Domain\QueryBuilder\SearchVoteQueryBuilder;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdminVoteController extends  FrameworkBundleAdminController
{

    public function loadData(Request $request): JsonResponse
    {
        try {
            $data= [
            'buttonName' => $request->request->get('buttonName'),
            // 'date' => date('Y-m-d'),
            'dateFrom' =>  $request->request->get('dateFrom') ?? null,
            'dateTo' =>  $request->request->get('dateTo') ?? null
            ];
        
             $vote = $this->get('expressopinionlite.query.search_vote_query_handler');
             $d = new SearchVoteQueryBuilder();
           $dd = $d->BuildSearchVoteQuery($data);
      
             $resultVote = $vote->handle($dd );

           // Removed the 'return 1;' statement
           return new JsonResponse(['success' => true, $resultVote]);
            // return $this->json( $resultVote);
        } catch (\Throwable $th) {
          
            return new JsonResponse(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
