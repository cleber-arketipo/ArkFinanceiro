$(function() {
    
    $('.excluir').click(function(){
        var apagar = confirm('Deseja realmente excluir este registro?');
      
        if (apagar){
            // aqui vai a instrução para apagar registro			
        } else {
            event.preventDefault();
        }	
    });
    
    $('.errors li').each(function(){
        $('#grupo_form').css('display', 'block');
    });
    
    if(($('#id').val() !== "") || (jQuery($('#tipo-PF')).is(":checked")) || (jQuery($('#tipo-PJ')).is(":checked"))){
        $('label[for=tipo]').css('display', 'none');
        $('label[class=label_radio_tipo]').css('display', 'none');
        $('#tipo-PF').css('display', 'none');
        $('#tipo-PJ').css('display', 'none');
        
        if(jQuery($('#tipo-PF')).is(":checked"))
            ativaPF();
        else if(jQuery($('#tipo-PJ')).is(":checked"))
            ativaPJ();
    }
    
    $("#cep").mask("99.999-999");
    $("#telefone").mask("(99) 99999999");
    $("#celular").mask("(99) 99999999?9");
    
    $('#tipo-PF').click(function(){
        ativaPF();
    });
    
    $('#tipo-PJ').click(function(){
        ativaPJ();
    });
    
    $("#tipocaixa").change(function(){        
        
        $.ajax({
            type: "POST",
            url: 'caixa/contas',
            data: {tipocaixa: $("#tipocaixa").val()},
            dataType: "json",
            success: function(retorno) {
                
                var options = '<option value="">-- SELECIONE --</option>';
                
                $.each(retorno , function(key, value){
                    options += '<option value="' + value['id'] + '">' + value['nome'] + '</option>';
                });
                
                $("#conta").html(options);
            }
          
        });
        
    });
    
    $("#documento").change(function(){        
        
        var docurl = "";
        
        if($("#tipocadastro").val() === 'cliente'){
            docurl = 'clientes/verifica';
        } else if($("#tipocadastro").val() === 'fornecedor'){
            docurl = 'fornecedores/verifica';
        }
        
        $.ajax({
            type: "POST",
            url: docurl,
            data: {documento: $("#documento").val()},
            dataType: "json",
            success: function(retorno) {
                               
                $.each(retorno , function(key, value){
                    if(value['documento'] == $("#documento").val()){
                        $('<ul class="errors" id="docerro"><li>Este '+ $("#tipocadastro").val() +' já foi cadastrado</li></ul>').insertAfter('#documento');
                    } else {
                        $("#docerro").remove();
                    }
                });
                
                if(retorno == ""){                    
                    $("#docerro").remove();
                }
                                
            }
          
        });
        
    });
    
});

function ativaPF(){
    $("#documento").mask("999.999.999-99");
    $('label[for=documento]').html('CPF');
    $('label[for=nome]').html('Nome');
    $('label[for=razao_social]').css('display', 'none');
    $('#razao_social').css('display', 'none');
    $('label[for=ie]').css('display', 'none');
    $('#ie').css('display', 'none');
    $('label[for=responsavel]').css('display', 'none');
    $('#responsavel').css('display', 'none');
    $('#grupo_form').css('display', 'block');
}

function ativaPJ(){
    $("#documento").mask("99.999.999/9999-99");
    $('label[for=documento]').html('CNPJ');
    $('label[for=nome]').html('Nome Fantasia');
    $('label[for=razao_social]').css('display', 'block');
    $('#razao_social').css('display', 'block');
    $('label[for=ie]').css('display', 'block');
    $('#ie').css('display', 'block');
    $('label[for=responsavel]').css('display', 'block');
    $('#responsavel').css('display', 'block');
    $('#grupo_form').css('display', 'block');
}

function getEndereco() {
    if($.trim($("#cep").val()) !== ""){
        
        $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
            
            if(resultadoCEP["resultado"] && resultadoCEP["bairro"] !== ""){
                
                $("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                $("#bairro").val(unescape(resultadoCEP["bairro"]));
                $("#cidade").val(unescape(resultadoCEP["cidade"]));
                $("#estado").val(unescape(resultadoCEP["uf"]));
                $("#num").focus();
            
            }

	});
    }
}