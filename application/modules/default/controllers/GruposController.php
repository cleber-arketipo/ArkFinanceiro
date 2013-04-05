<?php

class GruposController extends Zend_Controller_Action
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

    public function indexAction(){
        
        $grupos = new Default_Model_Grupo();
        $this->view->posts = $grupos->fetchAll();
        
    }
    
    public function inserirAction(){
        
        $form = new Form_Grupo();
        $grupo = new Default_Model_Grupo();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $id = $grupo->insert($form->getValues());
                $this->_redirect('grupos');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function editarAction(){
        
        $form = new Form_Grupo();
        $form->setAction('grupos/editar');
        $form->submit->setLabel('Editar');
        $grupos = new Default_Model_Grupo();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                $grupos->update($values, 'id = ' . $values['id']);
                $this->_redirect('grupos');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $grupo = $grupos->fetchRow("id =$id")->toArray();
            $form->populate($grupo);
            
        }
        
        $this->view->form = $form;
        
    }
    
    public function deletarAction(){
        
        $grupos = new Default_Model_Grupo();
        $id = $this->_getParam('id');
        $grupos->delete("id = $id");
        $this->_redirect('grupos');
        
    }


}