<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 21/04/18
 * Time: 14:35
 */
include_once '../configs/conection.php';

$iduser = $_GET['id'];
$acao = $_GET['acao'];

if($acao == "excluir"){
    $sql = "update membros.membros set status = 3 where member_id = '{$iduser}'";

    if(pg_query($sql)){
        echo "<script> alert('Usuário excluido com sucesso');
            window.location.href = 'javascript:history.go(-1)';
            </script>";
    }else{
        echo "<script> alert('Erro ao excluir usuário');</script>";
    }

}

if($acao == "view"){
//    $sql = "select * from membros.membros where member_id = '{$iduser}'";
//    pg_query($sql);
//    echo "<script>
//            window.location.href ='/application/view/blog/viewuser.phtml';
//          </script>";
}
