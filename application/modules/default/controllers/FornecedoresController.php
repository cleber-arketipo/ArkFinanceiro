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

    public function indexAction()
    {

        
                
    }
    
    /*
    public function inserirAction(){
        
        $form = new Application_Form_Noticia();
        $noticia = new Admin_Model_Noticia();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $id = $noticia->insert($form->getValues());
                $this->_redirect('admin/noticias/selecionar');
                
            } else {
                
                $form->populate($form->getValues());
                
            }
        }
        
        $this->view->form = $form;
        
    }
    
    public function selecionarAction(){
        
        $noticias = new Admin_Model_Noticia();
        $this->view->posts = $noticias->fetchAll();
        
    }
    
    public function editarAction(){
        
        $form = new Application_Form_Noticia();
        $form->setAction('/admin/noticias/editar');
        $form->submit->setLabel('Editar');
        $noticias = new Admin_Model_Noticia();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                $noticias->update($values, 'id = ' . $values['id']);
                $this->_redirect('admin/noticias/selecionar');
                
            } else {
                
                $form->populate($form->getValues()); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $noticia = $noticias->fetchRow("id =$id")->toArray();
            $form->populate($noticia);
            
        }
        
        $this->view->form = $form;
        
    }
    
    public function deletarAction(){
        
        $noticias = new Admin_Model_Noticia();
        $id = $this->_getParam('id');
        $noticias->delete("id = $id");
        $this->_redirect('admin/noticias/selecionar');
        
    }
    */

}