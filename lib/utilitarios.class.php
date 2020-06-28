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
class utilitarios extends myClass{

/* -------------------------------------------------------------------------------------------------------------------- */											
/* -------------------------------------------------------------------------------------------------------------------- */											

	public function dataHoje(){
		$str = NULL;
		$str .= DATE('d/m/Y');
		return $str;
	}

/* -------------------------------------------------------------------------------------------------------------------- */											


/* -------------------------------------------------------------------------------------------------------------------- */

function corta_string($texto, $quantidade_caracteres, $string_complemento)
{
     $string_sem_espacos = trim($texto);
     
     $recorte_string = "";
     
     for ($i = 0;; $i++)
     {
      if (($quantidade_caracteres + $i) <= strlen($texto))
      {
                        
       $string_recortada = substr($string_sem_espacos, 0, $quantidade_caracteres + $i);
       
       if(substr($string_recortada, -1) == " ")
       {
        $recorte_string = substr($string_recortada, 0, -1) ."".$string_complemento;
        break;
       }
        
      }
      elseif (($quantidade_caracteres + $i) > strlen($texto))
      {
       $recorte_string = $texto;
       break;
      }
      
     }
     
     return $recorte_string;
  }
/* -------------------------------------------------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------------------------------------------------- */
		function exibeMes($mes){
			global $_JANEIRO,$_FEVEREIRO,$_MARCO,$_ABRIL,$_MAIO,$_JUNHO,$_JULHO,$_AGOSTO,$_SETEMBRO,$_OUTUBRO,	$_NOVEMBRO,$_DEZEMBRO; 			
			switch($mes){				
				case 1: 	$mes = $_JANEIRO; 	break;
				case 2: 	$mes = $_FEVEREIRO; break;
				case 3: 	$mes = $_MARCO; 	break;
				case 4: 	$mes = $_ABRIL; 	break;
				case 5: 	$mes = $_MAIO; 		break;
				case 6: 	$mes = $_JUNHO; 	break;
				case 7: 	$mes = $_JULHO; 	break;
				case 8: 	$mes = $_AGOSTO; 	break;
				case 9: 	$mes = $_SETEMBRO; 	break;
				case 10: 	$mes = $_OUTUBRO; 	break;
				case 11: 	$mes = $_NOVEMBRO; 	break;
				case 12: 	$mes = $_DEZEMBRO; 	break;
			}
			
			return $mes;
		}

/* --------------------------------------------------------------------------------------------------------------- */		
		function menuSelect(){
			global $FORM,$CONSQL,$FetchArray;
			$str = NULL;
			$str .= $FORM->abreForm('POST',NULL,'name="form1"');
				$txtSelecione = "Selecione uma opção";
				
				$str .= $this->tags('select name="valor" onchange="this.form.submit()"','form-control');
					//SELECT action FROM `github_logs` group by action
			$where = NULL;
			$agrupa	= "group by  action";
			$consAcoes = $CONSQL->simplesQuery("action",'github_logs',$where,$agrupa);

					$str .= $this->tagsConteudo('option value="Seleciona"',NULL,$txtSelecione);
						while($ACAO = $FetchArray($consAcoes)){
							$str .= $this->tagsConteudo('option value="'.$ACAO["action"].'"',NULL,$ACAO['action']);
						}									
							/*
							$str .= $this->tagsConteudo('option value="1"',NULL,'Repositorios criados');
							$str .= $this->tagsConteudo('option value="2"',NULL,'Membros adicionados');
							$str .= $this->tagsConteudo('option value="3"',NULL,'Labs');
							$str .= $this->tagsConteudo('option value="4"',NULL,'Times criados');
							$str .= $this->tagsConteudo('option value="5"',NULL,'Projetos criados');
							*/
				$str .= $this->tags('/select');
			$str .= $FORM->fechaForm();
			return $str;
		}//function
		

/* -------------------------------------------------------------------------------------------------------------------- */

		function menuAtores(){
		global $CONSQL,$FORM,$FetchArray;
		$str = NULL;
		$where = "WHERE actor != ''";
		$agrupa	= "group by actor";
		$consAtores = $CONSQL->simplesQuery("actor",'github_logs',$where,$agrupa);
				$str .= $FORM->abreForm('POST',NULL,'name="formAtor"');
					$txtSelecione = "Selecione uma pessoa";
					
					$str .= $this->tags('select name="atores" onchange="this.form.submit()"','form-control');
						$str .= $this->tagsConteudo('option value="Seleciona"',NULL,$txtSelecione);
						while($ATOR = $FetchArray($consAtores)){
							$str .= $this->tagsConteudo('option value="'.$ATOR["actor"].'"',NULL,$ATOR['actor']);
						}
							
					$str .= $this->tags('/select');
				$str .= $FORM->fechaForm();				
				return $str;
		}

/* -------------------------------------------------------------------------------------------------------------------- */

				function valorBuscaColuna($sec_valor){
					global $RES,$MC;
				switch($sec_valor){
					case "account.plan_change": 
					case "integration_installation.create": 
					case "integration_installation.repositories_added": 
					case "integration_installation.repositories_removed":
					case "org.audit_log_export":
					case "org.create": 			
					case "org.oauth_app_access_approved": 
					case "org.oauth_app_access_requested": 
					case "org.update_default_repository_permission":		
					case "org.update_terms_of_service":		
					case "organization_default_label.create":		
					case "organization_default_label.destroy":		
					case "organization_default_label.update":		
					case "profile_picture.update":		
					case "project.access":		
					$mostrar =  $MC->tagsConteudo('td','text-center',$RES["org"]); 
					break;				
		
					case "org.add_member": 
					case "org.cancel_invitation":
					case "org.invite_member": 
					case "org.remove_member": 
					case "org.update_member": 
					case "repository_vulnerability_alert.dismiss":
					case "repo.remove_member":
					$mostrar =  $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["user"].' }').$MC->tagsConteudo('div',NULL,$RES["org"])); 
					break;
					case "issue_comment.update": 
					$mostrar =  $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["actor"].' }').$MC->tagsConteudo('div',NULL,$RES["org"])); 
					break;
					
					case "repo.add_member":
					case "repo.update_member":
					$mostrar =  $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["user"].' }').$MC->tagsConteudo('div',NULL,$RES["repo"])); 
					break;
					
					case "team.add_member":
					case "team.remove_member":
					$mostrar =  $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["user"].' }').$MC->tagsConteudo('div',NULL,$RES["team"])); 
					break;
					
					case "team.add_repository":
					case "team.create":
					case "team.rename":				
					$mostrar =  $MC->tagsConteudo('td','text-left',$RES["team"]); 
					break;
					
					case "team.update_repository_permission":					
					$mostrar =  $MC->tagsConteudo('td','text-left',$MC->tagsConteudo('div','text-info','*{ '.$RES["repo"].' }').$MC->tagsConteudo('div',NULL,$RES["team"]));
					break;

					default :$mostrar =  $MC->tagsConteudo('td',NULL,$RES["repo"]); break;
				
				}
				return $mostrar;
				}//function	

/* -------------------------------------------------------------------------------------------------------------------- */
}//FECHA CLASS

?>