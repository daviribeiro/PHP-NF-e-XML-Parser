<?php
/**
 * Escreve tabelas no formato PDF
 * @author Pablo Dall'Oglio
 */
class TTableWriterPDF implements ITableWriter
{
    private $styles;
    private $pdf;
    private $widths;
    private $colcounter;
    
    /**
     * Método construtor
     * @param $widths vetor contendo as larguras das colunas
     */
    public function __construct($widths)
    {
        // armazena as larguras
        $this->widths = $widths;
        // inicializa atributos
        $this->styles = array();
        
        // define o locale
        setlocale(LC_ALL, 'POSIX');
        // cria o objeto FPDF
        $this->pdf = new FPDF('P', 'pt', 'A4');
        $this->pdf->Open();
        $this->pdf->AddPage();
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
        $this->styles[$stylename] = array($fontface, $fontsize, $fontstyle, $fontcolor, $fillcolor);
    }
    
    /**
     * Aplica um estilo
     * @param $stylename nome do estilo
     */
    public function applyStyle($stylename)
    {
        // verifica se o estilo existe
        if (isset($this->styles[$stylename]))
        {
            $style = $this->styles[$stylename];
            // obtém os atributos do estilo
            $fontface    = $style[0];
            $fontsize    = $style[1];
            $fontstyle   = $style[2];
            $fontcolor   = $style[3];
            $fillcolor   = $style[4];
            
            // aplica os atributos do estilo
            $this->pdf->SetFont($fontface, $fontstyle); // fonte
            $this->pdf->SetFontSize($fontsize); // estilo
            $colorarray = self::rgb2int255($fontcolor);
            // cor do texto
            $this->pdf->SetTextColor($colorarray[0], $colorarray[1], $colorarray[2]);
            $colorarray = self::rgb2int255($fillcolor);
            // cor de preenchimento
            $this->pdf->SetFillColor($colorarray[0], $colorarray[1], $colorarray[2]);
        }
    }
    
    /**
     * Converte uma cor em RGB para um vetor de decimais
     * @param $rgb uma string contendo uma cor em RGB
     */
    private function rgb2int255($rgb)
    {
        $red   = hexdec(substr($rgb,1,2));
        $green = hexdec(substr($rgb,3,2));
        $blue  = hexdec(substr($rgb,5,2));
        
        return array($red, $green, $blue);
    }
    
    /**
     * Adiciona uma nova linha na tabela
     */
    public function addRow()
    {
        $this->pdf->Ln(); // quebra de linha
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
        $this->applyStyle($stylename); // aplica o estilo
        $fontsize = $this->styles[$stylename][1]; // obtém a fonte
        
        $width = 0;
        // calcula a largura da célula (incluindo as mescladas)
        for ($n=$this->colcounter; $n<$this->colcounter+$colspan; $n++)
        {
            $width += $this->widths[$n];
        }
        // exibe a célula com o conteúdo passado
        $this->pdf->Cell( $width, $fontsize * 1.5, $content, 1, 0, strtoupper(substr($align,0,1)), true);
        $this->colcounter ++;
    }
    
    /**
     * Armazena o conteúdo do documento em um arquivo
     * @param $filename caminho para o arquivo de saída
     */
    public function save($filename)
    {
        $this->pdf->Output($filename);
        return TRUE;
    }
}
?>