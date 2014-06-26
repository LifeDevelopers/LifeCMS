<?php
include_once('../../../interface/iRepositorio.php');

interface iCadastroArticle extends iRepositorio
{
	public function validar($obj);
}
?>