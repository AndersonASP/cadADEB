<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 25/12/17
 * Time: 21:17
 */

//try {
//$db = new PDO("pgsql:host=localhost dbname=cadadeb user=postgres password=ander1108");
//echo'Conexao efetuada';
//} catch (PDOException  $e) {
//    var_dump($e->getMessage());
//}

$db = pg_connect("host=localhost dbname=cadadeb user=postgres password=ander1108") or die("Error: falha na conexão");
