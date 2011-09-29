<?php 
/** 
 * classe TTable 
 * responsсvel pela exibiчуo de tabelas 
 */ 
class TTable extends TElement 
{ 
    /** 
     * mщtodo construtor 
     * Instancia uma nova tabela 
     */ 
    public function __construct() 
    { 
        parent::__construct('table'); 
    } 

    /** 
     * mщtodo addRow 
     * Agrega um novo objeto linha (TTableRow) na tabela 
     */ 
    public function addRow() 
    { 
        // instancia objeto linha 
        $row = new TTableRow; 
        // armazena no aray de linhas 
        parent::add($row); 
        return $row; 
    } 
} 
?>