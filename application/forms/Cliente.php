<?php

class Form_Cliente extends Zend_Form
{

    public function init()
    {
        $this->setName('cliente');

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
             ->setDecorators($customElementDecorators);
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
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
             ->setDecorators($customElementDecorators);
        
        $numero = new Zend_Form_Element_Text('numero');
        $numero->setLabel('Nº')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $bairro = new Zend_Form_Element_Text('bairro');
        $bairro->setLabel('Bairro')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $cidade = new Zend_Form_Element_Text('cidade');
        $cidade->setLabel('Cidade')
             ->addFilter('StripTags')
             ->addValidator('NotEmpty')
             ->setDecorators($customElementDecorators);
        
        $estado = new Zend_Form_Element_Select('estado');
        $estado->setLabel('Estado')
               ->setMultiOptions(array(
                   ''=>'-- Selecione --',
                   'AC'=>'Acre',
                   'AL'=>'Alagoas',
                   'AP'=>'Amapá',
                   'AM'=>'Amazonas',
                   'BA'=>'Bahia',
                   'CE'=>'Ceará',
                   'DF'=>'Distrito Federal',
                   'ES'=>'Espírito Santo',
                   'GO'=>'Goiás',
                   'MA'=>'Maranhão',
                   'MS'=>'Mato Grosso do Sul',
                   'MT'=>'Mato Grosso',
                   'MG'=>'Minas Gerais',
                   'PA'=>'Pará',
                   'PB'=>'Paraíba',
                   'PR'=>'Paraná',
                   'PE'=>'Pernambuco',
                   'PI'=>'Piauí',
                   'RJ'=>'Rio de Janeiro',
                   'RN'=>'Rio Grande do Norte',
                   'RS'=>'Rio Grande do Sul',
                   'RO'=>'Rondônia',
                   'RR'=>'Roraima',
                   'SC'=>'Santa Catarina',
                   'SP'=>'São Paulo',
                   'SE'=>'Sergipe',
                   'TO'=>'Tocantins',
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
             ->setDecorators($customElementDecorators);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Inserir')
               ->setAttrib('id', 'submit')
               ->setIgnore(true)
               ->setDecorators($submitElementDecorators);
        
        $this->addElements(array($id, $tipo, $razao_social, $nome, $documento, $ie, $ramo, $cep, $endereco, $numero, $bairro, $cidade, $estado, $telefone, $celular, $responsavel, $submit));
        
        
        $this->addDisplayGroup(array(        
                'razao_social',
                'nome',
                'documento',
                'ie',
                'ramo',
                'cep',
                'endereco',
                'numero',
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
        
        
        $this->setAction('clientes/inserir')
             ->setMethod('post');
    }

}