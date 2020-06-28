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
$exibeDebug = NULL;
		$str .=  $MC->tagsConteudo('div','col-12 alertNit alertNit-1 text-center','Ações realizadas '.$MC->tagsConteudo('b',NULL,'Geral'));
			if(!isset($sec_valor)){$sec_valor = "repo.create";}	
					
				$where = "WHERE action LIKE '%$sec_valor%'";

				$cons = $CONSQL->simplesQuery("*",'github_logs',$where);
		
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
							array('th width="20%"','alert-dark text-center text-info','Quem fez?'),
							array('th width="20%"','alert-dark text-center','O que fez?'),
							array('th width="35%"','alert-dark text-center',$MC->tagsConteudo('span','text-success','#Onde? #O que? #Quem?')),
							array('th width="15%"','alert-dark text-center text-danger','Quando?')			
							);
							$str .=  $MC->arrayTags($meuTexto);	
			$userAnterior = NULL;
			$i = 1;
			while($RES = $FetchArray($cons)){
		
				$exibeData =date("d/m/Y H:i:s", substr($RES["created_at"], 0, 10));
				$userAtual = $RES["actor"];
				$str .= $MC->tags('tr');		
				$str .= $MC->tagsConteudo('td',NULL,$i);
				if($userAnterior != $userAtual){						
						$str .= $MC->tagsConteudo('td',NULL,$RES["actor"]);
				}else{
				if($userAtual == ''){
					
					$str .= $MC->tagsConteudo('td','text-2','Não revelado');			
				}else{
					
					$str .= $MC->tagsConteudo('td','text-center',$MC->tagsConteudo('span','text-1','"'));			
				}
				}
				$str .= $MC->tagsConteudo('td',NULL,$RES["action"]);

/* ----------------------------------------- [ TRATAMENTO DE VALORES PARA EXIBIÇÃO ] ----------------------------------------------------- */

				//$str .= $UT->valorBuscaColuna($sec_valor);
				$completaWhere = NULL;
				
				if(($sec_valor == "org.invite_member")
				||($sec_valor == "org.cancel_invitation"))
					{$completaWhere = " AND user != ''";}
				
				if(($sec_valor == "project.close")
				||($sec_valor == "project.create")
				||($sec_valor == "project.open")
				||($sec_valor == "project.rename"))
					{$completaWhere = " AND repo != ''";}
				
				$where = "WHERE `action` LIKE '%$sec_valor%'$completaWhere";
				
				$consAcoes = $CONSQL->simplesQuery("*",'github_logs',$where);
				$breca = 0;
				$RESULT = $FetchObject($consAcoes);
/* ----------------------------------------------------------------------------------------------------------------- */

if(($RESULT->user != '')&&($RESULT->org != '')&&($RESULT->repo == '')&&($RESULT->team == '')){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 1');}
	
		$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["user"].' }'.$exibeDebug).$MC->tagsConteudo('div',NULL,$RES["org"]));
		$breca = 1;
	}

/* ----------------------------------------------------------------------------------------------------------------- */

	if(($RESULT->user != '')&&($RESULT->repo != '')&&($RESULT->repo != '')){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 2');}
			
		$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["user"].' }'.$exibeDebug).$MC->tagsConteudo('div',NULL,$RES["repo"]));
		$breca = 1;
	}
	

/* ----------------------------------------------------------------------------------------------------------------- */

if(($RESULT->user != '')&&($RESULT->team != '')){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 3');}
	
	$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["user"].' }'.$exibeDebug).$MC->tagsConteudo('div',NULL,$RES["team"]));
	$breca = 1;
	}

/* ----------------------------------------------------------------------------------------------------------------- */

if(($RESULT->repo != '')&&($RESULT->team != '')&&($RESULT->user != '')){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 4');}
		
	$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["repo"].' }'.$exibeDebug).$MC->tagsConteudo('div',NULL,$RES["team"]));
	$breca = 1;
	}

/* ----------------------------------------------------------------------------------------------------------------- */

if($sec_valor != "project.close"){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 5');}	
	
	if($RES["repo"] != ''){		
	$repositorio = explode('/',$RES["repo"]);
	if(($RESULT->user == '')&&($RESULT->repo != '')){
		$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('i','text-2min',$repositorio[0]).'/'.$repositorio[1].$exibeDebug);
		$breca = 1;
	}
	}else{
	if(($RESULT->user == '')&&($RESULT->repo != '')){
		$str .= $MC->tagsConteudo('td','text-left',$RES["repo"].$exibeDebug);
		$breca = 1;}		
	}
}//$sec_valor


/* ----------------------------------------------------------------------------------------------------------------- */
		
if(($RESULT->org != '')&&($RESULT->team == '')&&($RESULT->repo == '')&&($breca != 1)){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 6');}

	$str .= $MC->tagsConteudo('td','text-left',$RES["org"].$exibeDebug);
	$breca = 1;
	}

/* ----------------------------------------------------------------------------------------------------------------- */

if(($RESULT->org != '')&&($RESULT->team == '')&&($RESULT->repo != '')&&($breca != 1)){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 7');}	
	$str .= $MSG->alertaSwal('Entrei',"Passagem número 7",'success');
	if($sec_valor == "project.close"){
	if($RES["repo"] != ''){		
		$repositorio = explode('/',$RES["repo"]);
		$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('i','text-2min',$RES["org"].'/').$repositorio[1].$exibeDebug);
	}else{
		$str .= $MC->tagsConteudo('td','text-left',$RES["repo"].$exibeDebug);
	}
	$breca = 1;
	}
}
if(($RESULT->team != '')&&($breca != 1)){

/* ---------------------------------------- [ DEBUG ] -------------------------------------------------------------- */	
	if($DEBUG != 0){$exibeDebug = $MC->tagsConteudo('span','text-danger',$MC->espaco(2).'Debug Ativado: Entrei 8');}

	$str .= $MSG->alertaSwal('Entrei',"Passagem número 8",'success');
		$repositorio = explode('/',$RES["team"]);
		$str .= $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('i','text-2min',$repositorio[0]).'/'.$repositorio[1].$exibeDebug);
		}



					
				//print $str;
				//exit('OOoops!');		
/* --------------------------------------------------------------------------------------------------------------------------------------- */

				$str .= $MC->tagsConteudo('td','text-center',$exibeData);
				$str .= $MC->tags('/tr');
				$i++;
				$userAnterior = $userAtual;
			}
			$str .= $MC->tags('/table');

?>