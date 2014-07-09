<?php
/**
 * Classe de entidade de Comentário
 */
class Comentario{
	private $id;
	private $nome;
	private $email;
	private $texto;
	private $data;
	private $idStat;
	private $idArtigo;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getTexto(){
		return $this->texto;
	}
	public function setTexto($texto){
		$this->texto = $texto;
	}
	
	public function getData(){
		return $this->data;
	}
	public function setData($data){
		$this->data = $data;
	}
	
	public function getIdStat(){
		return $this->idStat;
	}
	public function setIdStat($idStat){
		$this->idStat = $idStat;
	}
	
	public function getIdArtigo(){
		return $this->idArtigo;
	}
	public function setIdArtido($idArtigo){
		$this->idArtigo = $idArtigo;
	}
}
?>