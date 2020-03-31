
<?php
use Phalcon\Http\Response;

class AuthController extends I18nController
{

    public function getCredentialsAction()
    {
        $this->view->disable();
        return json_encode($this->config->apiAuth);
    }
}
