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
	function BlocamosClassMSG($pagina){if(basename($_SERVER["PHP_SELF"])==$pagina){exit(header('Location: ../erro/erro404.php'));}}
	BlocamosClassMSG('mensagens.class.php');	
	
/* ------------------------------------------------------------------------------------------- */	  	
/* ------------------------------------------------------------------------------------------- */	  	
/* ------------------------------------------------------------------------------------------- */
	  	
class mensagens extends myClass{
      const EOF_LINE = "\n";
	  const MOF_LINE = "\n\t\t";
	  const MOFD_LINE = "\n\t";
	  
/* ------------------------------------------------------------------------------------------- */	  	
/* ------------------------------------------------------------------------------------------- */	  	
	public function alerta($msg){
		print "<script language=\"javascript\">alert('$msg');</script>";
	}
/* ------------------------------------------------------------------------------------------- */	  	
	public function alertaSwal($tituloAlerta,$textoComplementa,$modeloAlerta){
		$str = NULL;
		$str .= "<script>swal(\"$tituloAlerta\", \"$textoComplementa\", \"$modeloAlerta\");</script>".self::EOF_LINE;
		return $str;
		// EX: $MSG->alertaSwal($_MUDA_CONDICAO,$PERM->permitido,'success');
	}	
/* ------------------------------------------------------------------------------------------- */	
/* ------------------------------------------------------------------------------------------- */	
    private function addAtributos($attr_ar) {
        $str = '';
        foreach( $attr_ar as $key=>$val ) {
                $str .= " $key=\"$val\"";
        }
        return $str;
    }
/* ------------------------------------------------------------------------------------------- */		
/* ------------------------------------------------------------------------------------------- */		
	public function msgAcessoNeg(){
	global $CFG;
		$str = ($GLOBALS['MJO']->addTag('br/'));
		$str .= ($GLOBALS['MJO']->addTag('div '.$CFG->fadeAlerta.'').$GLOBALS['_ACESSO_NEGADO'].$GLOBALS['MJO']->addTag('/div'));
		$str .= ($GLOBALS['MJO']->addTag('br/'));
		$str .= ('<center><a id="botoes" href="'.$GLOBALS['ROTA'].'">'.$GLOBALS['_VOLTAR'] .'</a></center><br/>');
		$str .= $this->fadelay();	
		return $str;
	}
/* ------------------------------------------------------------------------------------------- */	
/* ------------------------------------------------------------------------------------------- */	
	public function msgErroLogin($mensagem,$atributo){		
	global $CFG;
		$str = ($GLOBALS['MJO']->addTag('div '.$atributo.'').$mensagem.$GLOBALS['MJO']->addTag('/div'));
		$str .= $this->fadelay();	
		return $str;
	}
/* ------------------------------------------------------------------------------------------- */	
/* ------------------------------------------------------------------------------------------- */	
	function msgERROMsgRetorno($msgRetorno,$linkRetorno=NULL){
	global $CFG;
		$str = '<div';
		//$str.= $this->addAtributos($atributo );
		$str.= '>'.$msgRetorno.'</div>'. self::EOF_LINE;
		$str .= $this->fadelay();		
		//$str .= exit();	
		print $str;	
		//exit('Você não está com permissão de acesso');
	}	
/* ------------------------------------------------------------------------------------------- */	
/* ------------------------------------------------------------------------------------------- */	
	public function msgErroCaptcha($mensagem,$atributo){		
	global $CFG;
		$str = '<div';
		$str.= $this->addAtributos($atributo );
		$str.= '>'.$mensagem.'</div>'. self::EOF_LINE;
		$str .= $this->fadelay();	
		return $str;
	}
/* ------------------------------------------------------------------------------------------- */	
/* ------------------------------------------------------------------------------------------- */
	
	public function msgRetorno($mensagem,$atributo){		
	global $CFG;
		$str = '<div';
		$str.= $this->addAtributos($atributo );
		$str.= '>'.$mensagem.'</div>'. self::EOF_LINE;
		$str .= $this->fadelay();	
		return $str;
	}	
	
	public function msgFadelayInOutSlide($mensagem,$delay,$atributo){		
	global $CFG;
		$str = '<div';
		$str.= $this->addAtributos($atributo );
		$str.= '>'.$mensagem.'</div>'. self::EOF_LINE;
		$str .= $delay;	
		return $str;

		/* ----------------------------------- */
		//exemplo de uso:
		//print $MSG->msgFadelayInOut($textoqualquer,$MSG->fadelayOut(),array("class"=>"fadout","id"=>"alertaVerde"));
		//print $MSG->msgFadelayInOutSlide(ucfirst($textoqualquer).'...',$MSG->fadelaySlideUp(),array("class"=>"slideUp","id"=>"alertaVermelho"));
		//print $MSG->msgFadelayInOutSlide($textoqualquer,$MSG->fadelay(),array("class"=>"faded","id"=>"alertaAmarelo"));
		//ou ainda caso definido em params.inc
		//print $MSG->msgFadelayInOutSlide($sec_tipoTraducao,$MSG->fadelay(),$CFG->fadeAlerta);
		/* ----------------------------------- */

	}
		
/* ------------------------------------------------------------------------------------------- */
/* --- [ CONFIRMA EXCLUSÃO ] --- */	
/* ------------------------------------------------------------------------------------------- */

