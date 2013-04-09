<?php

class CaixaController extends Zend_Controller_Action
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
        
        $caixas = new Default_Model_Caixa();
        $this->view->posts = $caixas->fetchAll();
        
    }
    
    public function inserirAction(){
        
        $form = new Form_Caixa();
        $caixa = new Default_Model_Caixa();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                /* Testar
                $locale = new Zend_Locale(date_default_timezone_get());
                $date='';
                $date = new Zend_Date($dataentrada, 'dd/MM/YYYY', $locale);
                $date = $date->toString('YYYY-MM-dd', 'America/Sao_Paulo');
                */
                
                $id = $caixa->insert($form->getValues());
                $this->_redirect('caixa');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function editarAction(){
        
        $form = new Form_Caixa();
        $form->setAction('caixa/editar');
        $form->submit->setLabel('Editar');
        $caixas = new Default_Model_Caixa();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                $caixas->update($values, 'id = ' . $values['id']);
                $this->_redirect('caixa');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $caixa = $caixas->fetchRow("id =$id")->toArray();
            $form->populate($caixa);
            
        }
        
        $this->view->form = $form;
        
    }
    
    public function deletarAction(){
        
        $caixas = new Default_Model_Caixa();
        $id = $this->_getParam('id');
        $caixas->delete("id = $id");
        $this->_redirect('caixa');
        
    }
    
    public function contasAction(){
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(false);
        
        $data = $this->_request->getPost();

        if($data['tipocaixa'] == 'ENTRADA')
            $campos = new Default_Model_Cliente();
        elseif($data['tipocaixa'] == 'SAÍDA')
            $campos = new Default_Model_Fornecedor();
        
        $select = $campos->select()->order('nome ASC');
        
        $this->_helper->json($campos->fetchAll($select));
        
    }

}