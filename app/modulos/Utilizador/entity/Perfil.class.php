<?php
/**
 * Classe modelo de Perfil
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
class Perfil {
	private $id;
	private $nome;
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
}
?>