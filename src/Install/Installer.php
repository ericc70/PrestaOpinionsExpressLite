<?php

declare(strict_types=1);

namespace Ericc70\ExpressOpinionLite\install;

use Module;
use Db;
use Language;
use Tab;

class Installer
{
    private $tabs = [
        [
            'class_name' => "c",
            'parent_class_name' => "AdminCatalog",
            'name' => "Express Opinon Lite",
            'icon' => "",
            'wording' => "Opinion express des clients, version lite",
            'wording_domain' => "Modules.ExpressOpinonLite.Admin",
        ]
    ];


    public function install(Module $module)
    {
        if (!$this->registerHook($module)) return false;
        if (!$this->installTab()) return false;
        if (!$this->installDatabase()) return false;
        return true;
    }

    public function uninstall()
    {
        return $this->uninstallTab() &&
            $this->uninstallDatabase();
    }

    public function registerHook(Module $module)
    {
        $hooks = [
            'moduleRoutes',
            'displayHome',
            'displayHeader',
        ];
        return (bool)$module->registerHook($hooks);
    }

    public function installTab()
    {
        $languages = Language::getLanguages();

        foreach ($this->tabs as $t) {
            $exist = Tab::getIdFromClassName($t['class_name']);

            if (!$exist) {
                $tab = new Tab();
                $tab->active = true;
                $tab->enabled = true;
                $tab->module = $t['name'];;
                $tab->class_name = $t['class_name'];
                $tab->id_parent = Tab::getIdFromClassName($t['parent_class_name']); // Correction ici
                $tab->name = array();

                foreach ($languages as $language) {
                    $tab->name[$language['id_lang']] = $t['name'];
                }

                $tab->icon = $t['icon'];
                $tab->wording = $t['wording'];
                $tab->wording_domain = $t['wording_domain'];

                $tab->save();
            }
        }
    }



    public function uninstallTab()
    {
        foreach ($this->tabs as $t) {
            $id = Tab::getIdFromClassName($t['class_name']);

            if ($id) {
                $tab = new Tab($id);
                $tab->delete();
            }
        }

        return true;
    }
    
    public function installDatabase()
    {
    }
    public function uninstallDatabase()
    {
    }
}
