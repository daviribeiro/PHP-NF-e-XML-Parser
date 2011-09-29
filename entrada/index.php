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


    <div class="container">
      <div class="hero-unit">
          
        <h2>Selecione o Arquivo XML encaminhado pelo fornecedor:</h2>
        <form action="recebe_upload_entrada.php" method="post" enctype="multipart/form-data">
        <fieldset>
    		<p><label>Arquivo:</label><input type="file" name="arquivo" /></p>
    		<p><button class="btn primary large" type="submit" onClick="alert('Processamento da NF-e de Entrada Concluido com Sucesso!')">Carregar</button></p>
    	</fieldset>
        </form>
                   
    </div>


      <footer>
        <p>&copy; </p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
