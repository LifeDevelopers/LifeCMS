<?php
interface iRepositorio{
	public function salvar($obj);
	public function remover($id);
	public function alterar($obj);
	public function buscar($id);
	public function filtrar($filtro);
}
?>