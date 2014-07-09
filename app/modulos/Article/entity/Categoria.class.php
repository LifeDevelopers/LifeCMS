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

	public function setId($id) {
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	
	public function setSubCategoria($subCategoria) {
		$this->subCategoria = $subCategoria;
	}
	public function getSubCategoria() {
		return $this->subCategoria;
	}
}
?>