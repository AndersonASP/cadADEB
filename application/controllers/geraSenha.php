<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 26/12/17
 * Time: 10:07
 */

/*Editar senha*/
include_once('../configs/conection.php');


$senhaNova = $_POST['senhaN'];
$senhaNRepetida = $_POST['senhaR'];
$cpf = preg_replace("/\D+/", "" ,$_POST['cpf']);

$senhaEn = md5($senhaNova);

/*Checa se todos os campos foram preenchidos*/
if(empty($senhaNova) || empty($senhaNRepetida) || empty($cpf)){
    echo "<script>alert('Existem Dados que não foram preenchidos.');
            window.location.href ='/application/view/auth/recSenha.phtml';
        </script>";
}else {
    /*Checa se o email informado está cadastrado*/
    $check_email = pg_query($db, "select * from usuario.membros where cpf='{$cpf}'");
    $check_num = pg_num_rows($check_email);

    if ($check_num == 0) {

        echo "<script>alert('Este CPF não está cadastrado em nosso sistema'); 
        window.location.href ='/application/view/auth/recSenha.phtml'; </script>";

    }else{
        pg_query($db, "update usuario.membros set senha ='{$senhaEn}' WHERE cpf='{$cpf}'");

        echo "<script>alert('Sua nova senha foi gravada com Sucesso! Sua nova senha é:"." $senhaNova, Faça seu login!');
            window.location.href ='/application/view/auth/login.phtml';
        </script>";
    }

}
