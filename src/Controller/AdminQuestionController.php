<?php

namespace Ericc70\Expressopinionlite\Controller;



use Ericc70\Expressopinionlite\Domain\Command\UpdateQuestionCommand;
use Ericc70\Expressopinionlite\Domain\Query\GetReponse;
use Ericc70\Expressopinionlite\Domain\QueryHandler\GetReponseByQuestionHandler;
use Ericc70\Expressopinionlite\Entity\Question;
use Ericc70\Expressopinionlite\Form\Type\QuestionType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;


class AdminQuestionController extends FrameworkBundleAdminController
{
    
    
    public  function indexAction(Request $request)
    {
        $questionFormBuilder = $this->get('expressopinionlites.form.builder.contact_form_builder');
        $questionForm = $questionFormBuilder->getFormFor(1); 
        $questionForm->handleRequest($request);
   

        $questionFormHandler = $this->get('expressopinionlites.form.handler.contact_form_handler');
         $result=$questionFormHandler->handleFor(1, $questionForm);

        $responseHandler = $this->get('expressopinionlite.query.get_reponse_by_question_handler');
    $reponses =  $responseHandler->handle(new GetReponse(1));
    
        if ($result->isSubmitted() && $result->isValid()) {
            $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

        // return $this->redirectToRoute('admin_contacts_index');
        }

        return $this->render('@Modules/expressopinionlite/views/templates/admin/question.html.twig',[
            'enableSidebar' => true,
            'layoutTitle' =>$this->trans('Express Opinion Lite', 'Module.ExpressOpinionLite.Admin'),
            'questionForm' => $questionForm->createView(),
             'responses' => $reponses,
          

        ]);
    }


}
