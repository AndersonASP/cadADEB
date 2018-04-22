<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 25/12/17
 * Time: 21:53
 */

date_default_timezone_set('America/Sao_Paulo');


include_once('../configs/conection.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = preg_replace("/\D+/", "", $_POST['cpf']);
$data = preg_replace("/\D+/", "", $_POST['data']);
$tel = preg_replace("/\D+/", "", $_POST['tel']);
$data_cad = date('Y-m-d H:i');
$senhaenc = md5($senha);

if (!($nome) || !($email) || !($senha) || !($cpf) || !($data) || !($tel)) {
    echo "<script>alert('Existem campos que não foram preenchidos'); window.location.href ='javascript:history.go(-1)';</script>";
} else {
    $checkCPF = "select count (member_id) from membros.membros WHERE cpf='{$cpf}'";
    $checkemail = "select count (member_id) from membros.membros WHERE email='{$email}'";

    $recEmail = pg_query($db, $checkemail);
    $recCpf = pg_query($db, $checkCPF);

    $eReg = pg_fetch_array($recEmail, 0);
    $cReg = pg_fetch_array($recCpf, 0);

    $email_check = $eReg[0];
    $cpf_check = $cReg[0];

    if ($email_check || $cpf_check) {
        echo "<br>ERROR:<br><br>";

        if ($email_check > 0) {
            echo "<script>alert('Este EMAIL já está cadastrado!'); window.location.href ='/application/view/auth/login.phtml';</script>";
            unset($email);

        }
        if ($cpf_check > 0) {
            echo "<script>alert('Este CPF já está cadastrado!Faça seu login');window.location.href ='/application/view/auth/login.phtml';</script>";
            unset($cpf);

        }
    } else {
        $sql = "insert into membros.membros (cpf,nome, dt_aniver, tel_cel, email, senha, data_cad) VALUES ('$cpf','$nome','$data', '$tel','$email','$senhaenc','$data_cad')";
        $salvar = pg_query($db, $sql);

        echo "<script>alert('Cadastro efetuado com sucesso! Sua senha é: {$senha} Faça seu login!')</script>";


        // Enviar um email ao usuário para confirmação e ativar o cadastro!
        $headers = "From:" . $email;
        $subject = "Confirmação de cadastro - teusite.com.br";
        $mensagem = "Amdwdmaowdmoamwomaowdmaowmdoamdoamwdoamdoamwd";
        if (mail("anderson.asp.si@gmail.com", $subject, $mensagem, $headers)) {
            echo "<script>alert('Foi enviado para seu email - (" . $email . ") um pedido de confirmação de cadastro, por favor verifique e sigas as instruções!')</script>";

        } else {
            echo "<script>alert('Email não enviado.')</script>";
        }

        echo "<script>window.location.href = '/application/view/auth/login.phtml';</script>";
    }
}
pg_close($db);