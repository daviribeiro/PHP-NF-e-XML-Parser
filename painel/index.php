<?php




    // autoload - carrega as funções de Acoordo
            function __autoload($classe)
{
    if (file_exists("app.ado/{$classe}.class.php"))
    {
        include_once "app.ado/{$classe}.class.php";
    }
    else if (file_exists("app.widgets/{$classe}.class.php"))
    {
        include_once "app.widgets/{$classe}.class.php";
    }
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Sistema de Importação de XML e Calculos de Impostos de Notas Ficais</title>
      <meta charset="utf-8"/>
    <meta name="description" content="Sistema para Importação de XMLs para Calculos de impostos diversos - Entrada e Saida"/>
    <meta name="author" content="Davi Antunes Ribeiro"/>
    <link href="../css/bootstrap-1.2.0.css" rel="stylesheet"/>

   </head>

  <body>

    

      <div class="topbar">
      <div class="fill">
        <div class="container">

          <ul class="nav">
           
             <li class="active"><a href="../">Home</a></li>
            <li><a href="../entrada/">Carga de XMLs de Entrada</a></li>
            <li><a href="../saida/">Carga de XMLs de Saida</a></li>
            <li><a href="../painel/">Painel Totalizador de Impostos</a></li>
           
          </ul>
        </div>
      </div>
    </div>



    <!--<div class="container">
      </div>-->



        <div class="hero-unit">
           
            <h2>Totalizador de Impostos de Entrada - Mês Atual</h2>
 <?php



try
{
    $conn = TConnection::open('xmlparser'); // abre uma conexão

    // cria um estilo para o cabeçalho
    $estilo_cabecalho = new TStyle('cabecalho');
    $estilo_cabecalho->font_family     = 'arial,verdana,sans-serif';
    $estilo_cabecalho->font_style      = 'normal';
    $estilo_cabecalho->font_weight     = 'bold';
    $estilo_cabecalho->color           = '#ffffff';
    $estilo_cabecalho->text_decoration = 'none';
    $estilo_cabecalho->background_color= '#825046';
    $estilo_cabecalho->font_size       = '10pt';

    // cria um estilo para os dados
    $estilo_dados = new TStyle('dados');
    $estilo_dados->font_family     = 'arial,verdana,sans-serif';
    $estilo_dados->font_style      = 'bold';

    $estilo_dados->color           = '#ffffff';
    $estilo_dados->background_color = '#757575';
    $estilo_dados->text_decoration = 'none';
    $estilo_dados->font_size       = '10pt';


    $estilo_dados->show();
    $estilo_cabecalho->show();



    $tabela = new TTable; // instancia objeto tabela
    // define algumas propriedades da tabela
    $tabela->width = 700;
    $tabela->border= 1;
    $tabela->style = "border-collapse:collapse";



    // instancia uma linha para o cabeçalho
    $cabecalho = $tabela->addRow();

    // adiciona células
    $cabecalho->addCell('Valor dos Produtos');
    $cabecalho->addCell('Valor do ICMS');
    $cabecalho->addCell('Valor Substituição Tributária');
    $cabecalho->addCell('Valor IPI');
    $cabecalho->addCell('Valor Total NF');
    $cabecalho->class = 'cabecalho';

    // define a consulta
    $sql = "SELECT SUM(valor_produtos), SUM(valor_icms), SUM(valor_subst_trib), SUM(valor_ipi), SUM(valor_pis), SUM(valor_pis), SUM(valor_cofins), SUM(valor_nf) FROM nfs_entrada";


    $result = $conn->query($sql); // executa a instrução SQL


    // inicializa variáveis de controle e totalização
    $colore = FALSE;

    // percorre os resultados
    foreach ($result as $row)
    {
        // verifica qual cor irá utilizar para o fundo
        $bgcolor = $colore ? '#d0d0d0' : '#ffffff';

        // adiciona uma linha para os dados
        $linha = $tabela->addRow();
        $linha->bgcolor = $bgcolor;
        $linha->class = 'dados';

        // adiciona as células
        $cell1 = $linha->addCell($row['SUM(valor_produtos)']);
        $cell2 = $linha->addCell($row['SUM(valor_icms)']);
        $cell3 = $linha->addCell($row['SUM(valor_subst_trib)']);
        $cell4 = $linha->addCell($row['SUM(valor_ipi)']);
        $cell5 = $linha->addCell($row['SUM(valor_nf)']);

        // define o alinhamento das células
        $cell1->align = 'right';
        $cell2->align = 'right';
        $cell3->align = 'right';
        $cell4->align = 'right';
        
        $cell5->align = 'right';

      
        $colore = !$colore; // inverte cor de fundo
    }


    $tabela->show();
}
catch (Exception $e)
{
    echo $e->getMessage(); // exibe a mensagem de erro
}

?>

        </div>

        <div class="hero-unit">
            
            <h2>Totalizador de Impostos de Saída - Mês Atual</h2>
            <?php



try
{
    $conn = TConnection::open('xmlparser'); // abre uma conexão

    // cria um estilo para o cabeçalho
    $estilo_cabecalho = new TStyle('cabecalho');
    $estilo_cabecalho->font_family     = 'arial,verdana,sans-serif';
    $estilo_cabecalho->font_style      = 'normal';
    $estilo_cabecalho->font_weight     = 'bold';
    $estilo_cabecalho->color           = '#ffffff';
    $estilo_cabecalho->text_decoration = 'none';
    $estilo_cabecalho->background_color= '#825046';
    $estilo_cabecalho->font_size       = '10pt';

    // cria um estilo para os dados
    $estilo_dados = new TStyle('dados');
    $estilo_dados->font_family     = 'arial,verdana,sans-serif';
    $estilo_dados->font_style      = 'bold';
  
    $estilo_dados->color           = '#ffffff';
    $estilo_dados->background_color = '#757575';
    $estilo_dados->text_decoration = 'none';
    $estilo_dados->font_size       = '10pt';

  
    $estilo_dados->show();
    $estilo_cabecalho->show();

    

    $tabela = new TTable; // instancia objeto tabela
    // define algumas propriedades da tabela
    $tabela->width = 700;
    $tabela->border= 1;
    $tabela->style = "border-collapse:collapse";



    // instancia uma linha para o cabeçalho
    $cabecalho = $tabela->addRow();

    // adiciona células
    $cabecalho->addCell('Valor dos Produtos');
    $cabecalho->addCell('Valor do ICMS');
    $cabecalho->addCell('Valor Substituição Tributária');
    $cabecalho->addCell('Valor IPI');
    $cabecalho->addCell('Valor PIS');
    $cabecalho->addCell('Valor COFINS');
    $cabecalho->addCell('Valor Total NF');
    $cabecalho->class = 'cabecalho';

    // define a consulta, trazendo apenas os registros do mes corrente apenas das naturezas de operação que possuem venda na descricão:
    $sql = "SELECT SUM(valor_produtos), SUM(valor_icms), SUM(valor_subst_trib), SUM(valor_ipi), SUM(valor_pis), SUM(valor_pis), SUM(valor_cofins), SUM(valor_nf), data_inclusao_nf FROM nfs_saida
        WHERE natureza_operacao LIKE '%venda%' AND MONTH(CURDATE())";

    $result = $conn->query($sql); // executa a instrução SQL


    // inicializa variáveis de controle e totalização
    $colore = FALSE;

    // percorre os resultados
    foreach ($result as $row)
    {
        // verifica qual cor irá utilizar para o fundo
        $bgcolor = $colore ? '#d0d0d0' : '#ffffff';
        
        // adiciona uma linha para os dados
        $linha = $tabela->addRow();
        $linha->bgcolor = $bgcolor;
        $linha->class = 'dados';

        // adiciona as células
        $cell1 = $linha->addCell($row['SUM(valor_produtos)']);
        $cell2 = $linha->addCell($row['SUM(valor_icms)']);
        $cell3 = $linha->addCell($row['SUM(valor_subst_trib)']);
        $cell4 = $linha->addCell($row['SUM(valor_ipi)']);
        $cell5 = $linha->addCell($row['SUM(valor_pis)']);
        $cell6 = $linha->addCell($row['SUM(valor_cofins)']);
        $cell7 = $linha->addCell($row['SUM(valor_nf)']);
        // define o alinhamento das células
        $cell1->align = 'right';
        $cell2->align = 'right';
        $cell3->align = 'right';
        $cell4->align = 'right';
        $cell5->align = 'right';
        $cell6->align = 'right';
        $cell7->align = 'right';

        $colore = !$colore; // inverte cor de fundo
    }


    $tabela->show();

}
catch (Exception $e)
{
    echo $e->getMessage(); // exibe a mensagem de erro
}

?>

        </div>

         <!-- Fim da div geral da pagina-->




      <footer>
        <p>&copy; </p>
      </footer>



  </body>
</html>
