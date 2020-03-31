<?php
/**
 * DONT TOUCH DONT USE BUT LEAVE IT HERE
 */

use Phalcon\Mvc\Controller;
use Phalcon\Filter;
use Phalcon\Security\Random;

class ServiceController extends I18nController
{

    public function translateAction()
    {
        echo date('r') . '<br/>' . PHP_EOL;
        $config = $this->di->getConfig()->translation;
        $translationsCsv = $config->messagesDir . $config->translationCsv . '.csv';
        if (($handle = fopen($translationsCsv, "w+")) !== FALSE) {
            fwrite($handle, file_get_contents($config->gDriveTranslationUrl));
            fclose($handle);
        }

//        $enFile = $config->messagesDir . 'en.php';

//        if (filemtime($translationsCsv) <= filemtime($enFile)) {
//            die('Nothing to do!');
//        }
        $data = [];
        if (($handle = fopen($translationsCsv, "r")) !== FALSE) {
            $languages = fgetcsv($handle, 0, ",", '"');
            array_shift($languages); // en de dk
            foreach ($languages as $lang) {
                $data [$lang] = [];

            }

            while (($row = fgetcsv($handle, 1000, ",", '"')) !== FALSE) {
                $key = array_shift($row);
                $i = 0;
                foreach ($languages as $lang) {
                    $data [$lang][$key] = $row[$i++];
                }
            }
            fclose($handle);
        }
        foreach ($data as $language => $rows){
            if(@unlink(realpath($config->messagesDir.$language.'.php'))){
                echo $config->messagesDir.$language.'.php deleted successfully<br/>'.PHP_EOL;
            } else {
                echo $config->messagesDir.$language.'.php delete failed<br/>'.PHP_EOL;
            }
            if (($handle = fopen($config->messagesDir.$language.'.php', "w+")) !== FALSE) {
                fwrite($handle, '<?php' . PHP_EOL . '$messages = ['. PHP_EOL);
                foreach ($rows as $key => $text){
                    fwrite($handle, "'" . $key . "' => '" . str_ireplace("'",'"', $text) . "'," . PHP_EOL);
                }
                fwrite($handle, '];'. PHP_EOL);
                fclose($handle);
            }
        }
        $this->view->disable();

        die('All files translated');
    }


    public function indexAction()
    {
        die('Nothing');
    }
}
