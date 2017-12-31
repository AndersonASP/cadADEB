<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 27/12/17
 * Time: 14:00
 */


//Inicia a sessão
session_start();

/*verifica a existência das variaveis necessárias para indentificar o usuário, se não houver VAR emite o alerta e
detroi a sessão
*/
if (!isset($_SESSION['cpf']) or (!isset($_SESSION['nome']))){

echo "<script>alert('Por favor, faça o login para acessar a página desejada! Caso não tenha acesso, efetue o cadastro e logue!');
window.location.href ='/application/view/auth/login.phtml';
</script>";

session_destroy();
exit;
}elseif ($_SESSION['nivel'] != $nivel_necessario){
    echo "<script>alert('Você não tem permissão para acessar essa página!');
            window.location.href ='javascript:history.go(-1)';
    </script>";

}