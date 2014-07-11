<?php
include_once('../../../interface/iRepositorio.php');

interface iCadastro extends iRepositorio
{
	public function validar($obj);
}
?>