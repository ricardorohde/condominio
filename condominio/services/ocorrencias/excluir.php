<?php
require_once (realpath(dirname(dirname(dirname(__FILE__)))) . '/services/lib/inicializa.php');

$banco = new banco();

$co_unidade = isset($_POST['co_unidade']) ? $_POST['co_unidade'] : '';
$co_ocorrencia = isset($_POST['co_ocorrencia']) ? $_POST['co_ocorrencia'] : '';

$banco = new banco();
$res = $banco->altera("tb_ocorrencia","st_ativo=false,dt_hr_registro=NOW()","co_unidade=".$co_unidade." AND co_unidade=".$co_unidade,FALSE);
	
$resultado =  array("tipo" => "sucesso", "msg" => "Exclusão feita com sucesso!");

echo json_encode($resultado);
exit;
