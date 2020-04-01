<?php

class LogonController extends I18nController
{

    public function initialize()
    {
        parent::initialize();
        $this->assets->addCss('css/logon/index.css');
        $this->assets->addJs('js/logon/index.js');
    }


    public function indexAction()
    {

    }
}

