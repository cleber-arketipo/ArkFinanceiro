<?php

class Form_Fornecedor extends Zend_Form
{

    public function init()
    {
        $this->setName('fornecedor');

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
        
        $tipocadastro = new Zend_Form_Element_Hidden('tipocadastro');
        $tipocadastro->setValue('fornecedor')
                     ->setRequired(false)
                     ->setIgnore(true)
                     ->setDecorators($customElementDecorators);
        
        $tipo = new Zend_Form_Element_Radio('tipo');
        $tipo->setLabel('Tipo')
             ->setMultiOptions(array('PF'=>'PF', 'PJ'=>'PJ'))
             ->setAttrib('class', 'input_radio')
             ->setAttrib('label_class', 'label_radio_tipo')
             ->setRequired(true)
             ->setSeparator('')
             ->setDecorators($radioElementDecorators);
        
        $razao_social = new Zend_Form_Element_Text('razao_social');
        $razao_social->setLabel('Razão Social')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $documento = new Zend_Form_Element_Text('documento');
        $documento->setLabel('Documento')
                  ->addFilter('StripTags')
                  ->addValidator('NotEmpty')
                  ->setDecorators($customElementDecorators);
        
        $ie = new Zend_Form_Element_Text('ie');
        $ie->setLabel('Inscrição Estadual')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $ramo = new Zend_Form_Element_Text('ramo');
        $ramo->setLabel('Ramo de Atividade')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $cep = new Zend_Form_Element_Text('cep');
        $cep->setLabel('CEP')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setAttrib('onmouseout', 'getEndereco()')
             ->setDecorators($customElementDecorators);
        
        $endereco = new Zend_Form_Element_Text('endereco');
        $endereco->setLabel('Endereço')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $numero = new Zend_Form_Element_Text('numero');
        $numero->setLabel('Nº')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $complemento = new Zend_Form_Element_Text('complemento');
        $complemento->setLabel('Complemento')
                    ->addFilter('StripTags')
                    ->addValidator('NotEmpty')
                    ->addFilter('StringToUpper')
                    ->setDecorators($customElementDecorators);
        
        $bairro = new Zend_Form_Element_Text('bairro');
        $bairro->setLabel('Bairro')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $cidade = new Zend_Form_Element_Text('cidade');
        $cidade->setLabel('Cidade')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $estado = new Zend_Form_Element_Select('estado');
        $estado->setLabel('Estado')
               ->setMultiOptions(array(
                   ''=>'-- SELECIONE --',
                   'AC'=>'ACRE',
                   'AL'=>'ALAGOAS',
                   'AP'=>'AMAPÁ',
                   'AM'=>'AMAZONAS',
                   'BA'=>'BAHIA',
                   'CE'=>'CEARÁ',
                   'DF'=>'DISTRITO FEDERAL',
                   'ES'=>'ESPÍRITO SANTO',
                   'GO'=>'GOIÁS',
                   'MA'=>'MARANHÃO',
                   'MS'=>'MATO GROSSO DO SUL',
                   'MT'=>'MATO GROSSO',
                   'MG'=>'MINAS GERAIS',
                   'PA'=>'PARÁ',
                   'PB'=>'PARAÍBA',
                   'PR'=>'PARANÁ',
                   'PE'=>'PERNAMBUCO',
                   'PI'=>'PIAUÍ',
                   'RJ'=>'RIO DE JANEIRO',
                   'RN'=>'RIO GRANDE DO NORTE',
                   'RS'=>'RIO GRANDE DO SUL',
                   'RO'=>'RONDÔNIA',
                   'RR'=>'RORAIMA',
                   'SC'=>'SANTA CATARINA',
                   'SP'=>'SÃO PAULO',
                   'SE'=>'SERGIPE',
                   'TO'=>'TOCANTINS',
                   ))
               ->addFilter('StripTags')
               ->addValidator('NotEmpty');
        
        $telefone = new Zend_Form_Element_Text('telefone');
        $telefone->setLabel('Telefone')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $celular = new Zend_Form_Element_Text('celular');
        $celular->setLabel('Celular')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $responsavel = new Zend_Form_Element_Text('responsavel');
        $responsavel->setLabel('Responsável')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->addFilter('StringToUpper')
             ->setDecorators($customElementDecorators);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Inserir')
               ->setAttrib('id', 'submit')
               ->setIgnore(true)
               ->setDecorators($submitElementDecorators);
        
        $this->addElements(array($id, $tipocadastro, $tipo, $documento, $razao_social, $nome, $ie, $ramo, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $telefone, $celular, $responsavel, $submit));
        
        
        $this->addDisplayGroup(array(        
                'documento',
                'razao_social',
                'nome',                
                'ie',
                'ramo',
                'cep',
                'endereco',
                'numero',
                'complemento',
                'bairro',
                'cidade',
                'estado',
                'telefone',
                'celular',
                'responsavel',
                'submit'
            ), 'campos', array('legend' => 'Contact Information'));
        
        $campos = $this->getDisplayGroup('campos');
        $campos->setDecorators(array('FormElements',array('HtmlTag',array('tag'=>'div','id'=>'grupo_form'))));
        
        
        $this->setAction('fornecedores/inserir')
             ->setMethod('post');
    }
    
    public function isValid($data)
    {
        if($this->getAction() ==  "fornecedores/inserir"){
            $this->getElement('documento')
                 ->addValidator(
                         'Db_NoRecordExists',
                         true,
                         array(
                             'table'     => 'fornecedores',
                             'field'     => 'documento',
                             'messages'   => 'Este fornecedor já foi cadastrado'
                             )
                         );
        }
        
        return parent::isValid($data);
    }

}