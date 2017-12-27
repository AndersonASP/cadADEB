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
        $sql = "insert into usuario.membros (cpf,nome, dt_aniver, tel_cel, email, senha, data_cad) VALUES ('$cpf','$nome','$data','$tel','$email','$senhaenc', '$data_cad')";
        $salvar = pg_query($db, $sql);



        // Enviar um email ao usuário para confirmação e ativar o cadastro!

        $headers = 'MIME-Version: 1.0\n'
        . 'Content-type: text/html; charset=iso-8859-1\n'
        .'anderson.fera9@gmail.com';

        $subject = "Confirmação de cadastro - teusite.com.br";
        $mensagem = "<strong>Prezado, {$nome}.</strong><br/>
        <p>Obrigado pelo seu cadastro em nosso site, <a href='http://www.teusite.com.br'>
        http://www.teusite.com.br</a>!<br/> <br/>
        
        Para confirmar seu cadastro e ativar sua conta em nosso site, podendo acessar à
        áreas exclusivas, por favor clique no link abaixo ou copie e cole na barra de
        endereço do seu navegador.<br/><br/>
        
        <br/><br/>
        Após a ativação de sua conta, você poderá ter acesso ao conteúdo exclusivo
        efetuado o login com os seguintes dados abaixo:<br > <br />
        
        <strong>Usuario</strong>:{$cpf}<br />
        <strong>Senha</strong>:{$senha}<br /> <br />
        
        Obrigado!<br /> <br /></p>
        
        Webmaster<br /> <br /> <br />
        Esta é uma mensagem automática, por favor não responda!";

        mail($email, $subject, $mensagem, $headers);

        echo "<strong>Cadastro efetuado com sucesso!</strong>Foi enviado para seu email - <strong>( " . $email . " )</strong> um pedido de
     confirmação de cadastro, por favor verifique e sigas as instruções!";
    }
}



pg_close($db);