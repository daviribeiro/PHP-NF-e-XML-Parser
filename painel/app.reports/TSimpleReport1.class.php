<?php
/**
 * Classe para construção de relatórios tabulares simples
 * @author Pablo Dall'Oglio
 */
class TSimpleReport
{
    private $database;
    private $sql;
    private $writter;
    private $columns;
    
    /**
     * Método construtor
     */
    public function __construct()
    {
        $this->columns = array();
    }
    
    /**
     * Define o banco de dados para a consulta SQL
     * @param $database nome do banco de dados
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }
    
    /**
     * Define a consulta SQL para geração do relatório
     * @param $sql consulta em SQL
     */
    public function setQuery($sql)
    {
        $this->sql = $sql;
    }
    
    /**
     * Define um objeto "escritor" do relatório
     * @param $writter objeto que implementa a interface ITableWritter
     */
    public function setReportWritter($writter)
    {
        $this->writter = $writter;
    }
    
    /**
     * Adiciona uma coluna ao relatório
     * @param $alias nome da coluna na consulta SQL
     * @param $label rótulo do campo (título da coluna)
     * @param $align alinhamento da coluna
     */
    public function addColumn($alias, $label, $align)
    {
        $this->columns[] = array('alias'=>$alias, 'label'=>$label, 'align'=>$align);
    }
    
    /**
     * Gera o relatório
     */
    public function generate()
    {
        // verifica se foi definido o banco de dados
        if (!isset($this->database))
        {
            throw new Exception('Banco de dados não definido');
        }
        
        // verifica se foi definida a consulta SQL
        if (!isset($this->sql))
        {
            throw new Exception('Consulta SQL não definida');
        }
        
        // verifica se foi definido o escritor de tabelas
        if (!isset($this->writter))
        {
            throw new Exception('Escritor de tabelas não definido');
        }
        
        // verifica se foram definidas as colunas do relatório
        if (count($this->columns) == 0)
        {
            throw new Exception('Colunas do relatório não definidas');
        }
        
        // adiciona uma linha para o cabeçalho (títulos das colunas)
        $this->writter->addRow();
        foreach ($this->columns as $column)
        {
            // adiciona as colunas de cabeçalho
            $this->writter->addCell($column['label'], $column['align'], 'title');
        }
        
        $conn = TConnection::open($this->database); // abre conexão com a base de dados
        
        // executa a instrução SQL
        $result = $conn->query($this->sql);
        
        $colore = FALSE;
        // percorre os resultados
        foreach ($result as $row)
        {
            // define o estilo a ser utilizado
            $style = $colore ? 'datai' : 'datap';
            
            // adiciona uma linha para os dados
            $this->writter->addRow();
            
            // adiciona as colunas com os dados
            foreach ($this->columns as $column)
            {
                $alias   = $column['alias'];
                $content = $row[$alias];
                $this->writter->addCell($content, $column['align'], $style);
            }
            
            // alterna variável de controle para cor de fundo
            $colore = !$colore;
        }
    }
    
    /**
     * Armazena o relatório em um arquivo
     * @param $filename localização do arquivo
     */
    public function save($filename)
    {
        $this->writter->save($filename);
    }
}
?>