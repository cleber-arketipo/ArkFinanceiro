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
    
    $("#cep").mask("99.999-999");
    $("#telefone").mask("(99) 99999999");
    $("#celular").mask("(99) 99999999?9");
    
    $('#tipo-PF').click(function(){
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
    });
    
    $('#tipo-PJ').click(function(){
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
    });
   
});

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