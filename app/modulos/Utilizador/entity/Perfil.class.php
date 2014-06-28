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
		self::$nome = $nome;
	}
	public function getNome() {
		return self::$nome;
	}
	
	public function setId($id) {
		self::$id = $id;
	}
	public function getId() {
		return self::$id;
	}
}
?>