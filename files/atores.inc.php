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

		$str .=  $MC->tagsConteudo('div','col-12 alertNit alertNit-vermelho text-center','Ações realizadas por: '.$MC->tagsConteudo('b',NULL,$sec_atores));
		$where = "WHERE actor LIKE '%$sec_atores%'";
		$consPorAtor = $CONSQL->simplesQuery("*",'github_logs',$where);
		
			$str .= $MC->tags('table','table table-sm');
			$str .= $MC->tags('tr');
			$str .= $MC->tagsConteudo('td width="30%"');
			$str .= $MC->tagsConteudo('td','text-center',$UT->menuSelect());
			$str .= $MC->tagsConteudo('td width="5%"');
			$str .= $MC->tagsConteudo('td','text-center',$UT->menuAtores());
			$str .= $MC->tagsConteudo('td width="30%	"');
			$str .= $MC->tags('/tr');
			$str .= $MC->tags('/table');
			
			$str .= $MC->tags('table','table table-striped table-bordered table-dark table-sm');
		
							$meuTexto = array(
							array('th width="3%"','alert-dark ','#'),
							array('th width="10%"','alert-dark text-center text-info','Quem fez?'),
							array('th width="15%"','alert-dark text-center','O que fez?'),
							array('th width="30%"','alert-dark text-center text-success','Onde?'),
							array('th width="15%"','alert-dark text-center text-danger','Quando?')	
							);
							$str .=  $MC->arrayTags($meuTexto);			

			$i = 1;
		while ($ATOR = $FetchArray($consPorAtor)){
			$exibeData =date("d/m/Y H:i:s", substr($ATOR["created_at"], 0, 10));
			$str .= $MC->tags('tr');
			$str .= $MC->tagsConteudo('td',NULL,$i);
			$str .= $MC->tagsConteudo('td',NULL,$ATOR["actor"]);
			$str .= $MC->tagsConteudo('td',NULL,$ATOR["action"]);
			$str .= $MC->tagsConteudo('td',NULL,$ATOR["repo"]);
			$str .= $MC->tagsConteudo('td','text-center',$exibeData);
			$str .= $MC->tags('/tr');
			$i++;
		}
		$str .= $MC->tags('/table');
?>