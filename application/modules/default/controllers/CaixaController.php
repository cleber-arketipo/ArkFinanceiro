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
        $select = $caixas->select()->order('id DESC');
        $resultado = $caixas->fetchAll($select);
        
        for($i=0; $i < count($resultado); $i++){
            $date = new Default_View_Helper_Date();
            $resultado[$i]['data'] = $date->date($resultado[$i]['data'], Zend_Date::DATE_MEDIUM);
            
            $resultado[$i]['valor'] = str_replace(".", ",", $resultado[$i]['valor']);
            
            if($resultado[$i]['tipo'] == 'ENTRADA'){
                $consultaConta = new Default_Model_Cliente();
            } elseif($resultado[$i]['tipo'] == 'SAIDA'){
                if($resultado[$i]['grupo'] == 6){
                    $consultaConta = new Default_Model_Funcionario();
                } else {
                    $consultaConta = new Default_Model_Fornecedor();
                }
            }
            
            $consultaGrupo = new Default_Model_Grupo();
            $idGrupo = $resultado[$i]['grupo'];
            $resGrupo = $consultaGrupo->fetchRow("id =$idGrupo")->toArray();
            $resultado[$i]['grupo'] = $resGrupo['nome'];
            
            $idConta = $resultado[$i]['conta'];
            $resConta = $consultaConta->fetchRow("id =$idConta")->toArray();
            $resultado[$i]['conta'] = $resConta['nome'];
            
        }
        
        $this->view->posts = $resultado;
        
        $form = new Form_Caixa();
        $this->view->form = $form;
        
    }
    
    public function inserirAction(){
        
        $form = new Form_Caixa();
        $caixa = new Default_Model_Caixa();
        
        $date = new Default_View_Helper_Date();
        
        if ($this->_request->isPost()) {
                        
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                $values['data'] = $date->date($values['data'], Zend_Date::ISO_8601, 'en_US');
                $values['valor'] = str_replace(",", ".", $values['valor']);
                $id = $caixa->insert($values);
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
        
        $date = new Default_View_Helper_Date();

        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $values = $form->getValues();
                $values['data'] = $date->date($values['data'], Zend_Date::ISO_8601, 'en_US');
                $values['valor'] = str_replace(",", ".", $values['valor']);
                $caixas->update($values, 'id = ' . $values['id']);
                $this->_redirect('caixa');
                
            } else {
                
                $values = $form->getValues();
                //$values['contaatual'] = $values['conta'];
                $form->populate($values); 
                
            }
            
        } else {
            
            $id = $this->_getParam('id');
            $caixa = $caixas->fetchRow("id =$id")->toArray();
        
            $caixa['data'] = $date->date($caixa['data'], Zend_Date::DATE_MEDIUM);
            $caixa['valor'] = str_replace(".", ",", $caixa['valor']);
            
            $caixa['contaatual'] = $caixa['conta'];
            
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
        elseif($data['tipocaixa'] == 'SAIDA'){
            if($data['grupocaixa'] == 6)
                $campos = new Default_Model_Funcionario();
            else
                $campos = new Default_Model_Fornecedor();
        }
        
        $select = $campos->select()->order('nome ASC');
        
        $this->_helper->json($campos->fetchAll($select));
        
    }

}