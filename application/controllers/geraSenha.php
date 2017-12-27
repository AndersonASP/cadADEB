<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 26/12/17
 * Time: 10:07
 */

/*Editar senha*/
include_once('../configs/conection.php');
$senhaA = $_POST['senhaA'];
$senhaN = $_POST['senhaN'];
$senhaR = $_POST['senhaR'];
$cpf = $_POST['cpf'];

$senhaEn = md5($senhaA);

$checkSenha = "select count(member_id) from usuario.membros WHERE senha='{$senhaEn}'";
$res = pg_query($db, $checkSenha);

$sRe = pg_fetch_array($res,0);

$resultadoNome = pg_query($db, "select nome from usuario.membros where cpf='{$cpf}'" );
$resultadoNome2 = pg_fetch_array($db, $resultadoNome);
//Nome2); echo '</pre>';
$checkSenha = $sRe[0];
if($checkSenha > 0){
    if($senhaN === $senhaR) {
        $senhaS = md5($senhaN);
        $senhaN = $senhaR;

        pg_query($db, "update usuario.membros set senha ='{$senhaS}' where cpf='{$cpf}'");


//        $to = "anderson.pereira@basis.com.br";
//        $subject = "Cadastro de novo membro";
//        $mensagem = "<strong>Nome:{$nome}</strong>" ;

    }
}