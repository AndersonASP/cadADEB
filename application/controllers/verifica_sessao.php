<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 27/12/17
 * Time: 14:00
 */
session_start();
if (!isset($_SESSION['cpf'])){

    header("Location:/application/view/auth/login.phtml");
    exit("Por favor, faça o login para acessar a página deseja! Caso não tenha acesso, efetue o cadastro e logue!");

}