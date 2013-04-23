<?php

class FuncionariosController extends Zend_Controller_Action
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
        
        $funcionarios = new Default_Model_Funcionario();
        $select = $funcionarios->select()->order('nome ASC');
        $this->view->posts = $funcionarios->fetchAll($select);
        
    }
    
    public function inserirAction(){
        
        $form = new Form_Funcionario();
        $funcionario = new Default_Model_Funcionario();
        
        $date = new Default_View_Helper_Date();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                if($values['nascimento'] != "")
                    $values['nascimento'] = $date->date($values['nascimento'], Zend_Date::ISO_8601, 'en_US');
                $id = $funcionario->insert($values);
                $this->_redirect('funcionarios');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function editarAction(){
        
        $form = new Form_Funcionario();
        $form->setAction('funcionarios/editar');
        $form->submit->setLabel('Editar');
        $funcionarios = new Default_Model_Funcionario();
        
        $date = new Default_View_Helper_Date();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                if($values['nascimento'] != "")
                    $values['nascimento'] = $date->date($values['nascimento'], Zend_Date::ISO_8601, 'en_US');
                $funcionarios->update($values, 'id = ' . $values['id']);
                $this->_redirect('funcionarios');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $funcionario = $funcionarios->fetchRow("id =$id")->toArray();
            
            if($funcionario['nascimento'] != "")
                $funcionario['nascimento'] = $date->date($funcionario['nascimento'], Zend_Date::DATE_MEDIUM);
            
            $form->populate($funcionario);
            
        }
        
        $this->view->form = $form;
        
    }
    
    public function deletarAction(){
        
        $funcionarios = new Default_Model_Funcionario();
        $id = $this->_getParam('id');
        $funcionarios->delete("id = $id");
        $this->_redirect('funcionarios');
        
    }
    
    /*
    public function verificaAction(){
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(false);
        
        $data = $this->_request->getPost();

        $campos = new Default_Model_Cliente();
        
        $select = $campos->select()->where('documento = ?', $data['documento']);
        
        $this->_helper->json($campos->fetchAll($select));
        
    }
     * 
     */

}