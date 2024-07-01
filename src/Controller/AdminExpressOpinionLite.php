<?php

declare(strict_types=1);

namespace Ericc70\ExpressOpinionLite\Controller;

use Ericc70\Expressopinionlite\Entity\EcExpressopinionsliteQuestion;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class AdminExpressOpinionLite extends FrameworkBundleAdminController
{
    public function indexAction()
    {

        $questionRepository = $this->getDoctrine()->getRepository(EcExpressopinionsliteQuestion::class);
        $question = $questionRepository->find(1)->getContent();

        return $this->render('@Modules/expressopinionlite/views/templates/admin/index.html.twig', [
            'enableSidebar' => true,
            'layoutTitle' => $this->trans('Express Opinion Lite', 'Module.ExpressOpinionLite.Admin'),
            'layoutHeaderToolbarBtn' => $this->getToolBarButtons(),
            'question' => $question,
            'votes' => []
        ]);
    }

    public function getToolBarButtons()
    {
        return
            [
                'add' => [
                    'desc' => $this->trans('configurer', 'Module.ExpressOpinionLite.Admin'),
                    'icon' => 'settings',
                    'href' => $this->generateUrl('ec_expressOpinion_question'),
                ]
            ];
    }
}
