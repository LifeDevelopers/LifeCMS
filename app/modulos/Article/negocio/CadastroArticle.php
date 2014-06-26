<?php
/**
* Classe para cadastro de Artigos onde teremos nossas regras de negócio
*/
include_once('../interface/iCadastroArticle.php');

class CadastroArticle implements iCadastroArticle
{
	private $repositorio;

	function __construct($repositorio)
	{
		self::$repositorio = $repositorio;
	}

	// Sobrescrevendo o método salvar
	public function salvar($artigo){
		return self::$repositorio->salvar($artigo);
	}

	// Sobrescrevendo o método remover
	public function remover($id){
		return self::$repositorio->remover($id);
	}

	// Sobrescrevendo o método alterar
	public function alterar($artigo){
		return self::$repositorio->alterar($artigo);
	}

	// Sobrescrevendo o método buscar
	public function buscar($id){
		return self::$repositorio->buscar($id);
	}

	// Sobrescrevendo o método filtrar
	public function filtrar($filtro){
		return self::$repositorio->filtrar($filtro);
	}

	// Sobrescrevendo o método validar
	public function validar($artigo){
		return self::$repositorio->validar($artigo);
	}
}
?>