	public function confirmaExcluir($areaNome,$acao,$acaoMenu,$qualEstrutura,$idRegistro){		
	global $CFG;
		$attT600 = array("border"=>0,"cellpadding"=>6,"cellspacing"=>12,"width"=>"780");
		$str  = $this->addTag('center');
		$str .= $this->addTabela($attT600,array("colspan"=>2),$this->msgRetorno('Deseja realmente excluir: <b id="destaqueVerde">'.$areaNome.'</b>.',array("class"=>"faded","id"=>"alertaVermelho")));
		$str .= $this->addLinha($this->msgFadelayInOutSlide(ucfirst($GLOBALS['_AGUARDE']).'...',$this->fadelaySlideUp(),$GLOBALS['CFG']->fadeSlideUpAguarde),array("COLSPAN"=>"2"));
		$str .= $this->addLinha($this->msgFadelayInOutSlide($this->link('?acaoMenu='.$qualEstrutura.'.excluir&pg='.$GLOBALS['sec_pg'].'&relacionamentos='.$GLOBALS['existeRelacionamento'].'&excluir=true&idRegistro='.$idRegistro.'&acao='.$acao,$GLOBALS['_SIM'],'botoes','botoes'),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown")),array("ALIGN"=>"RIGHT","width"=>"50%"));
		$str .= $this->addCel($this->msgFadelayInOutSlide($this->link('?acaoMenu='.$acaoMenu.'&pg='.$GLOBALS['sec_pg'].'&acao='.$acao,$GLOBALS['_NAO'],'botoes','botoes'),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown")));
		$str .= $this->addCel();
		$str .= $this->fechaTabela();		
		$str .= $this->addTag('/center');
		return $str;

		/* ----------------------------------- */
		//exemplo de uso:		
		//print $MSG->confirmaExcluir($sec_areaNome,'#',$sec_acaoMenu,'areas',$sec_idArea);
		/* ----------------------------------- */

	}
			
/* ------------------------------------------------------------------------------------------- */
/* --- [ CONFIRMA EXCLUSÃO MÓDULOS ] --- */	
/* ------------------------------------------------------------------------------------------- */

	public function confirmaExcluirModulo($areaNome,$acao,$acaoMenu,$qualEstrutura,$idRegistro){		
	global $CFG;
		$attT600 = array("border"=>0,"cellpadding"=>6,"cellspacing"=>12,"width"=>"780");
		$str  = $this->addTag('center');
		$str .= $this->addTabela($attT600,array("colspan"=>2),$this->msgRetorno('Deseja realmente excluir: <b id="destaqueVerde">'.$areaNome.'</b>.',array("class"=>"faded","id"=>"alertaVermelho")));
		$str .= $this->addLinha($this->msgFadelayInOutSlide(ucfirst($GLOBALS['_AGUARDE']).'...',$this->fadelaySlideUp(),$GLOBALS['CFG']->fadeSlideUpAguarde),array("COLSPAN"=>"2"));
		$str .= $this->addLinha($this->msgFadelayInOutSlide($this->link('?acaoMenu='.$qualEstrutura.'&pg='.$GLOBALS['sec_pg'].'&excluir=true&idRegistro='.$idRegistro.'&acao='.$acao,$GLOBALS['_SIM'],'botoes','botoes'),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown")),array("ALIGN"=>"RIGHT","width"=>"50%"));
		$str .= $this->addCel($this->msgFadelayInOutSlide($this->link('?acaoMenu='.$acaoMenu.'&pg='.$GLOBALS['sec_pg'].'&acao='.$acao,$GLOBALS['_NAO'],'botoes','botoes'),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown")));
		$str .= $this->addCel();
		$str .= $this->fechaTabela();		
		$str .= $this->addTag('/center');
		return $str;

		/* ----------------------------------- */
		//exemplo de uso:		
		//print $MSG->confirmaExcluir($sec_areaNome,'#',$sec_acaoMenu,'areas',$sec_idArea);
		/* ----------------------------------- */

	}			
/* ------------------------------------------------------------------------------------------- */
/* --- [ CONFIRMA EXCLUSÃO TAREFA DE ALUNO ] --- */	
/* ------------------------------------------------------------------------------------------- */

	public function confirmaExcluirGenerico($mensagem,$linkConfirmaExclusao,$linkCancelaExclusao){		
	global $CFG;
		$attT600 = array("border"=>0,"cellpadding"=>6,"cellspacing"=>12,"width"=>"780");
		$str  = $this->addTag('center');
		$str .= $this->addTabela($attT600,array("colspan"=>2),$this->msgRetorno($mensagem,array("class"=>"faded","id"=>"alertaVermelho")));
		$str .= $this->addLinha($this->msgFadelayInOutSlide(ucfirst($GLOBALS['_AGUARDE']).'...',$this->fadelaySlideUp(),$GLOBALS['CFG']->fadeSlideUpAguarde),array("COLSPAN"=>"2"));
		$str .= $this->addLinha($this->msgFadelayInOutSlide($this->link('?'.$linkConfirmaExclusao.'&excluir=true',$GLOBALS['_SIM'],'botoes','botoes'),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown")),array("ALIGN"=>"RIGHT","width"=>"50%"));
		$str .= $this->addCel($this->msgFadelayInOutSlide($this->link('?'.$linkCancelaExclusao.'&pg='.$GLOBALS['sec_pg'],$GLOBALS['_NAO'],'botoes','botoes'),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown")));
		$str .= $this->addCel();
		$str .= $this->fechaTabela();		
		$str .= $this->addTag('/center');
		return $str;

		/* ----------------------------------- */
		//exemplo de uso:		
		/*
		$mensagem = $_DESEJA_EXCLUIR_TAREFA_DE.': <b id="destaqueVerde">'.$dadosAlunoTarefa[0].'</b>.';
		$usaEsteLink = 'acao=Ylc5a2RXeHZjdz09&acaoMenu=mostraLista&nomeDir='.$sec_nomeDir.'&nomeTarefa='.$sec_nomeTarefa.'&listarAlunos=true';
		$linkConfirmaExclusao = $usaEsteLink.'&nomeArquivo='.$sec_nomeArquivo.'&exclusaoConfirmada=true';
		$linkCancelaExclusao = $usaEsteLink;
		$str .= $MSG->confirmaExcluirGenerico($mensagem,$linkConfirmaExclusao,$linkCancelaExclusao);
		*/
		/* ----------------------------------- */

	}
	
/* ------------------------------------------------------------------------------------------- */	
/* ------------------------------------------------------------------------------------------- */
	
	public function fadelay(){
		$str ="<style>";
		$str .=".faded { display: none;}";
		$str .="</style>";
		$str .="<script>";
		$str .="$(\".faded\").each(function(i) {";
		$str .="$(this).delay(1500).fadeIn('1500');";
		$str .="});";
		$str .="</script>";
		return $str;
	}
/* ------------------------------------------------------------------------------------------- */			
/* ------------------------------------------------------------------------------------------- */
			
	public function fadelayOut(){	
		$str ="<style>";
		$str .=".fadout { display: show;}";
		$str .="</style>";
		$str .="<script>";
		$str .="$(\".fadout\").each(function(i) {";
		$str .="$(this).delay(2000).fadeOut( 1500 );";
		$str .="});";
		$str .="</script>";
		return $str;
		/* http://api.jquery.com/fadeOut/ */
	}
/* ------------------------------------------------------------------------------------------- */
/* ------------------------------------------------------------------------------------------- */

	public function fadelaySlideUp(){	
		$str ="<style>";
		$str .=".slideUp { display: show;}";
		$str .="</style>";
		$str .="<script>";
		$str .="$(\".slideUp\").each(function(i) {";
		$str .="$(this).delay(2000).slideUp( 350 );";
		$str .="});";
		$str .="</script>";
		return $str;
		/* http://api.jquery.com/slideUp/ */
	}
	public function fadelaySlideDown(){	
		$str ="<style>";
		$str .=".slideDown { display: none;}";
		$str .="</style>";
		$str .="<script>";
		$str .="$(\".slideDown\").each(function(i) {";
		$str .="$(this).delay(800).slideDown(350);";
		$str .="});";
		$str .="</script>";
		return $str;
		/* http://api.jquery.com/slideDown/ */
	}

	function msgERROCriarArquivo($nomeDoArquivo){	
/*		$INC = new chamaArquivos;
		$INC->jquery($GLOBALS["ROTA"]);*/
		$GLOBALS["MJO"]->aDivMsg($GLOBALS["CFG"]->fadeAlerta,$GLOBALS["CFG"]->msgErroCriarArquivo.'[ <b>'.$nomeDoArquivo.'</b> ]');
		//print $GLOBALS["MJO"]->fadelay();
	}	
		
/* ------------------------------------------------------------------------------------------- */
/* ------------------------------------------------------------------------------------------- */

		public function botaoVoltar($linkBotaoVoltar,$idClass){	
			$str = $this->msgFadelayInOutSlide($this->link('?'.$linkBotaoVoltar,$GLOBALS['_VOLTAR'],$idClass,$idClass),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown"));
			return $str;
		}
		
		public function botoes($linkBotaoVoltar,$textoBotao,$idClass,$target=NULL){	
			$str = $this->msgFadelayInOutSlide($this->link($linkBotaoVoltar,$textoBotao,$idClass,$idClass,$target),$this->fadelaySlideDown(),array("class"=>"slideDown","id"=>"alertaSlideDown"));
			return $str;
		}

		public function btDoacao($_MSG_TEXTO_BOTAO_DOACAO,$_MSG_AGORA_VC_PODE){
					global $MC,$CFG;	
					$str = $MC->addBr(2);					
					$str .= ($_MSG_TEXTO_BOTAO_DOACAO);					
					$str .= $MC->addBr(1);					
					$str .= ($_MSG_AGORA_VC_PODE);					
					$str .= $MC->addBr(2);
					if($GLOBALS['sec_w'] <= 500){
						$str .= $CFG->chamaBotaoDoarPagSeguroResponsivo;
					}else{						
						$str .= $CFG->chamaBotaoDoarPagSeguro;
					}					
					return
					 $str;
					}
					
		public function destaqueDoacao($textoExplica,$_MSG_TEXTO_BOTAO_DOACAO,$_MSG_AGORA_VC_PODE){
			global $MC,$CFG,$str;
					$str .= $textoExplica;
					$str .= $MC->addCel($this->btDoacao($_MSG_TEXTO_BOTAO_DOACAO,$_MSG_AGORA_VC_PODE),array("id"=>"A11"));
					unset($textoExplica);			
		}
		
/* ------------------------------------------------------------------------------------------- */
/* ------------------------------------------------------------------------------------------- */
					
		public function destaquePaginaDoacao($exibeImagem,$tituloImagem,$textoExplica,$_MSG_TEXTO_BOTAO_DOACAO,$_MSG_AGORA_VC_PODE){
			global $MC,$CFG,$str;
				if($GLOBALS['sec_w'] <= 500){
					$str .= $this->imagem($GLOBALS['ROTA'].'/imagens/banners/'.$exibeImagem,array("title"=>"$tituloImagem","width"=>"320","height"=>"220"));
					$str .= $this->addBr(2);
					$str .= $textoExplica;
					$str .= $this->addBr(1);
					$str .= $this->btDoacao($_MSG_TEXTO_BOTAO_DOACAO,$_MSG_AGORA_VC_PODE);				
				}else{					
					$str .= $this->imagem($GLOBALS['ROTA'].'/imagens/banners/'.$exibeImagem,array("title"=>"$tituloImagem","align"=>"left"));
					$str .= $textoExplica;
					$str .= $this->addBr(4);
					$str .= $this->btDoacao($_MSG_TEXTO_BOTAO_DOACAO,$_MSG_AGORA_VC_PODE);
					$str .= $this->addBr(2);
					$str .= $this->addTag('center');
					$str .= "<form method='post' action='https://www.moip.com.br/Process.do'>
<input type='hidden' name='method' value='donation'/>
<input type='hidden' name='encrypted' value='PlBYd1IB77Or4QCQht8d+w=='/>
<input type='hidden' name='type' value='2'/>
<input type='image' name='submit' src='https://static.moip.com.br/imgs/buttons/bt_doar_c02_e04.png' alt='Manutenção' border='0' />
</form>	";
					$str .= $this->addTag('/center');
				}
				
					unset($textoExplica,$_MSG_TEXTO_BOTAO_DOACAO,$exibeImagem,$tituloImagem);			
		}							
/*?>
<p class="fadout">
If you click on this paragraph
you'll see it just fade away.
</p>
<script>
$( ".fadout" ).each(function(i) {
$( ".fadout" ).delay( 800 ).fadeOut( "1600" );
});
</script>
<?php	*/	
/* ------------------------------------------------------------------------------------------- */
	function CaixaDebugMetasTags($trocaMetas,$metaDescricao,$metaPalavrasChave){
				$strD = NULL;
				$strD .= $this->adBr(3).$this->tagsConteudo('div','alert alert-danger',
				'<b>Modo DEBUG ativado!</b>  em config.inc'.$this->adBr(1).'<b>A&ccedil;&atilde;o</b>:&nbsp;'
				.$trocaMetas.$this->adBr(1).'<b>Arquivo</b>:&nbsp;'
				.__FILE__.$this->adBr(1).'<b>Linha</b>:&nbsp;'
				.__LINE__.$this->adBr(1)
				.'<b>$metaDescricao</b>: '.$metaDescricao.$this->adBr(1)
				.'<b>$metaPalavrasChave</b>: '.$metaPalavrasChave.$this->adBr(1)
				);	
				return $strD;
				unset($strD);
	}
}
?>

