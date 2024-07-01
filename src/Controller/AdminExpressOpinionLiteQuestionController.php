<?php

declare(strict_types=1);

namespace Ericc70\Expressopinionlite\Controller;

use Ericc70\Expressopinionlite\Domain\Query\GetReponse;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;


class AdminExpressOpinionLiteQuestionController extends FrameworkBundleAdminController
{

    public  function indexAction(Request $request)
    {
        $questionFormBuilder = $this->get('expressopinionlites.form.builder.contact_form_builder');
        $questionForm = $questionFormBuilder->getFormFor(1);
        $questionForm->handleRequest($request);


        $questionFormHandler = $this->get('expressopinionlites.form.handler.contact_form_handler');
        $result = $questionFormHandler->handleFor(1, $questionForm);

        $responseHandler = $this->get('expressopinionlite.query.get_reponse_by_question_handler');
        $reponses =  $responseHandler->handle(new GetReponse(1));

        if ($result->isSubmitted() && $result->isValid()) {
            $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

            // return $this->redirectToRoute('admin_contacts_index');
        }
        // $customBreadcrumbs = [
        //     'Clients' => $this->generateUrl('ec_expressOpinion_index'), // Lien vers la page d'accueil
        //     'Express Opinion Lite',
        // ];
        return $this->render('@Modules/expressopinionlite/views/templates/admin/question.html.twig', [
            'enableSidebar' => true,
            'layoutTitle' => $this->trans('Express Opinion Lite', 'Module.ExpressOpinionLite.Admin'),
            'layoutHeaderToolbarBtn' => $this->getToolBarButtons(),
            'questionForm' => $questionForm->createView(),
            'responses' => $reponses,
        ]);
    }


    public function getToolBarButtons()
    {
        return [
            'add' => [
                'desc' => $this->trans('Retour', 'Module.ExpressOpinionLite.Admin'),
                'icon' => 'reply',
                'href' => $this->generateUrl('ec_expressOpinion_index'),
            ],
        ];
    }

    public function getBreadcrumbs()
    {
        return [
            'breadcrumbs2' => [
                $this->trans('Clients', 'Admin.Navigation.Menu') => $this->generateUrl('ec_expressOpinion_index'),
                $this->trans('Express Opinion Lite', 'Module.ExpressOpinionLite.Admin') => $this->generateUrl('ec_expressOpinion_index'),
                $this->trans('Question', 'Module.ExpressOpinionLite.Admin') => '',
            ],
        ];
    }
}
