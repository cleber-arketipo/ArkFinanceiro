<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setName('login');
 
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
            ),
            array(
                array('data' => 'HtmlTag'),
                array('tag' => 'div')
            )
        );
        
        $submitElementDecorators = array(
            'ViewHelper',
            'Errors',
            array(
                'Description',
                array('tag' => 'p','class' => 'description')
            ),
            array(
                array('data' => 'HtmlTag'),
                array('tag' => 'div')
            )
        );
        
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setDecorators($customElementDecorators);
 
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setDecorators($customElementDecorators);
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Logar')
               ->setAttrib('id', 'submitbutton')
               ->setDecorators($submitElementDecorators);
 
        $this->addElements(array($login, $senha, $submit));
    }


}

