<?php
session_start(); 
include("connect.php");

if(isset($_POST['ajudar'])){
    echo $_POST['beneficiado'];
}

?>