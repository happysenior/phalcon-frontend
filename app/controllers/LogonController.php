<?php

class LogonController extends I18nController
{

    public function initialize()
    {
        $this->assets->addCss('css/signin.css');
        $this->assets->addJs('js/logon/index.js');
        parent::initialize();
    }


    public function indexAction()
    {

    }
}

