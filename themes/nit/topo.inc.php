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

$str .= $MC->tags('html');
$str .= $MC->tags('head');
$str .= $MC->tags('meta http-equiv="Content-Type" content="text/html; charset=UTF-8"');
$str .= $MC->tags('link',NULL,1,' rel="shortcut icon" href="'.$ROTA.'/imagens/icones/favicon.ico" type="image/x-icon"');
$str .= $MC->tags('meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"');
$str .= $MC->tags('meta name="description" content=""');
$str .= $MC->tags('meta name="author" content="Marcos Oliveira"');
$str .= $MC->tagsConteudo('title',NULL,'ghLog Reader by Owpoga');
$str .= $MC->tags('link',NULL,1,'href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"');
$str .= $MC->tags('link',NULL,1,'rel="stylesheet" href="'.$ROTA.'/vendor/fontawesome-free-5.13.0-web/css/fontawesome.css"');
$str .= $MC->tags('link',NULL,1,'rel="stylesheet" href="'.$ROTA.'/vendor/fontawesome-free-5.13.0-web/css/brands.css"');
$str .= $MC->tags('link',NULL,1,'rel="stylesheet" href="'.$ROTA.'/vendor/fontawesome-free-5.13.0-web/css/solid.css"');
$str .= $MC->tags('link',NULL,1,' href="'.$ROTA.'/themes/'.$usaTema.'/css/sweetalert.min.css" rel="stylesheet"');
$str .= $MC->tags('link',NULL,1,'href="css/3-col-portfolio.css" rel="stylesheet"');
$str .= $MC->tags('link',NULL,1,'href="'.$ROTA.'/themes/'.$usaTema.'/css/owpoga.css" rel="stylesheet"');
$str .= $INC->chamaArquivoRepositorio($ROTA,'sweetalert.min.js');
$str .= $MC->tags('/head');
$str .= $MC->tags('body style="background-color:#363636;color:#f2f2f2;!important"');

?>