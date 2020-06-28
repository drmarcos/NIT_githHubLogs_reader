<?php
/*--------------------------------------------------------------------------------------------------------- *
@		SISTEMA DE GERENCIAMENTO DE CONTEÚDOS PARA SITES INTEGRADO AO MOODLE, 
@		VENDA DE CURSOS E MATRÍCULAS AUTOMATIZADAS 
@		{SOORDLE - SGCS - CMS}    	 
@		Idioma: Português - Brasil	            						 
@		Autor: 	Oliveira M.J.N
@		Contato:  soordle @ gmail dot com							                     								 	 
@       © todos os direitos reservados desde 2007  
@       VERSÃO 1.0
@       XAMALEON © um sistema para pré-inscrições online (recurso integrante do Projeto SOORDLE)
@ 		LECTORIBUS © um sistema complementar para ensino a distância (recurso integrante do Projeto SOORDLE) CRIADO EM AGOSTO DE 2013
@		OWPOGA Sistema de gerenciamento de jogos, ranking e realizações de tarefas, um elaborado projeto complementar para educação presencial e a distância.
@  
@ ---------------------------------------------------------------------------------------------------------- *
@ NOTICE OF COPYRIGHT -------------------------------------------------------------------------------------- *
@ ---------------------------------------------------------------------------------------------------------- *
@
@ Copyright (C) 2007  Oliveira M.J.N  http://www.eadgames.com.br        
@ Copyright (C) 2012  Oliveira M.J.N  http://www.soordle.org
@ Copyright (C) 2014  Oliveira M.J.N  http://www.owpoga.com                   
@	® This system and all its contents are protected by copyright laws direios (computer program record)  protocol BR 51 2015 000135 3
@ This program is not a free software; you cannot redistribute it and/or modify  
@                                                                       
@---------------------------------------------------------------------------------------------------------- */

	function BlocaCham($pagina){if(basename($_SERVER["PHP_SELF"])==$pagina){exit(header('Location: ../erro/erro404.php'));}}
	BlocaCham('chamaArquivos.class.php');	

class chamaArquivos{
	
	public function incluir($caminho){
		global $INCLUDE;
		include($INCLUDE."$caminho");
		return;
	}
	

	public function chamaCSS($recurso){
		$str = ('<link rel="stylesheet" type="text/css"  href="'.$recurso.'">'."\n".'');
		return $str;
	}

	function chamaArquivoRepositorio($caminho,$arquivo){
		$str = NULL;
		$str .= ('<script src="'.$caminho.'/repositorio/js/'.$arquivo.'" type="text/javascript"></script>');
		return $str;
	}
	
	function jquery($caminho){		
		print"\n\t<script type='text/javascript' src='$caminho/includes/js/jquery-1.4.2.min.js'></script>";
	}
	function jQuerylatestMin($caminho){
		print ('<script src="'.$caminho.'/includes/js/jquery-latest.min.js" type="text/javascript"></script>');
	}

	
	function jValidate($caminho){		
		print"\n\t<script type=\"text/javascript\" src=\"$caminho/includes/js/jquery.validate.js\"></script>";
		/*print"\n\t<script type='text/javascript' src='$caminho/includes/js/jquery.validate.min.js'></script>";*/
	}
	function filtroInput($caminho){		
		print"\n\t<script type=\"text/javascript\" src=\"$caminho/includes/js/jquery.filter_input.js\"></script>\n\t";
	}
	public function chamaJsMenuPrinc($caminho){
		$str = "\n\t<script type='text/javascript' src='$caminho/includes/js/jquery-1.4.2.min.js'></script>";
		$str .= "\n\t<script type='text/javascript' src='$caminho/includes/js/menu/ddsmoothmenu.js'></script>";
		return $str;						
		/***********************************************
		* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
		* This notice MUST stay intact for legal use
		* Visit Dynamic Drive at ?acao=$sec_acao/ for full source code
		***********************************************/					
	}
	function mascara($caminho){		
		print "\n\t<script type='text/javascript' src='$caminho/includes/js/jquery.maskedinput.js'></script>";
						
	}
	function marcaDagua($caminho){		
		print"\n\t<script type='text/javascript' src='$caminho/includes/js/jquery.watermarkinput.js'></script>";
	}	
	
	public function chamaGaleria($caminho){
		if($_SESSION['idioma'] != "pt_br"){
			$str = "\n\t<script type='text/javascript' src='$caminho/includes/js/ge1doot.js'></script>";
			$str .= "\n\t<script type='text/javascript' src='$caminho/includes/js/galeria.us_us.js'></script>";
		}else{			
			$str = "\n\t<script type='text/javascript' src='$caminho/includes/js/ge1doot.js'></script>";
			$str .= "\n\t<script type='text/javascript' src='$caminho/includes/js/galeriaprincipal.js'></script>";
		}
		print $str;
	}	
	
	public function ckeditor($caminho){		
		print'<script type="text/javascript" src="'.$caminho.'/repositorio/js/ckeditor/ckeditor.js"></script>';
	}					
}
?>