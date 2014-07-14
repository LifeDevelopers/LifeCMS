<?php
/**
 * Classe declarete de regra de negócios para registro de auditoria
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */

include_once('../../../interface/iRepositorio.php');

class AuditoriaBO implements iRepositorio{

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
	 * Methodo para registrar uma nova auditoria.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositorio
	 * @access public
	 * @param Auditoria $auditoria
	 * @return boolean
	 */
	public function salvar($auditoria){
		return $this->repositorio->salvar($auditoria);
	}

	/**
	 * Methodo para remover um registro de auditoria.
	 * Este methodo sobrescreve o methodo remover da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		return $this->repositorio->remover($id);
	}

	/**
	 * Methodo para alterar um registro de auditoria.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositorio
	 * @access public
	 * @param Auditoria $auditoria
	 * @return boolean
	 */
	public function alterar($auditoria){
		return $this->repositorio->alterar($auditoria);
	}

	/**
	 * Methodo para pesquisar um determinado registro de auditoria.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositorio
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		return $this->repositorio->buscar($id);
	}

	/**
	 * Methodo para filtrar uma lista de registros de auditoria.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositorio
	 * @access public
	 * @param Auditoria $auditoria
	 * @return array
	 */
	public function filtrar($auditoria){
		return $this->repositorio->filtrar($auditoria);
	}
}
?>