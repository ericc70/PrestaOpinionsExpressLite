<?php
declare(strict_types=1);

namespace Ericc70\ExpressOpinionLite\Controller;


use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Response;

class AdminExpressOpinionLite extends FrameworkBundleAdminController
{
    public function indexAction()
    {
        return $this->render('@Modules/expressopinionlite/views/templates/admin/index.html.twig',[
            'enableSidebar' => true,
            'layoutTitle' =>$this->trans('Express Opinion Lite', 'Module.ExpressOpinionLite.Admin')
        ]);
    }
}