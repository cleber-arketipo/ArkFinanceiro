<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
                'basePath' => APPLICATION_PATH,
                'namespace' => ''
        ));
        return $autoloader;
    }
    
    protected function _initTranslate()
    {
        try {
            $translate = new Zend_Translate('Array', APPLICATION_PATH . '/languages/pt_BR/Zend_Validate.php', 'pt_BR');
            Zend_Validate_Abstract::setDefaultTranslator($translate);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

}