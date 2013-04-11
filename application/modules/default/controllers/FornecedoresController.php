<?php

class FornecedoresController extends Zend_Controller_Action
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
        
        $fornecedores = new Default_Model_Fornecedor();
        $this->view->posts = $fornecedores->fetchAll();
        
    }
    
    public function inserirAction(){
        
        $form = new Form_Fornecedor();
        $fornecedor = new Default_Model_Fornecedor();
        
        $date = new Default_View_Helper_Date();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                if($values['fundacao'] != "")
                    $values['fundacao'] = $date->date($values['fundacao'], Zend_Date::ISO_8601, 'en_US');
                $id = $fornecedor->insert($values);
                $this->_redirect('fornecedores');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function editarAction(){
        
        $form = new Form_Fornecedor();
        $form->removeElement('documento');
        $form->setAction('fornecedores/editar');
        $form->submit->setLabel('Editar');
        $fornecedores = new Default_Model_Fornecedor();
        
        $date = new Default_View_Helper_Date();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                if($values['fundacao'] != "")
                    $values['fundacao'] = $date->date($values['fundacao'], Zend_Date::ISO_8601, 'en_US');
                $fornecedores->update($values, 'id = ' . $values['id']);
                $this->_redirect('fornecedores');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $fornecedor = $fornecedores->fetchRow("id =$id")->toArray();
            
            if($fornecedor['fundacao'] != "")
                $fornecedor['fundacao'] = $date->date($fornecedor['fundacao'], Zend_Date::DATE_MEDIUM);
            
            $form->populate($fornecedor);
            
        }
        
        $this->view->form = $form;
        
    }
    
    public function deletarAction(){
        
        $fornecedores = new Default_Model_Fornecedor();
        $id = $this->_getParam('id');
        $fornecedores->delete("id = $id");
        $this->_redirect('fornecedores');
        
    }
    
    public function verificaAction(){
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(false);
        
        $data = $this->_request->getPost();

        $campos = new Default_Model_Fornecedor();
        
        $select = $campos->select()->where('documento = ?', $data['documento']);
        
        $this->_helper->json($campos->fetchAll($select));
        
    }

}