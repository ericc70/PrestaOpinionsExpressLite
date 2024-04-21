<?php

declare(strict_types=1);

use Ericc70\Expressopinionlite\Install\Installer;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class ExpressOpinionLite extends Module
{
    public function __construct()
    {
        $this->name = 'expressopinionlite';
        $this->author = 'Ericc70';
        $this->version = '1.0.0';
        $this->need_instance = 0;
        $this->tab = 'administration';
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->trans('Version lite de ExpressOpinion', [], 'Modules.ExpressOpinionLite.Admin');
        $this->description = $this->trans(
            'Module ExpressOpinionLite a module for express opinion custommner',
            [],
            'Modules.ExpressOpinionLite.Admin'
        );

        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => '8.99.99'];
    }

    public function install()
    {
        if (!parent::install()) return false;
        
        $installer = new Installer();
        return $installer->install($this);
    }

    public function uninstall()
    {
        if (!parent::uninstall()) return false;
        $installer = new Installer();
        return $installer->uninstall($this);
    }

    public function hookDisplayHome()
    {
        echo "I am the king";
        if ($this->context->customer->isLogged()) {
            $config = $this->getConfiguration();
            // if database day  < day + 7
            //limit le nombre de jour
        // Générer un jeton CSRF et le stocker dans la session
        $csrfToken = Tools::getToken(false);
   
        $this->context->cookie->csrf_token = $csrfToken;
        //$question=$this->get('');


        //get question


        //get reponse
    
        $this->context->controller->addJs($this->_path .'/views/assets/js/formulaire.js');
        $this->context->controller->addCSS($this->_path.'/views/assets/css/formulaire.css');
    
        $this->context->smarty->assign(array(
            'form_action' => $this->context->link->getModuleLink('expressopinionlite', 'vote', array(), true),
            'csrf_token' => $csrfToken,
            'question' => "the question here",
            'reponses ' => "the reponses here"
        ));
    
        return $this->display(__FILE__, 'views/templates/hook/home.tpl');
    }
    }
    
    
    public function hookModuleRoutes()
    {
        return [];
    }

    private function getConfiguration(){
        return[
            'nb_day' => 7,
        ];
            
    }

}
 