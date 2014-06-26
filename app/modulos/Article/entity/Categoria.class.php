<?php
/**
 * Classe de entidade categoria
 */
class Categoria
{
	private $id;
	private $titulo;
	private $descricao;
	private $subCategoria;

	function __construct()
	{

	}

	public function setId($id) {
		self::$id = $id;
	}
	public function getId(){
		return self::$id;
	}
	
	public function setTitulo($titulo) {
		self::$titulo = $titulo;
	}
	public function getTitulo() {
		return self::$titulo;
	}
	
	public function setDescricao($descricao) {
		self::$descricao = $descricao;
	}
	public function getDescricao($descricao) {
		return self::$descricao;
	}
	
	public function setSubCategoria($subCategoria) {
		self::$subCategoria = $subCategoria;
	}
	public function getSubCategoria() {
		return self::$subCategoria;
	}
}
?>