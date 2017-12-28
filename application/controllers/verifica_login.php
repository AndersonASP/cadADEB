<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 26/12/17
 * Time: 03:36
 */

session_start();

include_once('../configs/conection.php');

$cpf = preg_replace("/\D+/", "", $_POST['cpf']);
$senha = $_POST['senha'];
$data_now = date('Y-m-d H:i');

if(!($cpf) || !($senha)) {
    echo "Preencha todos os campos";
}else {
    $senhad = md5($senha);
    $sql = "select * from usuario.membros where cpf='{$cpf}' and senha='{$senhad}'";
    $res = pg_query($db, $sql);

    $login_check = pg_num_rows($res);

    if ($login_check > 0) {

        while ($row = pg_fetch_array($res)) {

            foreach ($row AS $key => $val) {

                $$key = stripslashes($val);

            }

            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $nome;

            pg_query($db, "update usuario.membros set data_ult_login ='{$data_now}' WHERE cpf='{$cpf}'");

            header('Location: http://cadadeb.local/application/view/blog/cssehtml.phtml');

        }

    }else{
        echo "O CPF e ou SENHA informados não estão cadastrados. <a href='http://cadadeb.local/application/view/auth/cadastro.phtml'>Clique aqui</a> para efetuar cadastro";
    }
}
