<?php

class Form_Caixa extends Zend_Form
{

    public function init()
    {
        $this->setName('caixa');

        // reset form decorators to remove the 'dl' wrapper
        $this->setDecorators(array('FormElements','Form'));

        // custom decorator definition for form elements
        $customElementDecorators = array(
            'ViewHelper',
            'Errors',
            array(
                'Description',
                array('tag' => 'p','class' => 'description')
            ),
            array(
                'Label',
                array('separator' => ' ')
            )
        );
        
        $radioElementDecorators = array(
            'ViewHelper',
            'Errors',
            array(
                'Description',
                array('tag' => 'div','class' => 'description')
            ),
            array(
                'Label',
                array('separator' => '')
            )
        );
        
        $submitElementDecorators = array(
            'ViewHelper',
            'Errors',
            array(
                'Description',
                array('tag' => 'p','class' => 'description')
            )
        );
        
        $id = new Zend_Form_Element_Hidden('id');
        $id->setDecorators($customElementDecorators);
        
        $data = new Zend_Form_Element_Text('data');
        $data->setLabel('Data')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $tipo = new Zend_Form_Element_Select('tipo');
        $tipo->setLabel('Tipo')
             ->setAttrib('id', 'tipocaixa')
             ->setMultiOptions(array(''=>'-- Selecione --', 'Entrada'=>'Entrada', 'Saída'=>'Saída'))
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $conta = new Zend_Form_Element_Select('conta');
        $conta->setLabel('Conta')
              ->setMultiOptions(array(''=>'-- Selecione --'))
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addValidator('Int')
              ->setRegisterInArrayValidator(false)
              ->setDecorators($customElementDecorators);
                
        $grupo = new Zend_Form_Element_Select('grupo');
        $grupo->setLabel('Grupo')      
              ->addMultiOption('', '-- Selecione --')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addValidator('NotEmpty')
              ->setDecorators($customElementDecorators);
        
        $itens_grupo = new Default_Model_Grupo();
        
        foreach($itens_grupo->fetchAll(NULL, "nome ASC") as $row){
            $grupo->addMultiOption($row->id,$row->nome);
        }
        
        $descricao = new Zend_Form_Element_Text('descricao');
        $descricao->setLabel('Descrição')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $valor = new Zend_Form_Element_Text('valor');
        $valor->setLabel('Valor')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $situacao = new Zend_Form_Element_Select('situacao');
        $situacao->setLabel('Situação')
                 ->setMultiOptions(array(''=>'-- Selecione --', 'Previsto'=>'Previsto', 'Realizado'=>'Realizado'))
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addValidator('NotEmpty')
                 ->setDecorators($customElementDecorators);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Inserir')
               ->setAttrib('id', 'submit')
               ->setIgnore(true)
               ->setDecorators($submitElementDecorators);
        
        $this->addElements(array($id, $tipo, $data, $conta, $grupo, $descricao, $valor, $situacao, $submit));
                
        $this->setAction('caixa/inserir')
             ->setMethod('post');
    }

}