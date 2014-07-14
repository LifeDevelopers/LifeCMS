<?php
/**
 * Classe modelo de Tipo Auditoria
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */

class TipoAuditoria {
	private $id;
	private $descricao;
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	
	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
}
?>