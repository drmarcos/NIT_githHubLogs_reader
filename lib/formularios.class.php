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
 	class formularios extends myClass{
      const EOF_LINE = "\n";
	  const MOF_LINE = "\n\t\t";
	  const MOFD_LINE = "\n\t";

/* ----------------------------------------------------------------------------------- */
    private function Atributos( $attr_ar ) {
        $str = '';
        foreach( $attr_ar as $key=>$val ) {
                $str .= " $key=\"$val\"";
        }
        return $str;
    }
/* ----------------------------------------------------------------------------------- */

    private function addAttributes( $attr_ar ) {
        $str = '';
        // check minimized attributes
        $min_atts = array('checked', 'disabled', 'readonly', 'multiple');
        foreach( $attr_ar as $key=>$val ) {
            if ( in_array($key, $min_atts) ) {
                if ( !empty($val) ) { 
                    $str .= " $key=\"$key\"";
                }
            } else {
                $str .= " $key=\"$val\"";
            }
        }
        return $str;
    }
    
/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

		public function abreForm($metodo,$acao,$complementos=NULL){
			$str = NULL;
			$str .= $this->Tags('form',NULL,1,' method="'.$metodo.'" action="'.$acao.'" '.$complementos.'').self::EOF_LINE;
			return $str;
		}
		
		/* OU  */
		
		 public function startForm($action = '#', $method = 'post', $id = NULL, $attr_ar = array() ) {
        $str = "<form action=\"$action\" method=\"$method\"";
        if ( isset($id) ) {
            $str .= " id=\"$id\"";
        }
        $str .= $attr_ar? $this->addAttributes( $attr_ar ) . '>': '>';
        return $str;
    }
    
/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

    public function addLabelFor($forID, $text, $attr_ar = array() ) {
        $str = "\t\n<label for=\"$forID\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$text</label>".self::EOF_LINE;;
        return $str;
    }

/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

		public function inputSimples($tipo,$nomeCampo,$value,$classe=NULL){
			$str = NULL;			
			$str .= $this->tags('input type="'.$tipo.'"',NULL,1, ' name="'.$nomeCampo.'" value="'.$value.'" class="'.$classe.'"').self::EOF_LINE;
			return $str;
		}
		
/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

		public function input($tipo,$classe,$nomeCampo,$idcampo,$value=NULL,$textoExibido=NULL,$complementos=NULL,$requerido=NULL){
			$str = NULL;
			if($requerido != NULL){
				$requerido = "required=\"\"";
			}
			$str .= $this->Tags('input type="'.$tipo.'"',$classe,1, ' name="'.$nomeCampo.'" id="'.$idcampo.'" value="'.$value.'" placeholder="'.$textoExibido.'" '.$complementos.' '.$requerido.'').self::EOF_LINE;
			return $str;
		}

/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

		public function blocoInputText($nomeForLabel,$textNomeExibe,$tipoCampo,$faIcon,$nomeCampo,$idCampo,$textoValue,$complementos=NULL,$requerido=NULL){
			$str = NULL;
			$str .= $this->Tags('div','form-group');
			$str .= $this->duasTags('label for="'.$nomeForLabel.'" control-label','cols-sm-2 control-label','/label',NULL,''.$textNomeExibe.'');
			$str .= $this->duasTags('div','cols-sm-10','div','input-group');
			$str .= $this->duasTags('span','input-group-addon','/span',NULL,$this->duasTags('i aria-hidden="true"','fa fa-'.$faIcon.' fa','/i','input-group'));
			$str .= $this->input($tipoCampo,'form-control',$nomeCampo,$idCampo,$textoValue,$complementos,$requerido);
			$str .= $this->Tags('/div',NULL,3);
			return $str;
		}

/* ----------------------------------------------------------------------------------- */

    public function addInput($type,$id=NULL, $name, $value, $attr_ar = array()) {
        $str = "<input type=\"$type\"  id=\"$id\" name=\"$name\" value=\"$value\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= '/>';
        return $str;
    }
	
/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

	function arrayValoresInput($tamanhoCampo,$valorMaximo=NULL){
		global $CFG;
		$meuArray = array("size"=>$tamanhoCampo,"class"=>"$CFG->classeInputNormal","maxlength"=>$valorMaximo);
		return $meuArray;		
	}

/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

    public function addTextarea($name,$label, $rows = 4, $cols = 30, $value = '', $attr_ar = array() ) {
		$str = NULL;
		$str .= '<lable style="color:#800000;">'.$label.'</label>';
       // $str .= "\t\n<textarea name=\"$name\" value=\"$value\" rows=\"$rows\" cols=\"$cols\"";
        $str .= "\t\n<textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$value</textarea>\n";
        return $str;
    }

/* ----------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------- */

 function MOSTRA_SELECT_ATIVO ($nomeSelect,$vazio,$selecioneOpcao,$ativo,$inativo,$valorAtivo,$valorInativo,$classe=NULL,$id=NULL){
		$str = NULL;
		$str .='<select id="'.$id.'" class="'.$classe.'" name="'.$nomeSelect.'">'."\n";
		$str .='<option value="'.$vazio.'">... '.$selecioneOpcao.' ...</option>'."\n";
		$str .= '<option value="'.$valorAtivo.'">'.$ativo.'</option>'."\n";
		$str .='<option value="'.$valorInativo.'">'.$inativo.'</option>."\n"';
		$str .='</select>'."\n";
		return $str;
	}

/* ----------------------------------------------------------------------------------- */

	function addOption($arrayValores) {
		$str = '';
		  foreach($arrayValores as $short_code => $descriptive) {
  			$str .=  '<option value="'.$short_code.'">'.$descriptive.'</option>'."\n"; 
			}  
        return $str;
	}
				/* EXEMPLO DE USO
				$opcoes = array("1"=>'Acesso Direto',"2"=>'Pre-requisito',"3"=>'Anos Adicionais');
				$str .= addOption($opcoes);
				*/

/* ----------------------------------------------------------------------------------- */

			function filtroPorArraySubmit($camposFormPadrao,$opc,$nomeSelect,$tituloSelecao,$opcoes,$var1=NULL,$var2=NULL,$valorEditar=NULL){
				$str = NULL;	
				$str .= $this->duasTags('/td',NULL,'td');
				$str .= $camposFormPadrao;																							
				$str .= $this->addArrayInput($opc,$GLOBALS['hidden'])."\n";					
				$str .= $this->tags('select','form-control',1,' name="'.$nomeSelect.'"  onChange="submit(this.value);"')."\n";
				$str .= $this->duasTags('option value="'.$valorEditar.'"',NULL,'/option',NULL,$tituloSelecao)."\n";
				$str .= $this->addOption($opcoes)."\n";
				$str .= $this->tags('/select')."\n";
				$str .= $this->fechaForm();
				if(isset($var1)){$str .= $this->duasTags('span style="color:#ff8c8c"',NULL,'/span',NULL,$var2)."\n";}
				return $str;
			}
/* ----------------------------------------------------------------------------------- */

			function selectPorArray($selecioneAlgo,$nomeSelect,$tituloSelecao,$opcoes,$valorEditar=NULL,$usaLabel=0){
				$str = NULL;	
		  		if($usaLabel == 1){
				//$str .=  '<label>'.$tituloSelecao.'</label>';
				$str .= $this->duasTags('label style="color:#800000; font-weight:bold;"',NULL,'/label',NULL,strtoupper($tituloSelecao)).self::EOF_LINE;
				}
				$str .= $this->tags('select','form-control',1,' name="'.$nomeSelect.'"')."\n";
				$str .= $this->duasTags('option value="'.$valorEditar.'"',NULL,'/option',NULL,$selecioneAlgo)."\n";
				$str .= $this->addOption($opcoes)."\n";
				$str .= $this->tags('/select')."\n";
				return $str;
				/*
				EXEMPLO DE USO
					if($EDI->STATUS == 1){
						$selecioneOpcao = $_ATIVO;
						
					}else{
						$selecioneOpcao = $_INATIVO;						
					}				
					$arrayStatusOpcoes = array("1"=>"Ativo","0"=>"Inativo");
					$str .= $FORM->selectPorArray($selecioneOpcao,'status',$_STATUS,$arrayStatusOpcoes,$EDI->STATUS,1);
				*/
			}

/* ----------------------------------------------------------------------------------- */

	function addArrayInput($arrayValores,$isHidden,$classe=NULL,$usaLabel=0) {
		$str = '';
		  foreach($arrayValores as $short_code => $descriptive) {
		  		if($usaLabel == 1){$str .=  '<label>'.$descriptive.'</label>';}
  				$str .=  '<input type="'.$isHidden.'" name="'.$descriptive.'" value="'.$short_code.'" class="'.$classe.'">'."\n"; 
		  		if($usaLabel == 1){$str .=  '<br>';}
			}  
        return $str;
	}
				/* EXEMPLO DE USO

				*/
				
/* ----------------------------------------------------------------------------------- */
					function siglasEstadosArray(){
						
					$opcEstados = array(
						"AC" => "Acre - AC",
						"AL" => "Alagoas - AL",
						"AP" => "Amapá - AP",
						"AM" => "Amazonas - AM",
						"BA" => "Bahia - BA",
						"CE" => "Ceará - CE",
						"DF" => "Distrito Federal - DF",
						"ES" => "Espírito Santo - ES",
						"GO" => "Goiás - GO",
						"MA" => "Maranhão - MA",
						"MT" => "Mato Grosso - MT",
						"MS" => "Mato Grosso do Sul - MS",
						"MG" => "Minas Gerais - MG",
						"PA" => "Pará - PA",
						"PB" => "Paraíba - PB",
						"PR" => "Paraná - PR",
						"PE" => "Pernambuco - PE",
						"PI" => "Piauí - PI",
						"RJ" => "Rio de Janeiro - RJ",
						"RN" => "Rio Grande do Norte - RN",
						"RS" => "Rio Grande do Sul - RS",
						"RO" => "Rondônia - RO",
						"RR" => "Roraima - RR",
						"SC" => "Santa Catarina - SC",
						"SP" => "São Paulo - SP",
						"SE" => "Sergipe - SE",
						"TO" => "Tocantins - TO"
						);	
						return $opcEstados;
					}
					
/* ----------------------------------------------------------------------------------- */

/* ----------------------------------------------------------------------------------- */

	function montaInputArray($array,$usaLabel=1,$numColunas=NULL,$posicaoTexto='left'){
    	$str = NULL;
	    foreach ($array as $value) {
	    	if($usaLabel == 1){
	    	if($value[0] == 'hidden'){
				$mostraSimples = $this->duasTags('b style="color:#ff0000;"',NULL,'/b',NULL,$value[3]);
			}else{
				$mostraSimples = NULL;
			}
				if($numColunas){					
					$str .= $this->Tags('div','col-lg-'.$numColunas.' text-'.$posicaoTexto.'').self::EOF_LINE;				
				}
				$str .= $this->tags('br');
				$str .= $this->duasTags('label style="color:#800000; font-weight:bold;"',NULL,'/label',NULL,strtoupper($value[4]).''.$mostraSimples).self::EOF_LINE;
			}else{
				
			}
	    	$str .= '<input type="'.$value[0].'" name="'.$value[1].'" id="'.$value[2].'" value="'.$value[3].'" class="'.$value[5].'" placeholder="'.$value[6].'">'.self::EOF_LINE;
	    	if($numColunas){
				$str .= $this->Tags('/div',NULL,1).self::EOF_LINE;
			}
	    }					
	return $str;
	/*
		exemplo de usos:
		$input_array = array(
			array('text','nome','nome',$MUS->NOME,ucfirst($_NOME),'form-control',0),
			array('text','email','email',$MUS->CPF,ucfirst($_CPF),'form-control',0),
			array('text','rg','rg',$MUS->CPF,'RG','form-control',0),
			array('text','email','email',$MUS->DATA_NASC,ucfirst($_DATA_NASC),'form-control',0),
		);
		exemplo de uso com div:
		$str .= $FORM->montaInputArray($input_array,1,6);
		$str .= $FORM->montaInputArray($input_array,1,6,center); posicionando os elementos
			
		exemplo de uso sem div:
		$str .= $FORM->montaInputArray($input_array);
			
		PROCURE CRIAR BLOCOS COM MESMAS CARACTERISTICAS IGUAIS AGRUPADOS POR TYPE HIDDEN OU TEXT
		EVITE USAR AS DIVS EM BLOCOS DO TIPO HIDDEN
	*/
	}	
/* ----------------------------------------------------------------------------------- */
		
		public function fechaForm(){
			$str = NULL;
			$str .= $this->Tags('/form')."\n";
			return $str;
		}
		
/* ----------------------------------------------------------------------------------- */

				function tollsCkeditor2($idCampo){	
					$str = NULL;							
					$str .= "<script>
					CKEDITOR.replace('$idCampo',
						{
   							config.language = 'pt_br';
							config.uiColor = '#4f867c';
							width: '680px',
							height: '580px'									
						});
					</script>";		
					return $str;				
				}


/* ----------------------------------------------------------------------------------- */

					function tollsCkeditor($idCampo){								
					print"<script>
					CKEDITOR.replace( '$idCampo',
						{
							toolbar :
							[
								{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
								{ name: 'styles', items : [ 'Styles','Format' ]},
								{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
								{ name: 'TextColor', items : [ 'TextColor','BGColor' ] },
								{ name: 'tools', items : [ 'Source','-','About' ] }
							],
							width: '830px',
							height: '180px'									
						});
					</script>";						
				}	

/* ----------------------------------------------------------------------------------- */

	function confereDadosRecebido($data){
		global $_ATENCAO,$MSG,$MC;	
		$str = NULL;
		$gatilho = 0;
		foreach ($data as $key => $value) {
		  if($value==""){  	
			//$str .= $MSG->msgFadelayInOutSlide($_ATENCAO,$MSG->fadelaySlideUp(),array("class"=>"slideUp","id"=>"alertaVermelho"));
		    $str .= $MC->duasTags('div','alert alert-warning','/div',NULL,"$key não pode ser vazio!");
		    $gatilho = 1;
		  }
		}
		$usaVar = array(
			'mensagem' => $str,
			'gatilho' => $gatilho,
			
		); 
		return $usaVar;	
/*
	EXEMPLO DE USO::
	$data = array(
	'Descricao' => $sec_atividadeDescricao,
	'Processo Seletivo' => $sec_idProcSel,
	'Status' => $sec_status,
	'ID Ordena' => $sec_idOrdena
	);
	$imprimir = $FORM->confereDadosRecebido($data);
	print_r($imprimir['mensagem']);	
	$gatilho = ($imprimir['gatilho']);
*/		
	}

}// class 
?>