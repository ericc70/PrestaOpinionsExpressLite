<?php




namespace Ericc70\Expressopinionlite\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Ericc70\Expressopinionlite\Domain\CommandBuilder\ReponseCommandBuilder;
use League\Tactician\CommandBus;
use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class AdminResponseController extends  FrameworkBundleAdminController
{
    private $commandBus;
    private $commandBuilder;

    // public function __construct(
    //   CommandBusInterface $commandBus,
    //    //  ReponseCommandBuilder $commandBuilder
    //    )
    // {
    //    $this->commandBus = $commandBus;
    //    // $this->commandBuilder = $commandBuilder;
    // }

   
    public function updateByAjax(Request $request): JsonResponse
    {
        // Récupérer les données JSON de la requête
        $data = json_decode($request->getContent(), true);

        // $reponseBuilder= $this->get('expressopinionlite.command.builder.reponse');
        // $reponseHandler="";
        // $repbuild=$reponseBuilder->buildEditCommand();
        // reponseHandler->handle()
        // Vérifier si les données requises sont présentes
        if (!isset($data['id'], $data['content'], $data['questionId'])) {
            return new JsonResponse(['success' => false, 'message' => 'Missing required data'], 400);
        }

        try {
            // Construire la commande de mise à jour en utilisant le command builder
           // $command = $this->commandBuilder->buildEditCommand($data['responseId'], $data['content'], $data['questionId']);

            // Envoyer la commande au bus de commande pour exécution
         // $this->commandBus->handle($command);

            // Répondre avec succès
            return new JsonResponse(['success' => true, 'message' => 'Response updated successfully']);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse d'erreur
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
