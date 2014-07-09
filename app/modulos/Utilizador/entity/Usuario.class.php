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
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getNome() {
		return $this->nome;
	}
	
	public function setUser($user) {
		$this->user = $user;
	}
	public function getUser() {
		return $this->user;
	}
	
	public function setSenha($senha) {
		$this->senha = md5($senha,true);
	}
	public function getSenha() {
		return $this->senha;
	}
	
	public function setAlcunha($alcunha) {
		$this->alcunha = $alcunha;
	}
	public function getAlcunha(){
		return $this->alcunha;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	
	public function setDtCriacao($data) {
		$this->dtcriacao = $data;
	}
	public function getDtCriacao() {
		return $this->dtcriacao;
	}
	
	public function setWebSite($website) {
		$this->website = $website;
	}
	public function getWebSite() {
		return $this->website;
	}
	
	public function setBiografia($biografia) {
		$this->biografia = $biografia;
	}
	public function getBiografia(){
		return $this->biografia;
	}
	
	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}
	public function getPerfil(){
		return $this->perfil;
	}
}
?>