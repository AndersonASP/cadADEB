<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 16/04/18
 * Time: 14:58
 */
include_once('../../configs/conection.php');

$buscaDados = "select membros.member_id, membros.cpf, membros.membros.tel_cel, tb_status.ds_status, membros.nome, membros.email, tb_acess_level.ds_nome_level     
from membros.tb_status 
inner join membros.membros on (tb_status.id_status = membros.membros.status) 
inner join membros.tb_acess_level on (tb_acess_level.id_level = membros.level_acess)";

$sql1 = pg_query($buscaDados);
$date = pg_fetch_assoc($sql1);

//echo "<pre>"; print_r(pg_fetch_assoc($sql1));die; echo "</pre>";



