<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 27/12/17
 * Time: 01:12
 */

session_start();

if(!isset($_REQUEST['logmeout'])){
    echo "<script> let ande = confirm('Você realmente deseja sair da área restrita?');
    if(ande == true){
       window.location.href = 'logout.php?logmeout';
    }else{
        window.location.href = 'javascript:history.go(-1)';
    }
    </script>";
}
else{
    session_destroy();
    echo "<script>alert('Voce não está mais logado no Sistema!'); 
    window.location.href ='/application/view/auth/login.phtml';</script>";
}