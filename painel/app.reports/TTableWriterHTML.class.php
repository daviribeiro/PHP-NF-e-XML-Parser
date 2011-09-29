<?php
/**
 * Escreve tabelas no formato HTML
 * @author Pablo Dall'Oglio
 */
class TTableWriterHTML implements ITableWriter
{
    private $styles;
    private $widths;
    private $colcounter;
    private $table;
    private $currentRow;
    
    /**
     * Método construtor
     * @param $widths vetor contendo as larguras das colunas
     */
    public function __construct($widths)
    {
        // armazena as larguras
        $this->widths = $widths;
        // inicializa atributos
        $this->tables = array();
        $this->styles = array();
        
        // cria uma nova tabela
        $this->table = new TTable;
        $this->table->cellspacing = 0;
        $this->table->cellpadding = 0;
        $this->table->style = "border-collapse:collapse";
    }
    
    /**
     * Adiciona um novo estilo
     * @param @stylename nome do estilo
     * @param @fontface  nome da fonte
     * @param @fontsize  tamanho da fonte
     * @param @fontstyle estilo da fonte (B=bold, I=italic)
     * @param @fontcolor cor da fonte
     * @param @fillcolor cor de preenchimento
     */
    public function addStyle($stylename, $fontface, $fontsize, $fontstyle, $fontcolor, $fillcolor)
    {
        // cria um novo estilo
        $style = new TStyle($stylename); 
        $style->font_family      = $fontface;
        $style->color            = $fontcolor;
        $style->background_color = $fillcolor;
        $style->border_top       = "1px solid #000000";
        $style->border_bottom    = "1px solid #000000";
        $style->border_left      = "1px solid #000000";
        $style->border_right     = "1px solid #000000";
        $style->font_size        = "{$fontsize}pt";
        // verifica se o estilo deve ser negrito
        if (strstr($fontstyle, 'B'))
        {
            $style->font_weight = 'bold';
        }
        // verifica se o estilo deve ser itálico
        if (strstr($fontstyle, 'I'))
        {
            $style->font_style = 'italic';
        }
        // armazena o objeto de estilo no vetor
        $this->styles[$stylename] = $style;
    }
    
    /**
     * Adiciona uma nova linha na tabela
     */
    public function addRow()
    {
        $this->currentRow = $this->table->addRow();
        $this->colcounter = 0;
    }
    
    /**
     * Adiciona uma nova célula na linha atual da tabela
     * @param $content   conteúdo da célula
     * @param $align     alinhamento da célula
     * @param $stylename nome do estilo a ser utilizado
     * @param $colspan   quantidade de células a serem mescladas 
     */
    public function addCell($content, $align, $stylename = NULL, $colspan = 1)
    {
        $width = 0;
        // calcula a largura da célula (incluindo as mescladas)
        for ($n=$this->colcounter; $n<$this->colcounter+$colspan; $n++)
        {
            $width += $this->widths[$n];
        }
        // adiciona a célula na linha corrente
        $cell = $this->currentRow->addCell($content);
        $cell->align     = $align;
        $cell->width     = $width-2;
        $cell->colspan   = $colspan;
        // atribui o estilo
        if ($stylename)
        {
            $cell->{"class"} = $stylename;
        }
        $this->colcounter ++;
    }
    
    /**
     * Armazena o conteúdo do documento em um arquivo
     * @param $filename caminho para o arquivo de saída
     */
    public function save($filename)
    {
        ob_start();
        echo "<html>\n";
        // insere os estilos no documento
        foreach ($this->styles as $style)
        {
            $style->show();
        }
        // inclui a tabela no documento
        $this->table->show();
        echo "</html>";
        $content = ob_get_clean();
        
        file_put_contents($filename, $content);
        return TRUE;
    }
}
?>