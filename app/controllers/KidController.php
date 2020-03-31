<?php

class KidController extends I18nController
{

    public function indexAction()
    {
        $this->view->controller =  $this->di->getRouter()->getControllerName();
        $this->view->action =  $this->di->getRouter()->getActionName();
    }

    public function anotherAction()
    {
        $this->view->controller =  $this->di->getRouter()->getControllerName();
        $this->view->action =  $this->di->getRouter()->getActionName();
    }

    public function interviewAction()
    {
        $this->view->controller =  $this->di->getRouter()->getControllerName();
        $this->view->action =  $this->di->getRouter()->getActionName();
        parent::initialize();
        $this->assets->addCss('css/kid/interview.css');
        $this->assets->addJs('js/kid/interview.js');
    }

    public function overviewAction()
    {
        $this->view->controller =  $this->di->getRouter()->getControllerName();
        $this->view->action =  $this->di->getRouter()->getActionName();
        parent::initialize();
        $this->assets->addCss('css/kid/overview.css');
        $this->assets->addJs('js/kid/chart.js');
        $this->assets->addJs('js/kid/overview.js');
    }
}

