<?php
/**
 * Classe modelo de Usuário
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('Perfil.class.php');

class Usuario {
	private $id;
	private $nome;
	private $user;
	private $senha;
	private $alcunha;
	private $email;
	private $dtcriacao;
	private $website;
	private $biografia;
	private $perfil;
	
	public function setId($id) {
		self::$id = $id;
	}
	public function getId(){
		return self::$id;
	}
	
	public function setNome($nome) {
		self::$nome = $nome;
	}
	public function getNome() {
		return self::$nome;
	}
	
	public function setUser($user) {
		self::$user = $user;
	}
	public function getUser() {
		return self::$user;
	}
	
	public function setSenha($senha) {
		self::$senha = md5($senha,true);
	}
	public function getSenha() {
		return self::$senha;
	}
	
	public function setAlcunha($alcunha) {
		self::$alcunha = $alcunha;
	}
	public function getAlcunha(){
		return self::$alcunha;
	}
	
	public function setEmail($email) {
		self::$email = $email;
	}
	public function getEmail() {
		return self::$email;
	}
	
	public function setDtCriacao($data) {
		self::$dtcriacao = $data;
	}
	public function getDtCriacao() {
		return self::$dtcriacao;
	}
	
	public function setWebSite($website) {
		self::$website = $website;
	}
	public function getWebSite() {
		return self::$website;
	}
	
	public function setBiografia($biografia) {
		self::$biografia = $biografia;
	}
	public function getBiografia(){
		return self::$biografia;
	}
	
	public function setPerfil($perfil){
		self::$perfil = $perfil;
	}
	public function getPerfil(){
		return self::$perfil;
	}
}
?>