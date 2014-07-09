<?php
/**
* Classe de entidade Artigo
*/
include_once('Categoria.class.php');
include_once('../../Utilizador/entity/Usuario.class.php');

class Article
{
	private $id;
	private $titulo;
	private $conteudo;
	private $dataPublicacao;
	private $tags;
	private $publicado;
	private $imagem;
	private $banner;
	private $Categoria;
	private $user;

	function __construct()
	{
		$Categoria = new Categoria();
		$tags = Array();
	}

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function getTitulo(){
		return self::titulo;
	}

	public function setConteudo($conteudo){
		$this->conteudo = $conteudo;
	}
	public function getConteudo(){
		return $this->conteudo;
	}

	public function setCategoria($Categoria){
		$this->Categoria = $Categoria;
	}
	public function getCategoria(){
		return $this->Categoria;
	}

	public function setPublicado($publicado){
		$this->publicado = $publicado;
	}
	public function getPublicado(){
		return $this->publicado;
	}

	public function setImagem($imagem){
		$this->imagem = $imagem;
	}
	public function getImagem(){
		return $this->imagem;
	}

	public function setDtPublicacao($dataPublicacao){
		$this->dataPublicacao = $dataPublicacao;
	}
	public function getDtPublicacao(){
		return $this->dataPublicacao;
	}

	public function setTags($tags){
		$this->tags = $tags;
	}
	public function getTags(){
		return $this->tags;
	}

	public function setPublicado($publicado){
		$this->publicado = $publicado;
	}
	public function getPublicado(){
		return $this->publicado;
	}
	
	public function setBanner($banner){
		$this->banner = $banner;
	}
	public function getBanner(){
		return $this->banner;
	}
	
	public function setUser($usuario) {
		$this->user = $usuario;
	}
	public function getUser() {
		return $this->user;
	}
}
?>