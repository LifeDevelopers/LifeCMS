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
		return self::$id;
	}
	public function setId($id){
		self::$id = $id;
	}
	
	public function getNome() {
		return self::$nome;
	}
	public function setNome($nome) {
		self::$nome = $nome;
	}
	
	public function getEmail(){
		return self::$email;
	}
	public function setEmail($email){
		self::$email = $email;
	}
	
	public function getTexto(){
		return self::$texto;
	}
	public function setTexto($texto){
		self::$texto = $texto;
	}
	
	public function getData(){
		return self::$data;
	}
	public function setData($data){
		self::$data = $data;
	}
	
	public function getIdStat(){
		return self::$idStat;
	}
	public function setIdStat($idStat){
		self::$idStat = $idStat;
	}
	
	public function getIdArtigo(){
		return self::$idArtigo;
	}
	public function setIdArtido($idArtigo){
		self::$idArtigo = $idArtigo;
	}
}
?>