jQuery(function($){
    $("#cpf").mask("999.999.999-99");
    $("#tel").mask("(99) 99999-9999");
    $("#data").mask("99/99/9999");
});

$("#form_contato").validate({
   rules:{
       cpf:{
           require:true,

       },
       nome:{
          require:true,
          minLength:3
       },
       email:{
         require:true,
         email:true
       },
       senha:{
          require:true,
          minLength:true
       },
       tel:{
           require:true
       },
       date:{
           require:true,
           date:true
       }
   },
   messages:{
       cpf:{
            require:"Por favor, informe seu CPF!",
            minLength:"O CPF deve ter no mínimo 11 números"
       },
       nome:{
           require:"Por favor, informe seu nome",
           minLength:"O seu nome deve ter no mínimo 3 caracteres"
       },
       email:{
           require:"Por favor, informe um email",
           email:"Digite um email válido"
       },
       senha:{
            require:"Por favor, informe uma senha",
            minLength:"A sua senha  deve ter no mínimo 8 caracteres"
       },
       tel:{
           require:"Por favor, informe um número"
       },
       date:{
           require:"Por favor, informe sua data e aniversário",
           date:"Digite uma data valida"
       }

   }
});