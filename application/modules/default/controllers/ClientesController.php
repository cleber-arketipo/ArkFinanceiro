<?php

class ClientesController extends Zend_Controller_Action
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
        
        $clientes = new Default_Model_Cliente();
        $this->view->posts = $clientes->fetchAll();
        
    }
    
    public function inserirAction(){
        
        $form = new Form_Cliente();
        $cliente = new Default_Model_Cliente();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $id = $cliente->insert($form->getValues());
                $this->_redirect('clientes');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function editarAction(){
        
        $form = new Form_Cliente();
        $form->setAction('clientes/editar');
        $form->submit->setLabel('Editar');
        $clientes = new Default_Model_Cliente();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                $clientes->update($values, 'id = ' . $values['id']);
                $this->_redirect('clientes');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $cliente = $clientes->fetchRow("id =$id")->toArray();
            $form->populate($cliente);
            
        }
        
        $this->view->form = $form;
        
    }
    
    public function deletarAction(){
        
        $clientes = new Default_Model_Cliente();
        $id = $this->_getParam('id');
        $clientes->delete("id = $id");
        $this->_redirect('clientes');
        
    }

}