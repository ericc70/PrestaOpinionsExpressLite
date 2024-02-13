<?php

declare(strict_types=1);



class ExpressOpinionLite extends Module
{
    public function __construct()
    {
        $this->name = 'expressopinionlite';
        $this->author = 'Ericc70';
        $this->version = '1.0.0';
        $this->need_instance = 0;

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


}
 