<?php
/*--------------------------------------------------------------------------------------------------------- *
@		SISTEMA DE GERENCIAMENTO DE CONTEÃšDOS PARA SITES INTEGRADO AO MOODLE, 
@		VENDA DE CURSOS E MATRÃCULAS AUTOMATIZADAS 
@		{SOORDLE - SGCS - CMS}    	 
@		Idioma: PortuguÃªs - Brasil	            						 
@		Autor: 	Oliveira M.J.N
@		Contato: <soordle@gmail.com>							                     								 	 
@       Â© todos os direitos reservados desde 2007  
@       VERSÃƒO 1.0
@       XAMALEON Ã© um sistema para prÃ©-inscriÃ§Ãµes online (recurso integrante do Projeto SOORDLE)
@ 		LECTORIBUS Ã© um sistema complementar para ensino a distÃ¢ncia (recurso integrante do Projeto SOORDLE) CRIADO EM AGOSTO DE 2013
@
@ ---------------------------------------------------------------------------------------------------------- *
@ NOTICE OF COPYRIGHT -------------------------------------------------------------------------------------- *
@ ---------------------------------------------------------------------------------------------------------- *
@
@ Copyright (C) 2007  Oliveira M.J.N  http://www.eadgames.com.br        
@ Copyright (C) 2012  Oliveira M.J.N  http://www.soordle.org                    
@
@ This program is free software; you can redistribute it and/or modify  
@ it under the terms of the GNU General Public License as published by  
@ the Free Software Foundation; either version 2 of the License, or     
@ (at your option) any later version.                                   
@
@ This program is distributed in the hope that it will be useful,       
@ but WITHOUT ANY WARRANTY; without even the implied warranty of        
@ MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         
@ GNU General Public License for more details:                          
@
@          http://www.gnu.org/copyleft/gpl.html                         
@                                                                       
@---------------------------------------------------------------------------------------------------------- */
//-------------------------- CLASSE BD ------------------------------------->

class clausulas_sql
{
    /**
    * @param string $clausula_sql;
    * @access public
    */
    var $clausula_sql;

//-------------------------- INSERIR REGISTROS ----------------------------->

    /**
    * Cria cláusulas SQL INSERT
    *
    * @param string $tabela
    * @param array $campos
    * @param array $valores
    * @author Alfred Reinold Baudisch
    * @date Jan 05, 2004
    *
    * @access public
    */
	function conectaBD(){
		if($GLOBALS['versaoMysql'] == 'li'){			
			$con = $GLOBALS['ConectaBD']($GLOBALS['SERVER'],$GLOBALS['USUARIO_BD'],$GLOBALS['SENHA_BD'],$GLOBALS['dbname']) or ("Cannot connect!"  . mysql_error());
			$GLOBALS['MinhaQuery']($con,"SET NAMES utf8");
			if (!$con)exit('Could not connect: ' . mysqli_error());
		}else{
			$con = $GLOBALS['ConectaBD']($GLOBALS['SERVER'],$GLOBALS['USUARIO_BD'],$GLOBALS['SENHA_BD']) or ("Cannot connect!"  . mysql_error());
			$GLOBALS['SelecionaDB']($GLOBALS['dbname'] , $con) or die ("could not load the database" . mysql_error());
			$GLOBALS['MinhaQuery']("SET NAMES utf8");
			if (!$con)exit('Could not connect: ' . mysql_error());			
		}
		return $con;		
	}
/* ----------------------------------------- [ CONEXÃO COM O BANCO DE DADOS DOS CURSOS ] ----------------------------------------- */	
	function conectaBD2(){
		if($GLOBALS['versaoMysql'] == 'li'){			
			$con = $GLOBALS['ConectaBD']($GLOBALS['SERVER'],$GLOBALS['USUARIO_BD2'],$GLOBALS['SENHA_BD2'],$GLOBALS['dbname2']) or ("Cannot connect!"  . mysql_error());
			$GLOBALS['MinhaQuery']($con,"SET NAMES utf8");
			if (!$con)exit('Could not connect: ' . mysqli_error());
		}else{
			$con = $GLOBALS['ConectaBD']($GLOBALS['SERVER'],$GLOBALS['USUARIO_BD2'],$GLOBALS['SENHA_BD2']) or ("Cannot connect!"  . mysql_error());
			$GLOBALS['SelecionaDB']($GLOBALS['dbname2'] , $con) or die ("could not load the database" . mysql_error());
			$GLOBALS['MinhaQuery']("SET NAMES utf8");
			if (!$con)exit('Could not connect: ' . mysql_error());			
		}
		return $con;		
	}
/*	function closeBd(){
		$GLOBALS['fechaConexao']();
	}*/
    function gera_insert($tabela, $campos, $valores)
    {
        $this->clausula_sql = "INSERT INTO " . $tabela . " (";
        
        $quantidade_campos = count($campos);        

        for($i = 0; $i < $quantidade_campos; ++$i)
        {
            $this->clausula_sql .= $campos[$i];

            if($i < ($quantidade_campos-1))
            {
                $this->clausula_sql .= ", ";
            }
        }
        
        $this->clausula_sql .= ") VALUES (";

        for($i = 0; $i < $quantidade_campos; ++$i)
        {
            $this->clausula_sql .= 
		clausulas_sql::escreve_valor($valores[$i], $i, $quantidade_campos);
        }

        $this->clausula_sql .= ");";        

        return $this->clausula_sql;
    }

//-------------------------- EDITAR REGISTROS ----------------------------->

