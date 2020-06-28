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

	$str .= $MC->tagsConteudo('div','container-fluid alert',$MC->tags('img src="./imagens/logo.png"'));
	$str .= $MC->tags('div','container-fluid');	
	$str .= $MC->tags('div','row');	
	$str .=  $MC->tagsConteudo('div','col-12 alert text-center text-1',"<h2><b>Leitor de logs do github Escola de Saúde Pública do Ceará - ESPCE</b></h2>".$UT->dataHoje());

/* --------------------------------------------------------------------------------------------------------------- */		
	
	if(isset($sec_atores)){
		include('files/atores.inc.php');
	}else{
		include('files/geral.inc.php');		
	}

/* --------------------------------------------------------------------------------------------------------------- */	
?>