<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class AdminResponseController extends  FrameworkBundleAdminController
{

    public function updateByAjax(Request $request): JsonResponse
    {
        // Récupérer les données JSON de la requête
        $data = json_decode($request->getContent(), true);

        if (!isset($data['id'], $data['content'], $data['questionId'])) {
            return new JsonResponse(['success' => false, 'message' => 'Missing required data'], 400);
        }

        try {
            $id = $data['id'];
            $data2 = [];
            $data2['content'] = $data['content'];
            $data2['questionId'] = $data['questionId'];
            $reponseBuilder = $this->get('expressopinionlite.command.builder.reponse');
            $command = $reponseBuilder->buildEditCommand($id, $data2);
            $reponseHandler = $this->get('expressopinionlite.command.handler.update_reponse');

            $reponseHandler->handle($command);

            return new JsonResponse(['success' => true, 'message' => 'Response updated successfully']);
        } catch (\Exception $e) {
         
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
