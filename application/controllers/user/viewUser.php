<?php
include_once '../configs/conection.php';

$iduser = $_GET['id'];
$acao = $_GET['acao'];

if($acao == "view"){
    $sql = "select * from membros.membros where member_id = '{$iduser}'";
    pg_query($sql);
    echo "<script>
            window.location.href ='../../views/admin/user/viewuser.phtml';
          </script>";
}
