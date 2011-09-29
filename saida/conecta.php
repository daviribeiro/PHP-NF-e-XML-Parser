<?php


// Conexao à base de dados no banco MySQL. Após a fiunção de importação para fazer Queries a vontade:

$banco   = 'xmlparser';             // nome do banco aonde serão salvas as informações do XML 
$host    = '127.0.0.1';             // host
$usuario = 'root';                  // usuario
$senha   = 'tronblast';               // senha

//// connectamos ao host e selecionamos o banco
mysql_connect($host, $usuario, $senha);
mysql_select_db($banco);


?>
