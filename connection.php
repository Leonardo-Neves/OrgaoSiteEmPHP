<?php

define('HOST', 'localhost');
define('USER', 'root');
define('SENHA', '');
define('BD', 'orgao');

$connectionUser = mysqli_connect(HOST, USER, SENHA, BD) or die ('Não Conectou!!');
?>