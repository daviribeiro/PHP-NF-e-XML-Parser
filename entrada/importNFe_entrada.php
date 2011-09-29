<?php


// Retirado do nfePHP versão 2.0
// Usa o DOMDocument para importar o XML
// contribuiÃ§Ã£o de Giuliano Nascimento - código original
// Alterado por Davi Antunes (daviantunes27@hotmail.com) para alimentar em banco de dados MySQL em 09/09/2011.


// Include com a conexao a base de dados MySQL:
include ('../includes/conecta.php');


// arquivo XML carregado dentro do servidor. Crie a pasta para carregar o XML:
$arq = '/xmls_entrada/uploads/envio_xml_entrada.xml';


if ( is_file($arq) ){
    $docxml = file_get_contents($arq);
    $dados = importaNFe($docxml);
}


function importaNFe($xml){
    $doc = new DOMDocument();
    $doc->preservWhiteSpace = FALSE; //elimina espaÃ§os em branco
    $doc->formatOutput = FALSE;
    $doc->loadXML($xml,LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
    $node = $doc->getElementsByTagName('infNFe')->item(0);
    //obtem a versÃ£o do layout da NFe
    $dados['versao']=trim($node->getAttribute("versao"));
    $dados['chave']= substr(trim($node->getAttribute("Id")),3);

    // Reconhecimento dos campos do XML

    $dados['dataEmissao']=tagValue(&$doc,"dEmi");
    $dados['dataMovimento']=tagValue(&$doc,"dSaiEnt")." ".tagValue(&$doc,"hSaiEnt");
    $dados['codigonf']=tagValue(&$doc,"cNF");
    $dados['natureza']=tagValue(&$doc,"natOp");
    $dados['numero']=tagValue(&$doc,"nNF");
    $dados['modelo']=tagValue(&$doc,"mod");
    $dados['serie']=tagValue(&$doc,"serie");

    // Emitente:
    $emi=$doc->getElementsByTagName('emit')->item(0);
    $c1=tagValue(&$emi,"CNPJ");
    $c2=substr($c1,0,2).".".substr($c1,2,3).".".substr($c1,5,3)."/".substr($c1,8,4)."-".substr($c1,12,2);
    $dados['emitenteCnpj']=$c1;
    $dados['emitenteCnpjFormatado']=$c2;
    $dados['emitenteRazaoSocial']=tagValue(&$emi,"xNome");
    $dados['emitenteNome']=tagValue(&$emi,"xFant");
    $dados['emitenteInscricaoEstadual']=tagValue(&$emi,"IE");
    $dados['emitenteInscricaoMunicipal']=tagValue(&$emi,"IM");
    $dados['emitenteCnae']=tagValue(&$emi,"CNAE");
    $dados['emitenteEndereco']=tagValue(&$emi,"xLgr");
    $dados['emitenteNumero']=tagValue(&$emi,"nro");
    $dados['emitenteBairro']=tagValue(&$emi,"xBairro");
    $dados['emitenteMunicipio']=tagValue(&$emi,"xMun");
    $dados['emitenteMunicipioIbge']=tagValue(&$emi,"cMun");
    $dados['emitenteCep']=tagValue(&$emi,"CEP");
    $dados['emitenteUF']=tagValue(&$emi,"UF");
    $dados['emitentePaisIbge']=tagValue(&$emi,"cPais");
    $dados['emitentePais']=tagValue(&$emi,"xPais");
    $dados['emitenteTelefone']=tagValue(&$emi,"fone");

    // Destinatário:
    $dst=$doc->getElementsByTagName('dest')->item(0);
    $c1=tagValue(&$dst,"CNPJ");
    $c2=substr($c1,0,2).".".substr($c1,2,3).".".substr($c1,5,3)."/".substr($c1,8,4)."-".substr($c1,12,2);
    $dados['destinatarioCnpj']=$c1;
    $dados['destinatarioCnpjFormatado']=$c2;
    $dados['destinatarioRazaoSocial']=tagValue(&$dst,"xNome");
    $dados['destinatarioNome']=tagValue(&$dst,"xFant");
    $dados['destinatarioInscricaoEstadual']=tagValue(&$dst,"IE");
    $dados['destinatarioInscricaoMunicipal']=tagValue(&$dst,"IM");
    $dados['destinatarioEndereco']=tagValue(&$dst,"xLgr");
    $dados['destinatarioNumero']=tagValue(&$dst,"nro");
    $dados['destinatarioBairro']=tagValue(&$dst,"xBairro");
    $dados['destinatarioMunicipio']=tagValue(&$dst,"xMun");
    $dados['destinatarioMunicipioIbge']=tagValue(&$dst,"cMun");
    $dados['destinatarioCep']=tagValue(&$dst,"CEP");
    $dados['destinatarioUF']=tagValue(&$dst,"UF");
    $dados['destinatarioPaisIbge']=tagValue(&$dst,"cPais");
    $dados['destinatarioPais']=tagValue(&$dst,"xPais");
    $dados['destinatarioTelefone']=tagValue(&$dst,"fone");

    $dados['pesoLiquido']=floatval(tagValue(&$doc,"pesoL"));
    $dados['pesoBruto']=floatval(tagValue(&$doc,"pesoB"));

    $dados['dataRecibo']=tagValue(&$doc,"dhRecbto");
    $dados['protocolo']=tagValue(&$doc,"nProt");



    // Totais da NF-e. Para fazer a alimentação no database referente aos calculos e paineis:
    $total=$doc->getElementsByTagName('ICMSTot')->item(0);
     $dados['basecalculo']=tagValue(&$total,"vBC");
        $dados['valoricms']=tagValue(&$total,"vICMS");
        $dados['valorbcst']=tagValue(&$total,"vBCST");
        $dados['valorst']=tagValue(&$total,"vST");
        $dados['totalprodutos']=tagValue(&$total,"vProd");
        $dados['valorfrete']=tagValue(&$total,"vFrete");
        $dados['valorseguro']=tagValue(&$total,"vSeg");
        $dados['valordesconto']=tagValue(&$total,"vDesc");
        $dados['valorii']=tagValue(&$total,"vII");
        $dados['valoripi']=tagValue(&$total,"vIPI");
        $dados['valorpis']=tagValue(&$total,"vPIS");
        $dados['valorcofins']=tagValue(&$total,"vCOFINS");
        $dados['valoroutro']=tagValue(&$total,"vOutro");
        $dados['valortotalnf']=tagValue(&$total,"vNF");

// Tag det dos itens unitários:
    $det=$doc->getElementsByTagName('det');
    $itens="";
    for ($i = 0; $i < $det->length; $i++) {
        $item=$det->item($i);
        $s="";
        $s['codigo']=tagValue(&$item,"cProd");
        $s['ean']=tagValue(&$item,"cEAN");
        $s['nome']=tagValue(&$item,"xProd");
        $s['ncm']=tagValue(&$item,"NCM");
        $s['cfop']=tagValue(&$item,"CFOP");
        $s['unidade']=tagValue(&$item,"uCom");
        $s['quantidade']=tagValue(&$item,"qCom");
        $s['valor']=tagValue(&$item,"vUnCom");
        $s['valorTotal']=tagValue(&$item,"vProd");
        $s['valoricms']=tagValue(&$item,"vICMS");
        $s['valoripi']=tagValue(&$item,"vIPI");
        $itens[]=$s;
    }
    $dados['itens']=$itens;
    return($dados);
        
}




function tagValue($node,$tag){
    return $node->getElementsByTagName("$tag")->item(0)->nodeValue;
}


    
    // CALCULO DO PIS E COFINS:
    // Echo nos valores totais da NF. Valor do PIS e COFINS deve ser calculado no código fonte de acordo com o cálculo do e-mail do Renan:
    $calculo_sem_ipi_e_st = $dados['valortotalnf'] - $dados['valoripi'] - $dados['valorst'] + $dados['valorfrete'] ;

    //Calcula PIS e COFINS da nota fiscal em questão - USA A VARIAVEL PADRAO ACIMA:
    $resultado_pis = ($calculo_sem_ipi_e_st * 0.65)/ 100;
    $resultado_cofins = ($calculo_sem_ipi_e_st * 3) / 100;


// INSERÇÃO DE DADOS NO MYSQL:
$query = "insert into nfs_entrada
    (codigo_nf, natureza_operacao, nome_emitente, numero_nf, data_emissao, valor_base_calculo, valor_icms, valor_base_subst_trib, valor_subst_trib,
    valor_produtos, valor_frete, valor_seguro, valor_desconto, valor_ii, valor_ipi, valor_pis, valor_cofins, valor_outro, valor_nf, data_inclusao_nf)
    values (%d,'%s','%s', %d, %f, %f, %f, %f, %f, %f, %f, %f, %f, %f, %f, %f, %f, %f, %f, now())";

// Saida dos dados conforme a função importaNFE e alimentação no MySQL:
$tmpQuery = sprintf($query, $dados['codigonf'], $dados['natureza'], $dados['emitenteRazaoSocial'], $dados['numero'], $dados['dataEmissao'], $dados['basecalculo'], $dados['valoricms'], $dados['valorbcst'], $dados['valorst'], $dados['totalprodutos'], $dados['valorfrete'], $dados['valorseguro'], $dados['valordesconto'], $dados['valorii'], $dados['valoripi'], $resultado_pis, $resultado_cofins, $dados['valoroutro'], $dados['valortotalnf']);


// Executa a query para escrita no banco de dados:
mysql_query($tmpQuery);

// Retorna a agina inicial da carga de XML´s de saida:
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=/xmlparser/entrada/index.php'>";




?>
