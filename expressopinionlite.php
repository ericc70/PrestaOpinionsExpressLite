<?php

declare(strict_types=1);

use Ericc70\Expressopinionlite\Domain\Query\DateOlderVoteQuery;
use Ericc70\Expressopinionlite\Domain\Query\GetQuestionQuery;
use Ericc70\Expressopinionlite\Domain\Query\GetReponse;
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
            // Supprimer les valeurs de configuration spécifiques
            if (!Configuration::deleteByName($this->name)) {
                return false;
            }

        if (!parent::uninstall()) return false;
        $installer = new Installer();
        return $installer->uninstall($this);
    }

    public function hookDisplayHome()
    {        if ($this->context->customer->isLogged() && $this->isValidVoteConstumer() === true ) {
            $config = $this->getConfiguration();
       
            $csrfToken = Tools::getToken(false);

            $this->context->cookie->csrf_token = $csrfToken;
            //get question
            $questionHandler = $this->get('expressopinionlite.query.get_question_query_handler');
            $question = $questionHandler->handle(new GetQuestionQuery(1));
            //get reponse
            $reponseHandler = $this->get('expressopinionlite.query.get_reponse_by_question_handler');
            $reponse = $reponseHandler->handle(new GetReponse(1));


            $this->context->controller->addJs($this->_path . '/views/assets/js/formulaire.js');
            $this->context->controller->addCSS($this->_path . '/views/assets/css/formulaire.css');

            $this->context->smarty->assign(array(
                'form_action' => $this->context->link->getModuleLink('expressopinionlite', 'vote', array(), true),
                'csrf_token' => $csrfToken,
                'question' => $question[0]->getContent(),
                'reponses' => $reponse
            ));

            return $this->display(__FILE__, 'views/templates/hook/home.tpl');
        }
    }


    protected function isValidVoteConstumer()
    {
        $dateToCompare = \DateTime::createFromFormat('Y-m-d', date('Y-m-d') );

        try {

            $historyVote = $this->get('expressionlite.query.date_older_vote_query_handler');
 
           return $historyVote->handle(new DateOlderVoteQuery($this->context->customer->id, $dateToCompare));
           
        } catch (\Throwable $th) {

            return $th->getMessage();
        }

        
    }
    public function hookModuleRoutes()
    {
        return [];
    }

    private function getConfiguration()
    {
        return [
            'nb_day' => 7,
        ];
    }
}