    /**
    * Cria cláusulas SQL UPDATE
    *
    * @param string $tabela
    * @param array $campos
    * @param array $valores
    * @param string $sentenca
    * @author Alfred Reinold Baudisch
    * @date Jan 05, 2004
    *
    * @access public
    */
    function gera_update($tabela, $campos, $valores, $sentenca)
    {
        $this->clausula_sql = "UPDATE " . $tabela . " SET ";

        $quantidade_campos = count($campos);

        for($i = 0; $i < $quantidade_campos; ++$i)
        {
            $this->clausula_sql .= $campos[$i] . " = ";
            $this->clausula_sql .= 
		clausulas_sql::escreve_valor($valores[$i], $i, $quantidade_campos);
        }
        
        $this->clausula_sql .= " " . $sentenca . ";";

        return $this->clausula_sql;
    }
/* exemplo de uso
$CONDICAO1 = "ID_BLOG = '$sec_idPost' AND COD_REFERENCIA = '$sec_codReferenciaBlog'";	
$camposUpdate = array("ID_CATEGORIA","ID_AUTOR","AUTOR","TITULO","DESCRICAO","TAGS","TEXTO","COMENTARIO","LINK_SOURCE","IMAGEM","STATUS","DATA","HITS","IDIOMA","COD_REFERENCIA");
$dadosUpdate = array("$sec_categoria","$idAutor","$sec_autorCadBlog","$sec_nomeCadBlog","$sec_descricaoCadBlog","$sec_tagsCadBlog","$sec_textoCadBlog","$sec_comentarioCadBlog","$sec_fonteRecursoCadBlog","$sec_bannerCadBlog","$sec_statusCadBlog","$sec_dataCadBlog","$sec_hitsCadBlog","$sec_idiomaCadBlog","$sec_codReferenciaBlog");	

$update = $sql->gera_update($tabela, $camposUpdate, $dadosUpdate,"WHERE $CONDICAO1");
$result = $GLOBALS['MinhaQuery']($update);
*/
    /**
    * Retorna um valor formatado para se inserir na query SQL
    *
    * @param mix $valor
    * @param int $atual
    * @param int $total
    * @author Alfred Reinold Baudisch
    * @date Jan 05, 2004
    *
    * @access private
    */
    function escreve_valor($valor, $atual, $total)
    {
        if(is_string($valor))
        {
            $retorno = "'" . $valor . "'";
        }
        elseif(empty($valor))
        {
            $retorno = "NULL";
        }
        else
        {
            $retorno = $valor;
        }

        if($atual < ($total-1))
        {
            $retorno .= ", ";
        }

        return $retorno;
    }
	
	public function acaoDeleta($TABELA,$CAMPO,$VAR){
	//print "DELETE FROM $TABELA WHERE $CAMPO='$VAR'";
				$sql = "DELETE FROM $TABELA WHERE $CAMPO='$VAR'";
						$resultado = $GLOBALS['MinhaQuery']($sql)
						or die ("Não foi possível excluir registro");			
			}	

}
?>