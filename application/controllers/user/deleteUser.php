<?php
include_once '../configs/conection.php';

$iduser = $_GET['id'];
$acao = $_GET['acao'];

if($acao == "excluir"){
    $sql = "update membros.membros set id_status = 3 where member_id = '{$iduser}'";

    if(pg_query($sql)){
        echo "<script> alert('Usuário excluido com sucesso');
            window.location.href = 'javascript:history.go(-1)';
            </script>";
    }else{
        echo "<script> alert('Erro ao excluir usuário');</script>";
    }

}
