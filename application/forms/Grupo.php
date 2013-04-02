<?php

class Form_Grupo extends Zend_Form
{

    public function init()
    {
        $this->setName('grupo');

        $id = new Zend_Form_Element_Hidden('id');
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome')->setRequired(true)->addFilter('StripTags')->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Inserir')->setIgnore(true);
        
        $this->addElements(array($id, $nome, $submit));
        $this->setAction('/grupos/inserir')->setMethod('post');
    }

}