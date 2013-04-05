<?php

class Form_Grupo extends Zend_Form
{

    public function init()
    {
        $this->setName('grupo');

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
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Inserir')
               ->setAttrib('id', 'submit')
               ->setIgnore(true)
               ->setDecorators($submitElementDecorators);
        
        $this->addElements(array($id, $nome, $submit));
        
        $this->setAction('grupos/inserir')
             ->setMethod('post');
    }

}