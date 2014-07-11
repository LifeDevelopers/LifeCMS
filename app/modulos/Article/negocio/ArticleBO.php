<?php
/**
* Classe para cadastro de Artigos onde teremos nossas regras de negócio
*/
include_once('../../../interface/iCadastro.php');

class ArticleBO implements iCadastro
{
	private $repositorio;

	function __construct($repositorio)
	{
		$this->repositorio = $repositorio;
	}

	// Sobrescrevendo o método salvar
	public function salvar($artigo){
		return $this->repositorio->salvar($artigo);
	}

	// Sobrescrevendo o método remover
	public function remover($id){
		return $this->repositorio->remover($id);
	}

	// Sobrescrevendo o método alterar
	public function alterar($artigo){
		return $this->repositorio->alterar($artigo);
	}

	// Sobrescrevendo o método buscar
	public function buscar($id){
		return $this->repositorio->buscar($id);
	}

	// Sobrescrevendo o método filtrar
	public function filtrar($artigo){
		return $this->repositorio->filtrar($artigo);
	}

	// Sobrescrevendo o método validar
	public function validar($artigo){
		return $this->repositorio->validar($artigo);
	}
}
?>