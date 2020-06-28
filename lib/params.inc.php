<?php
/*--------------------------------------------------------------------------------------------------------- *
@ 	 
@		Idioma: Português - Brasil	            						 
@		Autor: 	Marcos J.N. Oliveira 
@		Contato:  owpoga @ gmail dot com							                     								 	 
@       © 2020  
@       VERSÃO 1.0
@  
@ ---------------------------------------------------------------------------------------------------------- *
@ NOTICE OF COPYRIGHT -------------------------------------------------------------------------------------- *
@ ---------------------------------------------------------------------------------------------------------- *
@
@ Copyright (C) 2020  Oliveira M.J.N  http://www.owpoga.com   
@ Núcleo de Inovação Tecnologica (Escola de Saúde Pública do Ceará - ESPCE)          
@           
@ This program is a free software; you can redistribute it and/or modify  
@
@                    GNU GENERAL PUBLIC LICENSE
@                      Version 3, 29 June 2007
@
@ 			Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
@ 			Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed.                                                                       
@
@
@---------------------------------------------------------------------------------------------------------- */
$blockParam = 0;
if($blockParam == 0){
	function BlocaParam($pagina){if(basename($_SERVER["PHP_SELF"])==$pagina){exit(@header('Location: ../erro/erro404.php'));}}
	BlocaParam('params.inc.php');	
}
/* ---------------------------------------------------------------------------------------------- */
//PARAMETROS PARA O SISTEMA
/* ---------------------------------------------------------------------------------------------- */
extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS, 'sec');

/* ---------------------------------------------------------------------------------------------- */
// ELIMINA A NECESSIDADE DE FAZER INCLUDES PARA QUALQUER ARQUIVO DE UMA CLASSE ] 
/* ---------------------------------------------------------------------------------------------- */

function __autoload($classe){
	global $INCLUDE,$tokenSite;
		include_once ("$INCLUDE/lib/{$classe}.class.php");
}

$MC = new myClass;
$SQL = new clausulas_sql;
$CONSQL = new consultasSql;
$UT = new utilitarios;
$FORM = new formularios;
$MSG = new mensagens;
$INC = new chamaArquivos;

$hidden = 'text';

switch($banco){
		case  "mysql":
		if($versaoMysql == 'li'){
			$ConectaBD = "mysqli_connect";
			$SelecionaDB = "mysqli_select_db";
			$MinhaQuery = "mysqli_query";
			$FetchArray = "mysqli_fetch_array";
			$FetchObject = "mysqli_fetch_object";
			$FetchAssoc = "mysqli_fetch_assoc";
			$NumRows = "mysqli_num_rows";
			$BdErro = "mysqli_error";
			$fechaConexao = "mysqli_close";
			$MeuResult = "mysqli_result";
			$dbErro = "mysqli_error";
			$FreeResult = "mysqli_free_result";
			$RealScapeString = "mysqli_real_escape_string";				
		}else{			
			$ConectaBD = "mysql_connect";
			$SelecionaDB = "mysql_select_db";
			$MinhaQuery = "mysql_query";
			$FetchArray = "mysql_fetch_array";
			$FetchObject = "mysql_fetch_object";
			$NumRows = "mysql_num_rows";
			$BdErro = "mysql_error";
			$fechaConexao = "mysql_close";
			$MeuResult = "mysql_result";
			$dbErro = "mysql_error";
			$FreeResult = "mysql_free_result";
			$RealScapeString = "mysql_real_escape_string";
			$FetchAssoc = "mysql_fetch_assoc";
		}	
		break;
		case  "postgres":
		$ConectaBD = "pg_connect";
		$SelecionaDB = "pg_select_db";
		$MinhaQuery = "pg_query";
		$FetchArray = "pg_fetch_array";
		$FetchObject = "pg_fetch_object";
		$FetchAssoc = "pg_fetch_assoc";
		$NumRows = "pg_num_rows";
		$BdErro = "pg_error";
		$fechaConexao = "pg_close";
		$MeuResult = "pg_result";
		$dbErro = "pg_error";
		$FreeResult = "pg_free_result";
		$RealScapeString = "pg_real_escape_string";			
		break;
		case  "mssql":	
		$ConectaBD = "mssql_connect";
		$SelecionaDB = "mssql_select_db";
		$MinhaQuery = "mssql_query";
		$FetchArray = "mssql_fetch_array";
		$FetchObject = "mssql_fetch_object";
		$NumRows = "mssql_num_rows";
		$BdErro = "mssql_error";
		$fechaConexao = "mssql_close";
		$MeuResult = "mssql_result";
		$dbErro = "mssql_error";
		$FreeResult = "mssql_free_result";
		$RealScapeString = "mssql_real_escape_string";	
		break;
		case  "oracle":
		$ConectaBD = "oci_connect";
		$SelecionaDB = "oci_select_db";
		$MinhaQuery = "oci_query";
		$FetchArray = "oci_fetch_array";
		$FetchObject = "oci_fetch_object";
		$NumRows = "oci_num_rows";
		$BdErro = "oci_error";
		$fechaConexao = "oci_close";
		$MeuResult = "oci_result";
		$dbErro = "oci_error";
		$FreeResult = "oci_free_result";
		$RealScapeString = "oci_real_escape_string";			
		break;
		default :
		$ConectaBD = "";
		$SelecionaDB = "";
		$MinhaQuery = "";
		$FetchArray = "";
		$FetchObject = "";
		$NumRows = "";
		$BdErro = "";
		$fechaConexao = "";
		$MeuResult = "";
		$dbErro = "";
		$FreeResult = "";
		$RealScapeString = "";		
		break;
	}


$SQL->conectaBD($dbname);
?>