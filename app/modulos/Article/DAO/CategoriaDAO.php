<?php
/**
 * Classe de cadastro de Categoria no repositório
 * @author Roberto Ramos <robertolopesramos@gmail.com>
 * @version 0.1
 * @access public
 */
include_once('../../../config/Repositorio.class.php');
include_once('../../../interface/iRepositorio.php');

class CategoriaDAO implements iRepositorio{
	
	private $conn;
	
	/**
	 * Methodo para receber uma conexão com o repositório.
	 * @access public
	 * @param String $sql
	 * @return Connexão
	 */
	private function getStatement($sql){
		$conn = Repositorio::GetConnection();
		$conn->beginTransaction();
		return $conn->prepare($sql);
	}

	/**
	 * Methodo para salvar uma nova categoria.
	 * Este methodo sobrescreve o methodo salvar da interface iRepositório
	 * @access public
	 * @param Categoria $categoria
	 * @return boolean
	 */
	public function salvar($categoria){
		try{
			$sql = "INSERT INTO CATEGORIA(cat_titulo,cat_descricao,cat_subid) VALUES(?,?,?)";
			$ps = getStatement($sql);

			$ps->bindParam(1,$categoria->getTitulo(),PDO::PARAM_STR);
			$ps->bindParam(2,$categoria->getDescricao(),PDO::PARAM_STR);
			$ps->bindParam(3,$categoria->getSubCategoria(),PDO::PARAM_INT);
			$ps->execute();
			$ps->commit();
			if($ps->rowCount() != 1){
				throw new PDOException("Erro ao inserir dados no Banco.");
			}
			$ps = null;
		}catch(PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao inserir dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	/**
	 * Methodo para remover uma categoria.
	 * Este methodo sobrescreve o methodo remover da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function remover($id){
		try{
			$sql = "DELETE FROM CATEGORIA WHERE cat_id = ?";
			$ps = getStatement($sql);
			
			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$ps->commit();
			if($ps->rowCount()!= 1){
				throw new PDOException("Erro ao tentar deletar dados do Banco.");
			}
			$ps = null;
		}catch(PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao tentar deletar dados do Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	/**
	 * Methodo para alterar uma categoria.
	 * Este methodo sobrescreve o methodo alterar da interface iRepositório
	 * @access public
	 * @param Categoria $categoria
	 * @return boolean
	 */
	public function alterar($categoria){
		try{
			$sql = "UPDATE CATEGORIA SET cat_titulo = ?,cat_descricao = ?,cat_subid = ?";
			$ps = getStatement($sql);
			
			$ps->bindParam(1,$categoria->getTitulo(),PDO::PARAM_STR);
			$ps->bindParam(2,$categoria->getDescricao(),PDO::PARAM_STR);
			$ps->bindParam(3,$categoria->getSubCategoria(),PDO::PARAM_INT);
			
			$ps->execute();
			$ps->commit();
			if($ps->rowCount()!= 1){
				throw new PDOException("Erro ao tentar alterar dados no Banco.");
			}
			$ps = null;
		}catch (PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	/**
	 * Methodo para pesquisar uma determinada categoria.
	 * Este methodo sobrescreve o methodo buscar da interface iRepositório
	 * @access public
	 * @param Integer $id
	 * @return boolean
	 */
	public function buscar($id){
		try{
			$sql = "SELECT * FROM CATEGORIA WHERE cat_id = ?";
			$ps = getStatement($sql);
			$ps->bindParam(1,$id,PDO::PARAM_INT);
			$ps->execute();
			$rs = $ps->fetch(PDO::FETCH_ASSOC);
			
			
			$categoria = new Categoria();
			$categoria->setId($rs['cat_id']);
			$categoria->setTitulo($rs['cat_titulo']);
			$categoria->setDescricao($rs['cat_descricao']);
			$categoria->setSubCategoria($rs['cat_subid']);
			
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		
		return $categoria;
	}

	/**
	 * Methodo para filtrar uma lista de categorias.
	 * Este methodo sobrescreve o methodo filtrar da interface iRepositório
	 * @access public
	 * @param Categoria $categoria
	 * @return array
	 */
	public function filtrar($categoria){
		$listaCategorias = array();
		try{
			$sql = "SELECT * FROM CATEGORIA";
			$sqlConector = " AND ";

			if($categoria->getTitulo() != null && !empty($categoria->getTitulo())){
				$sql .= $sqlConector."cat_titulo LIKE '%?%' \n ";
			}
			if($categoria->getDescricao() != null && !empty($categoria->getDescricao())){
				$sql .= $sqlConector."cat_descricao LIKE '%?%' \n";
			}
			if($categoria->getSubCategoria() != null && !empty($categoria->getSubCategoria())){
				$sql .= $sqlConector."cat_subid = ? \n";
			}
			
			$ps = getStatement($sql);
			$i = 1;
			if($categoria->getTitulo() != null && !empty($categoria->getTitulo())){
				$ps->bindParam($i, $categoria->getTitulo(), PDO::PARAM_STR);
				$i++;
			}
			if($categoria->getDescricao() != null && !empty($categoria->getDescricao())){
				$ps->bindParam($i, $categoria->getDescricao(), PDO::PARAM_STR);
				$i++;
			}
			if($categoria->getSubCategoria() != null && !empty($categoria->getSubCategoria())){
				$ps->bindParam($i, $categoria->getSubCategoria(), PDO::PARAM_STR);
				$i++;
			}
			
			$ps->execute();
			$listaCategorias = $ps->fech(PDO::FETCH_ASSOC);
			$ps = null;
		}catch (PDOException $e){
			echo "<p>Erro ao tentar alterar dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return $listaCategorias;
	}
}
?>