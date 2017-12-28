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
$cpf=preg_replace("/\D+/", "", $_POST['cpf']);
$data =preg_replace("/\D+/","", $_POST['data']);
$tel =preg_replace("/\D+/","", $_POST['tel']);
$data_cad = date('Y-m-d H:i');
$senhaenc = md5($senha);

if(!($nome) || !($email) || !($senha) || !($cpf) || !($data) || !($tel)){
    if(!$nome)
    {
        echo "O campo <strong>NOME</strong> deve ser preenchido<br/><br/><br/>";
    }
    if(!$email)
    {
        echo "O campo <strong>EMAIL</strong> deve ser preenchido<br/><br/><br/>";
    }
    if(!$senha)
    {
        echo "O campo <strong>SENHA</strong> deve ser preenchido<br/><br/><br/>";
    }
    if(!$cpf)
    {
        echo "O campo <strong>CPF</strong> deve ser preenchido<br/><br/><br/>";
    }
    if(!$data)
    {
        echo "O campo <strong>DATA</strong> deve ser preenchido<br/><br/><br/>";
    }
    if(!$tel)
    {
        echo "O campo <strong>TELEFONE</strong> deve ser preenchido<br/><br/><br/>";
    }

    echo "Existem campos que não foram preenchidos";
}else {
    $checkCPF = "select count (member_id) from usuario.membros WHERE cpf='{$cpf}'";
    $checkemail = "select count (member_id) from usuario.membros WHERE email='{$email}'";

    $recEmail = pg_query($db, $checkemail);
    $recCpf = pg_query($db, $checkCPF);

    $eReg = pg_fetch_array($recEmail,0);
    $cReg = pg_fetch_array($recCpf, 0);

    $email_check = $eReg[0];
    $cpf_check = $cReg[0];

    if ($email_check || $cpf_check) {
        echo "<br><strong>ERROR:</strong><br><br>";

        if ($email_check > 0) {
            echo "Este email já está cadastrado,<a href='../view/auth/login.phtml'>Clique aqui</a> para efetuar login!<br>";
            unset($email);
        }
        if ($cpf_check > 0) {
            echo "Este CPF já está cadastrado, <a href='../view/auth/login.phtml'>Clique aqui</a> para efetuar login!<br>";
            unset($cpf);
        }
    }else {
        $sql = "insert into usuario.membros (cpf,nome, dt_aniver, tel_cel, email, senha, data_cad) VALUES ('$cpf','$nome','$data', '$tel','$email','$senhaenc','$data_cad')";
        $salvar = pg_query($db, $sql);

        echo "<script>alert('Cadastro efetuado com sucesso! Sua senha é:{$senha}')</script>";


        // Enviar um email ao usuário para confirmação e ativar o cadastro!
        $headers = "From:". $nome;
        $subject = "Confirmação de cadastro - teusite.com.br";
        $mensagem = "Amdwdmaowdmoamwomaowdmaowmdoamdoamwdoamdoamwd";
        if (mail("anderson.asp.si@gmail.com", $subject, $mensagem, $headers)){
            echo "<script>alert('Foi enviado para seu email - (". $email .") um pedido de confirmação de cadastro, por favor verifique e sigas as instruções!')</script>";

        }else{
            echo "<script>alert('Email não enviado.')</script>";
        }



    }
}




pg_close($db);