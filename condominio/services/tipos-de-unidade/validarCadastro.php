<?php
$resultado = '';

$TipoUnidade = new TipoUnidade($_POST);

if( $TipoUnidade->getNoTipoUnidade() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Nome não preenchido!");
	echo json_encode($resultado);
	exit;
}
if( $TipoUnidade->getSgSiglaUnidade() == null ){
	$resultado =  array("id" => null, "tipo" => "danger", "msg" => "Sigla não preechida!");
	echo json_encode($resultado);
	exit;
}

