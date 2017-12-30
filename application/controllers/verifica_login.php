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
    echo "<script>alert('Preencha todos os campos');
 window.location.href ='/application/view/auth/login.phtml';
    </script>";
}else {
    $senhad = md5($senha);
    $sql = "select * from usuario.membros where cpf='{$cpf}' and senha='{$senhad}' and usu_ativ='false'";
    $res = pg_query($db, $sql);

    $login_check = pg_num_rows($res);


    if ($login_check > 0) {

        while ($row = pg_fetch_assoc($res)) {

            foreach ($row AS $key => $val) {

                $$key = stripslashes($val);

            }

            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $nome;
            $_SESSION['nivel'] = $row['level_acess'];


            pg_query($db, "update usuario.membros set data_ult_login ='{$data_now}' WHERE cpf='{$cpf}'");

            echo "<script>
                    window.location.href ='/application/view/blog/cssehtml.phtml';
                    alert('Olá, $nome! Seja Bem-vindo!');
                  </script>";

        }

    }else{
        echo "<script>alert('O CPF e ou SENHA informados não estão cadastrados. Faça seu cadastro ou recupere sua senha'</script>";
    }
}
