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
        
        $date = new Default_View_Helper_Date();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                if($values['fundacao'] != "")
                    $values['fundacao'] = $date->date($values['fundacao'], Zend_Date::ISO_8601, 'en_US');
                $id = $cliente->insert($values);
                $this->_redirect('clientes');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function editarAction(){
        
        $form = new Form_Cliente();
        $form->removeElement('documento');
        $form->setAction('clientes/editar');
        $form->submit->setLabel('Editar');
        $clientes = new Default_Model_Cliente();
        
        $date = new Default_View_Helper_Date();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                if($values['fundacao'] != "")
                    $values['fundacao'] = $date->date($values['fundacao'], Zend_Date::ISO_8601, 'en_US');
                $clientes->update($values, 'id = ' . $values['id']);
                $this->_redirect('clientes');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $cliente = $clientes->fetchRow("id =$id")->toArray();
            
            if($cliente['fundacao'] != "")
                $cliente['fundacao'] = $date->date($cliente['fundacao'], Zend_Date::DATE_MEDIUM);
            
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
    
    public function verificaAction(){
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(false);
        
        $data = $this->_request->getPost();

        $campos = new Default_Model_Cliente();
        
        $select = $campos->select()->where('documento = ?', $data['documento']);
        
        $this->_helper->json($campos->fetchAll($select));
        
    }

}