<?php

class LogoutController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {

        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->_helper->redirector->goToRoute( array('module' => 'default'), null, true);
        
    }


}

