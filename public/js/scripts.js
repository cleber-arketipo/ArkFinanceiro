$(function() {
    
    $('.excluir').click(function(){
        var apagar = confirm('Deseja realmente excluir este registro?');
      
        if (apagar){
            // aqui vai a instrução para apagar registro			
        } else {
            event.preventDefault();
        }	
    });   
   
});