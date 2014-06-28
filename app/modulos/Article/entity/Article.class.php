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
		self::$id = $id;
	}
	public function getId(){
		return self::$id;
	}

	public function setTitulo($titulo){
		self::$titulo = $titulo;
	}
	public function getTitulo(){
		return self::titulo;
	}

	public function setConteudo($conteudo){
		self::$conteudo = $conteudo;
	}
	public function getConteudo(){
		return self::$conteudo;
	}

	public function setCategoria($Categoria){
		self::$Categoria = $Categoria;
	}
	public function getCategoria(){
		return self::$Categoria;
	}

	public function setPublicado($publicado){
		self::$publicado = $publicado;
	}
	public function getPublicado(){
		return self::$publicado;
	}

	public function setImagem($imagem){
		self::$imagem = $imagem;
	}
	public function getImagem(){
		return self::$imagem;
	}

	public function setDtPublicacao($dataPublicacao){
		self::$dataPublicacao = $dataPublicacao;
	}
	public function getDtPublicacao(){
		return self::$dataPublicacao;
	}

	public function setTags($tags){
		self::$tags = $tags;
	}
	public function getTags(){
		return self::$tags;
	}

	public function setPublicado($publicado){
		self::$publicado = $publicado;
	}
	public function getPublicado(){
		return self::$publicado;
	}
	
	public function setBanner($banner){
		self::$banner = $banner;
	}
	public function getBanner(){
		return self::$banner;
	}
	
	public function setUser($usuario) {
		self::$user = $usuario;
	}
	public function getUser() {
		return self::$user;
	}
}
?>