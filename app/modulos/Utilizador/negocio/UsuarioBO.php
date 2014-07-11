<?php
/**
 * Classe de Cadastro de novos utilizadores
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('../../../interface/iCadastro.php');
class UsuarioBO implements iCadastro{
	
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
	 * Methodo para salvar um novo utilizador.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositorio
	 * @access public
	 * @param Usuario $usuario
	 * @return boolean
	 */
	public function salvar($usuario){
		return $this->repositorio->salvar($usuario);
	}
	
	/**
	 * Methodo para remover um utilizador.
	 * Este methodo sobrescreve o methodo remover da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		return $this->repositorio->remover($id);
	}
	
	/**
	 * Methodo para alterar dados de um utilizador.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositorio
	 * @access public
	 * @param Usuario $usuario
	 * @return boolean
	 */
	public function alterar($usuario){
		return $this->repositorio->alterar($usuario);
	}
	
	/**
	 * Methodo para pesquisar um determinado utilizador.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		return $this->repositorio->buscar($id);
	}
	
	/**
	 * Methodo para filtrar uma lista de utilizadores.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositorio
	 * @access public
	 * @param Usuario $usuario
	 * @return array
	 */
	public function filtrar($usuario){
		return $this->repositorio->filtrar($usuario);
	}
	
	/**
	 * Methodo para validar dados de cadastro de um utilizador.
	 * Este methodo sobrescreve o methodo validar da interface iCadastro
	 * @access public
	 * @param Usuario $Usuario
	 * @return boolean
	 */
	public function validar($usuario){
		//implemente
		return $usuario;
	}
} 
?>