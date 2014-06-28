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
	private $usuario;
	private $data;
	private $tipo;
	private $descricao;
	
	function setId($id) {
		self::$id = $id;
	}
}
?>