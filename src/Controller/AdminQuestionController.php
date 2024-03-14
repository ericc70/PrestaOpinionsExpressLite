<?php

namespace Ericc70\Expressopinionlite\Controller;



use Ericc70\Expressopinionlite\Domain\Command\UpdateQuestionCommand;
use Ericc70\Expressopinionlite\Entity\Question;
use Ericc70\Expressopinionlite\Form\Type\QuestionType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;


class AdminQuestionController extends FrameworkBundleAdminController
{
    
    
   /*
    public function new(Request $request)
    {
        $form = $this->createForm(QuestionType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $command = $form->getData();
            $this->get('command_bus')->handle($command);

            return $this->redirectToRoute('question_list');
        }

        return $this->render('question/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
  */
  public function indexAction(Request $request)
    {
        $questionFormBuilder = $this->get('expressopinionlites.form.builder.contact_form_builder');
    $questionForm = $questionFormBuilder->getFormFor(1); 
    $questionForm->handleRequest($request);

    $questionFormHandler = $this->get('expressopinionlites.form.handler.contact_form_handler');
    $result=$questionFormHandler->handleFor(1, $questionForm);
    if ($result->isSubmitted() && $result->isValid()) {
        $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

       // return $this->redirectToRoute('admin_contacts_index');
    }

        return $this->render('@Modules/expressopinionlite/views/templates/admin/question.html.twig',[
            'enableSidebar' => true,
            'layoutTitle' =>$this->trans('Express Opinion Lite', 'Module.ExpressOpinionLite.Admin'),
            'questionForm' => $questionForm->createView(),

        ]);
    }
    /**
     * 
     */
    /*
    public function edit(Request $request, int $id)
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);


        $command = new UpdateQuestionCommand($id, $question->getContent());
       
        $form = $this->createForm(QuestionType::class, $command);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $command = $form->getData();
            $this->get('command_bus')->handle($command);

            return $this->redirectToRoute('question_list');
        }

        return $this->render('question/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    */
}
