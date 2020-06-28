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

	$metaAutor = "Oliveira M.J.N www.owpoga.com"; 
	$usaTema = 'nit';
	
	$banco = "mysql";
	$versaoMysql = 'lino';
	$DEBUG = 0;
	$producao = 0;
	
	if($producao != 1){
	
		$SERVER = "localhost";
		$USUARIO_BD = "root";
		$SENHA_BD = "";
		$dbname = "ghlog";
		
/* -------------------------------------------------------------------------------------------------------------------------- */
	/* --- [ CAMINHO VIRUTAL ] ------------------------------- */
/* -------------------------------------------------------------------------------------------------------------------------- */
		$ROTA = "http://localhost/ghlog";
/* -------------------------------------------------------------------------------------------------------------------------- */
	/* --- [ CAMINHO FÍSICO ] -------------------------------- */
/* -------------------------------------------------------------------------------------------------------------------------- */
		$INCLUDE = "C:/xampp/htdocs/ghlog";	
	
	}else{
	error_reporting(0);
		ini_set("display_errors", 0 );
		$ROTA = "http://seusite.com/projetos/";
		$INCLUDE = "/home2/suaconta/public_html/seutie/ghlog";
		$SERVER = "localhost";
		$USUARIO_BD = "USUARIO";
		$SENHA_BD = "SENHA";
		$dbname = "BANCO";				
	}	

?>