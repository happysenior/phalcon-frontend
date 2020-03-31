<?php
use Phalcon\Http\Response;


class IndexController extends I18nController
{

    public function indexAction()
    {
        if(!$this->session->adult_token) {
            $this->dispatcher->forward(
                [
                    "controller" => "logon",
                    "action" => "index"
                ]
            );
        } else {
            $this->dispatcher->forward(
                [
                    "controller" => "kid",
                    "action" => "index"
                ]
            );
        }
    }
}

