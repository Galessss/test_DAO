<?php

require_once("config.php");


$sql = new sql();
$usuario =$sql ->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
?>