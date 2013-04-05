<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        if ( !Zend_Auth::getInstance()->hasIdentity() ) {
            return $this->_helper->redirector->goToRoute( array('controller' => 'login'), null, true);
        } else {
            $admin = Zend_Auth::getInstance()->getIdentity();
            $this->view->admin = $admin;
        }
    }

    public function indexAction()
    {

        return $this->_helper->redirector->goToRoute( array('controller' => 'caixa'), null, true);
        
    }


}

