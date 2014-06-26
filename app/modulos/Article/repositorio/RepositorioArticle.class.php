<?php
/**
* Classe de repositório de Articles
*/
include_once('../../../config/Repositorio.class.php');
include_once('../../../interface/iRepositorio.php');

class RepositorioArticle implements iRepositorio
{
	private $conn;

	private function getStatement($sql){
		$conn = Repositorio::GetConnection();
		$conn->beginTransaction();
		return $conn->prepare($sql);
	}

	// Sobrescrevendo o método salvar
	public function salvar($artigo){
		try{
			$sql = "INSERT INTO ARTICLE(art_titulo,art_conteudo,art_dtpublicacao,art_tags,art_publicado,art_imagem,art_banner,cat_id) VALUES(?,?,?,?,?,?,?,?)";
			$ps = getStatement($sql);

			$ps->bindParam(1,$artigo->getTitulo(),PDO::PARAM_STR);
			$ps->bindParam(2,$artigo->getConteudo(),PDO::PARAM_STR);
			$ps->bindParam(3,$artigo->getDtPublicacao(),PDO::PARAM_STR);
			$ps->bindParam(4,$artigo->getTags(),PDO::PARAM_STR);
			$ps->bindParam(5,$artigo->getPublicado(),PDO::PARAM_INT);
			$ps->bindParam(6,$artigo->getImagem(),PDO::PARAM_STR);
			$ps->bindParam(7,$artigo->getBanner(),PDO::PARAM_STR);
			$ps->bindParam(8,$artigo->getCategoria()->getId(),PDO::PARAM_INT);
			$ps->execute();
			$ps->commit();
			if($ps->rowCount() != 1){
				throw new PDOException("Erro ao inserir dados no Banco.");
			}
		}catch(PDOException $e){
			$ps->rollBack();
			echo "<p>Erro ao inserir dados no Banco.</p>";
			echo "<p>Arquivo: ".$e->getFile()."</p>";
			echo "<p>Message: ".$e->getMessage()."</p>";
			echo "<p>Linha: ".$e->getLine()."</p>";
		}
		return true;
	}

	// Sobrescrevendo o método remover
	public function remover($id){
		try{
			$sql = "DELETE FROM ARTICLE WHERE art_id = ?";
			$ps = self::getStatement($sql);
			
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
	}

	// Sobrescrevendo o método alterar
	public function alterar($artigo){
		try{
			$sql = "UPDATE ARTICLE SET art_titulo = ?,art_conteudo = ?,art_dtpublicacao = ?,art_tags = ?,art_publicado = ?,art_imagem = ?,art_banner = ?,cat_id = ? WHERE art_id = ?";
			$ps = self::getStatement($sql);
			
			$ps->bindParam(1,$artigo->getTitulo(),PDO::PARAM_STR);
			$ps->bindParam(2,$artigo->getConteudo(),PDO::PARAM_STR);
			$ps->bindParam(3,$artigo->getDtPublicacao(),PDO::PARAM_STR);
			$ps->bindParam(4,$artigo->getTags(),PDO::PARAM_STR);
			$ps->bindParam(5,$artigo->getPublicado(),PDO::PARAM_INT);
			$ps->bindParam(6,$artigo->getImagem(),PDO::PARAM_STR);
			$ps->bindParam(7,$artigo->getBanner(),PDO::PARAM_STR);
			$ps->bindParam(8,$artigo->getCategoria()->getId(),PDO::PARAM_INT);
			$ps->bindParam(9,$artigo->getId(),PDO::PARAM_INT);
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

	// Sobrescrevendo o método buscar
	public function buscar($id){
		$sql = "SELECT * FROM ARTICLE a, CATEGORIA c WHERE a.cat_id = c.cat_id and a.id = ?";
		$ps = self::getStatement($sql);
		$ps->bindParam(1,$id,PDO::PARAM_INT);
		$ps->execute();
		$rs = $ps->fetch(PDO::FETCH_ASSOC);
		
		
		$article = new Article();
		$article->setId($rs['id']);
		$article->setTitulo($rs['titulo']);
		$article->setConteudo($rs['conteudo']);
		
		$categoria = new Categoria();
		$categoria->setId($rs['id']);
		$categoria->setTitulo($rs['titulo']);
		$categoria->setDescricao($rs['descricao']);
		$categoria->setSubCategoria($rs['subcategoria']);
		$article->setCategoria($categoria);
		$article->setQtdView($rs['qtdview']);
		$article->setQtdComentario($rs['qtdcomentario']);
		
	}

	// Sobrescrevendo o método filtrar
	public function filtrar($filtro){
		//implementar metodo filtrar no banco de dados
	}

}
?>