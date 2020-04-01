<?php
/**
 * Created by IntelliJ IDEA.
 * User: Norbert
 * Date: 08.10.2019
 * Time: 14:19
 */

use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

// use Phalcon\Http\Cookie; until phalcon has fixed the issue keep using plain php for cookies


class I18nController extends ControllerBase
{
    public function initialize()
    {
        $this->view->t = $this->getTranslation();
    }

    protected function getTranslation()
    {
        $messages = [];
        $language = strtolower(substr($this->detectLanguage(), 0, 2));
        $translationFile = $this->di->getConfig()->translation->messagesDir . $language . '.php';

        if (!file_exists($translationFile)) { // Is there a translation file for that language
            $language = 'en';
        }

        require $this->di->getConfig()->translation->messagesDir . $language . '.php';
        setcookie('language', $language, time() + 15 * 86400, '/', "", false, false);
        $this->view->selectedLang = $language;

        return new NativeArray(
            [
                'content' => $messages,
            ]
        );
    }

    protected function detectLanguage()
    {
        $return = $this->cookies->has('language')
            ? $this->cookies->get('language')->getValue()
            : $this->request->getBestLanguage();
        if (!is_string($return)) {
            $return = 'en_EN';
        }
        return $return;
    }
}
