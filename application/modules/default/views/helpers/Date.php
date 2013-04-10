<?php

class Default_View_Helper_Date extends Zend_View_Helper_Abstract {
    
    protected static $_date = null;

    
    public function date($valor, $formato = Zend_Date::DATETIME_MEDIUM, $local = "pt_BR") {
    
        return $this->getDate()
                    ->set($valor)   
                    ->setLocale($local)
                    ->get($formato);
        
    }

    public function getDate() {
        if (self::$_date == null) {
            self::$_date = new Zend_Date();            
        }
                
        return self::$_date;
    }

}