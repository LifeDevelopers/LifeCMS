<?php
/**
 * Classe de cadastro de Categoria
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('../interface/iCadastro.php');

class CadastroCategoria implements iCadastro{
	
	private $repositorio;

	/**
	 * Methodo Contrutor da classe para iniciar o objeto Repositório
	 * @access public
	 * @param Repositorio $repositorio
	 * @return void
	 */
	function __construct($repositorio)
	{
		self::$repositorio = $repositorio;
	}

	/**
	 * Methodo para salvar uma nova categoria.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositório
	 * @access public
	 * @param Categoria $categoria
	 * @return boolean
	 */
	public function salvar($categoria){
		return self::$repositorio->salvar($categoria);
	}

	/**
	 * Methodo para remover uma categoria.
	 * Este methodo sobrescreve o methodo remover da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		return self::$repositorio->remover($id);
	}

	/**
	 * Methodo para alterar uma categoria.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositório
	 * @access public
	 * @param Categoria $categoria
	 * @return boolean
	 */
	public function alterar($categoria){
		return self::$repositorio->alterar($categoria);
	}

	/**
	 * Methodo para pesquisar uma determinada categoria.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		return self::$repositorio->buscar($id);
	}

	/**
	 * Methodo para filtrar uma lista de categorias.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositório
	 * @access public
	 * @param Categoria $categoria
	 * @return array
	 */
	public function filtrar($categoria){
		return self::$repositorio->filtrar($categoria);
	}

	/**
	 * Methodo para validar dados de cadastro de uma categoria.
	 * Este methodo sobrescreve o methodo validar da interface iCadastro
	 * @access public
	 * @param Categoria $categoria
	 * @return boolean
	 */
	public function validar($categoria){
		return self::$repositorio->validar($categoria);
	}
} 
?>