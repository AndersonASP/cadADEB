jQuery(function($){
    $("#cpf").mask("999.999.999-99");
    $("#tel").mask("(99) 99999-9999");
    $("#data").mask("99/99/9999");

});

jQuery(function ($) {

    $("#form_contato").validate({

        rules:{
           cpf:{
               required:true,
               maxLength:11

           },
           nome:{
              required:true,
              minLength:3
           },
           email:{
             required:true,
             email:true
           },
           senha:{
              required:true,
              minLength:8
           },
           Rsenha:{
               required:true,
               minLength:8,
               equalTo: "cadastro.senha"
           },
           tel:{
               required:true
           },
           data:{
               required:true,
               date:true,
           }
       },
       messages:{
           cpf:{
                required:"Por favor, informe seu CPF!",
                minLength:"O CPF deve ter no mínimo 11 números"
           },
           nome:{
               required:"Por favor, informe seu nome",
               minLength:"O seu nome deve ter no mínimo 3 caracteres"
           },
           email:{
               required:"Por favor, informe um email",
               email:"Digite um email válido"
           },
           senha:{
                required:"Por favor, informe uma senha",
                minLength:"A sua senha  deve ter no mínimo 8 caracteres"
           },
           Rsenha:{
               required:"Por favor, informe a uma senha",
               minLength:"A sua senha  deve ter no mínimo 8 caracteres",
               equalTo:"As senhas não são iguais"
           },
           tel:{
               required:"Por favor, informe um número"
           },
           data:{
               required:"Por favor, informe sua data de aniversário",
               date:"Digite uma data valida"
           }

       }
    });
});



