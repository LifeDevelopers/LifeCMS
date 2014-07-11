<?php
/**
 * Classe para Submit de Comentários
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('../../../interface/iCadastro.php');

class ComentarioBO implements iCadastro{

	private $repositorio;

	/**
	 * Methodo Contrutor da classe para iniciar o objeto Repositório
	 * @access public
	 * @param Repositorio $repositorio
	 * @return void
	 */
	function __construct($repositorio)
	{
		$this->repositorio = $repositorio;
	}

	/**
	 * Methodo para salvar um novo comentário.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositório
	 * @access public
	 * @param Comentario $comentario
	 * @return boolean
	 */
	public function salvar($comentario){
		return $this->repositorio->salvar($comentario);
	}

	/**
	 * Methodo para remover um comentario.
	 * Este methodo sobrescreve o methodo remover da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		return $this->repositorio->remover($id);
	}

	/**
	 * Methodo para alterar um comentario.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositório
	 * @access public
	 * @param Comentario $comentario
	 * @return boolean
	 */
	public function alterar($comentario){
		return $this->repositorio->alterar($comentario);
	}

	/**
	 * Methodo para pesquisar um determinado comentario.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		return $this->repositorio->buscar($id);
	}

	/**
	 * Methodo para filtrar uma lista de comentarios.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositório
	 * @access public
	 * @param Comentario $comentario
	 * @return array
	 */
	public function filtrar($comentario){
		return $this->repositorio->filtrar($comentario);
	}

	/**
	 * Methodo para validar dados de cadastro de um comentario.
	 * Este methodo sobrescreve o methodo validar da interface iCadastro
	 * @access public
	 * @param Comentario $comentario
	 * @return boolean
	 */
	public function validar($comentario){
		return $this->repositorio->validar($comentario);
	}
}
?>