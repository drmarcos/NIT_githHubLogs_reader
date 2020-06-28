<?php

class consultasSql{
			
/*----------------------------------------------------------------------------------------------- */
/*----------------- [ CONTAR A QUANTIDADE DE UM DETERMINADO REGISTRO ] ---------------------------*/
/*----------------------------------------------------------------------------------------------- */
			
			function sqlTotalRegistro($contaQuem,$qualTabela,$condicao=NULL,$ordenarPor=NULL){
			global $MinhaQuery,$FetchAssoc,$MSG,$DEBUG;				
				$sqlBuscaResultadoTotal = $MinhaQuery("SELECT count($contaQuem) as total FROM $qualTabela $condicao $ordenarPor");
				$data1= $FetchAssoc($sqlBuscaResultadoTotal);
				$resultado = $data1['total'];
				//print "SELECT count($contaQuem) as total FROM $qualTabela $condicao $ordenarPor";
				if($DEBUG != 0){print $MSG->alerta("SELECT count($contaQuem) as total FROM $qualTabela $condicao $ordenarPor");}
				return $resultado;			
			}
			
/*----------------------------------------------------------------------------------------------- */
			function simplesQuery($oqueSelecionar,$tabelaUsada,$condicao=NULL,$ordenar=NULL){
				global $MinhaQuery,$DEBUG,$MSG;
				$consulta = $MinhaQuery("SELECT $oqueSelecionar FROM $tabelaUsada $condicao $ordenar");
				//print "SELECT $oqueSelecionar FROM $tabelaUsada $condicao $ordenar ------- ";
				if($DEBUG != 0){print $MSG->alerta("SELECT $oqueSelecionar FROM $tabelaUsada $condicao $ordenar");}
				if($DEBUG != 0){print $MSG->alertaSwal('Este é um',"Alerta!",'success');}
				return $consulta;
			}
	
/*----------------------------------------------------------------------------------------------- */





/*----------------------------------------------------------------------------------------------- */

		}//CLASS

?>