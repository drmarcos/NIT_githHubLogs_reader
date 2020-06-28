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
class myClass{
 	const EOF_LINE = "\n";
	const MOF_LINE = "\n\t\t";
	const MOFD_LINE = "\n\t";


/*------------------------------------------------------------------------------------------ */
	
	function tags($recurso,$class=NULL,$quantidade='1',$atributos=NULL){
		$str = '';
	if(($recurso{0} == "/")||(($recurso == "BR")||($recurso == "br"))){//NÃO LEMBRO PQ FIZ ISSO KKKKK! 
		//$str .= 'tem algo aqui';
		$classe = NULL;		
	}elseif($class != NULL){
		$classe = ' class="'.$class.'"';
	}else{
		$classe = NULL;		
	}
		for($i=0;$i<$quantidade;$i++){
			$str .= '<'.$recurso.' '.$classe.''.$atributos.'>';
		}
		return $str;
	}
	


/*------------------------------------------------------------------------------------------ */

	function arrayTags($array){
	$str = NULL;
	    foreach ($array as $value) {
	    	$str .= '<'.$value[0].' class="'.$value[1].'">';
	    	$str .= $value[2];
	    	$str .= '</'.$value[0].'>';
	    }					

		return $str;
	}	

	
/* -------------------------------------------------------------------------------------------------------- */	
	
	function espaco($quantidade='1'){
		$str = '';
		for($i=0;$i<$quantidade;$i++){
			$str .= '&nbsp;';
		}
		return $str;
	}
	
/* -------------------------------------------------------------------------------------------------------- */	
	
	function adBr($quantidade='1'){
		$str = '';
		for($i=0;$i<$quantidade;$i++){
			$str .= $this->tags('br');
		}
		return $str;
	}



/*------------------------------------------------------------------------------------------ */

	function tagsConteudo($usaTag,$classe=NULL,$conteudo=NULL){
		$str = NULL;
		$usaTagArr = explode(' ',$usaTag);		
		$str .= $this->tags($usaTag,$classe).$conteudo.$this->tags('/'.$usaTagArr[0]);
		return $str;
	}	

/*------------------------------------------------------------------------------------------ */
	
	
/*------------------------------------------------------------------------------------------ */
function fechaDiv($quantidade=1){
	$str = NULL;
		for($i=0;$i<$quantidade;$i++){
			$str .= $this->tags('/div');
		}
		return $str;
}		


}//FECHA myClass
?>