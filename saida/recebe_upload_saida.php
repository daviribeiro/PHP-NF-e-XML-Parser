<?php
/*
 *
 * carga de arquivos para o servidor para geração das informações dos arquivos XMLs´dentro do database
 * escolhido para processar as notas para calculo dos impostos.
 * 
 *
 *
 * Criado a partir do src code gerado pelo tHiago no site http://blog.thiagobelem.net/php/upload-de-arquivos-com-php/
 *
 */



// Pasta onde o arquivo xml sera salvo
$_UP['pasta'] = '/xmls_entrada/uploads/';

// Renomeia o arquivo - opcional em uso para atender as especificacoes do XML:
$_UP['renomeia'] = true;

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
exit; // Para a execução do script
}



// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria o arquivo:

 
    $nome_final = "/xmls_entrada/uploads/envio_xml_saida.xml";

    }
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'],  $nome_final)) {

    // Executa o código para processar o arquivo:
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=/xmlparser/saida/importNFe_saida.php'>";

}

?>
