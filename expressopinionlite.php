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


}
 