<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 27/12/17
 * Time: 01:12
 */

session_start();

if(!isset($_REQUEST['logmeout'])){
    echo "Você realmente deseja sair da área restrita?<br />";
    echo "<a href=\"logout.php?logmeout\">Sim</a> | ";
    echo "<a href=\"javascript:history.go(-1)\">Não</a>";
}else{
    session_destroy();

    echo "<strong>Voce não está mais logado</strong>";

    header("Location:http://cadadeb.local/application/view/auth/login.phtml");
}