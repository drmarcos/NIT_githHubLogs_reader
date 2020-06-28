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
@
@ This program is not a free software; you cannot redistribute it and/or modify  
@                                                                       
@---------------------------------------------------------------------------------------------------------- */
$blockMenuP = 0;
if($blockMenuP == 0){
	function BlocamosRecursosJS($pagina){if(basename($_SERVER["PHP_SELF"])==$pagina){exit(@header('Location: ../erro/erro404.php'));}}
	BlocamosRecursosJS('chama.arquivos.complementos.php');	
}
if($chamaMenuResponsivo == "ChameMenuPadraoResponsivo"){	
print('
   <link rel="stylesheet" href="'.$CFG->caminhoTemas.'/css/menu_responsivo.css">
   <script src="'.$CFG->caminhoRepositorio.'/js/jquery-latest.min.js" type="text/javascript"></script>
   <script src="'.$CFG->caminhoRepositorio.'/js/menu_responsivo/script.js"></script>
');
}
?>