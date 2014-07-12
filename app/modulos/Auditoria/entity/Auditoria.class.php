<?php
/**
 * Classe modelo de Auditoria
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('../../Utilizador/entity/Usuario.class.php');

class Auditoria {
	private $id;
	private $Usuario;
	private $data;
	private $TipoAuditoria;
	private $descricao;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setUsuario($usuario) {
		$this->Usuario = $usuario;
	}
	public function getUsuario() {
		return $this->Usuario;
	}
	
	public function setData($data) {
		$this->data = $data;
	}
	public function getData() {
		return $this->data;
	}
	
	public function setTipoAuditoria($tipoauditoria) {
		$this->TipoAuditoria = $tipoauditoria;
	}
	public function getTipoAuditoria() {
		return $this->TipoAuditoria;
	}
	
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
}
?>